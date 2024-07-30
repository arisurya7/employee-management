@extends('admin.templates.main')
@section('styles')
   
@endsection
@section('content')
    <div class="container-fluid">
         <!-- Page Heading -->
         <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Data Master</h1>
        </div>

        <div class="row">
            <div class="col-xl-12 col-lg-8">
                <div class="card shadow mb-1">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Data Unit</h6>
                    </div>
                    <div class="card-body p-4">
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <button class="btn btn-primary" onclick="addModal()">Tambah Data</button>
                            </div>
                        </div>
                        <div class="row">
                            <div class="table-responsive">
                                <table class="table table-bordered display" width="100%" cellspacing="0"
                                    id="table-unit">
                                    <thead>
                                        <tr>
                                            <th class="index">#</th>
                                            <th>Nama</th>
                                            <th width="20%" class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
            
                </div>
            </div>
        </div>
      
    </div>


    {{-- modal add data --}}
    <div class="modal fade" tabindex="-1" id="add-data-modal">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Tambah Data</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form id="formDataUnit">
                <label for="name" class="form-label"> Name</label>
                <input type="text" class="form-control" id="name-input" name='name' placeholder="masukan nama unit" required>
              </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
              <button type="button" class="btn btn-primary" onclick="storeUnit()">Tambah</button>
            </div>
          </div>
        </div>
      </div>

    {{-- modal show data --}}
    <div class="modal fade" tabindex="-1" id="show-data-modal">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Lihat Data</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <label for="name" class="form-label"> Name</label>
                <input type="text" class="form-control" id="name-show" name='name' placeholder="masukan nama unit" readonly>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
            </div>
          </div>
        </div>
      </div>

    {{-- modal show data --}}
    <div class="modal fade" tabindex="-1" id="edit-data-modal">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Edit Data</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <form id="formDataUnitEdit">
                        <label for="name" class="form-label"> Name</label>
                        <input type="text" class="form-control" id="name-edit" name='name'>
                        <input type="hidden" name="unit-id" id="unit-id">
                </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
              <button type="button" class="btn btn-primary" onclick="updateUnit()">Update</button>
            </div>
          </div>
        </div>
      </div>
   
@endsection

@section('scripts')
<script type="text/javascript">
   
   $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

   var table_unit = $('#table-unit').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: '{{ route('unit.datatable') }}',

        },
        columns: [{
                data: 'DT_RowIndex',
                name: 'DT_RowIndex'
            },
            {
                data: 'name',
                name: 'name'
            },
            {
                data: 'action',
                name: 'action',
                className: 'text-align-center text-center',
                orderlable: false,
                searchable: false,
            }
        ]
    });

    function addModal(){
        $('#add-data-modal').modal('show');
    }

    function show(id, name){
        $('#name-show').val(name);
        $('#show-data-modal').modal('show');
    }

    function edit(id, name){
        $('#name-edit').val(name);
        $('#unit-id').val(id);
        $('#edit-data-modal').modal('show');
    }

    $('#add-data-modal').on('hidden.bs.modal', function () {
        $('#name-input').val('');
    });

    function storeUnit(){
        let formDataUnit = new FormData(document.getElementById('formDataUnit'));
        $.ajax({
            url: "{{ route('unit.store') }}",
            method: "POST",
            data: formDataUnit,
            processData: false,
            contentType: false,
            success: function(res){
                if (res.status) {
                    Swal.fire(res.message, '', 'success').then(function() {
                        window.location = "{{ route('unit.index') }}";
                    });
                }
            },
            error: function(err){
                
                var response = JSON.parse(err
                    .responseText);

                var errorString = '';
                if (typeof response.validator ===
                    'object') {
                    $.each(response.validator, function(
                        key, value) {
                        errorString += value +
                            "<br>";
                    });
                } else {
                    errorString = response.message;
                }

                Swal.fire(
                    'Wrong', errorString, 'error'
                )
            }
        })
    }

    function updateUnit(){
       
        var unitId = $('#unit-id').val();
        var nameEdit = $('#name-edit').val();
    
        $.ajax({
            url: "unit/"+unitId,
            method: "PUT",
            data: {
              name : nameEdit,
              _token: '{{ csrf_token() }}'
            },
            success: function(res){
                if (res.status) {
                    Swal.fire(res.message, '', 'success').then(function() {
                        window.location = "{{ route('unit.index') }}";
                    });
                }
            },
            error: function(err){
                
                var response = JSON.parse(err
                    .responseText);

                var errorString = '';
                if (typeof response.validator ===
                    'object') {
                    $.each(response.validator, function(
                        key, value) {
                        errorString += value +
                            "<br>";
                    });
                } else {
                    errorString = response.message;
                }

                Swal.fire(
                    'Wrong', errorString, 'error'
                )
            }
        })
    }

    function deleteUnit(id_data) {
        Swal.fire({
            title: 'Apakah anda yakin hapus data?',
            text: "Data tidak dapat dikembalikan lagi!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, hapus'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "DELETE",
                    url: 'unit/' + id_data,
                    data: {
                        id: id_data,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        console.log(response);
                        if (response.status) {
                            successModal(response.message)
                            $('#table-unit').DataTable().ajax.reload(null, false);
                        } 
                    },
                    error: function(error) {
                        var response = JSON.parse(error.responseText);
                        errorString = response.message;
                        Swal.fire(
                            'Wrong', errorString, 'error'
                        )
                    },
                });
            }
        });
    }



    function successModal(msg) {
        Swal.fire(
            'Success!',
            msg,
            'success');
    }
</script>
@endsection
