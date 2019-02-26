<!DOCTYPE html>
<html >
<head>
  <!-- Site made with Mobirise Website Builder v4.9.1, https://mobirise.com -->
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="generator" content="Mobirise v4.9.1, mobirise.com">
  <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1">
  <link rel="shortcut icon" href="<?php echo base_url('assets/images/tes-128x129.png') ?>" type="image/x-icon">
  <meta name="description" content="">
  <title><?php echo $title; ?></title>
  <link rel="stylesheet" href="<?php echo base_url('assets/web/assets/mobirise-icons/mobirise-icons.css') ?>">
  <link rel="stylesheet" href="<?php echo base_url('assets/tether/tether.min.css') ?>">
  <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css') ?>">
  <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/css/bootstrap-grid.min.css') ?>">
  <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/css/bootstrap-reboot.min.css') ?>">
  <link rel="stylesheet" href="<?php echo base_url('assets/dropdown/css/style.css') ?>">
  <link rel="stylesheet" href="<?php echo base_url('assets/datatables/data-tables.bootstrap4.min.css') ?>">
  <link rel="stylesheet" href="<?php echo base_url('assets/mobirise/css/mbr-additional.css') ?>" type="text/css">    
  <link rel="stylesheet" href="<?php echo base_url('assets/theme/css/style.css') ?>">
  <?php echo $map['js'] ?>
