<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
  <div class="position-sticky pt-2" style="height: 100vh;">
    <div class="sidebar-header">
      <h6 class="sidebar-heading px-3 mt-4 mb-2 text-muted">
        <span>Menu</span>
      </h6>
      <ul class="nav flex-column">
        <li class="nav-item">
          <a class="nav-link" href="<?= BASEURL; ?>/admin/index.php">
            <div class="row">
              <div class="col-2 text-end">
                <i class="fa fa-dashboard fs-5"></i>
              </div>
              <div class="col-6">
                <span>Dashboard</span>
              </div>
            </div>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?= BASEURL; ?>/admin/siswa/index.php">
            <div class="row">
              <div class="col-2 text-end">
                <i class="fa fa-users fs-5"></i>
              </div>
              <div class="col-8">
                <span>Data Siswa</span>
              </div>
            </div>
          </a>
        </li>
        <h6 class="sidebar-heading px-3 mt-4 mb-2 text-muted">
          <span>Setting</span>
        </h6>
        <li class="nav-item">
          <a class="nav-link" href="<?= BASEURL; ?>/admin/setting/index.php">
            <div class="row">
              <div class="col-2 text-end">
                <i class="fa fa-cog fs-5"></i>
              </div>
              <div class="col-8">
                <span>Pengaturan</span>
              </div>
            </div>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?= BASEURL; ?>/admin/mode/index.php">
            <div class="row">
              <div class="col-2 text-end">
                <i class="fa fa-user-circle-o fs-5"></i>
              </div>
              <div class="col-8">
                <span>Mode User</span>
              </div>
            </div>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?= BASEURL; ?>/admin/logout.php">
            <div class="row">
              <div class="col-2 text-end">
                <i class="fa fa-reply fs-5"></i>
              </div>
              <div class="col-8">
                <span>Logout</span>
              </div>
            </div>
          </a>
        </li>
      </ul>
    </div>

  </div>
</nav>