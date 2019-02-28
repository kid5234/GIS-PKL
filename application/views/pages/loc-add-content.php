<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('pages/required/head-min', $this->data);
?>
<!-- Load Navigation -->
<style type="text/css">
html, body {
  height: 100%;
  margin: 0;
  padding: 0;
}
#map {
  height: 100%;
}
#description {
  font-family: Roboto;
  font-size: 15px;
  font-weight: 300;
}

#infowindow-content .title {
  font-weight: bold;
}

#infowindow-content {
  display: none;
}

#map #infowindow-content {
  display: inline;
}

.pac-card {
  margin: 10px 10px 0 0;
  border-radius: 2px 0 0 2px;
  box-sizing: border-box;
  -moz-box-sizing: border-box;
  outline: none;
  box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
  background-color: #fff;
  font-family: Roboto;
}

#pac-container {
  padding-bottom: 12px;
  margin-right: 12px;
}

.pac-controls {
  display: inline-block;
  padding: 5px 11px;
}

.pac-controls label {
  font-family: Roboto;
  font-size: 13px;
  font-weight: 300;
}

#pac-input {
  background-color: #fff;
  font-family: Roboto;
  font-size: 15px;
  font-weight: 300;
  margin-left: 12px;
  padding: 0 11px 0 13px;
  text-overflow: ellipsis;
  width: 500px;
}

#pac-input:focus {
  border-color: #4d90fe;
}

#title {
  color: #fff;
  background-color: #4d90fe;
  font-size: 25px;
  font-weight: 500;
  padding: 6px 12px;
}
#target {
  width: 345px;
}
</style>

<?php
if (!empty($method)) {
  echo "<script type='text/javascript'>". "\n";
  echo "var save_method = " . json_encode($method) . "\n";
  if (isset($result) && !empty($result)){
    echo "var provid = " . json_encode($result->loc_prov_id) . "\n";
    echo "var kotkab_selected = " . json_encode($result->loc_reg_id) . "\n";
  }
  echo "</script>";
}
?>

