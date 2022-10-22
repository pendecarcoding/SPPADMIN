<!--Header-->
<header class="main-header">
  <!-- Logo -->
  <a href="{{url('/admin')}}" class="logo" style="background-color:{{$datauser->colour}}">
    <!-- mini logo for sidebar mini 50x50 pixels -->
    <span class="logo-mini"><b>S</b>PP</span>
    <!-- logo for regular state and mobile devices -->
    <span style="background-color:{{$datauser->colour}}" class="logo-lg"><b>APP </b>SPP</span>
  </a>
  <!-- Header Navbar: style can be found in header.less -->
  <nav class="navbar navbar-static-top" style="background-color:{{$datauser->colour}}">
    <!-- Sidebar toggle button-->
    <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button" style="background-color:{{$datauser->colour}}">
      <span class="sr-only">Toggle navigation</span>
    </a>

    <div class="navbar-custom-menu">
      <ul class="nav navbar-nav">
        <!-- Messages: style can be found in dropdown.less-->



        <!-- User Account: style can be found in dropdown.less -->
        <li class="dropdown user user-menu">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">

            <img src="{{asset("images/$foto")}}" class="user-image" alt="User Image">
            <span class="hidden-xs">{{$datauser->nama}}</span>
          </a>
          <ul class="dropdown-menu">
            <!-- User image -->
            <li class="user-header" style="background-color:{{$datauser->colour}}">
              <img src="{{asset("images/$foto")}}" class="img-circle" alt="User Image">

              <p>
                {{$datauser->nama}} - {{$datauser->level}}

              </p>
            </li>
            <!-- Menu Body -->

            <!-- Menu Footer-->
            <li class="user-footer">
              <div class="pull-left">
                <?php
                if(Session::get('level')=='admin'){
                 ?>
                <a href="{{url('/admin/pengaturan')}}" class="btn btn-default btn-flat">Profile</a>
                <?php
              }if(Session::get('level')=='operator'){
                 ?>
                 <a href="{{url('/operator/pengaturan')}}" class="btn btn-default btn-flat">Profile</a>
                 <?php
               }
               ?>
              </div>
              <div class="pull-right">
                <a href="{{url('/logout')}}" class="btn btn-default btn-flat">Sign out</a>
              </div>
            </li>
          </ul>
        </li>

      </ul>
    </div>
  </nav>
</header>
<!-- Left side column. contains the logo and sidebar -->
