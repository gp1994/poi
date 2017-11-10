@extends('master')

@section('content')
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>Point Of Interest</title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />
    <!-- Bootstrap core CSS     -->
    <link href="http://localhost/poi/public/BSDash/assets/css/bootstrap.min.css" rel="stylesheet" />
    <!--  Material Dashboard CSS    -->
    <link href="http://localhost/poi/public/BSDash/assets/css/material-dashboard.css?v=1.2.0" rel="stylesheet" />
    <!--  Fonts and icons     -->
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300|Material+Icons' rel='stylesheet' type='text/css'>
    <link rel ="stylesheet" href="css/app.css">
    <link href="http://localhost/poi/public/BSLogin/bootstrap3/css/bootstrap.css" rel="stylesheet" />
    <link href="http://localhost/poi/public/BSLogin/login-register.css" rel="stylesheet" />
    <link rel="stylesheet" href="http://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">  
    <script src="http://localhost/poi/public/BSLogin/jquery/jquery-1.10.2.js" type="text/javascript"></script>
    <script src="http://localhost/poi/public/BSLogin/bootstrap3/js/bootstrap.js" type="text/javascript"></script>
    <script src="http://localhost/poi/public/BSLogin/login-register.js" type="text/javascript"></script>
</head>
<body>
    <div class="sidebar" data-color="purple" data-image="http://localhost/poi/public/BSDash/assets/img/sidebar-1.jpg">
        <div class="logo">
            <div class="simple-text">
                    Point of Interest
            </div>
        </div>
            <div class="sidebar-wrapper">
                <ul class="nav">
                    <li class="active">
                        <a href="./">
                            <i class="material-icons">location_on</i>
                            <p>POI List</p>
                        </a>
                    </li>
                    @if (Session('roles')=='admin')
                    <li>
                        <a href="./datatable">
                            <i class="material-icons">content_paste</i>
                            <p>Datatable Utama</p>
                        </a>
                    </li>
                    <li>
                        <a href="./detable">
                            <i class="material-icons">content_paste</i>
                            <p>Datatable Detail</p>
                        </a>
                    </li>
                    @endif
                </ul>
            </div>
        </div>
        <div class="main-panel">
          <nav class="navbar navbar-transparent navbar-absolute">
                <div class="container-fluid">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <div class="navbar-brand"> POI List </div>
                    </div>
                    <div class="collapse navbar-collapse">
                        <ul class="nav navbar-nav navbar-right">
                        <li> @if ( Request::session()->has('usrn') )
                        <div id="sess" style ="position:relative;top:15px">
                        Welcome {{session('usrn')}}! Click here to <a href="./logout">Logout</a> </div><br> 
                        @else
                        <a class="btn big-login" data-toggle="modal" href="javascript:void(0)" style ="position:relative;left:-10px"onclick="openLoginModal();">Login</a>
                        @endif
                        </li>
                        </ul>
                    </div>
                </div>
            </nav>
            <div class="content" style="position:relative;top:-40px">
           
  <div class="container">
   
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
    <div id="err" style ="position:relative;top:-60px">
     @if ((count($errors) > 0 ) || (session('status') == 'salah'))
  Maaf Username atau Password anda salah!
  @endif
