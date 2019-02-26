<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('pages/required/head-min', $this->data);
?>

<style>
.example-modal .modal {
  position: relative;
  top: auto;
  bottom: auto;
  right: auto;
  left: auto;
  display: block;
  z-index: 1;
}

.example-modal .modal {
  background: transparent !important;
}

ul.options {
  list-style-type: none;
  width: 100%;
  margin: 0.3em 0;
  padding: 0;
}

ul.options li {
  margin: 1px;
  padding: 0.1em 0.3em;
  cursor: pointer;
  color: #46a;
  font-weight: bold;
  border: solid 1px #cde;
}
</style>
<!-- Load Navigation -->
<?php $this->load->view('pages/required/nav-min', $this->data);
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Data PKL
      <small> Teknik Informatika</small>
    </h1>
  </section>

  <!-- Main content -->
  <section class="content">

    <!-- Default box -->
    <div class="box">
      <div class="box-header">        
       <button class="btn btn-success" onclick="add_person()"><i class="fa fa-plus"></i> Add PKL</button>
       <button class="btn btn-default" onclick="reload_table()"><i class="fa fa-refresh"></i> Reload</button>
     </button>
   </div>
   <!-- /.box-header -->
   <div class="box-body">

    <table id="table" class="table table-bordered table-striped table-hover" cellspacing="0" width="100%">
      <thead>
        <tr>
          <th>Mahasiswa</th>
          <th>Dosen Pembimbing</th>
          <th>Lokasi</th>
          <th>Tgl Mulai</th>
          <th>Tgl Selesai</th>
          <th style="width:135px;">Action</th>
        </tr>
      </thead>
      <tbody>
      </tbody>
      <tfoot>
        <tr>
          <th>Mahasiswa</th>
          <th>Dosen Pembimbing</th>
          <th>Lokasi</th>
          <th>Tgl Mulai</th>
          <th>Tgl Selesai</th>
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
  $('.select2').select2()

  $('#datepicker').datepicker({
    autoclose: true,
    format: 'yyyy/mm/dd'
  })
  
  $('#datepicker2').datepicker({
    autoclose: true,
    format: 'yyyy/mm/dd'
  })

    //datatables
    table = $('#table').DataTable({ 

        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.

        // Load data for the table's content from an Ajax source
        "ajax": {
          "url": "<?php echo site_url('pkl_c/pkl_ajax_list')?>",
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

    $("input").change(function(){
      $(this).parent().parent().removeClass('has-error');
      $(this).next().empty();
    });
    $("textarea").change(function(){
      $(this).parent().parent().removeClass('has-error');
      $(this).next().empty();
    });
    $("select").change(function(){
      $(this).parent().parent().removeClass('has-error');
    });

    $('#listmhs').on("select2:select", function(e) { 
      var select = $('#listmhs');
      var $ul = $(select).prev('ul');
      if ($ul.find('input[value=' + $(select).val() + ']').length == 0)
        $ul.append('<li>' +
          '<input type="hidden" name="mhs[]" value="' + 
          $(select).val() + '" /> ' +
          $(select).find(':selected').text() + '<a class="fa fa-close pull-right" onclick="$(this).parent().remove();"></a></li>');
    });

  });

function add_person() {
  save_method = 'add';
    $('#form')[0].reset(); // reset form on modals
    $('#opt').empty();
    $('.select2').val('').trigger('change');
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
    $('#modal_form').modal('show'); // show bootstrap modal
    $('.modal-title').text('Tambah Data PKL'); // Set Title to Bootstrap modal title
  }

  function edit_person(id)
  {
    save_method = 'update';
    $('#form')[0].reset(); // reset form on modals
    $('#opt').empty();
    $('.select2').val('').trigger('change');
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string

    //Ajax Load data from ajax
    $.ajax({
      url : "<?php echo site_url('pkl_c/pkl_ajax_edit/')?>/" + id,
      type: "GET",
      dataType: "JSON",
      success: function(data)
      {
        var nim = data.mhsnim;
        var arrnim  = nim.split(',');
        $('[name="idkelompok"]').val(data.idkelompok);
        $('#listdosen').val(data.dosen_nip).trigger('change');
        for (var i = 0; i < arrnim.length; i++) {
          $('#listmhs').val(arrnim[i]).trigger('change');
          $('#opt').append('<li>' +
          '<input type="hidden" name="mhs[]" value="' + 
          $('#listmhs').val() + '" /> ' +
          $('#listmhs').find(':selected').text() + '<a class="fa fa-close pull-right" onclick="$(this).parent().remove();"></a></li>');  
        }
        $('#listlok').val(data.loc_id).trigger('change');       
        $('[name="tglawal"]').val(data.pkl_tglawal);       
        $('[name="tglakhir"]').val(data.pkl_tglakhir);       
            $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Edit Data PKL'); // Set title to Bootstrap modal title

          },
          error: function (jqXHR, textStatus, errorThrown)
          {
            alert('Error get data from ajax');
          }
        });
  }

  function reload_table()
  {
    table.ajax.reload(null,false); //reload datatable ajax 
  }

  function save()
  {
    $('#btnSave').text('saving...'); //change button text
    $('#btnSave').attr('disabled',true); //set button disable 
    var url;

    if(save_method == 'add') {
      url = "<?php echo site_url('pkl_c/pkl_ajax_add')?>";
    } else {
      url = "<?php echo site_url('pkl_c/pkl_ajax_update')?>";
    }

    // ajax adding data to database
      $.ajax({
      url : url,
      type: "POST",
      data: $('#form').serialize(),
      dataType: "JSON",
      success: function(data)
      {

            if(data.status) //if success close modal and reload ajax table
            {
              $('#modal_form').modal('hide');
              reload_table();
            }
            else
            {
              for (var i = 0; i < data.inputerror.length; i++) 
              {
                    $('[name="'+data.inputerror[i]+'"]').parent().parent().addClass('has-error'); //select parent twice to select div form-group class and add has-error class
                    $('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]); //select span help-block class set text error string
                  }
                }
            $('#btnSave').text('save'); //change button text
            $('#btnSave').attr('disabled',false); //set button enable 


          },
          error: function (jqXHR, textStatus, errorThrown)
          {
            alert('Error adding / update data');
            $('#btnSave').text('save'); //change button text
            $('#btnSave').attr('disabled',false); //set button enable 

          }
        });
  }

  function delete_person(id)
  {
    if(confirm('Are you sure delete this data?'))
    {
        // ajax delete data to database
        $.ajax({
          url : "<?php echo site_url('pkl_c/pkl_ajax_delete')?>/"+id,
          type: "POST",
          dataType: "JSON",
          success: function(data)
          {
                //if success reload ajax table
                $('#modal_form').modal('hide');
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
  <!-- /.modal add start-->
  <div class="modal fade" id="modal_form" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h3 class="modal-title">PKL Form</h3>
        </div>
        <div class="modal-body form">
          <form action="" id="form" class="form-horizontal">
            <input type="hidden" value="" name="id"/> 
            <div class="form-body">
              <div class="form-group">
                <div class="col-md-9">
                  <input name="idkelompok" placeholder="" class="form-control" type="hidden">
                  <span class="help-block"></span>
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-3">Mahasiswa</label>
                <div class="col-md-9">
                 <ul id="opt" class="options">                    
                 </ul>
                 <select id="listmhs" class="form-control select2" style="width: 100%;">
                  <option value="" >--Pilih Mahasiswa--</option>
                  <?php
                  foreach ($mhs as $key => $value) {
                    echo "<option value='".$value->nim."'>".$value->mhs_nama."</option>";
                  }
                  ?>
                </select>
                <span class="help-block"></span>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3">Dosen</label>
              <div class="col-md-9">
                <select name="dosen" id="listdosen" class="form-control select2" style="width: 100%;">
                  <option value="" >--Pilih Dosen--</option>
                  <?php
                  foreach ($dosen as $key => $value) {
                    echo "<option value='".$value->nip."'>".$value->dosen_nama."</option>";
                  }
                  ?>
                </select>
                <span class="help-block"></span>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3">Lokasi PKL</label>
              <div class="col-md-9">
                <select name="lokasi" id="listlok" class="form-control select2" style="width: 100%;">
                  <option value="" >--Pilih Lokasi--</option>
                  <?php
                  foreach ($lokasi as $key => $value) {
                    echo "<option value='".$value->loc_id."'>".$value->loc_nama."</option>";
                  }
                  ?>
                </select>
                <span class="help-block"></span>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3">Tanggal Mulai:</label>
              <div class="col-md-9">
                <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" class="form-control pull-right" name="tglawal" id="datepicker">
                </div>
                <span class="help-block"></span>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3">Tanggal Selesai:</label>
              <div class="col-md-9">
                <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" class="form-control pull-right" name="tglakhir" id="datepicker2">
                </div>
                <span class="help-block"></span>
              </div>
            </div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" id="btnSave" onclick="save()" class="btn btn-primary">Save</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div>
<!-- /.modal add end-->
</body>
</html>