<?php $this->load->view('pages/required/nav-min', $this->data);
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      <?php echo $cara ?> Data Lokasi
      <small> Praktek Kerja Lapangan</small>
    </h1>
  </section>

  <!-- Main content -->
  <section class="content">

    <!-- Default box -->
    <div class="box box-default">
      <div class="box-header">        
        <div class="alert alert-success alert-dismissible fade in" style="display:none;">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
          <i class="icon fa fa-check"></i> <b>Success!</b> Data lokasi berhasil di<?php echo $cara ?>.
        </div>
        <a href="<?php echo base_url('dashboard/location')?>" class='btn btn-default'><i class='fa fa-arrow-left'></i> <span>  Kembali</span></a>
      </div>
      <!-- /.box-header -->
      <div class="box-body">
        <div class="row">
          <div class="col-md-6">
            <form action="" id="form" name="form" class="form-horizontal">
              <div class="form-body">
                <div class="form-group">
                  <label class="control-label col-md-2">Place ID</label>
                  <div class="col-md-10">
                    <input id="placeid" name="placeid" <?php if (empty($result)){ echo 'placeholder="Place ID .."';} else { echo 'value="'.$result->loc_id.'"';} ?> class="form-control" type="text">
                    <span class="help-block"></span>
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-md-2">Nama</label>
                  <div class="col-md-10">
                    <input id="nama" name="nama"  <?php if (empty($result)){ echo 'placeholder="Nama .."';} else { echo 'value="'.$result->loc_nama.'"';} ?> class="form-control" type="text">
                    <span class="help-block"></span>
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-md-2">Alamat</label>
                  <div class="col-md-10">
                    <textarea id="alamat" name="alamat" <?php if (empty($result)){ echo 'placeholder="Alamat .."';}?> class="form-control"><?php if (empty($result)){} else { echo $result->loc_alamat;} ?></textarea>
                    <span class="help-block"></span>
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-md-2">Telepon</label>
                  <div class="col-md-10">
                    <div class="input-group">
                      <div class="input-group-addon">
                        <i class="fa fa-phone"></i>
                      </div>
                      <input type="text" <?php if (empty($result)){ echo 'placeholder=""';} else { echo 'value="'.$result->loc_notelp.'"';} ?>name="telepon" class="form-control">
                    </div>
                    <span class="help-block"></span>
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-md-2">Provinsi</label>
                  <div class="col-md-10">
                    <select name="prov" class="form-control" style="width: 100%;">
                      <option value="" >--Pilih Provinsi--</option>
                      <?php
                      foreach ($province as $key => $value) {
                        echo "<option value='".$value->id."'>".$value->name."</option>";
                      }
                      ?>
                    </select>
                    <span class="help-block"></span>
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-md-2">Kota</label>
                  <div class="col-md-10">
                    <select name="kota" class="form-control" style="width: 100%;">
                      <option value="">--Select Province First--</option>
                    </select>
                    <span class="help-block"></span>
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-md-2">Jenis</label>
                  <div class="col-md-10">
                    <select name="jenis" class="form-control" style="width: 100%;">
                      <option value="">--Select Jenis--</option>
                      <?php
                      foreach ($jenis as $key => $val) {
                        if (!empty($result) && $val->loc_category_id == $result->loc_category_id){
                          echo "<option value='".$val->loc_category_id."' selected>".$val->loc_category_name."</option>";
                        } else {
                          echo "<option value='".$val->loc_category_id."'>".$val->loc_category_name."</option>";
                        }
                      }
                      ?>
                    </select>
                    <span class="help-block"></span>
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-md-2">Latitude</label>
                  <div class="col-md-10">
                    <input id="lat" name="lat" <?php if (empty($result)){ echo 'placeholder="Latitude .."';} else { echo 'value="'.$result->loc_lat.'"';} ?> class="form-control" type="number">
                    <span class="help-block"></span>
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-md-2">Longitude</label>
                  <div class="col-md-10">
                    <input id="lng" name="lng" <?php if (empty($result)){ echo 'placeholder="Longitude .."';} else { echo 'value="'.$result->loc_lang.'"';} ?> class="form-control" type="number">
                    <span class="help-block"></span>
                  </div>
                </div>
                <hr>
                <div class="form-group">
                  <div class="col-md-12">
                    <button type="button" id="btnSave" onclick="save()" class="btn btn-primary pull-right">Save</button>
                    <button type="button" id="btnReset" class="btn btn-danger" >Cancel</button>
                  </div>
                </div>
              </div>
            </form>
          </div>
          <div class="col-md-6">
            <label class="control-label col-md-10">Setelah melakukan pencarian, klik marker untuk mengambil data lokasi ke form</label>
            <input type="text" name="pac-input" id="pac-input" placeholder="Search Here" />
            <div id="map" style="height: 400px; width: 100%;"></div>
            <div id="infowindow-content">
              <img src="" width="16" height="16" id="place-icon">
              <span id="place-name"  class="title"></span><br>
            </div>
            <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAJGxbuldQVV1qodn-Ge3uSqoe7rWRg8vk&libraries=places&callback=initAutocomplete&language=id&region=ID"
            async defer></script>
            <script type="text/javascript"> //init google-maps
            function initAutocomplete() {
              var map;
              var marker = [];
              var infowindow = new google.maps.InfoWindow();
              var infowindowContent = document.getElementById('infowindow-content');
              infowindow.setContent(infowindowContent);

              if (save_method == "update"){
                var latval = parseFloat(document.getElementById("lat").value);
                var lngval = parseFloat(document.getElementById("lng").value);
                var myLatLng = {lat: latval, lng: lngval};
                map = new google.maps.Map(document.getElementById('map'), {
                  center: myLatLng,
                  zoom: 16,
                  mapTypeId: 'roadmap'
                });

                marker = new google.maps.Marker({
                  map: map,
                  position: myLatLng,
                  draggable: true
                });
                marker.setMap(map);

                google.maps.event.addListener(marker,'drag',function(event) {
                  document.getElementById('lat').value = event.latLng.lat();
                  document.getElementById('lng').value = event.latLng.lng();
                });

                google.maps.event.addListener(marker,'dragend',function(event) 
                {
                  document.getElementById('lat').value =event.latLng.lat();
                  document.getElementById('lng').value =event.latLng.lng();
                });

              } else {
                map = new google.maps.Map(document.getElementById('map'), {
                  center: {lat: -0.4959538, lng:117.1562388},
                  zoom: 13,
                  mapTypeId: 'roadmap'
                });
              }

              var input = document.getElementById('pac-input');
              var searchBox = new google.maps.places.SearchBox(input);
              map.controls[google.maps.ControlPosition.TOP_RIGHT].push(input);

              map.addListener('bounds_changed', function() {
                searchBox.setBounds(map.getBounds());
              });

              searchBox.addListener('places_changed', function() {
                var places = searchBox.getPlaces();

                if (places.length == 0) {
                  return;
                }

                var bounds = new google.maps.LatLngBounds();
                places.forEach(function(place) {

                  if (!place.geometry) {
                    console.log("Returned place contains no geometry");
                    return;
                  }
                  var icon = {
                    url: place.icon,
                    size: new google.maps.Size(71, 71),
                    origin: new google.maps.Point(0, 0),
                    anchor: new google.maps.Point(17, 34),
                    scaledSize: new google.maps.Size(25, 25)
                  };

                  if (marker && marker.setMap) {
                    marker.setMap(null);
                    marker = [];
                  }
                  marker = new google.maps.Marker({
                    map: map,
                    position: place.geometry.location
                  });

                  var id = place.place_id;
                  var name = place.name;
                  var lat = marker.getPosition().lat();
                  var lng = marker.getPosition().lng();
                  var address = '';
                  if (place.address_components) {
                    address = [
                    (place.address_components[1] && place.address_components[1].long_name || ''),
                    (place.address_components[0] && place.address_components[0].short_name || ''),
                    (place.address_components[2] && place.address_components[2].long_name || ''),
                    ].join(' ');
                  }

                  infowindowContent.children['place-icon'].src = place.icon;
                  infowindowContent.children['place-name'].textContent = place.name;
                  infowindow.open(map, marker);

                  google.maps.event.addListener(marker, 'click', function() {
                    infowindowContent.children['place-icon'].src = place.icon;
                    infowindowContent.children['place-name'].textContent = place.name;
                    infowindow.open(map, this);
                    document.getElementById('placeid').value = id;
                    document.getElementById('nama').value = name;
                    document.getElementById('alamat').value = address;
                    document.getElementById('lat').value = lat;
                    document.getElementById('lng').value = lng;
                  });

                  if (place.geometry.viewport) {
                    bounds.union(place.geometry.viewport);

                  } else {
                    bounds.extend(place.geometry.location);
                  }
                });

                map.fitBounds(bounds);
              });
            }
          </script>            
        </div>
      </div>
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

