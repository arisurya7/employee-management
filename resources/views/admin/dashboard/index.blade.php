@extends('admin.templates.main')
@section('styles')
   
@endsection
@section('content')
    <div class="container-fluid">
         <!-- Page Heading -->
         <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
        </div>

        <div class="row align-items-end mb-3">
            <div class="col-md-3">
                <label for="start_date" class="form-label">Tanggal Awal</label>
                <input type="date" id="start_date" class="form-control" placeholder="Start Date">
            </div>
            <div class="col-md-3">
                <label for="end_date" class="form-label">Tanggal Akhir</label>
                <input type="date" id="end_date" class="form-control" placeholder="End Date">
            </div>
            <div class="col-md-3">
                <button id="filter" class="btn btn-primary">Filter</button>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-info shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                    Karyawan</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800" id="count-employee"> {{ $data['count_employee'] ?? 0 }} </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-users fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-info shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                    Unit</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800" id="count-unit"> {{ $data['count_unit'] ?? 0 }} </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-place-of-worship fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-info shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                    Jabatan</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800" id="count-position"> {{ $data['count_position'] ?? 0 }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-user-tag fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-info shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                    Jumlah Login</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800" id="count-login"> {{ $data['count_login'] ?? 0 }} </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-sign-in-alt fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>

        <div class="row">
            <div class="col-xl-12 col-lg-8">
                <div class="card shadow mb-1">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Top Pegawai Login</h6>
                    </div>
                    <div class="card-body p-4">

                        <div class="row">
                            <div class="table-responsive">
                                <table class="table table-bordered display" width="100%" cellspacing="0"
                                    id="table-login">
                                    <thead>
                                        <tr>
                                            <th class="index">#</th>
                                            <th>Nama</th>
                                            <th>Jumlah</th>
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

        var table = $('#table-login').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: '{{ route("user-login.datatable") }}',
                data: function(d) {
                    d.start_date = $('#start_date').val();
                    d.end_date = $('#end_date').val();
                }
            },
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex' },
                { data: 'name', name: 'name' },
                { data: 'login_count', name: 'login_count' }
            ]
        });

        $('#filter').click(function() {
                table.draw();
                update_dashboard()
        });

        function update_dashboard(){
            $.ajax({
            url: "{{ route('count.dashboard') }}",
            method: "GET",
            data: {
                start_date : $('#start_date').val(),
                end_date : $('#end_date').val()
            },
            success: function(res){
                if (res.status) {
                    $('#count-employee').text(res.data.count_employee);
                    $('#count-unit').text(res.data.count_unit);
                    $('#count-position').text(res.data.count_position);
                    $('#count-login').text(res.data.count_login);
                    Swal.fire(res.message, '', 'success').then(function() {});
                }
            },
            error: function(err){
                console.log(err);
            }
        })
        }
    </script>
@endsection
