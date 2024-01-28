<?php

namespace Campusdigital\CampusCMS\Http\Controllers;

use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Campusdigital\CampusCMS\Mails\EmailVerificationMail;
use App\Models\User;
use Campusdigital\CampusCMS\Models\KategoriUser;
use Campusdigital\CampusCMS\Models\Komisi;
use Campusdigital\CampusCMS\Models\Setting;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Show the application registration form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showRegistrationForm(Request $request)
    {
        // Referal
        referral($request->query('ref'), 'auth.register');

        // Data kategori user
        $kategori = KategoriUser::orderBy('id_ku','desc')->get();

        // View
        return view('auth.'.setting('site.view.register'), [
            'kategori' => $kategori
        ]);
    }

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/member';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'nama_lengkap' => ['required', 'string', 'max:255'],
            'tanggal_lahir' => ['required'],
            'jenis_kelamin' => ['required'],
            'nomor_hp' => ['required', 'numeric'],
            'user_kategori' => ['required'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'username' => ['required', 'string', 'min:6', 'max:255', 'unique:users', 'alpha_dash'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
            'instansi' => ['required']
        ], array_validation_messages());
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {		
		// Create user
		$user = new User;
		$user->nama_user = $data['nama_lengkap'];
		$user->username = $data['username'];
		$user->email = $data['email'];
		$user->password = Hash::make($data['password']);
		$user->tanggal_lahir = generate_date_format($data['tanggal_lahir'], 'y-m-d');
		$user->jenis_kelamin = $data['jenis_kelamin'];
		$user->nomor_hp = $data['nomor_hp'];
		$user->user_kategori = $data['user_kategori'];
		$user->reference = $data['reference'] != null ? $data['reference'] : $data['ref'];
		$user->foto = '';
		$user->role = role('student');
        $user->is_admin = 0;
        $user->status = 0;
		$user->email_verified = 0;
        $user->last_visit = null;
		$user->saldo = 0;
		$user->register_at = date('Y-m-d H:i:s');
        $user->instansi = $data['instansi'];
		$user->save();
		
		// Get data sponsor
		$user_sponsor = User::where('username','=',$data['ref'])->first();
		
		// Create data comission
		$new_user = User::where('username','=',$user->username)->first();
		$komisi = new Komisi;
		$komisi->id_user = $new_user->id_user;
		$komisi->id_sponsor = $user_sponsor->id_user;
		$komisi->komisi_hasil = $user_sponsor->role == role('student') ? setting('site.komisi_student') : setting('site.komisi_trainer');
        $komisi->komisi_aktivasi = setting('site.biaya_aktivasi');
        $komisi->komisi_status = 0;
        $komisi->komisi_proof = '';
		$komisi->masuk_ke_saldo = 0;
		$komisi->komisi_at = null;
        $komisi->inv_komisi = '';
		$komisi->save();

        // Generate invoice
        $new_komisi = Komisi::latest('id_komisi')->first();
        $new_komisi->inv_komisi = generate_invoice($new_komisi->id_komisi, 'KOM');
        $new_komisi->save();
		
		// Send Mail
		Mail::to($user->email)->send(new EmailVerificationMail($user->id_user));
		
		return $user;
    }
}