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
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
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
                            <p>Datatable POI</p>
                        </a>
                    </li>
                    @endif
                    @if (Session('roles')=='admin')
                    <li>
                        <a href="./showLog">
                            <i class="material-icons">history</i>
                            <p>History Log</p>
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
                        Welcome {{session('peng')}}! Click here to <a href="./logout">Logout</a> </div><br> 
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
                              <div id="err" style ="position:relative;top:-10px"></div>  
                                <label>Username</label>
                                <input type="text" name="usrn" class="form-control" maxlength="32">
                                <label>Password</label>
                                <input type="password" name="pwd" class="form-control" maxlength="64">
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
    <div id="falert" style="position:relative;left:28px;top:-27px;width:913px;"></div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header" data-background-color="purple">
                        @if(count($utama))
                            @foreach($utama as $locations)
                                <h4>{{$locations->lokasi}}</h4>
                            @endforeach
                       
                    </div>
                    <div class="card-content">
                        <div id="typography">
                            <div class="title">
                               @if(count($detil))
                                @foreach($detil as $det)
                                <div class="w3-content w3-display-container" onmouseover="showNav()" onmouseout="fadeNav()">
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
                                    <button id = "left" class="w3-button w3-black w3-display-left" onclick="plusDivs(-1)" onmouseover="showNav()" onmouseout="fadeNav()" style="top:260px;left:20px;opacity:0;">&#10094;</button>
                                    <button id = "right" class="w3-button w3-black w3-display-right" onclick="plusDivs(1)" onmouseover="showNav()" onmouseout="fadeNav()" style="top:260px;right:20px;opacity:0;">&#10095;</button>
                                    @if($det->keterangan)
                                    <div id ="keterangan">{{$det->keterangan}}</div><br>
                                    @else
                                    <h3>No Details Available</h3>
                                    @endif
                                    <h1>Video</h1>
                                    @if($det->videos)
                                    <iframe width="900" height="400" src="{{$det->videos}}"  frameborder="0" allowfullscreen></iframe>
                                    @else
                                    <h3>No Video Available</h3>
                                    @endif
                                    <div class="col-md-3">
                                    @if (Session('roles')=='admin')

                  <button id="editpoibutton" data-toggle="modal" data-target="#editPoiModal" data-id="{{$det->id}}" data-odesc ="{{$det->oketerangan}}" data-desc="{{$det->keterangan}}" data-img="{{$det->image}}" data-img2="{{$det->image2}}" data-img3="{{$det->image3}}" data-img4="{{$det->image4}}" data-img5="{{$det->image5}}" data-img6="{{$det->image6}}" data-img7="{{$det->image7}}" data-img8="{{$det->image8}}" data-img9="{{$det->image9}}" data-img10="{{$det->image10}}" data-vid="{{$det->videos}}">Edit </button>
                  @endif
                </div>
                <div id="editPoiModal" class="modal fade">
                <div class="modal-dialog modal-lg">
                  <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    Edit <span id="namadet"></span>
                  </div>
                    <div class="modal-body">
                     <form method="POST" action="./editdet" enctype="multipart/form-data" id="editdt">
                      <input name="_token" type="hidden" value="{{ csrf_token() }}">
                      <input id="idds" type="hidden" name="iddts">
                      Detail:<br>
                      <textarea id="detinput"  name="editeddet" style="width:840px;height:270px;" cols="40" rows="100" maxlength="4294967295"></textarea><br><br>
                      <textarea id="odetinput"  name="oediteddet" style="display:none;" cols="40" rows="100" maxlength="4294967295" readonly></textarea><br><br>
                      Image: (Upload JPG or PNG Image)<br>
                      <table>
                        <tr>
                        <td style="padding: 9px;">
                      <input id="iminput" type="file" accept="image/*" name="editedim" onchange="$('#pik').val($(this).val());">
                      <input id="pik" name="edtim" style="position:relative;top:10px;" size ="35" type="text" readonly> <div style="position:absolute;top:441px;left:20px;text-align: center;">1</div>
                      <input id ="opik" name="oedtim" style="position:relative;top:10px;" size ="40" type="hidden" readonly>
                        </td>
                        <td style="padding: 9px;">
                      <input id="iminput2" type="file" accept="image/*" name="editedim2" onchange="$('#pik2').val($(this).val());">
                      <input id="pik2" name="edtim2" style="position:relative;top:10px;" size ="35" type="text" readonly> <div style="position:absolute;top:441px;left:317px;text-align: center;">2</div>
                       <input id ="opik2" name="oedtim2" style="position:relative;top:10px;" size ="40" type="hidden" readonly>
                        </td>
                        </tr>
                        <tr>
                        <td style="padding: 9px;">
                      <input id="iminput3" type="file" accept="image/*" name="editedim3" onchange="$('#pik3').val($(this).val());">
                      <input id="pik3" name="edtim3" style="position:relative;top:10px;" size ="35" type="text" readonly><div style="position:absolute;top:512px;left:20px;text-align: center;">3</div>
                       <input id ="opik3" name="oedtim3" style="position:relative;top:10px;" size ="40" type="hidden" readonly>
                        </td>
                        <td style="padding: 9px;">
                      <input id="iminput4" type="file" accept="image/*" name="editedim4" onchange="$('#pik4').val($(this).val());">
                      <input id="pik4" name="edtim4" style="position:relative;top:10px;" size ="35" type="text" readonly><div style="position:absolute;top:512px;left:317px;text-align: center;">4</div>
                      <input id ="opik4" name="oedtim4" style="position:relative;top:10px;" size ="40" type="hidden" readonly>
                        </td>
                        </tr>
                        <tr>
                        <td style="padding: 9px;">
                      <input id="iminput5" type="file" accept="image/*" name="editedim5" onchange="$('#pik5').val($(this).val());">
                      <input id="pik5" name="edtim5"  style="position:relative;top:10px;" size ="35" type="text" readonly><div style="position:absolute;top:581px;left:20px;text-align: center;">5</div>
                      <input id="opik5" name="oedtim5"  style="position:relative;top:10px;" size ="40" type="hidden" readonly>
                        </td>
                        <td style="padding: 9px;">
                      <input id="iminput6" type="file" accept="image/*" name="editedim6" onchange="$('#pik6').val($(this).val());">
                      <input id="pik6" name="edtim6"  style="position:relative;top:10px;" size ="35" type="text" readonly><div style="position:absolute;top:581px;left:317px;text-align: center;">6</div>
                      <input id="opik6" name="oedtim6"  style="position:relative;top:10px;" size ="40" type="hidden" readonly>
                        </td>
                        </tr>
                        <tr>
                        <td style="padding: 9px;">
                      <input id="iminput7" type="file" accept="image/*" name="editedim7" onchange="$('#pik7').val($(this).val());">
                      <input id="pik7" name="edtim7"  style="position:relative;top:10px;" size ="35" type="text" readonly><div style="position:absolute;top:652px;left:20px;text-align: center;">7</div>
                       <input id="opik7" name="oedtim7"  style="position:relative;top:10px;" size ="40" type="hidden" readonly>
                        </td>
                        <td style="padding: 9px;">
                      <input id="iminput8" type="file" accept="image/*" name="editedim8" onchange="$('#pik8').val($(this).val());">
                      <input id="pik8" name="edtim8"  style="position:relative;top:10px;" size ="35" type="text" readonly><div style="position:absolute;top:652px;left:317px;text-align: center;">8</div>
                       <input id="opik8" name="oedtim8"  style="position:relative;top:10px;" size ="40" type="hidden" readonly>
                        </td>
                        </tr>
                        <tr>
                        <td style="padding: 9px;">
                      <input id="iminput9" type="file" accept="image/*" name="editedim9" onchange="$('#pik9').val($(this).val());">
                      <input id="pik9" name="edtim9"  style="position:relative;top:10px;" size ="35" type="text" readonly><div style="position:absolute;top:721px;left:20px;text-align: center;">9</div>
                       <input id="opik9" name="oedtim9"  style="position:relative;top:10px;" size ="40" type="hidden" readonly>
                        </td>
                        <td style="padding: 9px;">
                      <input id="iminput10" type="file" accept="image/*" name="editedim10" onchange="$('#pik10').val($(this).val());">
                      <input id="pik10" name="edtim10"  style="position:relative;top:10px;" size ="35" type="text" readonly><div style="position:absolute;top:721px;left:312px;text-align: center;">10</div>
                      <input id="opik10" name="oedtim10"  style="position:relative;top:10px;" size ="40" type="hidden" readonly><br>
                        </td>
                        </tr>
                  </table><br>
                      Video: (Upload MP4 Video)<br>
                      <input id="vdinput" type="file" accept="video/*" name="editedvid" style="position:relative;top:10px;" onchange="$('#video').val($(this).val());">
                      <input id="video" name="edtvid" style="position:relative;top:15px;" size ="89" type="text" readonly>
                      <input id="ovideo" name="oedtvid" style="position:relative;top:15px;" size ="89" type="hidden" readonly>
                      <br><br><br>
                      <input type="submit" value="Save" />
                      </form>
                    </div>
                  </div>
                </div>
              </div>
                @endforeach
            @else
            <h3>No Details Available (Yet)</h3>
          @if (Session('roles')=='admin')
           <button id="addDetButton" data-toggle="modal" data-target="#addDetModal" style="position:relative;left:29px;top:3px;">Add </button>
           @endif
           <div id="addDetModal" class="modal fade">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header" style="color:#0000FF">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            Add <span id="namadet"></span>
                        </div>
                            <div class="modal-body" style="color:#0000FF">
                                <form method="POST" action="./storedet" enctype="multipart/form-data" id="strdt">
                                    <input name="_token" type="hidden" value="{{ csrf_token() }}">
                                    <input id="iddt" type="hidden" name="iddsc">
                                    Detail:<br>
                                <textarea id="dinput" name="newdet" style="width:830px;height:270px;" cols="40" rows="100" maxlength="4294967295"></textarea><br><br>
                                    Image: (Upload JPG or PNG Image)<br>
                                    <input id="iinput" type="file" name="newim[]" accept="image/*" multiple><br>
                                    Video: (Upload MP4 Video)<br>
                                    <input id="vinput" type="file" name="newvid" accept="video/*" ><br><br>
                                    <input type="submit" value="Save" />
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
            </div>
        </div>
        @else
        <h2>POI Doesn't Exist!</h2>
         @endif
    </div>
