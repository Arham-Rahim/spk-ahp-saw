<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

  <!-- Sidebar - Brand -->
  <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
      <div class="sidebar-brand-text mx-3">SPK-LP</div>
  </a>

  <!-- Divider -->
  <hr class="sidebar-divider my-0">

  <!-- Nav Item - Dashboard -->
  <li class="{{ request()->is('/') ? 'active':'' }} nav-item">
    <a class="nav-link" href="/">
      <i class="fa fa-home"></i> <span>Home</span>
    </a>
  </li>
<li class="{{ request()->is('alternatif') ? 'active':'' }} nav-item">
    <a class="nav-link" href="/alternatif">
      <i class="fa fa-users"></i> <span>Data Alternatif</span>
    </a>
</li>
<li class="{{ request()->is('kriteria') ? 'active':'' }} nav-item">
  <a class="nav-link" href="/kriteria">
    <i class="fa fa-pen"></i> <span>Data Kriteria</span>
  </a>
</li>
<li class="{{ request()->is('pembobotan') ? 'active':'' }} nav-item">
    <a class="nav-link" href="/pembobotan">
      <i class="fa fa-signal"></i> <span>Pembobotan Kriteria</span>
    </a>
</li>
<li class="{{ request()->is('pembobotan/subkriteria') ? 'active':'' }} nav-item">
  <a class="nav-link" href="/pembobotan/subkriteria">
    <i class="fa fa-signal"></i> <span>Pembobotan Subkriteria</span>
  </a>
</li>
<li class="{{ request()->is('penilaian') ? 'active':'' }} nav-item">
  <a class="nav-link" href="/penilaian">
    <i class="fa fa-check-square"></i> <span>Penilaian</span>
  </a>
</li>
<li class="{{ Request::is('user*') ? 'active':''}} nav-item">
    <a class="nav-link" href="/user">
      <i class="fa fa-user"></i> <span>User</span>
    </a>
</li>



  <!-- Divider -->
  <hr class="sidebar-divider d-none d-md-block">

  <!-- Sidebar Toggler (Sidebar) -->
  <div class="text-center d-none d-md-inline">
      <button class="rounded-circle border-0" id="sidebarToggle"></button>
  </div>
</ul>


{{-- <ul class="sidebar-menu">
    <li class="header">MAIN NAVIGATION</li>
    <li class="{{ request()->is('/') ? 'active':'' }} treeview">
      <a href="/">
        <i class="fa fa-home"></i> <span>Home</span>
      </a>
    </li>
    <li class="{{ request()->is('kriteria') ? 'active':'' }} treeview">
        <a href="/kriteria">
          <i class="fa fa-pencil"></i> <span>Data Kriteria</span>
        </a>
    </li>
    <li class="{{ request()->is('alternatif') ? 'active':'' }} treeview">
        <a href="/alternatif">
          <i class="fa fa-users"></i> <span>Data Alternatif</span>
        </a>
    </li>
    <li class="{{ request()->is('pembobotan') ? 'active':'' }} treeview">
        <a href="/pembobotan">
          <i class="fa fa-signal"></i> <span>Pembobotan Kriteria</span>
        </a>
    </li>
    <li class="{{ request()->is('pembobotan/subkriteria') ? 'active':'' }} treeview">
      <a href="/pembobotan/subkriteria">
        <i class="fa fa-signal"></i> <span>Pembobotan Subkriteria</span>
      </a>
    </li>
    <li class="{{ request()->is('penilaian') ? 'active':'' }} treeview">
      <a href="/penilaian">
        <i class="fa fa-check-square-o"></i> <span>Penilaian</span>
      </a>
    </li>
    <li class="{{ Request::is('user*') ? 'active':''}} treeview">
        <a href="/user">
          <i class="fa fa-user"></i> <span>User</span>
        </a>
    </li>
  </ul> --}}