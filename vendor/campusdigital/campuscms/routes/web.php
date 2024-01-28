<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Namespace Prefix
$namespacePrefix = '\\'.config('faturcms.controllers.namespace').'\\';

// Guest Capabilities
Route::group(['middleware' => ['campuscms.guest']], function() use ($namespacePrefix){
	// Cek Sertifikat
	Route::get('cek', function(){
		return 'cek apakah masuk';
	});
	Route::get('/check-certificate/{id}', $namespacePrefix.'SertifikatController@check')->name('site.check-certificate');

	// Login
	Route::get('/login', $namespacePrefix.'LoginController@showLoginForm')->name('auth.login');
	Route::post('/login', $namespacePrefix.'LoginController@login')->name('auth.postlogin');

	// Register
	Route::get('/register', $namespacePrefix.'RegisterController@showRegistrationForm')->name('auth.register');
	Route::post('/register', $namespacePrefix.'RegisterController@register')->name('auth.postregister');

	// Verifikasi
	Route::get('/verify', $namespacePrefix.'VerificationController@verify')->name('auth.verify');

	// Lupa Password
	Route::get('/forgot-password', $namespacePrefix.'ForgotPasswordController@showLinkRequestForm')->name('auth.forgotpassword');
	Route::post('/forgot-password', $namespacePrefix.'ForgotPasswordController@sendResetLinkEmail')->name('auth.postforgotpassword');
});