</div>
</div>
</div>
</div>
</body>
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

function showNav() {
   document.getElementById("left").style.opacity = "1";
   document.getElementById("right").style.opacity = "1";
}

function fadeNav() {
   document.getElementById("left").style.opacity = "0";
   document.getElementById("right").style.opacity = "0";
}

</script>
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
        $(function() {
            $('#editPoiModal').on('show.bs.modal', function (e) {
                var button = $(e.relatedTarget);
                var iddc = button.data('id');
                var dsc = button.data('desc');
                var odsc = button.data('odesc');
                var im = button.data('img');
                var im2 = button.data('img2');
                var im3 = button.data('img3');
                var im4 = button.data('img4');
                var im5 = button.data('img5');
                var im6 = button.data('img6');
                var im7 = button.data('img7');
                var im8 = button.data('img8');
                var im9 = button.data('img9');
                var im10 = button.data('img10');
                var vd = button.data('vid');
                $('.modal-body #idds').val(iddc);
                $('.modal-body #detinput').val(dsc);
                $('.modal-body #odetinput').val(dsc);
                $('.modal-body #pik').val(im);
                $('.modal-body #pik2').val(im2); 
                $('.modal-body #pik3').val(im3); 
                $('.modal-body #pik4').val(im4); 
                $('.modal-body #pik5').val(im5); 
                $('.modal-body #pik6').val(im6); 
                $('.modal-body #pik7').val(im7); 
                $('.modal-body #pik8').val(im8); 
                $('.modal-body #pik9').val(im9);    
                $('.modal-body #pik10').val(im10);
                $('.modal-body #video').val(vd);
                $('.modal-body #opik').val(im);
                $('.modal-body #opik2').val(im2); 
                $('.modal-body #opik3').val(im3); 
                $('.modal-body #opik4').val(im4); 
                $('.modal-body #opik5').val(im5); 
                $('.modal-body #opik6').val(im6); 
                $('.modal-body #opik7').val(im7); 
                $('.modal-body #opik8').val(im8); 
                $('.modal-body #opik9').val(im9);    
                $('.modal-body #opik10').val(im10);
                $('.modal-body #ovideo').val(vd);    
                $('#dsc').html($(e.relatedTarget).data('desc'));
                $('#odsc').html($(e.relatedTarget).data('odesc'));
                $('#im').html($(e.relatedTarget).data('im'));
                $('#im2').html($(e.relatedTarget).data('im2'));
                $('#im3').html($(e.relatedTarget).data('im3'));
                $('#im4').html($(e.relatedTarget).data('im4'));
                $('#im5').html($(e.relatedTarget).data('im5'));
                $('#im6').html($(e.relatedTarget).data('im6'));
                $('#im7').html($(e.relatedTarget).data('im7'));
                $('#im8').html($(e.relatedTarget).data('im8'));
                $('#im9').html($(e.relatedTarget).data('im9'));
                $('#im10').html($(e.relatedTarget).data('im10'));
                $('#vd').html($(e.relatedTarget).data('vid'));
            });
        });
    </script>
   <script type="text/javascript">
    @if(Session::has('fmsg'))
    $('#falert').addClass('alert alert-danger').html("{{Session::get('fmsg')}}").fadeTo(2000, 500).slideUp(500, function(){$("#success-alert").slideUp(500);});   ;
    @endif 
</script>
</html>