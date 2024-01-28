@extends('faturcms::template.admin.main')

@section('title', 'Data User')

@section('content')

<!-- Main -->
<main class="app-content">

    <!-- Breadcrumb -->
    @include('faturcms::template.admin._breadcrumb', ['breadcrumb' => [
        'title' => 'Data User',
        'items' => [
            ['text' => 'User', 'url' => route('admin.user.index')],
            ['text' => 'Data User', 'url' => '#'],
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
                    <div class="btn-group">
                        <a href="{{ route('admin.user.create') }}" class="btn btn-sm btn-theme-1"><i class="fa fa-plus mr-2"></i> Tambah Data</a>
                        <a href="{{ route('admin.user.export', ['filter' => $filter]) }}" class="btn btn-sm btn-success"><i class="fa fa-file-excel-o mr-2"></i> Export ke Excel</a>
                        @if(has_access('UserController::import', Auth::user()->role, false))
                        <button id="myBtn" class="btn btn-danger">Import Excel</button>
                        @endif
                        @if(has_access('UserController::active', Auth::user()->role, false))
                        <form id="formMulti" class="formMulti" method="post" enctype="multipart/form-data" action="{{ route('admin.user.active') }}">
                          @csrf
                          <input type="hidden" id="inputActive" name="inputActive[]" value="">
                          <select name="selectMulti" id="selectMulti" class="btn btn-light">
                            <option selected>Pilih Aksi Aktifasi</option>
                            <option value="1">Aktivasi Member</option>
                            <option value="2">Non-Aktif Member</option>
                          </select>
                        </form>
                        @endif
                        
                    </div>
                    <div>
                        <select id="filter" class="form-control form-control-sm">
                            <option value="all" {{ $filter == 'all' ? 'selected' : '' }}>Semua</option>
                            <option value="admin" {{ $filter == 'admin' ? 'selected' : '' }}>Admin</option>
                            <option value="member" {{ $filter == 'member' ? 'selected' : '' }}>Member</option>
                            <option value="aktif" {{ $filter == 'aktif' ? 'selected' : '' }}>Aktif</option>
                            <option value="belum-aktif" {{ $filter == 'belum-aktif' ? 'selected' : '' }}>Belum Aktif</option>
                        </select>
                    </div>
                </div>
                <!-- /Tile Title -->
                {{-- modal form --}}
                <div id="myModal" class="modalku">
                    <div class="container" style="width: 65%">
                        <div class="row">
                            <!-- Modal content -->
                            <div class="modal-contentku">
                                <div class="modal-headerku">
                                    <span class="close">&times;</span>     
                                  </div>
                                  <div class="modal-bodyku">
                                    <p>Ikuti format tabel di bawah ini sebelum melakukan import data <br>
                                        <span style="color: red">
                                            *password otomatis  : 12345678 <br>
                                            *username            : Tentukan terlebih dahulu, tidak boleh sama<br>
                                            *reference           : isikan username bila ada, kosong bila tidak ada
                                        </span>
                                    </p>
                                    
                                    <table class="table table-responsive mt-2">
                                        <thead>
                                          <tr>
                                            <th scope="col">nama_user</th>
                                            <th scope="col">username</th>
                                            <th scope="col">email</th>
                                            <th scope="col">jenis_kelamin</th>
                                            <th scope="col">nomor_hp</th>
                                            <th scope="col">reference</th>
                                            <th scope="col">instansi</th>
                                          </tr>
                                        </thead>
                                        <tbody>
                                          <tr>
                                            <th scope="row">Campus 1</th>
                                            <td>campus123</td>
                                            <td>Otto@gmail.com</td>
                                            <td>L</td>
                                            <td>081000</td>
                                            <td>farisfanani</td>
                                            <td>SMA 10</td>
                                          </tr>
                                          <tr>
                                            <th scope="row">Campus 2</th>
                                            <td>campus124</td>
                                            <td>Thornton@gmail.com</td>
                                            <td>L</td>
                                            <td>081000</td>
                                            <td></td>
                                            <td>SMA 10</td>
                                          </tr>
                                          <tr>
                                            <th scope="row">Campus 3</th>
                                            <td>campus125</td>
                                            <td>theBird@gmail.com</td>
                                            <td>L</td>
                                            <td>081000</td>
                                            <td></td>
                                            <td>SMA 10</td>
                                          </tr>
                                        </tbody>
                                      </table>

                                    <form method="POST" accept-charset="utf-8" enctype="multipart/form-data" action="{{ route('admin.user.import') }}">
                                        @csrf
                                        <div class="form-group">
                                            <input type="file" name="file" class="form-control">
                                        </div>

                                        <button type="submit" class="btn btn-primary mb-2" id="submit">Submit</button>
                                    </form>
                                  </div>
                            </div>
                        </div>
                    </div>
                </div>
                    
                {{-- end modal form --}}
                <!-- Tile Body -->
                <div class="tile-body">
                    @if(Session::get('message') != null)
                    <div class="alert alert-dismissible alert-success">
                        <button class="close" type="button" data-dismiss="alert">×</button>{{ Session::get('message') }}
                    </div>
                    @endif
                    <div class="table-responsive">
                        <table id="dataTable" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th width="20"><input type="checkbox" class="checkAll" name="checkAll" onchange="doalert(this)"></th>
                                    <th>Identitas User</th>
                                    <th width="80">Role</th>
                                    <th width="70">Asal Sekolah/Instansi</th>
                                    <th width="50">Refer</th>
                                    <th width="50">Status</th>
                                    <th width="90">Waktu Daftar</th>
                                    <th width="60">Opsi</th>
                                </tr>
                            </thead>
                        </table>
                        <form id="form-delete" class="d-none" method="post" action="{{ route('admin.user.delete') }}">
                            {{ csrf_field() }}
                            <input type="hidden" name="id">
                        </form>
                    </div>
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

@endsection

@section('css-extra')
<style type="text/css">
    /* The Modal (background) */
.modalku {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 1; /* Sit on top */
  padding-top: 100px; /* Location of the box */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
}

/* Modal Content */
.modal-contentku {
  position: relative;
  background-color: #fefefe;
  margin: auto;
  padding: 0;
  border: 1px solid #888;
  width: 80%;
  box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2),0 6px 20px 0 rgba(0,0,0,0.19);
  -webkit-animation-name: animatetop;
  -webkit-animation-duration: 0.4s;
  animation-name: animatetop;
  animation-duration: 0.4s
}

/* Add Animation */
@-webkit-keyframes animatetop {
  from {top:-300px; opacity:0} 
  to {top:0; opacity:1}
}

@keyframes animatetop {
  from {top:-300px; opacity:0}
  to {top:0; opacity:1}
}

/* The Close Button */
.close {
  color: #000;
  float: right;
  font-size: 28px;
  font-weight: bold;
}

.close:hover,
.close:focus {
  color: #272727;
  text-decoration: none;
  cursor: pointer;
}

.modal-headerku {
  padding: 2px 16px;
  color: white;
}

.modal-bodyku {padding: 2px 16px;}

.modal-footerku {
  padding: 2px 16px;
  color: white;
}
</style>
@endsection

@section('js-extra')

@include('faturcms::template.admin._js-table')

<script type="text/javascript">
    
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

    function doalert(checkboxElem) {
      $(document).ready(function(){
        if (checkboxElem.checked) {
            $('.check').prop('checked', true);
        } else {
            $('.check').prop('checked', false);
        }
      })
    }

    $(document).ready(function(){
      
      $('select').change(function ()
      {
        var val = [];
        $(':checkbox:checked').each(function(i){
          val[i] = $(this).val();
        });
        
        $('#inputActive').attr('value',val);
          $(this).closest('form').submit();
      });
    })

// Get the modal
var modal = document.getElementById("myModal");

// Get the button that opens the modal
var btn = document.getElementById("myBtn");
$('#myBtn').on('click', function(){
    modal.style.display = 'block';
})

$('.close').on('click', function(){
    modal.style.display = "none";
})

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}
    // DataTable
    generate_datatable("#dataTable", {
		    "url": "{{ route('admin.user.data', ['filter' => $filter]) }}",
        "columns": [
            {data: 'checkbox', name: 'checkbox'},
            {data: 'user_identity', name: 'user_identity'},
            {data: 'nama_role', name: 'nama_role'},
            {data: 'instansi', name: 'instansi'},
            {data: 'refer', name: 'refer'},
            {data: 'status', name: 'status'},
            {data: 'register_at', name: 'register_at'},
            {data: 'options', name: 'options'},
        ],
        "order": [6, 'desc']
	});

    // Filter
    $(document).on("change", "#filter", function(){
        var value = $(this).val();
        if(value == 'all') window.location.href = "{{ route('admin.user.index', ['filter' => 'all']) }}";
        else if(value == 'admin') window.location.href = "{{ route('admin.user.index', ['filter' => 'admin']) }}";
        else if(value == 'member') window.location.href = "{{ route('admin.user.index', ['filter' => 'member']) }}";
        else if(value == 'aktif') window.location.href = "{{ route('admin.user.index', ['filter' => 'aktif']) }}";
        else if(value == 'belum-aktif') window.location.href = "{{ route('admin.user.index', ['filter' => 'belum-aktif']) }}";
    });
</script>

@endsection