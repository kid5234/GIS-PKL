<?php
defined('BASEPATH') OR exit('No direct script access allowed');?>

<!-- Load Header -->
<?php $this->load->view('pages/required/head-min', $this->data);
?>

<!-- Load Navigation -->
<?php $this->load->view('pages/required/nav-min', $this->data);
?>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1>
          <span class="navbar-logo">                    
           <img src="<?php echo base_url('assets/images/tes-128x129.png') ?>" alt="PKL GIS" title="" style="height: 4.7rem;">
         </span> PKL GIS
          <small> Pemetaan Lokasi Praktek Kerja Lapangan Mahasiswa Teknik Informatika</small>
        </h1>
      </section>

      <!-- Main content -->
      <section class="content">

        <!-- Default box -->
        <div class="box">
          <div class="box-header with-border">
            <h3 class="box-title"></h3>
          </div>
          <div class="box-body">
            <b><i>Sistem Informasi Geografis Pemetaan Lokasi Praktek Kerja Lapangan Mahasiswa Teknik Informatika </i></b> ini dibuat untuk memenuhi tugas Skripsi Universitas Mulawarman.
            <br>
            Sistem ini dibangun dengan menggunakan Framework PHP Codeigniter 3, Google Maps API, dan menggunakan MySQL sebagai sistem basis data
            <br>
            <hr>
            <b><i>Biografi Peneliti:</i></b>
            <br>
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
          <!-- /.box-body -->
          <div class="box-footer">
    
          </div>
          <!-- /.box-footer-->
        </div>
        <!-- /.box -->

      </section>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
  <footer class="main-footer">
      <div class="pull-right hidden-xs">
        <b>Version</b> 2.4.0
      </div>
      <strong>Copyright &copy; 2014-2016 <a href="https://adminlte.io">Almsaeed Studio</a>.</strong> All rights
      reserved.
    </footer>


  <!-- Add the sidebar's background. This div must be placed
   immediately after the control sidebar -->
   <div class="control-sidebar-bg"></div>
 </div>
 <!-- ./wrapper -->

 <!-- Load script -->
<?php
$this->load->view('pages/required/foot-min', $this->data);?>
</body>
</html>