// Admin Capabilities
Route::group(['middleware' => ['campuscms.admin']], function() use ($namespacePrefix){
	// Logout
	Route::post('/admin/logout', $namespacePrefix.'LoginController@logout')->name('admin.logout');

	// Dashboard
	Route::get('/admin', $namespacePrefix.'DashboardController@admin')->name('admin.dashboard');
	
	// Profil
	Route::get('/admin/profile', $namespacePrefix.'UserController@profile')->name('admin.profile');
	Route::get('/admin/profile/edit', $namespacePrefix.'UserController@editProfile')->name('admin.profile.edit');
	Route::post('/admin/profile/update', $namespacePrefix.'UserController@updateProfile')->name('admin.profile.update');

	//gallery
	Route::get('/admin/gallery/',$namespacePrefix. 'GalleryController@index')->name('admin.gallery.index');
	Route::post('/admin/gallery/store',$namespacePrefix. 'GalleryController@store')->name('admin.gallery.store');
	Route::get('/admin/gallery/create',$namespacePrefix. 'GalleryController@create')->name('admin.gallery.create');
	Route::get('/admin/gallery/edit/{id}',$namespacePrefix. 'GalleryController@edit')->name('admin.gallery.edit');
	Route::post('/admin/gallery/update',$namespacePrefix. 'GalleryController@update')->name('admin.gallery.update');
	Route::post('/admin/gallery/delete',$namespacePrefix. 'GalleryController@delete')->name('admin.gallery.delete');
	Route::get('/admin/gallery/images',$namespacePrefix. 'GalleryController@showImages')->name('admin.gallery.images');


	// Package
	Route::get('/admin/sistem/package', $namespacePrefix.'PackageController@index')->name('admin.package.index');
	Route::get('/admin/sistem/package/me', $namespacePrefix.'PackageController@me')->name('admin.package.me');
	Route::get('/admin/sistem/package/update', $namespacePrefix.'PackageController@update')->name('admin.package.update');
	// Route::get('/admin/sistem/package/update-me', $namespacePrefix.'PackageController@updateMe')->name('admin.package.update-me');
	Route::get('/admin/sistem/package/detail', $namespacePrefix.'PackageController@detail')->name('admin.package.detail');

	// Artisan
	Route::get('/admin/sistem/artisan', $namespacePrefix.'ArtisanController@index')->name('admin.artisan.index');
	Route::post('/admin/sistem/artisan/call', $namespacePrefix.'ArtisanController@call')->name('admin.artisan.call');

	// User
	Route::get('/admin/user', $namespacePrefix.'UserController@index')->name('admin.user.index');
	Route::get('/admin/user/data', $namespacePrefix.'UserController@data')->name('admin.user.data');
	Route::get('/admin/user/create', $namespacePrefix.'UserController@create')->name('admin.user.create');
	Route::post('/admin/user/store', $namespacePrefix.'UserController@store')->name('admin.user.store');
	Route::get('/admin/user/detail/{id}', $namespacePrefix.'UserController@detail')->name('admin.user.detail');
	Route::get('/admin/user/edit/{id}', $namespacePrefix.'UserController@edit')->name('admin.user.edit');
	Route::post('/admin/user/update', $namespacePrefix.'UserController@update')->name('admin.user.update');
	Route::post('/admin/user/updateref', $namespacePrefix.'UserController@updateref')->name('admin.user.updateref');
	Route::post('/admin/user/delete', $namespacePrefix.'UserController@delete')->name('admin.user.delete');
	Route::get('/admin/user/refer/{id}', $namespacePrefix.'UserController@refer')->name('admin.user.refer');
	Route::get('/admin/user/refer/{id}/{idref}', $namespacePrefix.'UserController@referid')->name('admin.user.referid');
	Route::get('/admin/user/export', $namespacePrefix.'UserController@export')->name('admin.user.export');
	Route::post('/admin/user/import', $namespacePrefix.'UserController@import')->name('admin.user.import');
	Route::post('/admin/user/update-photo', $namespacePrefix.'UserController@updatePhoto')->name('admin.user.updatephoto');
	Route::get('/admin/user/images', $namespacePrefix.'UserController@showImages')->name('admin.user.images');
	Route::post('/admin/user/active', $namespacePrefix.'UserController@active')->name('admin.user.active');

	// Kategori User
	Route::get('/admin/user/kategori', $namespacePrefix.'KategoriUserController@index')->name('admin.user.kategori.index');
	Route::get('/admin/user/kategori/create', $namespacePrefix.'KategoriUserController@create')->name('admin.user.kategori.create');
	Route::post('/admin/user/kategori/store', $namespacePrefix.'KategoriUserController@store')->name('admin.user.kategori.store');
	Route::get('/admin/user/kategori/detail/{id}', $namespacePrefix.'KategoriUserController@detail')->name('admin.user.kategori.detail');
	Route::get('/admin/user/kategori/edit/{id}', $namespacePrefix.'KategoriUserController@edit')->name('admin.user.kategori.edit');
	Route::post('/admin/user/kategori/update', $namespacePrefix.'KategoriUserController@update')->name('admin.user.kategori.update');
	Route::post('/admin/user/kategori/delete', $namespacePrefix.'KategoriUserController@delete')->name('admin.user.kategori.delete');

	// Kelompok User
	Route::get('/admin/user/kelompok', $namespacePrefix.'KelompokController@index')->name('admin.user.kelompok.index');
	Route::get('/admin/user/kelompok/create', $namespacePrefix.'KelompokController@create')->name('admin.user.kelompok.create');
	Route::post('/admin/user/kelompok/store', $namespacePrefix.'KelompokController@store')->name('admin.user.kelompok.store');
	Route::get('/admin/user/kelompok/detail/{id}', $namespacePrefix.'KelompokController@detail')->name('admin.user.kelompok.detail');
	Route::get('/admin/user/kelompok/edit/{id}', $namespacePrefix.'KelompokController@edit')->name('admin.user.kelompok.edit');
	Route::post('/admin/user/kelompok/update', $namespacePrefix.'KelompokController@update')->name('admin.user.kelompok.update');
	Route::post('/admin/user/kelompok/delete', $namespacePrefix.'KelompokController@delete')->name('admin.user.kelompok.delete');

	// Rekening
	Route::get('/admin/rekening', $namespacePrefix.'RekeningController@index')->name('admin.rekening.index');
	Route::get('/admin/rekening/create', $namespacePrefix.'RekeningController@create')->name('admin.rekening.create');
	Route::post('/admin/rekening/store', $namespacePrefix.'RekeningController@store')->name('admin.rekening.store');
	Route::get('/admin/rekening/edit/{id}', $namespacePrefix.'RekeningController@edit')->name('admin.rekening.edit');
	Route::post('/admin/rekening/update', $namespacePrefix.'RekeningController@update')->name('admin.rekening.update');
	Route::post('/admin/rekening/delete', $namespacePrefix.'RekeningController@delete')->name('admin.rekening.delete');

	// Platform
	Route::get('/admin/platform', $namespacePrefix.'PlatformController@index')->name('admin.platform.index');
	Route::get('/admin/platform/create', $namespacePrefix.'PlatformController@create')->name('admin.platform.create');
	Route::post('/admin/platform/store', $namespacePrefix.'PlatformController@store')->name('admin.platform.store');
	Route::get('/admin/platform/edit/{id}', $namespacePrefix.'PlatformController@edit')->name('admin.platform.edit');
	Route::post('/admin/platform/update', $namespacePrefix.'PlatformController@update')->name('admin.platform.update');
	Route::post('/admin/platform/delete', $namespacePrefix.'PlatformController@delete')->name('admin.platform.delete');

	// Default Rekening
	Route::get('/admin/default-rekening', $namespacePrefix.'DefaultRekeningController@index')->name('admin.default-rekening.index');
	Route::get('/admin/default-rekening/create', $namespacePrefix.'DefaultRekeningController@create')->name('admin.default-rekening.create');
	Route::post('/admin/default-rekening/store', $namespacePrefix.'DefaultRekeningController@store')->name('admin.default-rekening.store');
	Route::get('/admin/default-rekening/edit/{id}', $namespacePrefix.'DefaultRekeningController@edit')->name('admin.default-rekening.edit');
	Route::post('/admin/default-rekening/update', $namespacePrefix.'DefaultRekeningController@update')->name('admin.default-rekening.update');
	Route::post('/admin/default-rekening/delete', $namespacePrefix.'DefaultRekeningController@delete')->name('admin.default-rekening.delete');

	// Transaksi Komisi
	Route::get('/admin/transaksi/komisi', $namespacePrefix.'KomisiController@index')->name('admin.komisi.index');
	Route::get('/admin/transaksi/komisi/data', $namespacePrefix.'KomisiController@data')->name('admin.komisi.data');
	Route::post('/admin/transaksi/komisi/verify', $namespacePrefix.'KomisiController@verify')->name('admin.komisi.verify');
	Route::post('/admin/transaksi/komisi/confirm', $namespacePrefix.'KomisiController@confirm')->name('admin.komisi.confirm');

	// Transaksi Withdrawal
	Route::get('/admin/transaksi/withdrawal', $namespacePrefix.'WithdrawalController@index')->name('admin.withdrawal.index');
	Route::post('/admin/transaksi/withdrawal/send', $namespacePrefix.'WithdrawalController@send')->name('admin.withdrawal.send');

	// Transaksi Pelatihan
	Route::get('/admin/transaksi/pelatihan', $namespacePrefix.'PelatihanController@transaction')->name('admin.pelatihan.transaction');
	Route::get('/admin/transaksi/pelatihan/data', $namespacePrefix.'PelatihanController@dataTransaction')->name('admin.pelatihan.transaction.data');
	Route::post('/admin/transaksi/pelatihan/verify', $namespacePrefix.'PelatihanController@verify')->name('admin.pelatihan.verify');

	// Email
	Route::get('/admin/email', $namespacePrefix.'EmailController@index')->name('admin.email.index');
	Route::get('/admin/email/data', $namespacePrefix.'EmailController@data')->name('admin.email.data');
	Route::get('/admin/email/create', $namespacePrefix.'EmailController@create')->name('admin.email.create');
	Route::post('/admin/email/store', $namespacePrefix.'EmailController@store')->name('admin.email.store');
	Route::post('/admin/email/forward', $namespacePrefix.'EmailController@forward')->name('admin.email.forward');
	Route::post('/admin/email/schedule', $namespacePrefix.'EmailController@schedule')->name('admin.email.schedule');
	Route::get('/admin/email/detail/{id}', $namespacePrefix.'EmailController@detail')->name('admin.email.detail');
	Route::post('/admin/email/delete', $namespacePrefix.'EmailController@delete')->name('admin.email.delete');
	Route::post('/admin/email/import', $namespacePrefix.'EmailController@import')->name('admin.email.import');
	Route::get('/admin/email/member-json', $namespacePrefix.'EmailController@memberJson')->name('admin.email.member-json');

	// Halaman
	Route::get('/admin/halaman', $namespacePrefix.'HalamanController@index')->name('admin.halaman.index');
	Route::get('/admin/halaman/create', $namespacePrefix.'HalamanController@create')->name('admin.halaman.create');
	Route::post('/admin/halaman/store', $namespacePrefix.'HalamanController@store')->name('admin.halaman.store');
	Route::get('/admin/halaman/edit/{id}', $namespacePrefix.'HalamanController@edit')->name('admin.halaman.edit');
	Route::post('/admin/halaman/update', $namespacePrefix.'HalamanController@update')->name('admin.halaman.update');
	Route::post('/admin/halaman/delete', $namespacePrefix.'HalamanController@delete')->name('admin.halaman.delete');

	// File Manager
	Route::get('/admin/file-manager/{kategori}', $namespacePrefix.'FileController@index')->name('admin.filemanager.index');

	// File
	Route::get('/admin/file-manager/{kategori}/file/create', $namespacePrefix.'FileController@create')->name('admin.file.create');
	Route::post('/admin/file-manager/{kategori}/file/store', $namespacePrefix.'FileController@store')->name('admin.file.store');
	Route::get('/admin/file-manager/{kategori}/file/detail/{id}', $namespacePrefix.'FileController@detail')->name('admin.file.detail');
	Route::get('/admin/file-manager/{kategori}/file/edit/{id}', $namespacePrefix.'FileController@edit')->name('admin.file.edit');
	Route::post('/admin/file-manager/{kategori}/file/update', $namespacePrefix.'FileController@update')->name('admin.file.update');
	Route::post('/admin/file-manager/{kategori}/file/delete', $namespacePrefix.'FileController@delete')->name('admin.file.delete');
	Route::post('/admin/file-manager/{kategori}/file/move', $namespacePrefix.'FileController@move')->name('admin.file.move');
	Route::post('/admin/file-manager/{kategori}/file/upload-pdf', $namespacePrefix.'FileController@uploadPDF')->name('admin.file.uploadpdf');
	Route::post('/admin/file-manager/{kategori}/file/upload-tools', $namespacePrefix.'FileController@uploadTools')->name('admin.file.uploadtools');
	Route::get('/admin/file/images', $namespacePrefix.'FileController@showImages')->name('admin.file.images');

	// Folder
	Route::get('/admin/file-manager/{kategori}/folder/create', $namespacePrefix.'FolderController@create')->name('admin.folder.create');
	Route::post('/admin/file-manager/{kategori}/folder/store', $namespacePrefix.'FolderController@store')->name('admin.folder.store');
	Route::get('/admin/file-manager/{kategori}/folder/edit/{id}', $namespacePrefix.'FolderController@edit')->name('admin.folder.edit');
	Route::post('/admin/file-manager/{kategori}/folder/update', $namespacePrefix.'FolderController@update')->name('admin.folder.update');
	Route::post('/admin/file-manager/{kategori}/folder/delete', $namespacePrefix.'FolderController@delete')->name('admin.folder.delete');
	Route::post('/admin/file-manager/{kategori}/folder/move', $namespacePrefix.'FolderController@move')->name('admin.folder.move');
	Route::get('/admin/folder/images', $namespacePrefix.'FolderController@showImages')->name('admin.folder.images');

	// Kategori Folder
	Route::get('/admin/folder/kategori', $namespacePrefix.'FolderKategoriController@index')->name('admin.folder.kategori.index');
	Route::get('/admin/folder/kategori/create', $namespacePrefix.'FolderKategoriController@create')->name('admin.folder.kategori.create');
	Route::post('/admin/folder/kategori/store', $namespacePrefix.'FolderKategoriController@store')->name('admin.folder.kategori.store');
	Route::get('/admin/folder/kategori/edit/{id}', $namespacePrefix.'FolderKategoriController@edit')->name('admin.folder.kategori.edit');
	Route::post('/admin/folder/kategori/update', $namespacePrefix.'FolderKategoriController@update')->name('admin.folder.kategori.update');
	Route::post('/admin/folder/kategori/delete', $namespacePrefix.'FolderKategoriController@delete')->name('admin.folder.kategori.delete');
	Route::post('/admin/folder/kategori/sort', $namespacePrefix.'FolderKategoriController@sorting')->name('admin.folder.kategori.sort');

	// Artikel
	Route::get('/admin/blog', $namespacePrefix.'BlogController@index')->name('admin.blog.index');
	Route::get('/admin/blog/create', $namespacePrefix.'BlogController@create')->name('admin.blog.create');
	Route::post('/admin/blog/store', $namespacePrefix.'BlogController@store')->name('admin.blog.store');
	Route::get('/admin/blog/edit/{id}', $namespacePrefix.'BlogController@edit')->name('admin.blog.edit');
	Route::post('/admin/blog/update', $namespacePrefix.'BlogController@update')->name('admin.blog.update');
	Route::post('/admin/blog/delete', $namespacePrefix.'BlogController@delete')->name('admin.blog.delete');
	Route::get('/admin/blog/images', $namespacePrefix.'BlogController@showImages')->name('admin.blog.images');

	// Kategori Artikel
	Route::get('/admin/blog/kategori', $namespacePrefix.'KategoriArtikelController@index')->name('admin.blog.kategori.index');
	Route::get('/admin/blog/kategori/create', $namespacePrefix.'KategoriArtikelController@create')->name('admin.blog.kategori.create');
	Route::post('/admin/blog/kategori/store', $namespacePrefix.'KategoriArtikelController@store')->name('admin.blog.kategori.store');
	Route::get('/admin/blog/kategori/edit/{id}', $namespacePrefix.'KategoriArtikelController@edit')->name('admin.blog.kategori.edit');
	Route::post('/admin/blog/kategori/update', $namespacePrefix.'KategoriArtikelController@update')->name('admin.blog.kategori.update');
	Route::post('/admin/blog/kategori/delete', $namespacePrefix.'KategoriArtikelController@delete')->name('admin.blog.kategori.delete');

	// Tag Artikel
	Route::get('/admin/blog/tag', $namespacePrefix.'TagController@index')->name('admin.blog.tag.index');
	Route::get('/admin/blog/tag/create', $namespacePrefix.'TagController@create')->name('admin.blog.tag.create');
	Route::post('/admin/blog/tag/store', $namespacePrefix.'TagController@store')->name('admin.blog.tag.store');
	Route::get('/admin/blog/tag/edit/{id}', $namespacePrefix.'TagController@edit')->name('admin.blog.tag.edit');
	Route::post('/admin/blog/tag/update', $namespacePrefix.'TagController@update')->name('admin.blog.tag.update');
	Route::post('/admin/blog/tag/delete', $namespacePrefix.'TagController@delete')->name('admin.blog.tag.delete');

	// Kontributor Artikel
	Route::get('/admin/blog/kontributor', $namespacePrefix.'KontributorController@index')->name('admin.blog.kontributor.index');
	Route::get('/admin/blog/kontributor/create', $namespacePrefix.'KontributorController@create')->name('admin.blog.kontributor.create');
	Route::post('/admin/blog/kontributor/store', $namespacePrefix.'KontributorController@store')->name('admin.blog.kontributor.store');
	Route::get('/admin/blog/kontributor/edit/{id}', $namespacePrefix.'KontributorController@edit')->name('admin.blog.kontributor.edit');
	Route::post('/admin/blog/kontributor/update', $namespacePrefix.'KontributorController@update')->name('admin.blog.kontributor.update');
	Route::post('/admin/blog/kontributor/delete', $namespacePrefix.'KontributorController@delete')->name('admin.blog.kontributor.delete');

	// Acara
	Route::get('/admin/acara', $namespacePrefix.'AcaraController@index')->name('admin.acara.index');
	Route::get('/admin/acara/create', $namespacePrefix.'AcaraController@create')->name('admin.acara.create');
	Route::post('/admin/acara/store', $namespacePrefix.'AcaraController@store')->name('admin.acara.store');
	Route::get('/admin/acara/detail/{id}', $namespacePrefix.'AcaraController@detail')->name('admin.acara.detail');
	Route::get('/admin/acara/edit/{id}', $namespacePrefix.'AcaraController@edit')->name('admin.acara.edit');
	Route::post('/admin/acara/update', $namespacePrefix.'AcaraController@update')->name('admin.acara.update');
	Route::post('/admin/acara/delete', $namespacePrefix.'AcaraController@delete')->name('admin.acara.delete');
	Route::get('/admin/acara/images', $namespacePrefix.'AcaraController@showImages')->name('admin.acara.images');

	// Kategori Acara
	Route::get('/admin/acara/kategori', $namespacePrefix.'KategoriAcaraController@index')->name('admin.acara.kategori.index');
	Route::get('/admin/acara/kategori/create', $namespacePrefix.'KategoriAcaraController@create')->name('admin.acara.kategori.create');
	Route::post('/admin/acara/kategori/store', $namespacePrefix.'KategoriAcaraController@store')->name('admin.acara.kategori.store');
	Route::get('/admin/acara/kategori/edit/{id}', $namespacePrefix.'KategoriAcaraController@edit')->name('admin.acara.kategori.edit');
	Route::post('/admin/acara/kategori/update', $namespacePrefix.'KategoriAcaraController@update')->name('admin.acara.kategori.update');
	Route::post('/admin/acara/kategori/delete', $namespacePrefix.'KategoriAcaraController@delete')->name('admin.acara.kategori.delete');

	// Program
	Route::get('/admin/program', $namespacePrefix.'ProgramController@index')->name('admin.program.index');
	Route::get('/admin/program/create', $namespacePrefix.'ProgramController@create')->name('admin.program.create');
	Route::post('/admin/program/store', $namespacePrefix.'ProgramController@store')->name('admin.program.store');
	Route::get('/admin/program/edit/{id}', $namespacePrefix.'ProgramController@edit')->name('admin.program.edit');
	Route::post('/admin/program/update', $namespacePrefix.'ProgramController@update')->name('admin.program.update');
	Route::post('/admin/program/delete', $namespacePrefix.'ProgramController@delete')->name('admin.program.delete');
	Route::get('/admin/program/images', $namespacePrefix.'ProgramController@showImages')->name('admin.program.images');

	// Kategori Program
	Route::get('/admin/program/kategori', $namespacePrefix.'KategoriProgramController@index')->name('admin.program.kategori.index');
	Route::get('/admin/program/kategori/create', $namespacePrefix.'KategoriProgramController@create')->name('admin.program.kategori.create');
	Route::post('/admin/program/kategori/store', $namespacePrefix.'KategoriProgramController@store')->name('admin.program.kategori.store');
	Route::get('/admin/program/kategori/edit/{id}', $namespacePrefix.'KategoriProgramController@edit')->name('admin.program.kategori.edit');
	Route::post('/admin/program/kategori/update', $namespacePrefix.'KategoriProgramController@update')->name('admin.program.kategori.update');
	Route::post('/admin/program/kategori/delete', $namespacePrefix.'KategoriProgramController@delete')->name('admin.program.kategori.delete');

	// Pelatihan
	Route::get('/admin/pelatihan', $namespacePrefix.'PelatihanController@index')->name('admin.pelatihan.index');
	Route::get('/admin/pelatihan/create', $namespacePrefix.'PelatihanController@create')->name('admin.pelatihan.create');
	Route::post('/admin/pelatihan/store', $namespacePrefix.'PelatihanController@store')->name('admin.pelatihan.store');
	Route::get('/admin/pelatihan/detail/{id}', $namespacePrefix.'PelatihanController@detail')->name('admin.pelatihan.detail');
	Route::get('/admin/pelatihan/edit/{id}', $namespacePrefix.'PelatihanController@edit')->name('admin.pelatihan.edit');
	Route::post('/admin/pelatihan/update', $namespacePrefix.'PelatihanController@update')->name('admin.pelatihan.update');
	Route::post('/admin/pelatihan/delete', $namespacePrefix.'PelatihanController@delete')->name('admin.pelatihan.delete');
	Route::post('/admin/pelatihan/duplicate', $namespacePrefix.'PelatihanController@duplicate')->name('admin.pelatihan.duplicate');
	Route::get('/admin/pelatihan/peserta/{id}', $namespacePrefix.'PelatihanController@participant')->name('admin.pelatihan.participant');
	Route::post('/admin/pelatihan/update-status', $namespacePrefix.'PelatihanController@updateStatus')->name('admin.pelatihan.updatestatus');
	Route::get('/admin/pelatihan/images', $namespacePrefix.'PelatihanController@showImages')->name('admin.pelatihan.images');

	// Kategori Pelatihan
	Route::get('/admin/pelatihan/kategori', $namespacePrefix.'KategoriPelatihanController@index')->name('admin.pelatihan.kategori.index');
	Route::get('/admin/pelatihan/kategori/create', $namespacePrefix.'KategoriPelatihanController@create')->name('admin.pelatihan.kategori.create');
	Route::post('/admin/pelatihan/kategori/store', $namespacePrefix.'KategoriPelatihanController@store')->name('admin.pelatihan.kategori.store');
	Route::get('/admin/pelatihan/kategori/edit/{id}', $namespacePrefix.'KategoriPelatihanController@edit')->name('admin.pelatihan.kategori.edit');
	Route::post('/admin/pelatihan/kategori/update', $namespacePrefix.'KategoriPelatihanController@update')->name('admin.pelatihan.kategori.update');
	Route::post('/admin/pelatihan/kategori/delete', $namespacePrefix.'KategoriPelatihanController@delete')->name('admin.pelatihan.kategori.delete');

	// Karir
	Route::get('/admin/karir', $namespacePrefix.'KarirController@index')->name('admin.karir.index');
	Route::get('/admin/karir/create', $namespacePrefix.'KarirController@create')->name('admin.karir.create');
	Route::post('/admin/karir/store', $namespacePrefix.'KarirController@store')->name('admin.karir.store');
	Route::get('/admin/karir/edit/{id}', $namespacePrefix.'KarirController@edit')->name('admin.karir.edit');
	Route::post('/admin/karir/update', $namespacePrefix.'KarirController@update')->name('admin.karir.update');
	Route::post('/admin/karir/delete', $namespacePrefix.'KarirController@delete')->name('admin.karir.delete');
	Route::get('/admin/karir/images', $namespacePrefix.'KarirController@showImages')->name('admin.karir.images');

	// Psikolog
	Route::get('/admin/psikolog', $namespacePrefix.'PsikologController@index')->name('admin.psikolog.index');
	Route::get('/admin/psikolog/create', $namespacePrefix.'PsikologController@create')->name('admin.psikolog.create');
	Route::post('/admin/psikolog/store', $namespacePrefix.'PsikologController@store')->name('admin.psikolog.store');
	Route::get('/admin/psikolog/edit/{id}', $namespacePrefix.'PsikologController@edit')->name('admin.psikolog.edit');
	Route::post('/admin/psikolog/update', $namespacePrefix.'PsikologController@update')->name('admin.psikolog.update');
	Route::post('/admin/psikolog/delete', $namespacePrefix.'PsikologController@delete')->name('admin.psikolog.delete');

	// Pop-Up
	Route::get('/admin/pop-up', $namespacePrefix.'PopupController@index')->name('admin.pop-up.index');
	Route::get('/admin/pop-up/create', $namespacePrefix.'PopupController@create')->name('admin.pop-up.create');
	Route::post('/admin/pop-up/store', $namespacePrefix.'PopupController@store')->name('admin.pop-up.store');
	Route::get('/admin/pop-up/detail/{id}', $namespacePrefix.'PopupController@detail')->name('admin.pop-up.detail');
	Route::get('/admin/pop-up/edit/{id}', $namespacePrefix.'PopupController@edit')->name('admin.pop-up.edit');
	Route::post('/admin/pop-up/update', $namespacePrefix.'PopupController@update')->name('admin.pop-up.update');
	Route::post('/admin/pop-up/delete', $namespacePrefix.'PopupController@delete')->name('admin.pop-up.delete');

	// Sertifikat
	Route::get('/admin/e-sertifikat/trainer', $namespacePrefix.'SertifikatController@indexTrainer')->name('admin.sertifikat.trainer.index');
	Route::get('/admin/e-sertifikat/trainer/detail/{id}', $namespacePrefix.'SertifikatController@detailTrainer')->name('admin.sertifikat.trainer.detail');
	Route::get('/admin/e-sertifikat/peserta', $namespacePrefix.'SertifikatController@indexParticipant')->name('admin.sertifikat.peserta.index');
	Route::get('/admin/e-sertifikat/peserta/data', $namespacePrefix.'SertifikatController@dataParticipant')->name('admin.sertifikat.peserta.data');
	Route::get('/admin/e-sertifikat/peserta/detail/{id}', $namespacePrefix.'SertifikatController@detailParticipant')->name('admin.sertifikat.peserta.detail');
	Route::post('/admin/e-sertifikat/peserta/delete', $namespacePrefix.'SertifikatController@delete')->name('admin.sertifikat.peserta.delete');

	// Slider
	Route::get('/admin/slider', $namespacePrefix.'SliderController@index')->name('admin.slider.index');
	Route::get('/admin/slider/create', $namespacePrefix.'SliderController@create')->name('admin.slider.create');
	Route::post('/admin/slider/store', $namespacePrefix.'SliderController@store')->name('admin.slider.store');
	Route::get('/admin/slider/edit/{id}', $namespacePrefix.'SliderController@edit')->name('admin.slider.edit');
	Route::post('/admin/slider/update', $namespacePrefix.'SliderController@update')->name('admin.slider.update');
	Route::post('/admin/slider/delete', $namespacePrefix.'SliderController@delete')->name('admin.slider.delete');
	Route::post('/admin/slider/sort', $namespacePrefix.'SliderController@sorting')->name('admin.slider.sort');
	Route::get('/admin/slider/images', $namespacePrefix.'SliderController@showImages')->name('admin.slider.images');

	// Slider
	Route::get('/admin/deskripsi', $namespacePrefix.'DeskripsiController@index')->name('admin.deskripsi.index');
	Route::post('/admin/deskripsi/update', $namespacePrefix.'DeskripsiController@update')->name('admin.deskripsi.update');

	// Fitur
	Route::get('/admin/fitur', $namespacePrefix.'FiturController@index')->name('admin.fitur.index');
	Route::get('/admin/fitur/create', $namespacePrefix.'FiturController@create')->name('admin.fitur.create');
	Route::post('/admin/fitur/store', $namespacePrefix.'FiturController@store')->name('admin.fitur.store');
	Route::get('/admin/fitur/edit/{id}', $namespacePrefix.'FiturController@edit')->name('admin.fitur.edit');
	Route::post('/admin/fitur/update', $namespacePrefix.'FiturController@update')->name('admin.fitur.update');
	Route::post('/admin/fitur/delete', $namespacePrefix.'FiturController@delete')->name('admin.fitur.delete');
	Route::post('/admin/fitur/sort', $namespacePrefix.'FiturController@sorting')->name('admin.fitur.sort');
	Route::get('/admin/fitur/images', $namespacePrefix.'FiturController@showImages')->name('admin.fitur.images');

	// Mitra
	Route::get('/admin/mitra', $namespacePrefix.'MitraController@index')->name('admin.mitra.index');
	Route::get('/admin/mitra/create', $namespacePrefix.'MitraController@create')->name('admin.mitra.create');
	Route::post('/admin/mitra/store', $namespacePrefix.'MitraController@store')->name('admin.mitra.store');
	Route::get('/admin/mitra/edit/{id}', $namespacePrefix.'MitraController@edit')->name('admin.mitra.edit');
	Route::post('/admin/mitra/update', $namespacePrefix.'MitraController@update')->name('admin.mitra.update');
	Route::post('/admin/mitra/delete', $namespacePrefix.'MitraController@delete')->name('admin.mitra.delete');
	Route::post('/admin/mitra/sort', $namespacePrefix.'MitraController@sorting')->name('admin.mitra.sort');
	Route::get('/admin/mitra/images', $namespacePrefix.'MitraController@showImages')->name('admin.mitra.images');

	// Cabang
	Route::get('/admin/cabang', $namespacePrefix.'CabangController@index')->name('admin.cabang.index');
	Route::get('/admin/cabang/create', $namespacePrefix.'CabangController@create')->name('admin.cabang.create');
	Route::post('/admin/cabang/store', $namespacePrefix.'CabangController@store')->name('admin.cabang.store');
	Route::get('/admin/cabang/edit/{id}', $namespacePrefix.'CabangController@edit')->name('admin.cabang.edit');
	Route::post('/admin/cabang/update', $namespacePrefix.'CabangController@update')->name('admin.cabang.update');
	Route::post('/admin/cabang/delete', $namespacePrefix.'CabangController@delete')->name('admin.cabang.delete');

	// Mentor
	Route::get('/admin/mentor', $namespacePrefix.'MentorController@index')->name('admin.mentor.index');
	Route::get('/admin/mentor/create', $namespacePrefix.'MentorController@create')->name('admin.mentor.create');
	Route::post('/admin/mentor/store', $namespacePrefix.'MentorController@store')->name('admin.mentor.store');
	Route::get('/admin/mentor/edit/{id}', $namespacePrefix.'MentorController@edit')->name('admin.mentor.edit');
	Route::post('/admin/mentor/update', $namespacePrefix.'MentorController@update')->name('admin.mentor.update');
	Route::post('/admin/mentor/delete', $namespacePrefix.'MentorController@delete')->name('admin.mentor.delete');
	Route::post('/admin/mentor/sort', $namespacePrefix.'MentorController@sorting')->name('admin.mentor.sort');
	Route::get('/admin/mentor/images', $namespacePrefix.'MentorController@showImages')->name('admin.mentor.images');

	// Testimoni
	Route::get('/admin/testimoni', $namespacePrefix.'TestimoniController@index')->name('admin.testimoni.index');
	Route::get('/admin/testimoni/create', $namespacePrefix.'TestimoniController@create')->name('admin.testimoni.create');
	Route::post('/admin/testimoni/store', $namespacePrefix.'TestimoniController@store')->name('admin.testimoni.store');
	Route::get('/admin/testimoni/edit/{id}', $namespacePrefix.'TestimoniController@edit')->name('admin.testimoni.edit');
	Route::post('/admin/testimoni/update', $namespacePrefix.'TestimoniController@update')->name('admin.testimoni.update');
	Route::post('/admin/testimoni/delete', $namespacePrefix.'TestimoniController@delete')->name('admin.testimoni.delete');
	Route::post('/admin/testimoni/sort', $namespacePrefix.'TestimoniController@sorting')->name('admin.testimoni.sort');
	Route::get('/admin/testimoni/images', $namespacePrefix.'TestimoniController@showImages')->name('admin.testimoni.images');

	// Tandatangan Digital
	Route::get('/admin/e-signature', $namespacePrefix.'SignatureController@index')->name('admin.signature.index');
	Route::get('/admin/e-signature/input', $namespacePrefix.'SignatureController@input')->name('admin.signature.input');
	Route::post('/admin/e-signature/update', $namespacePrefix.'SignatureController@update')->name('admin.signature.update');
	Route::post('/admin/e-signature/delete', $namespacePrefix.'SignatureController@delete')->name('admin.signature.delete');

	// Absensi
	Route::get('/admin/absensi', $namespacePrefix.'AbsensiController@index')->name('admin.absensi.index');
	Route::post('/admin/absensi/delete', $namespacePrefix.'AbsensiController@delete')->name('admin.absensi.delete');
	Route::get('/admin/absensi/export', $namespacePrefix.'AbsensiController@export')->name('admin.absensi.export');

	// Role
	Route::get('/admin/role', $namespacePrefix.'RoleController@index')->name('admin.role.index');
	Route::get('/admin/role/edit/{id}', $namespacePrefix.'RoleController@edit')->name('admin.role.edit');
	Route::post('/admin/role/update', $namespacePrefix.'RoleController@update')->name('admin.role.update');

	// Role Permission
	Route::get('/admin/role-permission', $namespacePrefix.'RolePermissionController@index')->name('admin.rolepermission.index');
	Route::post('/admin/role-permission/update-access', $namespacePrefix.'RolePermissionController@update')->name('admin.rolepermission.update');

	// Permission
	Route::get('/admin/role-permission/create', $namespacePrefix.'PermissionController@create')->name('admin.permission.create');
	Route::post('/admin/role-permission/store', $namespacePrefix.'PermissionController@store')->name('admin.permission.store');
	Route::get('/admin/role-permission/edit/{id}', $namespacePrefix.'PermissionController@edit')->name('admin.permission.edit');
	Route::post('/admin/role-permission/update', $namespacePrefix.'PermissionController@update')->name('admin.permission.update');
	Route::post('/admin/role-permission/delete', $namespacePrefix.'PermissionController@delete')->name('admin.permission.delete');
	Route::post('/admin/role-permission/sort', $namespacePrefix.'PermissionController@sorting')->name('admin.permission.sort');

	// Setting
	Route::get('/admin/setting', $namespacePrefix.'SettingController@index')->name('admin.setting.index');
	Route::get('/admin/setting/{category}', $namespacePrefix.'SettingController@edit')->name('admin.setting.edit');
	Route::post('/admin/setting/{category}/update', $namespacePrefix.'SettingController@update')->name('admin.setting.update');

	// Icon
	Route::get('/admin/logo/images', $namespacePrefix.'SettingController@showLogos')->name('admin.logo.images');
	Route::get('/admin/icon/images', $namespacePrefix.'SettingController@showIcons')->name('admin.icon.images');

	// Statistik
	Route::get('/admin/statistik/member', $namespacePrefix.'StatistikController@member')->name('admin.statistik.member');
	Route::get('/admin/statistik/device', $namespacePrefix.'StatistikController@device')->name('admin.statistik.device');
	Route::get('/admin/statistik/location', $namespacePrefix.'StatistikController@location')->name('admin.statistik.location');
	Route::get('/admin/statistik/finance', $namespacePrefix.'StatistikController@finance')->name('admin.statistik.finance');
	Route::get('/admin/statistik/by-tanggal', $namespacePrefix.'StatistikController@byTanggal')->name('admin.statistik.by-tanggal');
	Route::get('/admin/statistik/by-kelompok', $namespacePrefix.'StatistikController@byKelompok')->name('admin.statistik.by-kelompok');

	// Visitor
	Route::get('/admin/visitor', $namespacePrefix.'VisitorController@index')->name('admin.visitor.index');
	Route::get('/admin/visitor/top', $namespacePrefix.'VisitorController@topVisitor')->name('admin.visitor.top');
	Route::get('/admin/visitor/top/data', $namespacePrefix.'VisitorController@dataTopVisitor')->name('admin.visitor.top.data');
	Route::post('/admin/visitor/info', $namespacePrefix.'VisitorController@info')->name('admin.visitor.info');
	// Route::get('/admin/visitor/update-location', $namespacePrefix.'VisitorController@updateLocation')->name('admin.visitor.update-location');

	// Media
	Route::get('/admin/media', $namespacePrefix.'MediaController@index')->name('admin.media.index');
	Route::get('/admin/media/detail', $namespacePrefix.'MediaController@detail')->name('admin.media.detail');
	Route::post('/admin/media/delete', $namespacePrefix.'MediaController@delete')->name('admin.media.delete');
	Route::post('/admin/media/delete-batch', $namespacePrefix.'MediaController@deleteBatch')->name('admin.media.delete-batch');

	// Log Aktivitas
	Route::get('/admin/log', $namespacePrefix.'LogController@index')->name('admin.log.index');
	Route::get('/admin/log/activity/{id}', $namespacePrefix.'LogController@activity')->name('admin.log.activity');
	Route::get('/admin/log/activity-get/{id}', $namespacePrefix.'LogController@getActivity')->name('admin.log.activity.get');
	Route::post('/admin/log/activity-delete', $namespacePrefix.'LogController@deleteActivity')->name('admin.log.activity.delete');
	Route::get('/admin/log/login-error', $namespacePrefix.'LogController@login')->name('admin.log.login');

	// Report
	Route::get('/admin/report', $namespacePrefix.'ReportController@index')->name('admin.report.index');

	/* API Controllers */

	// API Visitor
	Route::get('/admin/api/visitor/count/last-week', $namespacePrefix.'API\VisitorController@visitorLastWeek')->name('api.visitor.count.last-week');
	Route::get('/admin/api/visitor/count/last-month', $namespacePrefix.'API\VisitorController@visitorLastMonth')->name('api.visitor.count.last-month');
	Route::get('/admin/api/visitor/top/last-week', $namespacePrefix.'API\VisitorController@topVisitorLastWeek')->name('api.visitor.top.last-week');
	Route::get('/admin/api/visitor/top/last-month', $namespacePrefix.'API\VisitorController@topVisitorLastMonth')->name('api.visitor.top.last-month');

	// API Member
	Route::get('/admin/api/member/status', $namespacePrefix.'API\MemberController@memberStatus')->name('api.member.status');
	Route::get('/admin/api/member/gender', $namespacePrefix.'API\MemberController@memberGender')->name('api.member.gender');
	Route::get('/admin/api/member/age', $namespacePrefix.'API\MemberController@memberAge')->name('api.member.age');

	// API Visitor Device
	Route::get('/admin/api/visitor/device', $namespacePrefix.'API\VisitorDeviceController@visitorDevice')->name('api.visitor.device');
	Route::get('/admin/api/visitor/browser', $namespacePrefix.'API\VisitorDeviceController@visitorBrowser')->name('api.visitor.browser');
	Route::get('/admin/api/visitor/platform', $namespacePrefix.'API\VisitorDeviceController@visitorPlatform')->name('api.visitor.platform');
	Route::get('/admin/api/visitor/device-family', $namespacePrefix.'API\VisitorDeviceController@visitorDeviceFamily')->name('api.visitor.device-family');

	// API Visitor Location
	Route::get('/admin/api/visitor/city', $namespacePrefix.'API\VisitorLocationController@visitorCity')->name('api.visitor.city');
	Route::get('/admin/api/visitor/region', $namespacePrefix.'API\VisitorLocationController@visitorRegion')->name('api.visitor.region');
	Route::get('/admin/api/visitor/country', $namespacePrefix.'API\VisitorLocationController@visitorCountry')->name('api.visitor.country');

	// API Finance
	Route::get('/admin/api/finance/income', $namespacePrefix.'API\FinanceController@income')->name('api.finance.income');
	Route::get('/admin/api/finance/outcome', $namespacePrefix.'API\FinanceController@outcome')->name('api.finance.outcome');
	Route::get('/admin/api/finance/revenue/{month}/{year}', $namespacePrefix.'API\FinanceController@revenue')->name('api.finance.revenue');

	// API Berdasarkan Tanggal
	Route::get('/admin/api/by-tanggal/kunjungan', $namespacePrefix.'API\ByTanggalController@kunjungan')->name('api.by-tanggal.kunjungan');
	Route::get('/admin/api/by-tanggal/ikut-pelatihan', $namespacePrefix.'API\ByTanggalController@ikutPelatihan')->name('api.by-tanggal.ikut-pelatihan');
	Route::get('/admin/api/by-tanggal/churn-rate', $namespacePrefix.'API\ByTanggalController@churnRate')->name('api.by-tanggal.churn-rate');
	Route::get('/admin/api/by-tanggal/kunjungan-hari', $namespacePrefix.'API\ByTanggalController@kunjunganHari')->name('api.by-tanggal.kunjungan-hari');
	Route::get('/admin/api/by-tanggal/kunjungan-jam', $namespacePrefix.'API\ByTanggalController@kunjunganJam')->name('api.by-tanggal.kunjungan-jam');

	// API By Kelompok
	Route::get('/admin/api/by-kelompok/login', $namespacePrefix.'API\ByKelompokController@byKelompokLogin')->name('api.by-kelompok.login');
	Route::get('/admin/api/by-kelompok/aktivitas', $namespacePrefix.'API\ByKelompokController@byKelompokAktivitas')->name('api.by-kelompok.aktivitas');

	// API Get
	Route::get('/admin/api/get/user-by-kelompok', $namespacePrefix.'API\GetController@getUserByKelompok')->name('api.get.user-by-kelompok');
	Route::get('/admin/api/get/pelatihan-by-user', $namespacePrefix.'API\GetController@getPelatihanByUser')->name('api.get.pelatihan-by-user');
	Route::get('/admin/api/get/coordinate', $namespacePrefix.'API\GetController@getCoordinate')->name('api.get.coordinate');

	// API Report
	Route::get('/admin/api/report', $namespacePrefix.'API\ReportController@report')->name('api.report');

	// User Setting
	Route::get('/admin/user-setting/set-theme', $namespacePrefix.'UserSettingController@setTheme')->name('admin.user-setting.set-theme');
});

