<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
      
      <li class="nav-item">
        <a href="/karyawan" class="nav-link">
          <i class="nav-icon fa fa-id-card"></i>
          <p>Data Karyawan</p>
        </a>
      </li>
      <li class="nav-item">
        <a href="/departemen" class="nav-link">
          <i class="nav-icon fas fa-code-branch"></i>
          <p>Data Departemen</p>
        </a>
      </li>
      <li class="nav-item">
        <a href="/jabatan" class="nav-link">
          <i class="nav-icon fas fa-bookmark"></i>
          <p>Data Jabatan</p>
        </a>
      </li>
      <li class="nav-header">Modul Aturan Absensi</li>
      <li class="nav-item">
        <a href="/jamkerja" class="nav-link">
          <i class="far fa-clock nav-icon"></i>
          <p>Jam Kerja</p>
        </a>
      </li>
      <li class="nav-item">
        <a href="/kalender" class="nav-link">
          <i class="far fa-calendar nav-icon"></i>
          <p>Kalender Kerja</p>
        </a>
      </li>
      <!--
      <li class="nav-header">Modul Mesin Finger</li>
        <li class="nav-item">
          <a href="/mesin" class="nav-link">
            <i class="fa fa-fax nav-icon"></i>
            <p>Mesin Absensi Finger</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="/uploadnama" class="nav-link">
            <i class="fa fa-external-link-alt nav-icon"></i>
            <p>Update Data Karyawan</p>
          </a>
        </li>-->
      <li class="nav-header">Modul Laporan</li>
      <li class="nav-item">
        <a href="/downattlog" class="nav-link">
          <i class="fa fa-download nav-icon"></i>
          <p>Import Data Absensi</p>
        </a>
      </li>
      <li class="nav-item">
        <a href="/rawdata" class="nav-link">
          <i class="fa fa-database nav-icon"></i>
          <p>Data Absensi Individu</p>
        </a>
      </li>
      <li class="nav-item">
        <a href="/laporan" class="nav-link">
          <i class="nav-icon fas fa-edit"></i>
          <p>Laporan Absensi</p>
        </a>
      </li>
      <li class="nav-header"></li>
      <li class="nav-item">
        <a class="nav-link btn-block bg-gradient-danger btn-sm" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        
                                        <i class="nav-icon fa fa-sign-out-alt"></i>
                                        <p>LOGOUT</p>
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
          @csrf
        </form>
      </li>
    </ul>
  </nav>