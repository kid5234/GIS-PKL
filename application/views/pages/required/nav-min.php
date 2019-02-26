</head>
<body class="hold-transition skin-red sidebar-mini fixed">
  <div class="wrapper">

    <header class="main-header">
      <!-- Logo -->
      <a href="<?php echo base_url('dashboard')?>" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        
        <span class="logo-mini"><b>S</b>KL</span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><b>Sig</b>PKL</span>
      </a>
      <!-- Header Navbar: style can be found in header.less -->
      <nav class="navbar navbar-static-top">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
          <span class="sr-only">Toggle navigation</span>
        </a>

        <div class="navbar-custom-menu">
          <ul class="nav navbar-nav">
            <li>
              <a href="<?php echo base_url()?>">
                <i class="fa fa-arrow-right"></i> <span>to Main Page</span>
              </a>
            </li>
            <!-- User Account: style can be found in dropdown.less -->
            <li class="dropdown user user-menu">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <img src="<?php echo base_url('assets/dist/img/avatar04.png') ?>" class="user-image" alt="User Image">
                <span class="hidden-xs"><?php echo $this->session->userdata('nama')?></span>
              </a>
              <ul class="dropdown-menu">
                <!-- User image -->
                <li class="user-header">
                  <img src="<?php echo base_url('assets/dist/img/avatar04.png') ?>" class="img-circle" alt="User Image">

                  <p>
                    <?php echo $this->session->userdata('nama')?>
                  </p>
                </li>
                <!-- Menu Footer-->
                <li class="user-footer">
                  <div class="pull-left">
                    <a href="<?php echo base_url('dashboard/profile')?>" class="btn btn-default btn-flat">Profile</a>
                  </div>
                  <div class="pull-right">
                    <a href="<?php echo base_url('user/signout') ?>" class="btn btn-default btn-flat">Log out</a>
                  </div>
                </li>
              </ul>
            </li>
            <!-- Control Sidebar Toggle Button -->          
          </ul>
        </div>
      </nav>
    </header>
    <!-- Left side column. contains the logo and sidebar -->
    <aside class="main-sidebar">
      <!-- sidebar: style can be found in sidebar.less -->
      <section class="sidebar">

        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">
          <li class="header">MAIN NAVIGATION</li>
          <li <?php if($this->uri->segment( $this->uri->total_segments())=="dashboard"){echo 'class="active"';}?>>
            <a href="<?php echo base_url('dashboard')?>">
              <i class="fa fa-dashboard"></i> <span>Dashboard</span>
            </a>
          </li>
          <li <?php if($this->uri->segment( $this->uri->total_segments())=="location" or $this->uri->segment( $this->uri->total_segments())=="addlocation" or $this->uri->segment( $this->uri->total_segments())=="jenislokasi" or $this->uri->segment(2)=="editlocation"){echo 'class="treeview active menu-open"';} else {echo 'class="treeview"';}?>>
            <a href="">
              <i class="fa fa-globe"></i> <span>Lokasi</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li <?php if($this->uri->segment( $this->uri->total_segments())=="jenislokasi" ){echo 'class="active"';}?>><a href="<?php echo base_url('dashboard/jenislokasi')?>"><i class="fa fa-circle-o"></i> Jenis Lokasi</a></li>
              <li <?php if($this->uri->segment( $this->uri->total_segments())=="location" or $this->uri->segment(2)=="editlocation" or $this->uri->segment( $this->uri->total_segments())=="addlocation"){echo 'class="active"';}?>><a href="<?php echo base_url('dashboard/location')?>"><i class="fa fa-circle-o"></i> List Lokasi</a></li>
            </ul>
          </li>
          <li <?php if($this->uri->segment( $this->uri->total_segments())=="mahasiswa"){echo 'class="active"';}?>>
            <a href="<?php echo base_url('dashboard/mahasiswa')?>">
              <i class="fa fa-mortar-board"></i> <span>Mahasiswa</span>
            </a>
          </li>
          <li <?php if($this->uri->segment( $this->uri->total_segments())=="dosen"){echo 'class="active"';}?>>
            <a href="<?php echo base_url('dashboard/dosen')?>">
              <i class="fa fa-university"></i> <span>Dosen</span>
            </a>
          </li>
          <li <?php if($this->uri->segment( $this->uri->total_segments())=="pkl"){echo 'class="active"';}?>>
            <a href="<?php echo base_url('dashboard/pkl')?>">
              <i class="fa fa-th"></i> <span>PKL</span>
            </a>
          </li>
        </ul>
      </section>
      <!-- /.sidebar -->
    </aside>