// Member Capabilities
Route::group(['middleware' => ['campuscms.member']], function() use ($namespacePrefix){
	// Logout
	Route::post('/member/logout', $namespacePrefix.'LoginController@logout')->name('member.logout');

	// Dashboard
	Route::get('/member', $namespacePrefix.'DashboardController@member')->name('member.dashboard');

	// Profil
	Route::get('/member/profile', $namespacePrefix.'UserController@profile')->name('member.profile');
	Route::get('/member/profile/edit', $namespacePrefix.'UserController@editProfile')->name('member.profile.edit');
	Route::post('/member/profile/update', $namespacePrefix.'UserController@updateProfile')->name('member.profile.update');
	Route::post('/member/user/update-photo', $namespacePrefix.'UserController@updatePhoto')->name('member.user.updatephoto');
	Route::get('/member/user/images', $namespacePrefix.'UserController@showImages')->name('member.user.images');

	// Rekening
	Route::get('/member/rekening', $namespacePrefix.'RekeningController@index')->name('member.rekening.index');
	Route::get('/member/rekening/create', $namespacePrefix.'RekeningController@create')->name('member.rekening.create');
	Route::post('/member/rekening/store', $namespacePrefix.'RekeningController@store')->name('member.rekening.store');
	Route::get('/member/rekening/edit/{id}', $namespacePrefix.'RekeningController@edit')->name('member.rekening.edit');
	Route::post('/member/rekening/update', $namespacePrefix.'RekeningController@update')->name('member.rekening.update');
	Route::post('/member/rekening/delete', $namespacePrefix.'RekeningController@delete')->name('member.rekening.delete');

	// Cara Jualan
	Route::get('/member/afiliasi/cara-jualan', function(){
		return view('faturcms::member.afiliasi.cara-jualan');
	})->name('member.afiliasi.carajualan');

	// Komisi
	Route::get('/member/transaksi/komisi', $namespacePrefix.'KomisiController@index')->name('member.komisi.index');
	Route::post('/member/transaksi/komisi/confirm', $namespacePrefix.'KomisiController@confirm')->name('member.komisi.confirm');
	Route::post('/member/transaksi/komisi/withdraw', $namespacePrefix.'KomisiController@withdraw')->name('member.komisi.withdraw');

	// Withdrawal
	Route::get('/member/transaksi/withdrawal', $namespacePrefix.'WithdrawalController@index')->name('member.withdrawal.index');

	// File Manager
	Route::get('/member/file-manager/{kategori}', $namespacePrefix.'FileController@index')->name('member.filemanager.index');
	Route::get('/member/file-manager/{kategori}/file/detail/{id}', $namespacePrefix.'FileController@detail')->name('member.file.detail');
	Route::post('/member/file-manager/{kategori}/voucher', $namespacePrefix.'FileController@inputVoucher')->name('member.file.voucher');

	// Pelatihan
	Route::get('/member/pelatihan', $namespacePrefix.'PelatihanController@index')->name('member.pelatihan.index');
	Route::get('/member/pelatihan/detail/{id}', $namespacePrefix.'PelatihanController@detail')->name('member.pelatihan.detail');
	Route::get('/member/pelatihan/trainer', $namespacePrefix.'PelatihanController@trainer')->name('member.pelatihan.trainer');
	Route::get('/member/pelatihan/peserta/{id}', $namespacePrefix.'PelatihanController@participant')->name('member.pelatihan.participant');
	Route::post('/member/pelatihan/register', $namespacePrefix.'PelatihanController@register')->name('member.pelatihan.register');
	Route::post('/member/pelatihan/update-status', $namespacePrefix.'PelatihanController@updateStatus')->name('member.pelatihan.updatestatus');
	Route::get('/member/user/trainer/{id}', $namespacePrefix.'UserController@trainer')->name('member.user.trainer');

	// Sertifikat
	Route::get('/member/e-sertifikat/trainer', $namespacePrefix.'SertifikatController@indexTrainer')->name('member.sertifikat.trainer.index');
	Route::get('/member/e-sertifikat/trainer/detail/{id}', $namespacePrefix.'SertifikatController@detailTrainer')->name('member.sertifikat.trainer.detail');
	Route::get('/member/e-sertifikat/peserta', $namespacePrefix.'SertifikatController@indexParticipant')->name('member.sertifikat.peserta.index');
	Route::get('/member/e-sertifikat/peserta/detail/{id}', $namespacePrefix.'SertifikatController@detailParticipant')->name('member.sertifikat.peserta.detail');

	// Tandatangan Digital
	Route::get('/member/e-signature/input', $namespacePrefix.'SignatureController@input')->name('member.signature.input');
	Route::post('/member/e-signature/update', $namespacePrefix.'SignatureController@update')->name('member.signature.update');
});
