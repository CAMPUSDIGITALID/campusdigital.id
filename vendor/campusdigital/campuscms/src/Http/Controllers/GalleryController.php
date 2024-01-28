<?php

namespace Campusdigital\CampusCMS\Http\Controllers;

use Auth;
use Campusdigital\CampusCMS\Models\Gallery;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        has_access(generate_method(__METHOD__), Auth::user()->role);

        // Data mentor
        $gallery = Gallery::all();
        
        // View
        return view('faturcms::admin.gallery.index', [
            'gallery' => $gallery,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
                // Check Access
                has_access(generate_method(__METHOD__), Auth::user()->role);

                // View
                return view('faturcms::admin.gallery.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validasi
        $validator = Validator::make($request->all(), [
            'judul_gambar' => 'required',
        ], array_validation_messages());
        
        // Mengecek jika ada error
        if($validator->fails()){
            // Kembali ke halaman sebelumnya dan menampilkan pesan error
            return redirect()->back()->withErrors($validator->errors())->withInput($request->only([
                'judul_gambar',
            ]));
        }
        // Jika tidak ada error
        else{

            // Menambah data
            $gallerys = new Gallery;
            $gallerys->judul_gambar = $request->judul_gambar;
            $gallerys->gambar = name_image($request, 'gambar','assets/images/dokumentasi/');
            $gallerys->save();
        }

        // Redirect
        return redirect()->route('admin.gallery.index')->with(['message' => 'Berhasil menambah data.']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function show(Gallery $gallery)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function edit(Gallery $gallery, Request $request)
    {
                // Check Access
                has_access(generate_method(__METHOD__), Auth::user()->role);

                // Data mentor
                $gallery = Gallery::find($request->id);
        
                // View
                return view('faturcms::admin.gallery.edit', [
                    'data' => $gallery
                ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Gallery $gallery)
    {
        // Validasi
        $validator = Validator::make($request->all(), [
            'judul_gambar' => 'required',
        ], array_validation_messages());
        
        // Mengecek jika ada error
        if($validator->fails()){
            // Kembali ke halaman sebelumnya dan menampilkan pesan error
            return redirect()->back()->withErrors($validator->errors())->withInput($request->only([
                'judul_gambar',
            ]));
        }
        // Jika tidak ada error
        else{
            // Mengupdate data
            $gallerys = Gallery::find($request->id);
            $gallerys->judul_gambar = $request->judul_gambar;
            $gallerys->gambar = $request->gambar != '' ? name_image($request, 'gambar','assets/images/dokumentasi/') : $gallerys->gambar;
            $gallerys->save();
        }

        // Redirect
        return redirect()->route('admin.gallery.index')->with(['message' => 'Berhasil mangupdate data.']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function delete(Gallery $gallery,Request $request)
    {
        // Check Access
        has_access(generate_method(__METHOD__), Auth::user()->role);
        
    	// Menghapus data
        $mentor = Gallery::find($request->id);
        $mentor->delete();

        // Redirect
        return redirect()->route('admin.gallery.index')->with(['message' => 'Berhasil menghapus data.']);
    }

    public function showImages(Request $request)
    {
        echo json_encode(generate_file(public_path('assets/images/gallery'), ['..png']));
    }
}
