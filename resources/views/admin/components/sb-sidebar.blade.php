  <!-- Sidebar -->
  <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('dashboard') }}">
        <div class="sidebar-brand-icon rotate-n-15">
            
        </div>
        <div class="sidebar-brand-text mx-3">Employee Management</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

   
    <li class="nav-item active">
        <a class="nav-link" href="{{ route('dashboard') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>
    


    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    {{-- <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTours"
            aria-expanded="true" aria-controls="collapseTours">
            <i class="fas fa-fw fa-cog"></i>
            <span>Tanaman</span>
        </a>
        <div id="collapseTours" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Packages:</h6>
                <a class="collapse-item" href="#">Data Artikel</a>
                <a class="collapse-item" href="#">Data Kategori</a>
            </div>
        </div>
    </li> --}}
    @if (Session::get('user')->is_admin == 1)
        <li class="nav-item">
            <a class="nav-link" href="{{ route('pegawai.index') }}">
                <i class="fas fa-users"></i>
                <span>Pegawai</span></a>
        </li>
        
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseDataMaster"
                aria-expanded="true" aria-controls="collapseDataMaster">
                <i class="fas fa-database"></i>
                <span>Data Master</span>
            </a>
            <div id="collapseDataMaster" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Data Master:</h6>
                    <a class="collapse-item" href="{{ route('unit.index') }}">Data Unit</a>
                    <a class="collapse-item" href="{{ route('position.index') }}"  >Data Jabatan</a>
                </div>
            </div>
        </li>
    @endif
    

   
    
    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->
