@extends('admin.templates.main')
@section('styles')
   
@endsection
@section('content')
    <div class="container-fluid">
         <!-- Page Heading -->
         <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Pegawai</h1>
        </div>

        <div class="row">
            <div class="col-xl-12 col-lg-8">
                <div class="card shadow mb-1">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Tambah Data Pegawai</h6>
                    </div>
                    <div class="card-body p-4">
                       
                        <div class="row">
                            <div class="col">
                                
                                    <div class="row mb-3">
                                        <div class="col">
                                            <label for="name" class="form-label">Nama <span class="text-danger">*</span></label>
                                            <input type="text" id="name" name="name" class="form-control" placeholder="masukan nama" value="{{ $data->name ?? ''}}" readonly>
                                        </div>
                                        <div class="col">
                                            <label for="date_join">Tanggal Bergabung <span class="text-danger">*</span></label>
                                            <input type="date" name="date_join" id="date_join" class="form-control" value="{{ $data->date_join ?? ''}}" readonly>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col">
                                            <label for="username" class="form-label">Username <span class="text-danger">*</span></label>
                                            <input type="text" id="username" name="username" class="form-control" placeholder="masukan username" value="{{ $data->username ?? ''}}" readonly>
                                        </div>
                                        <div class="col">
                                            <label for="password">Password <span class="text-danger">*</span></label>
                                            <div class="input-group mb-3">
                                                <input type="password" class="form-control" name="password" id="password" readonly
                                                    aria-describedby="basic-addon2" value="{{ $data->password ?? ""}}">
                                                <span class="input-group-text" id="basic-addon2" onclick="password_show_hide();">
                                                    <i class="fas fa-eye" id="show_eye"></i>
                                                    <i class="fas fa-eye-slash d-none" id="hide_eye"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col">
                                            <label for="unit" class="form-label">Unit <span class="text-danger">*</span></label>
                                            <select name="unit" id="unit" class="form-control select2" readonly>
                                                
                                                @if (isset($unit))
                                                    @foreach ($unit as $item)
                                                        <option value="{{ $item->id }}" selected> {{ $item->name}}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                        <div class="col">
                                            <label for="position" class="form-label">Jabatan <span class="text-danger">*</span></label>
                                            <select name="position[]" id="position" class="form-control select2" multiple="multiple" readonly >
                                                @if (isset($positions))
                                                @foreach ($positions as $item)
                                                    <option value="{{ $item->id }}" selected> {{ $item->name}}</option>
                                                @endforeach
                                            @endif
                                            </select>
                                        </div>
                                    </div>

                                    <div class="row text-right mt-4">
                                        <div class="col">
                                            <a href="{{ route('pegawai.index') }}" style="text-decoration: none">
                                                <button id="back_button" type="button" class="btn btn-secondary"><i class="typcn typcn-times"></i>Kembali</button>
                                            </a>
                                        </div>
                                    </div>
                                
                            </div>
                        </div>
                    </div>
            
                </div>
            </div>
        </div>
      
    </div>
   
@endsection

@section('scripts')
<script type="text/javascript">
    function password_show_hide() {
        var x = document.getElementById("password");
        var show_eye = document.getElementById("show_eye");
        var hide_eye = document.getElementById("hide_eye");
        hide_eye.classList.remove("d-none");
        if (x.type === "password") {
            x.type = "text";
            show_eye.style.display = "none";
            hide_eye.style.display = "block";
        } else {
            x.type = "password";
            show_eye.style.display = "block";
            hide_eye.style.display = "none";
        }
    }

    $(document).ready(function(){

        $('#unit').select2({
            placeholder: "Cari unit",
            allowClear: false,
        });

        $('#position').select2({
            placeholder: "Cari jabatan",
            allowClear: false,
        });

    })

</script>
@endsection