</div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header" data-background-color="purple">
                        @if(count($utama))
                            @foreach($utama as $locations)
                                <h4>{{$locations->lokasi}}</h4>
                            @endforeach
                        @endif
                    </div>
                    <div class="card-content">
                        <div id="typography">
                            <div class="title">
                               @if(count($detil))
                                @foreach($detil as $det)
                                <div class="w3-content w3-display-container">
                                    @if($det->image)
                                        <img class="mySlides" src="{{$det->image}}" style="width:900px;height:400px;">
                                    @endif
                                    @if($det->image2)
                                        <img class="mySlides" src="{{$det->image2}}" style="width:900px;height:400px;">
                                    @endif
                                    @if($det->image3)
                                        <img class="mySlides" src="{{$det->image3}}" style="width:900px;height:400px;">
                                    @endif
                                    @if($det->image4)
                                        <img class="mySlides" src="{{$det->image4}}" style="width:900px;height:400px;">
                                    @endif
                                    @if($det->image5)
                                        <img class="mySlides" src="{{$det->image5}}" style="width:900px;height:400px;">
                                    @endif
                                    @if($det->image6)
                                        <img class="mySlides" src="{{$det->image6}}" style="width:900px;height:400px;">
                                    @endif
                                    @if($det->image7)
                                        <img class="mySlides" src="{{$det->image7}}" style="width:900px;height:400px;">
                                    @endif
                                    @if($det->image8)
                                        <img class="mySlides" src="{{$det->image8}}" style="width:900px;height:400px;">
                                    @endif
                                    @if($det->image9)
                                        <img class="mySlides" src="{{$det->image9}}" style="width:900px;height:400px;">
                                    @endif
                                    @if($det->image10)
                                        <img class="mySlides" src="{{$det->image10}}" style="width:900px;height:400px;">
                                    @endif
                                    @if(!$det->image)
                                        @if(!$det->image2)
                                            @if(!$det->image3)
                                                @if(!$det->image4)
                                                    @if(!$det->image5)
                                                        @if(!$det->image6)
                                                            @if(!$det->image7)
                                                                @if(!$det->image8)
                                                                    @if(!$det->image9)
                                                                        @if(!$det->image10)
                                                                        <h3>No Image(s) Available</h3>
                                                                        @endif
                                                                    @endif
                                                                @endif
                                                            @endif
                                                        @endif
                                                    @endif
                                                @endif
                                            @endif
                                        @endif
                                    @endif
                                        </div>
                                        <button class="w3-button w3-black w3-display-left" onclick="plusDivs(-1)">&#10094;</button>
                                        <button class="w3-button w3-black w3-display-right" onclick="plusDivs(1)">&#10095;</button>
                                        <div id ="keterangan">{{$det->keterangan}}</div><br>
                                        <h1>Video</h1>
                                    @if($det->videos == 'videos/')
                                    <h3>No Video Available</h3>
                                    @else
                                    <iframe width="900" height="400" src="{{ $det->videos }}"  frameborder="0" allowfullscreen></iframe>
                                    @endif
                                    @endforeach
                                   @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
     </div>
</body>
<!--   Core JS Files   -->
<script src="http://localhost/poi/public/BSDash/assets/js/jquery-3.2.1.min.js" type="text/javascript"></script>
<script src="http://localhost/poi/public/BSDash/assets/js/bootstrap.min.js" type="text/javascript"></script>
<script src="http://localhost/poi/public/BSDash/assets/js/material.min.js" type="text/javascript"></script>
<!--  Charts Plugin -->
<script src="http://localhost/poi/public/BSDash/assets/js/chartist.min.js"></script>
<!--  Dynamic Elements plugin -->
<script src="http://localhost/poi/public/BSDash/assets/js/arrive.min.js"></script>
<!--  PerfectScrollbar Library -->
<script src="http://localhost/poi/public/BSDash/assets/js/perfect-scrollbar.jquery.min.js"></script>
<!--  Notifications Plugin    -->
<script src="http://localhost/poi/public/BSDash/assets/js/bootstrap-notify.js"></script>
<script>
var slideIndex = 1;
showDivs(slideIndex);

function plusDivs(n) {
  showDivs(slideIndex += n);
}

function showDivs(n) {
  var i;
  var x = document.getElementsByClassName("mySlides");
  if (n > x.length) {slideIndex = 1}    
  if (n < 1) {slideIndex = x.length}
  for (i = 0; i < x.length; i++) {
     x[i].style.display = "none";  
  }
  x[slideIndex-1].style.display = "block";  
}
</script>
</html>