</head>
<body>
  <!-- <link rel="stylesheet" href="style.less" class="cid-rgwhiAv3k0" id="menu1-0" data-rv-view="70"> -->
  <section class="menu cid-rgwhiAv3k0" once="menu" id="menu1-0">
    <nav class="navbar navbar-expand beta-menu navbar-dropdown align-items-center navbar-toggleable-sm">
      <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <div class="hamburger">
          <span></span>
          <span></span>
          <span></span>
          <span></span>
        </div>
      </button>
      <div class="menu-logo">
        <div class="navbar-brand">
          <span class="navbar-logo">                    
           <img src="<?php echo base_url('assets/images/tes-128x129.png') ?>" alt="PKL GIS" title="" style="height: 4.7rem;">
         </span>
         <span class="navbar-caption-wrap">
          <a class="navbar-caption text-white display-5" href="<?php echo base_url() ?>">PKL GIS V(1)</a>
        </span>
      </div>
    </div>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav nav-dropdown nav-right" data-app-modern-menu="true">
        <li class="nav-item">
          <a class="nav-link link text-white display-4" data-toggle="modal" href="#modal-about">
            <span class="mbri-smile-face mbr-iconfont mbr-iconfont-btn"></span>About Us
          </a>
          </li><?php if($this->session->has_userdata('admin_login') == FALSE) : ?>
          <li class="nav-item">
            <a class="nav-link link text-white display-4" data-toggle="modal" href='#modalLogin' aria-expanded="true">
              <span class="mbri-unlock mbr-iconfont mbr-iconfont-btn"></span>Login
            </a>
          </li>
          <?php else : ?>
            <li class="nav-item dropdown open">
              <a class="nav-link link text-white dropdown-toggle display-4" href="" data-toggle="dropdown-submenu" aria-expanded="true">
                <span class="mbri-desktop mbr-iconfont mbr-iconfont-btn"></span>Hi, <?php echo $this->session->userdata('user') ?>
              </a>
              <div class="dropdown-menu">
                <a class="text-white dropdown-item display-4" href="<?php echo base_url('dashboard') ?>" aria-expanded="false">
                  <span class="mbri-setting3 mbr-iconfont mbr-iconfont-btn"></span>Dashboard
                </a>
                <a class="text-white dropdown-item display-4" href="<?php echo base_url('user/signout') ?>">
                  <span class="mbri-lock mbr-iconfont mbr-iconfont-btn"></span>Logout
                </a>
              </div>
            </li>
          <?php endif; ?>
        </ul>            
      </div>
    </nav>
  </section>
  <section class="engine">
    <a href="https://mobirise.info/u">bootstrap responsive templates</a>
  </section>
  <section class="mbr-section contacts1 cid-rgwil13nrD" id="contacts1-3">
    <!---->    
    <!---->
    <!--Overlay-->
    <!--Container-->
    <div class="container">
      <div class="row">
        <!--Titles-->
            <!-- <div class="title col-12">
              <h2 class="align-left mbr-fonts-style display-1">
                Our Contacts
              </h2>
            </div> -->
            <!--Left-->
            <div class="col-12 col-md-3">
              <div class="left-block wrapper">
                <form action="" class="form-group" method="POST" role="form">
                  <h5 class="align-left mbr-fonts-style m-0 display-6">
                    Search Location By:
                  </h5>
                  <br>
                  <select id="showby" name="showby" class="form-control">
                    <option value="">-- Select --</option>
                    <option value="rank">Ranking</option>
                    <option value="jenis">Jenis Instansi</option>
                  </select>
                  <hr>
                  <select id="listtype" name="listtype" class="form-control" style="display: none">
                    <option value="noll">-- Select --</option>
                  </select>
                  <button type="submit" class="btn btn-primary">Search</button>
                </form>
              </div>
            </div>
            <!--Right-->
            <div class="col-12 col-md-9">
              <div class="map-canvas">
               <?php echo $map['html'] ?>
             </div>
           </div>
         </div>
       </div>
       <div class="modal fade" id="modalLogin">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              <h4 class="modal-title">Login</h4>
            </div>
            <form action="<?php echo base_url('user/auth') ?>" method="POST" role="form">
              <div class="modal-body">
                <div class="form-group">
                  <label for="">Username / E-Mail :</label>
                  <input type="text" class="form-control" name="identity" required>
                </div>
                <div class="form-group">
                  <label for="">Password :</label>
                  <input type="password" class="form-control" name="pwd" required>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Login</button>
              </div>
            </form>
          </div>
        </div>
      </div>
      <div class="modal fade" id="modal-alert">
        <div class="modal-dialog modal-alert">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title"><i class="fa fa-warning"></i> Perhatian! <?php echo $this->session->flashdata('message') ?></h4>
            </div>
          </div>
        </div>
      </div>
      <div class="modal fade" id="modal-about" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              <h4 class="modal-title">Tentang Aplikasi</h4>
            </div>
            <div class="modal-body">
              <p class="text-center">PKL GIS adalah GIS yang dibangun dengan PHP (Framework Codeigniter 3), Google Maps V3 API dan Twitter bootstrap, Dibuat demi memenuhi tugas <i>Skripsi</i> Teknik Informatika, Universitas Mulawarman.</p>
              <table class="table table-striped">
                <tbody>
                  <tr>
                    <td>Nama Pengembang</td>
                    <td width="50" class="text-center">:</td>
                    <td>Nashiruddin Kafi</td>
                  </tr>
                  <tr>
                    <td>Tempat, Tanggal Lahir</td>
                    <td width="50" class="text-center">:</td>
                    <td>Balikpapan, 23 Oktober 1994</td>
                  </tr>
                  <tr>
                    <td>NIM</td>
                    <td width="50" class="text-center">:</td>
                    <td>1215015071</td>
                  </tr>
                  <tr>
                    <td>Alamat Saat Ini:</td>
                    <td width="50" class="text-center">:</td>
                    <td>Jl. Pramuka 5A Samarinda</td>
                  </tr>
                  <tr>
                    <td>Nomor Telepon</td>
                    <td width="50" class="text-center">:</td>
                    <td>0821-5731-6552</td>
                  </tr>
                </tbody>
              </table>                  
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div>
    </section>
  </section>
  <section once="" class="cid-rgJdTiJ1Q7" id="footer6-8">
    <div class="container">
      <div class="media-container-row align-center mbr-white">
        <div class="col-12">
          <p class="mbr-text mb-0 mbr-fonts-style display-7">
            © Copyright 2019 - Theme by Mobirise | Nashiruddin Kafi - All Rights Reserved
          </p>
        </div>
      </div>
    </div>
  </section>
  <script src="<?php echo base_url('assets/web/assets/jquery/jquery.min.js') ?>"></script>
  <script src="<?php echo base_url('assets/popper/popper.min.js') ?>"></script>
  <script src="<?php echo base_url('assets/tether/tether.min.js') ?>"></script>
  <script src="<?php echo base_url('assets/bootstrap/js/bootstrap.min.js') ?>"></script>
  <script src="<?php echo base_url('assets/smoothscroll/smooth-scroll.js') ?>"></script>
  <script src="<?php echo base_url('assets/dropdown/js/script.min.js') ?>"></script>
  <script src="<?php echo base_url('assets/touchswipe/jquery.touch-swipe.min.js') ?>"></script>
  <script src="<?php echo base_url('assets/datatables/jquery.data-tables.min.js') ?>"></script>
  <script src="<?php echo base_url('assets/datatables/data-tables.bootstrap4.min.js') ?>"></script>
  <script src="<?php echo base_url('assets/theme/js/script.js') ?>"></script>
  <script src="<?php echo base_url('assets/formoid/formoid.min.js') ?>"></script>
  <script language="javascript">
    var ranklist = [
    {display: "-- Select --", value: "0" },
    {display: "Top 5", value: "top-5" }, 
    {display: "Top 10", value: "top-10" }, 
    {display: "Top 20", value: "top-20" },
    {display: "Top 50", value: "top-50" }];

    $(document).ready(function() {
      $('select[name="showby"]').on('change', function() {
        if ($(this).val() == 'rank') {
          $('#listtype').show();
                $('#listtype').empty(); //reset child options
                $(ranklist).each(function (i) { //populate child options 
                  $('#listtype').append("<option value=\""+ranklist[i].value+"\">"+ranklist[i].display+"</option>");
                });
              } else if ($(this).val() == 'jenis'){
                $('#listtype').show();
                $('#listtype').empty();
                $.ajax({
                  url: '<?php echo base_url('/welcome/getjenis')?>',
                  type: "GET",
                  dataType: "json",
                  success:function(data) {
                    $('#listtype').append('<option value="">--Pilih Jenis--</option>');
                    $.each(data, function(key, value) {
                      $('#listtype').append('<option value="'+ value.loc_category_id +'">'+ value.loc_category_name +'</option>');
                    });
                  }
                });
              } else if ($(this).val() == ''){
                $('#listtype').hide();
              }
            });



    });
  </script>
  <script>
    function detail_hotel(param) 
    {
      $('div#modal-id').modal('show');
    }
    $(document).ready(function() {
      <?php if($this->session->flashdata('message')) : ?>
        $('div#modal-alert').modal('show');
      <?php endif; ?>
    });
  </script>
</body>
</html>