<script type="text/javascript"> //doc-ready-func

$(document).ready(function() {
  //$('.alert').hide()
  //$('.select2').select2()

  if (typeof provid != 'undefined') {
    $('select[name="prov"]').val(provid).prop('selected', true);
    listkotakab();
  }

  if (save_method == 'update'){
    $('[name="placeid"]').prop("readonly", true);
  }

  $('#btnReset').on('click', function () {
        $('#form')[0].reset(); // reset form on modals
        $('form').find('.has-error').removeClass("has-error");
        $('form').find('.help-block').empty();
      });

  $('select[name="prov"]').on('change', function() {
    listkotakab();
  });

  $("input").change(function(){
    $(this).parent().parent().removeClass('has-error');
    $(this).next().empty();
  });
  $("textarea").change(function(){
    $(this).parent().parent().removeClass('has-error');
    //$(this).next().empty();
  });

});

function listkotakab() {
  var stateID = $('select[name="prov"]').val();
  if(stateID) {
    $.ajax({
      url: '<?php echo base_url('/dashboard/getreg/')?>'+stateID,
      type: "GET",
      dataType: "json",
      success:function(data) {
        $('select[name="kota"]').empty();
        $('select[name="kota"]').append('<option value="">-- Pilih Kabupaten/Kota --</option>');
        $.each(data, function(key, value) {
          if (typeof kotkab_selected != 'undefined'){
            if (value.id == kotkab_selected){
              $('select[name="kota"]').append('<option value="'+ value.id +'" selected>'+ value.name +'</option>');
            } else {
              $('select[name="kota"]').append('<option value="'+ value.id +'">'+ value.name +'</option>');
            }       
          } else {
            $('select[name="kota"]').append('<option value="'+ value.id +'">'+ value.name +'</option>');
          }    
        });
      }
    });
  }else{
    $('select[name="city"]').empty();
  }
}

function save(){
    $('#btnSave').text('saving...'); //change button text
    $('#btnSave').attr('disabled',true); //set button disable 
    var url;

    if(save_method == 'add') {
      url = "<?php echo site_url('loc_c/loc_ajax_add')?>";
    } else {
      url = "<?php echo site_url('loc_c/loc_ajax_update')?>";
    }

    $.ajax({
      url : url,
      type: "POST",
      data: $('#form').serialize(),
      dataType: "JSON",
      success: function(data)
      {
            if(data.status) //if success close modal and reload ajax table
            {
              $('.alert').fadeIn('slow', function(){
               $('.alert').delay(3000).fadeOut(); 
              });
              //$('.alert').show();
              $('#form')[0].reset(); 
              $('input[name="pac-input"').val('');// reset form on modals
              if (save_method == 'update'){
                window.location.href = "<?php echo base_url('dashboard/location')?>";
              }
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
</script>
</body>
</html>