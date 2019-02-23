<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('pages/required/head-min', $this->data);
?>

<!-- Load Navigation -->
<?php $this->load->view('pages/required/nav-min', $this->data);
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Data Lokasi
      <small> Praktek Kerja Lapangan</small>
    </h1>
  </section>

  <!-- Main content -->
  <section class="content">

    <!-- Default box -->
    <div class="box">
      <div class="box-header">        
       <a class="btn btn-success" href="<?php echo base_url('dashboard/addlocation');  ?>"><i class="fa fa-plus"></i> Add Lokasi</a>
       <button class="btn btn-default" onclick="reload_table()"><i class="fa fa-refresh"></i> Reload</button>
     </button>
  </div>
  <!-- /.box-header -->
  <div class="box-body">

    <table id="table" class="table table-bordered table-striped table-hover" cellspacing="0" width="100%">
      <thead>
        <tr>
          <th>Nama</th>
          <th>Alamat</th>
          <th>Jenis Lokasi</th>
          <th>Kota</th>
          <th>Provinsi</th>
          <th style="width:125px;">Action</th>
        </tr>
      </thead>
      <tbody>
      </tbody>
      <tfoot>
        <tr>
          <th>Nama</th>
          <th>Alamat</th>
          <th>Jenis Lokasi</th>
          <th>Kota</th>
          <th>Provinsi</th>
          <th>Action</th>
        </tr>             
      </tfoot>
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

 <script type="text/javascript">

var save_method; //for save method string
var table;

$(document).ready(function() {

    //datatables
    table = $('#table').DataTable({ 

        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.

        // Load data for the table's content from an Ajax source
        "ajax": {
          "url": "<?php echo site_url('loc_c/loc_ajax_list')?>",
          "type": "POST"
        },

        //Set column definition initialisation properties.
        "columnDefs": [
        { 
            "targets": [ -1 ], //last column
            "orderable": false, //set not orderable
          },
          ],

        });
  });

  function reload_table()
  {
    table.ajax.reload(null,false); //reload datatable ajax 
  }

  function delete_person(id)
  {
    if(confirm('Are you sure delete this data?'))
    {
        // ajax delete data to database
        $.ajax({
          url : "<?php echo site_url('loc_c/loc_ajax_delete')?>/"+id,
          type: "POST",
          dataType: "JSON",
          success: function(data)
          {
                reload_table();
              },
              error: function (jqXHR, textStatus, errorThrown)
              {
                alert('Error deleting data');
              }
            });

      }
    }

  </script>
</body>
</html>