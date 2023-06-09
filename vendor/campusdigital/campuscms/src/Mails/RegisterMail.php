<?php

namespace Campusdigital\CampusCMS\Mails;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\User;
use Campusdigital\CampusCMS\Models\DefaultRekening;
use Campusdigital\CampusCMS\Models\Komisi;

class RegisterMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * int id pelamar
     * @return void
     */
    public function __construct($user, $komisi)
    {
        $this->user = $user;
        $this->komisi = $komisi;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        // CS
        $cs = User::where('role','=',role('cs'))->first();

		// Get data user
		$user = User::find($this->user);
		
		// Get data komisi
		$komisi = Komisi::find($this->komisi);
		
        // Get data default rekening
        $default_rekening = DefaultRekening::join('platform','default_rekening.id_platform','=','platform.id_platform')->orderBy('tipe_platform','asc')->get();
		
        return $this->from($cs->email, setting('site.name'))->markdown('faturcms::email.register')->subject('Notifikasi Pendaftaran '.setting('site.name'))->with([
            'user' => $user,
			'komisi' => $komisi,
			'default_rekening' => $default_rekening,
        ]);
    }
}
