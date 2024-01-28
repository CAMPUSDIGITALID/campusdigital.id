@extends('faturcms::template.admin.main')

@section('title', 'Edit File Video')

@section('content')

<!-- Main -->
<main class="app-content">

    <!-- Breadcrumb -->
    @include('faturcms::template.admin._breadcrumb', ['breadcrumb' => [
        'title' => 'Edit File',
        'items' => [
            ['text' => 'File Manager', 'url' => '#'],
            ['text' => $kategori->prefix_kategori.' '.$kategori->folder_kategori, 'url' => route('admin.filemanager.index', ['kategori' => $kategori->slug_kategori])],
            ['text' => 'Edit File', 'url' => '#'],
        ]
    ]])
    <!-- /Breadcrumb -->

    <!-- Row -->
    <div class="row">
        <!-- Column -->
        <div class="col-md-12">
            <!-- Tile -->
            <div class="tile">
                <!-- Tile Title -->
                <div class="tile-title-w-btn">
                    <!-- Breadcrumb Direktori -->
                    <ol class="breadcrumb bg-white p-0 mb-0">
                        @foreach(file_breadcrumb($directory) as $key=>$data)
                            @if($key + 1 == count(file_breadcrumb($directory)))
                            <li class="breadcrumb-item active" aria-current="page">{{ $data->folder_nama == '/' ? 'Home' : $data->folder_nama }}</li>
                            @else
                            <li class="breadcrumb-item"><a href="{{ route('admin.filemanager.index', ['kategori' => $kategori->slug_kategori, 'dir' => $data->folder_dir]) }}">{{ $data->folder_nama == '/' ? 'Home' : $data->folder_nama }}</a></li>
                            @endif
                        @endforeach
                    </ol>
                    <!-- /Breadcrumb Direktori -->
                </div>
                <!-- /Tile Title -->
                <!-- Tile Body -->
                <div class="tile-body">
                    <form id="form" method="post" action="{{ route('admin.file.update', ['kategori' => $kategori->slug_kategori]) }}" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <input type="hidden" name="id" value="{{ $file->id_file }}">
                        <input type="hidden" name="file_kategori" value="{{ $kategori->id_fk }}">
                        <input type="hidden" name="id_folder" value="{{ $directory->id_folder }}">
                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">Nama File <span class="text-danger">*</span></label>
                            <div class="col-md-10">
                                <input type="text" name="nama_file" class="form-control {{ $errors->has('nama_file') ? 'is-invalid' : '' }}" value="{{ $file->file_nama }}">
                                @if($errors->has('nama_file'))
                                <div class="small text-danger mt-1">{{ ucfirst($errors->first('nama_file')) }}</div>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">Gambar</label>
                            <div class="col-md-10">
                                <input type="file" id="file" class="d-none" accept="image/*">
                                <a class="btn btn-sm btn-secondary btn-image" href="#"><i class="fa fa-image mr-2"></i>Pilih Gambar...</a>
                                <br>
                                <img src="{{ image('assets/images/file/'.$file->file_thumbnail, 'video') }}" id="img-file" class="mt-2 img-thumbnail {{ $file->file_thumbnail != '' ? '' : 'd-none' }}" style="max-height: 150px">
                                <input type="hidden" name="gambar">
                                <input type="hidden" name="gambar_url">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">Deskripsi</label>
                            <div class="col-md-10">
                                <textarea name="file_deskripsi" class="form-control {{ $errors->has('file_deskripsi') ? 'is-invalid' : '' }}" rows="3">{{ $file->file_deskripsi }}</textarea>
                                @if($errors->has('file_deskripsi'))
                                <div class="small text-danger mt-1">{{ ucfirst($errors->first('file_deskripsi')) }}</div>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">Kode YouTube <span class="text-danger">*</span></label>
                            <div class="col-md-10">
                                <input type="text" name="file_konten" class="form-control {{ $errors->has('file_konten') ? 'is-invalid' : '' }}" value="{{ $file->file_konten }}">
                                @if($errors->has('file_konten'))
                                <div class="small text-danger mt-1">{{ ucfirst($errors->first('file_konten')) }}</div>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">Kode Embed Google Slide</label>
                            <div class="col-md-10">
                                <textarea name="file_keterangan" class="form-control {{ $errors->has('file_keterangan') ? 'is-invalid' : '' }}" rows="3">{!! html_entity_decode($file->file_keterangan) !!}</textarea>
                                @if($errors->has('file_keterangan'))
                                <div class="small text-danger mt-1">{{ ucfirst($errors->first('file_keterangan')) }}</div>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-2 col-form-label"></label>
                            <div class="col-md-10">
                                <button type="submit" class="btn btn-theme-1"><i class="fa fa-save mr-2"></i>Simpan</button>
                            </div>
                        </div>
                    </form>
                </div>
                <!-- /Tile Body -->
            </div>
            <!-- /Tile -->
        </div>
        <!-- /Column -->
    </div>
    <!-- /Row -->
</main>
<!-- /Main -->

@include('faturcms::template.admin._modal-image', ['croppieWidth' => 848, 'croppieHeight' => 480])

@endsection

@section('js-extra')

@include('faturcms::template.admin._js-image', ['imageType' => 'file', 'croppieWidth' => 848, 'croppieHeight' => 480])

@endsection

@section('css-extra')

<link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/croppie/croppie.css') }}">

@endsection
