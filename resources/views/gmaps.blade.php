@extends('master')

@section('content')
<!DOCTYPE html>
<html>
<head>
<title>Point of Interest</title>
<script src="http://maps.google.com/maps/api/js?key=AIzaSyC5BGMy8w4z0CZm022t08c5mLhOjslHJZQ"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gmaps.js/0.4.24/gmaps.js"></script>
<link rel ="stylesheet" href="css/app.css">
<link href="http://localhost/poi/public/BSLogin/bootstrap3/css/bootstrap.css" rel="stylesheet" />
<link href="http://localhost/poi/public/BSLogin/login-register.css" rel="stylesheet" />
<link rel="stylesheet" href="http://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">  
<script src="http://localhost/poi/public/BSLogin/jquery/jquery-1.10.2.js" type="text/javascript"></script>
<script src="http://localhost/poi/public/BSLogin/bootstrap3/js/bootstrap.js" type="text/javascript"></script>
<script src="http://localhost/poi/public/BSLogin/login-register.js" type="text/javascript"></script>
</head>
<body>
  <div id="content">
  @if ( Request::session()->has('usrn') )
  Welcome {{session('usrn')}}! Click here to <a href="./logout">Logout</a> <br> 
  @else
  <div class="container">
  <a class="btn big-login" data-toggle="modal" href="javascript:void(0)" style ="position:relative;left:-40px"onclick="openLoginModal();">Login</a>
  @if ((count($errors) > 0 ) || (session('status') == 'salah'))
  Maaf Username atau Password anda salah!
  @endif  
     <div class="modal fade login" id="loginModal">
          <div class="modal-dialog login animated">
              <div class="modal-content">
                 <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title">Login</h4>
                  </div>
                    <div class="modal-body">  
                        <div class="box">
                           <div class="content">
                              <div class="form loginBox">
                                <form method="post" action="{{action('PenggunaController@cekLogin')}}">
                                {{ csrf_field() }}
                                <br>    
                                <label>Username</label>
                                <input type="text" name="usrn" class="form-control">
                                <label>Password</label>
                                <input type="password" name="pwd" class="form-control">
                                <button type="submit" class="btn btn-block btn-primary">Login</button>
                                </form>
                                </div>
                             </div>
                        </div>
                    </div>        
              </div>
          </div>
      </div>
    </div>
  @endif
  @if(session('roles') == 'admin')
  <a href = "./datatable">Datatable Utama</a>
  <a href = "./detable">Datatable Detail</a>
  @endif
  <div id="mymap"></div>
  
<script>
function initMap() {
    var map;
    var bounds = new google.maps.LatLngBounds();
    var mapOptions = {
        mapTypeId: 'roadmap'
    };
                    
    // Display a map on the web page
    map = new google.maps.Map(document.getElementById("mymap"), mapOptions);
    map.setTilt(50);
        
    // Multiple markers location, latitude, and longitude
    var markers = [
    @foreach ($locations as $loc)
      [ "{{ $loc->lokasi }}","{{ $loc->latitude }}", "{{ $loc->longitude }}" ,"{{ $loc->id}}"], 
    @endforeach
    ];
                        
    // Info window content
    var infoWindowContent = [
    @foreach ($det as $detail)
      ["{{$detail->image}}","{{ $detail->keterangan}}","{{$detail->id}}"], 
    @endforeach
    ];
        
    // Add multiple markers to map
    var infoWindow = new google.maps.InfoWindow(), marker, i;
    
    // Place each marker on the map  
    for( i = 0; i < markers.length; i++ ) {
        var position = new google.maps.LatLng(markers[i][1], markers[i][2]);
        bounds.extend(position);
        marker = new google.maps.Marker({
            position: position,
            map: map,
            title: markers[i][0]
        });
        
        // Add info window to marker    
      google.maps.event.addListener(marker, 'click', (function(marker, i) {return function() {infoWindow.setContent('<div id ="nama_lokasi"><h4>'+markers[i][0]+'</h4></div>'+ '<div id ="gambar">'+'<img src='+infoWindowContent[i][0]+'>'+'</div>'+'<div id="info_content">'+infoWindowContent[i][1]+'</div>'+'@if(session('roles') == 'user')'+'<a href="./downloadPDF/' +markers[i][3]+'">'+'Download PDF'+'</a>'+ '@endif'+ '@if(session('roles') == 'admin')'+'<a href="./downloadPDF/' +markers[i][3]+'">'+'Download PDF'+'</a>'+ '@endif');
        infoWindow.open(map, marker);
            }
        })(marker, i));

        // Center the map to fit all markers on the screen
        map.fitBounds(bounds);
    }

    // Set zoom level
    var boundsListener = google.maps.event.addListener((map), 'bounds_changed', function(event) {
        this.setZoom(5);
        google.maps.event.removeListener(boundsListener);
    });
    
}
// Load initialize function
google.maps.event.addDomListener(window, 'load', initMap);
</script>
</body>
</html>
 