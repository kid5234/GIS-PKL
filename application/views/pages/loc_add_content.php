<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('pages/required/head-min', $this->data);
?>
<!-- Load Navigation -->
<style type="text/css">
 /* Always set the map height explicitly to define the size of the div
 * element that contains the map. */
 /* Optional: Makes the sample page fill the window. */
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
  width: 300px;
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
<?php $this->load->view('pages/required/nav-min', $this->data);
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Tambah Data Lokasi
      <small> Praktek Kerja Lapangan</small>
    </h1>
  </section>

  <!-- Main content -->
  <section class="content">

    <!-- Default box -->
    <div class="box box-default">
      <div class="box-header">        
        <div class="alert alert-success alert-dismissible fade in">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
          <h4><i class="icon fa fa-check"></i> Success!</h4> Success alert preview. This alert is dismissable.
        </div>
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
                    <input id="placeid" name="placeid" placeholder="Place ID .." class="form-control" type="text">
                    <span class="help-block"></span>
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-md-2">Nama</label>
                  <div class="col-md-10">
                    <input id="nama" name="nama" placeholder="Nama .." class="form-control" type="text">
                    <span class="help-block"></span>
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-md-2">Alamat</label>
                  <div class="col-md-10">
                    <textarea id="alamat" name="alamat" placeholder="Alamat .." class="form-control"></textarea>
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
                      <input type="text" name="telepon" class="form-control">
                    </div>
                    <span class="help-block"></span>
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-md-2">Provinsi</label>
                  <div class="col-md-10">
                    <select name="prov" class="form-control">
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
                    <select name="kota" class="form-control">
                      <option value="">--Select Province First--</option>
                    </select>
                    <span class="help-block"></span>
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-md-2">Jenis</label>
                  <div class="col-md-10">
                    <select name="jenis" class="form-control">
                      <option value="">--Select Jenis--</option>
                      <?php
                      foreach ($jenis as $key => $value) {
                        echo "<option value='".$value->loc_category_id."'>".$value->loc_category_name."</option>";
                      }
                      ?>
                    </select>
                    <span class="help-block"></span>
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-md-2">Latitude</label>
                  <div class="col-md-10">
                    <input id="lat" name="lat" placeholder="Latitude .." class="form-control" type="text">
                    <span class="help-block"></span>
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-md-2">Longitude</label>
                  <div class="col-md-10">
                    <input id="lng" name="lng" placeholder="Longitude .." class="form-control" type="text">
                    <span class="help-block"></span>
                  </div>
                </div>
                <hr>
                <div class="col-md-12">
                  <button type="button" id="btnSave" onclick="save()" class="btn btn-primary pull-right">Save</button>
                  <button type="button" id="btnReset" class="btn btn-danger" >Cancel</button>
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
            <script type="text/javascript">
          // This example adds a search box to a map, using the Google Place Autocomplete
// feature. People can enter geographical searches. The search box will return a
// pick list containing a mix of places and predicted search terms.

// This example requires the Places library. Include the libraries=places
// parameter when you first load the API. For example:
// <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">

function initAutocomplete() {
  var map = new google.maps.Map(document.getElementById('map'), {
    center: {lat: -0.4959538, lng:117.1562388},
    zoom: 13,
    mapTypeId: 'roadmap'
  });

  // Create the search box and link it to the UI element.
  var input = document.getElementById('pac-input');
  var searchBox = new google.maps.places.SearchBox(input);
  map.controls[google.maps.ControlPosition.TOP_RIGHT].push(input);
  var marker = [];

  // Bias the SearchBox results towards current map's viewport.
  map.addListener('bounds_changed', function() {
    searchBox.setBounds(map.getBounds());
  });

  // Listen for the event fired when the user selects a prediction and retrieve
  // more details for that place.
  searchBox.addListener('places_changed', function() {
    marker = [];
    
    // Clear out the old markers.
    marker.forEach(function(marker) {
      marker.setMap(null);      
      map.removeLayer(marker);
    });
    
    var places = searchBox.getPlaces();
    if (places.length == 0) {
      return;
    }

    // For each place, get the icon, name and location.
    var bounds = new google.maps.LatLngBounds();
    var infowindow = new google.maps.InfoWindow();
    var infowindowContent = document.getElementById('infowindow-content');
    infowindow.setContent(infowindowContent);
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

      var id = place.place_id;
      var name = place.name;
      var lat = place.geometry.location.lat();
      var lng = place.geometry.location.lng();
      //var address = place.formatted_address;
      var address = '';
      if (place.address_components) {
        address = [
        (place.address_components[1] && place.address_components[1].long_name || ''),
        (place.address_components[0] && place.address_components[0].short_name || ''),
        (place.address_components[2] && place.address_components[2].long_name || ''),
        ].join(' ');
      }

      // Create a marker for each place.
      var marker = new google.maps.Marker({
        map: map,
        position: place.geometry.location
      });

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
        // Only geocodes have viewport.
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

 <script type="text/javascript">

var save_method; //for save method string
var table;

$(document).ready(function() {
  save_method = 'add';
  $('.alert').hide();

  $('#btnReset').on('click', function () {
        $('#form')[0].reset(); // reset form on modals
        $('form').find('.has-error').removeClass("has-error");
        $('form').find('.help-block').empty();
      });

    //Init regencies by province
    $('select[name="prov"]').on('change', function() {
      var stateID = $(this).val();
      if(stateID) {
        $.ajax({
          url: '<?php echo base_url('/dashboard/getreg/')?>'+stateID,
          type: "GET",
          dataType: "json",
          success:function(data) {
            $('select[name="kota"]').empty();
            $('select[name="kota"]').append('<option value="">-- Pilih Kabupaten/Kota --</option>');
            $.each(data, function(key, value) {
              $('select[name="kota"]').append('<option value="'+ value.id +'">'+ value.name +'</option>');
            });
          }
        });
      }else{
        $('select[name="city"]').empty();
      }
    });

    //set input/textarea/select event when change value, remove class error and remove text help block 
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
      $(this).next().empty();
    });

  });

function save()
{
    $('#btnSave').text('saving...'); //change button text
    $('#btnSave').attr('disabled',true); //set button disable 
    var url;

    if(save_method == 'add') {
      url = "<?php echo site_url('loc_c/loc_ajax_add')?>";
    } else {
      url = "<?php echo site_url('loc_c/loc_ajax_update')?>";
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
              $('.alert').show();
              $('#form')[0].reset(); // reset form on modals
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