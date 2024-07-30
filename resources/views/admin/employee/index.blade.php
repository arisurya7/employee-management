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
                        <h6 class="m-0 font-weight-bold text-primary">Data Pegawai</h6>
                    </div>
                    <div class="card-body p-4">
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <a href="{{ route('pegawai.create') }}" class="btn btn-primary">Tambah Data</a>
                            </div>
                        </div>
                        <div class="row">
                            <div class="table-responsive">
                                <table class="table table-bordered display" width="100%" cellspacing="0"
                                    id="table-employee">
                                    <thead>
                                        <tr>
                                            <th class="index">#</th>
                                            <th>Nama</th>
                                            <th>Tanggal Bergabung</th>
                                            <th>Unit</th>
                                            <th class="text-center">Action</th>
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
   
@endsection

@section('scripts')
<script type="text/javascript">
   
   $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

   var table_unit = $('#table-employee').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: '{{ route('pegawai.datatable') }}',

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
                data: 'date_join',
                name: 'date_join'
            },
            {
                data: 'unit_name',
                name: 'unit_name'
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

   

    function deleteEmployee(id_data) {
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
                    url: 'pegawai/' + id_data,
                    data: {
                        id: id_data,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        console.log(response);
                        if (response.status) {
                            successModal(response.message)
                            $('#table-employee').DataTable().ajax.reload(null, false);
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
