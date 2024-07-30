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
                                <form id="formDataEmployee" method="POST" action="{{ isset($data) ? route('pegawai.update', $data->id) : route('pegawai.store')}}">
                                    @csrf
                                    @if (isset($data))
                                        {{ method_field('PUT') }}
                                    @endif
                                    <div class="row mb-3">
                                        <div class="col">
                                            <label for="name" class="form-label">Nama <span class="text-danger">*</span></label>
                                            <input type="text" id="name" name="name" class="form-control" placeholder="masukan nama" value="{{ $data->name ?? ''}}" required>
                                        </div>
                                        <div class="col">
                                            <label for="date_join">Tanggal Bergabung <span class="text-danger">*</span></label>
                                            <input type="date" name="date_join" id="date_join" class="form-control" value="{{ $data->date_join ?? ''}}" required>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col">
                                            <label for="username" class="form-label">Username <span class="text-danger">*</span></label>
                                            <input type="text" id="username" name="username" class="form-control" placeholder="masukan username" value="{{ $data->username ?? ''}}" required>
                                        </div>
                                        <div class="col">
                                            <label for="password">Password <span class="text-danger">*</span></label>
                                            <div class="input-group mb-3">
                                                <input type="password" class="form-control" name="password" id="password" required
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
                                            <select name="unit" id="unit" class="form-control select2">
                                                
                                                @if (isset($unit))
                                                    @foreach ($unit as $item)
                                                        <option value="{{ $item->id }}" selected> {{ $item->name}}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                        <div class="col">
                                            <label for="position" class="form-label">Jabatan <span class="text-danger">*</span></label>
                                            <select name="position[]" id="position" class="form-control select2" multiple="multiple">
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
                                                <button id="back_button" type="button" class="btn btn-secondary"><i class="typcn typcn-times"></i>Batal</button>
                                            </a>
                                            <button class="btn btn-primary" id="submit_button"> {{ isset($data) ? 'Ubah' : 'Tambah' }} </button>
                                        </div>
                                    </div>

                                </form>
                                
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
            allowClear: true,
            tags: true,
            ajax: {
                url: '{{ route('search.unit') }}',
                dataType: 'json',
                delay: 250,
                processResults: function(data){
                    return {
                        results: data
                    }
                },
                cache: true
            }
        });

        $('#position').select2({
            placeholder: "Cari jabatan",
            allowClear: true,
            tags: true,
            ajax: {
                url: '{{ route('search.position') }}',
                dataType: 'json',
                delay: 250,
                processResults: function(data){
                    return {
                        results: data
                    }
                },
                cache: true
            }
        });


        $('#formDataEmployee').submit(function(e){
            e.preventDefault();
            let formData = new FormData(this);
            let method = $(this).attr('method'); 
            let action = $(this).attr('action');
   
            Swal.fire({
                title: 'Apakah data sudah benar?',
                text: "Tambah atau Update data",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya',
                    preConfirm: function() {
                        return new Promise(function(resolve) {
                            $.ajax({
                                method : method,
                                url : action,
                                data : formData,
                                contentType: false,
                                processData: false,
                                success : function(res){
                                    resolve(res);
                                },
                                error: function(err){

                                   

                                    var response = JSON.parse(err.responseText);
                                    
                                    var errorString = '';
                                    if(typeof response.validator === 'object'){
                                        $.each( response.validator, function( key, value) {
                                            errorString += value + "<br>";
                                        });
                                    }else{
                                        errorString = response.message;
                                    }
                                
                                    Swal.fire(
                                        'Wrong',errorString,'error'
                                    )
                                }
                            })
                        });
                    }
                }).then(function(data) {
                    data = data.value;                
                    if(data.status){
                        Swal.fire(data.message,'','success');
                        $('#back_button').click();
                    }
                });

        });
    })

</script>
@endsection
