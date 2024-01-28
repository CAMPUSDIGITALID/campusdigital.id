@extends('faturcms::template.admin.main')

@section('title', 'Tambah Artikel')

@section('content')

<!-- Main -->
<main class="app-content">

    <!-- Breadcrumb -->
    @include('faturcms::template.admin._breadcrumb', ['breadcrumb' => [
        'title' => 'Tambah Artikel',
        'items' => [
            ['text' => 'Artikel', 'url' => route('admin.blog.index')],
            ['text' => 'Tambah Artikel', 'url' => '#'],
        ]
    ]])
    <!-- /Breadcrumb -->

    <!-- Row -->
    <div class="row">
        <!-- Column -->
        <div class="col-md-12">
            <!-- Tile -->
            <div class="tile">
                <!-- Tile Body -->
                <div class="tile-body">
                    <form id="form" method="post" action="{{ route('admin.blog.store') }}" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">Judul Artikel <span class="text-danger">*</span></label>
                            <div class="col-md-10">
                                <input type="text" name="judul_artikel" class="form-control {{ $errors->has('judul_artikel') ? 'is-invalid' : '' }}" value="{{ old('judul_artikel') }}">
                                @if($errors->has('judul_artikel'))
                                <div class="small text-danger mt-1">{{ ucfirst($errors->first('judul_artikel')) }}</div>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">Kategori <span class="text-danger">*</span></label>
                            <div class="col-md-10">
                                <select name="kategori" class="form-control {{ $errors->has('kategori') ? 'is-invalid' : '' }}" >
                                    <option value="" disabled selected>--Pilih--</option>
                                    @foreach($kategori as $data)
                                    <option value="{{ $data->id_ka }}" {{ old('kategori') === $data->id_ka ? 'selected' : '' }}>{{ $data->kategori }}</option>
                                    @endforeach
                                </select>
                                @if($errors->has('kategori'))
                                <div class="small text-danger mt-1">{{ ucfirst($errors->first('kategori')) }}</div>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">Gambar</label>
                            <div class="col-md-10">
                                <label class="btn btn-secondary">
                                    <input type="file" id="fileImage" name="gambar" class="d-none" accept="image/*" onChange="img_pathUrl(this);">
                                    <i class="fa fa-image mr-2"></i>
                                    <span>Pilih Gambar...</span>
                                </label>
                                <br>
                                <img id="img-file"  style="max-height: 150px">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">Tag</label>
                            <div class="col-md-10">
                                <input type="text" name="tag" data-role="tagsinput" class="form-control {{ $errors->has('tag') ? 'is-invalid' : '' }}" value="{{ old('tag') }}">
                                @if($errors->has('tag'))
                                <div class="small text-danger mt-1">{{ ucfirst($errors->first('tag')) }}</div>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">Kontributor</label>
                            <div class="col-md-10">
                                <select name="kontributor" class="form-control {{ $errors->has('kontributor') ? 'is-invalid' : '' }}" >
                                    <option value="" disabled selected>--Pilih--</option>
                                    @foreach($kontributor as $data)
                                    <option value="{{ $data->id_kontributor }}" {{ old('kontributor') === $data->id_kontributor ? 'selected' : '' }}>{{ $data->kontributor }}</option>
                                    @endforeach
                                </select>
                                @if($errors->has('kontributor'))
                                <div class="small text-danger mt-1">{{ ucfirst($errors->first('kontributor')) }}</div>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">Konten</label>
                            <div class="col-md-10">
                                <textarea name="konten" class="d-none"></textarea>
                                <div id="editor"></div> 
                                @if($errors->has('konten'))
                                <div class="small text-danger mt-1">{{ ucfirst($errors->first('konten')) }}</div>
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

@include('faturcms::template.admin._modal-image', ['croppieWidth' => 640, 'croppieHeight' => 360])

@endsection

@section('js-extra')

@include('faturcms::template.admin._js-image', ['imageType' => 'blog', 'croppieWidth' => 640, 'croppieHeight' => 360])

@include('faturcms::template.admin._js-editor')

@include('faturcms::template.admin._js-tagsinput')

<script type="text/javascript">
    // Quill
    generate_quill("#editor");

    // Tagsinput
    generate_tagsinput("input[name=tag]");

    // Button Submit
    $(document).on("click", "button[type=submit]", function(e){
        var myEditor = document.querySelector('#editor');
        var html = myEditor.children[0].innerHTML;
        $("textarea[name=konten]").text(html);
        $("#form").submit();
    });
</script>

@endsection

@section('css-extra')

<link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/croppie/croppie.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/quill/quill.snow.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/bootstrap-tagsinput/bootstrap-tagsinput.min.css') }}">

@endsection