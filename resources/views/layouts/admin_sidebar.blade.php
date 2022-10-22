<!--sidebar-->
<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">
    <!-- Sidebar user panel -->
    <div class="user-panel">
      <div class="pull-left image">
        <img src="{{asset("images/$foto")}}" class="img-circle" alt="User Image">
      </div>
      <div class="pull-left info">
        <p>{{Session::get('namauser')}}</p>
        <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
      </div>
    </div>
    <!-- search form -->
    <form action="#" method="get" class="sidebar-form">
      <div class="input-group">
        <input type="text" name="q" class="form-control" placeholder="Search...">
        <span class="input-group-btn">
              <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
              </button>
            </span>
      </div>
    </form>
    <!-- /.search form -->
    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu" data-widget="tree">

    @if($level=='admin')
    <li class="{{ Request::is('admin')? "active":"" }}" ><a href="{{url('/admin')}}"><i class="fa fa-dashboard"></i><span>Dashboard</span></a></li>
      <!--Data master-->
      <li class="
      {{ Request::is('master/datadpa/tambah')? "active":"" }}
      {{ Request::is('master/datadpa')? "active":"" }}
      {{ Request::is('master/databidang/tambah')? "active":"" }}
      {{ Request::is('master/databidang')? "active":"" }}
      {{ Request::is('master/datapegawai/tambah')? "active":"" }}
      {{ Request::is('master/datapegawai')? "active":"" }}
      {{ Request::is('master/dataoperator')? "active":"" }}
      {{ Request::is('master/dataoperator/tambah')? "active":"" }} treeview">
        <a href="#">
          <i class="fa fa-database" aria-hidden="true"></i> <span>Data Master</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li class="
          {{ Request::is('master/databidang/tambah')? "active":"" }}
          {{ Request::is('master/databidang')? "active":"" }}"
          ><a href="{{url('master/databidang')}}"><i class="fa fa-building"></i> Data Bidang & Kepegwaian</a></li>
          <li class="
          {{ Request::is('master/datapegawai/tambah')? "active":"" }}
          {{ Request::is('master/datapegawai')? "active":"" }}"><a href="{{url('master/datapegawai')}}"><i class="fa fa-users"></i>Data Pegawai</a></li>
          <li class="
          {{ Request::is('master/dataoperator')? "active":"" }}
          {{ Request::is('master/dataoperator/tambah')? "active":"" }}"><a href="{{url('master/dataoperator')}}"><i class="fa fa-user"></i>Data Operator</a></li>

          <li class="
          {{ Request::is('master/datadpa/tambah')? "active":"" }}
          {{ Request::is('master/datadpa')? "active":"" }}"><a href="{{url('master/datadpa')}}"><i class="fa fa-tag"></i> Mata Anggaran</a></li>

        </ul>
      </li>
      @endif
      @if($level=='walikelas')
      <li class="{{ Request::is('kesehatansiswa')? "active":"" }}" ><a href="{{url('/kesehatansiswa')}}"><i class="fa fa-thermometer-empty"></i><span>Data Kesehatan</span></a></li>
      <li class="{{ Request::is('hafalansiswa')? "active":"" }}" ><a href="{{url('/hafalansiswa')}}"><i class="fa fa-book"></i><span>Data Hafalan</span></a></li>
      @endif
      @if($level=='operator')
      <li class="{{ Request::is('admin')? "active":"" }}" ><a href="{{url('/admin')}}"><i class="fa fa-dashboard"></i><span>Dashboard</span></a></li>
      <li class="{{ Request::is('pembayaran/*')? "active":"" }}">
        <a href="{{url('/pembayaran/pembayaransiswa')}}"><i class="fa fa-credit-card"></i><span>Pembayaran Siswa</span></a></li>

      <li class="treeview {{ Request::is('payment/bulanan*')? "active":"" }} {{ Request::is('keuangan/poskeuangan*')? "active":"" }}{{ Request::is('keuangan/kebijakan*')? "active":"" }}
      {{ Request::is('payment/jenis_pay*')? "active":"" }}
      {{ Request::is('payment/paymentkhusus')? "active":"" }} ">
        <a href="#">
          <i class="fa fa-money" aria-hidden="true"></i> <span>Keuangan</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu ">
          <li class="{{ Request::is('keuangan/poskeuangan*')? "active":"" }}
          "><a href="{{url('/keuangan/poskeuangan')}}"><i class="fa fa-circle"></i>POS Keuangan</a></li>
          <li class="{{ Request::is('keuangan/kebijakan')? "active":"" }}
          "><a href="{{url('/keuangan/kebijakan')}}"><i class="fa fa-circle"></i>Kebijakan</a></li>
          <li class="{{ Request::is('payment/jenis_pay*')? "active":"" }}{{ Request::is('payment/bulanan*')? "active":"" }}">
            <a href="{{url('/payment/jenis_pay')}}"><i class="fa fa-circle"></i>Tarif Umum</a></li>
            <li class="{{ Request::is('payment/paymentkhusus')? "active":"" }}">
              <a href="{{url('/payment/paymentkhusus')}}"><i class="fa fa-circle"></i>Tarif Khusus</a></li>

        </ul>
      </li>



      <li class="treeview {{ Request::is('jurnalumum/pemasukan')? "active":"" }}
      {{ Request::is('jurnalumum/jenispengeluaran')? "active":"" }}
      {{ Request::is('jurnalumum/pengeluaran')? "active":"" }} ">
        <a href="#">
          <i class="fa fa-pencil-square-o" aria-hidden="true"></i> <span>Jurnal Umum</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu ">
          <li class="{{ Request::is('jurnalumum/pemasukan')? "active":"" }}
          "><a href="{{url('/jurnalumum/pemasukan')}}"><i class="fa fa-circle"></i>Penerimaan</a></li>
          <li class="{{ Request::is('jurnalumum/jenispengeluaran')? "active":"" }}">
            <a href="{{url('/jurnalumum/jenispengeluaran')}}"><i class="fa fa-circle"></i>Jenis Pengeluaran</a></li>
            <li class="{{ Request::is('jurnalumum/pengeluaran')? "active":"" }}">
              <a href="{{url('/jurnalumum/pengeluaran')}}"><i class="fa fa-circle"></i>Pengeluaran</a></li>


        </ul>
      </li>

      <li class="treeview {{ Request::is('datamaster*')? "active":"" }}">
        <a href="#">
          <i class="fa fa-database" aria-hidden="true"></i> <span>Data Master</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu ">
          <li class="{{ Request::is('datamaster/datakelas')? "active":"" }}">
            <a href="{{url('/datamaster/datakelas')}}"><i class="fa fa-circle"></i>Kelas</a></li>
          <li class="{{ Request::is('datamaster/datasiswa')? "active":"" }}
          "><a href="{{url('/datamaster/datasiswa')}}"><i class="fa fa-circle"></i>Siswa</a></li>
          <li class="{{ Request::is('datamaster/dataguru')? "active":"" }}{{ Request::is('datamaster/editguru*')? "active":"" }}
          "><a href="{{url('/datamaster/dataguru')}}"><i class="fa fa-circle"></i>Data Guru</a></li>
          <li class="{{ Request::is('datamaster/datawalikelas')? "active":"" }}
          "><a href="{{url('/datamaster/datawalikelas')}}"><i class="fa fa-circle"></i>Data Wali Kelas</a></li>

          <li class="{{ Request::is('datamaster/walimurid')? "active":"" }}
          "><a href="{{url('/datamaster/walimurid')}}"><i class="fa fa-users"></i>Data Wali Murid</a></li>

        </ul>
      </li><li class="treeview {{ Request::is('laporan/laporantahunan')? "active":"" }}{{ Request::is('laporan/laporanbulanan')? "active":"" }}">
        <a href="#">
          <i class="fa fa-print" aria-hidden="true"></i> <span>Laporan</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu ">
          <li class="{{ Request::is('laporan/laporanbulanan')? "active":"" }}">
            <a href="{{url('/laporan/laporanbulanan')}}"><i class="fa fa-circle"></i> Laporan Bulanan</a></li>
          <!--<li class="{{ Request::is('laporan/laporantahunan')? "active":"" }}">
            <a href="{{url('/laporan/laporantahunan')}}"><i class="fa fa-circle"></i> Laporan Tahunan</a></li>-->


        </ul>
      </li>
      <li class="{{ Request::is('kenaikan/setkenaikan')? "active":"" }}{{ Request::is('kenaikan/lihatsiswakelas')? "active":"" }}">
      <a href="{{url('/kenaikan/setkenaikan')}}"><i class="fa fa-book"></i><span>Kenaikan Kelas</span></a></li>

      <li class="{{ Request::is('kelulusan/setkelulusan')? "active":"" }}{{ Request::is('kelulusan/lihatsiswakelas')? "active":"" }}">
      <a href="{{url('/kelulusan/setkelulusan')}}"><i class="fa fa-graduation-cap"></i><span>Kelulusan Siswa</span></a></li>

      @endif
      @if($level=='admin')
      <li class="{{ Request::is('admin/pengaturan')? "active":"" }}"><a href="{{url('admin/pengaturan')}}"><i class="fa fa-cog"></i><span>Pengaturan</span></a></li>
      @endif
      @if($level=='operator')
      <li class="treeview {{ Request::is('operator/pengaturan')? "active":"" }}
      {{ Request::is('operator/pengaturan/sekolah')? "active":"" }}">
        <a href="#">
          <i class="fa fa-cog" aria-hidden="true"></i> <span>Pengaturan</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu ">
        <li class="{{ Request::is('operator/pengaturan')? "active":"" }}">
          <a href="{{url('/operator/pengaturan')}}"><i class="fa fa-user"></i><span> Data Diri</span></a></li>
        <li class="{{ Request::is('operator/pengaturan/sekolah')? "active":"" }}">
        <a href="{{url('/operator/pengaturan/sekolah')}}"><i class="fa fa-building"></i> Sekolah</a></li>


        </ul>
      </li>

      @endif
    </ul>
  </section>
  <!-- /.sidebar -->
</aside>
