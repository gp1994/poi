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
                    <li>
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
                    <li class="active">
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
                        <div class="navbar-brand"> History Log </div>
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
    <div id="falert" style="position:relative;left:50px;top:-37px;">
          @if(Session::has('fmsg'))
          {{Session::get('fmsg')}}
          @endif 
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card" id="log1">
                    <div class="card-header" data-background-color="purple"> 
                      <h4>POI Log</h4>
                    </div>
                    <div class="card-content">
                        <div id="typography">
                            <div id="poilog">
                               @if(count($utama))
                                @foreach($utama as $logu)
                                <div id="detlog" style="border-style:solid;border-width: thin;">
                                @if($logu->action == 'add')
                                {{$logu->created_at}} | {{$logu->updated_at}} <b>{{$logu->nama_admin}}</b> has created POI <b>{{$logu->lokasi}}</b> with longitude <b>{{$logu->longitude}}</b> and latitude <b>{{$logu->latitude}}</b> <br><br>
                                @endif
                                @if ($logu->action =='edit')
                                {{$logu->created_at}} | {{$logu->updated_at}} <b> {{$logu->nama_admin}}</b> has edited  
                                @if ($logu->olokasi != $logu->lokasi)
                                POI name from <b>{{$logu->olokasi}}</b> to <b>{{$logu->lokasi}}</b>,
                                @endif
                                @if ($logu->olongitude != $logu->longitude)
                                longitude from <b>{{$logu->olongitude}}</b> to <b>{{$logu->longitude}}</b>,
                                @endif
                                @if ($logu->olatitude != $logu->latitude)
                                latitude from <b>{{$logu->olatitude}}</b> to <b>{{$logu->latitude}}</b>,
                                @endif
                                @if($logu->olokasi == $logu->lokasi)
                                @if($logu->olongitude == $logu->longitude)
                                @if($logu->olatitude == $logu->latitude)
                                nothing on POI <b>{{$logu->lokasi}}</b>
                                @endif
                                @endif
                                @endif
                               <br><br>
                                @endif
                                </div><br>
                                @endforeach
                                @else
                                <h2>No Log(s) Available Yet </h2>
                              @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
                <div class="card" id="log1">
                    <div class="card-header" data-background-color="purple"> 
                      <h4>Detail Log</h4>
                    </div>
                    <div class="card-content">
                        <div id="typography">
                            <div id="detaillog">
                               @if(count($detil))
                                @foreach($detil as $logd)
                                <div id="detlog" style="border-style:solid;border-width: thin;">
                                @if($logd->action == 'add')
                                {{$logd->created_at}} | <b>{{$logd->nama_admin}}</b> has created 
                                  @if($logd->keterangan)
                                  details <b>{{$logd->keterangan}}</b><br><br>
                                  @endif
                                  @if($logd->image)
                                  image <b>{{$logd->image}}</b>,
                                  @endif
                                  @if($logd->image2)
                                  image <b>{{$logd->image2}}</b>,
                                  @endif
                                  @if($logd->image3)
                                  image <b>{{$logd->image3}}</b>,
                                  @endif
                                  @if($logd->image4)
                                  image <b>{{$logd->image4}}</b>,
                                  @endif
                                  @if($logd->image5)
                                  image <b>{{$logd->image5}}</b>,
                                  @endif
                                  @if($logd->image6)
                                  image <b>{{$logd->image6}}</b>,
                                  @endif
                                  @if($logd->image7)
                                  image <b>{{$logd->image7}}</b>,
                                  @endif
                                  @if($logd->image8)
                                  image <b>{{$logd->image8}}</b>,
                                  @endif
                                  @if($logd->image9)
                                  image <b>{{$logd->image9}}</b>,
                                  @endif
                                  @if($logd->image10)
                                  image <b>{{$logd->image10}}</b>,
                                  @endif
                                  @if($logd->videos)
                                  video <b>{{$logd->videos}}</b>,
                                  @endif
                                  @if(!$logd->keterangan)
                                  @if(!$logd->image)
                                  @if(!$logd->image2)
                                  @if(!$logd->image3)
                                  @if(!$logd->image4)
                                  @if(!$logd->image5)
                                  @if(!$logd->image6)
                                  @if(!$logd->image7)
                                  @if(!$logd->image8)
                                  @if(!$logd->image9)
                                  @if(!$logd->image10)
                                  @if(!$logd->videos)
                                  detail with no contents
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
                                  @endif
                                  @endif
                                  to POI {{$logd->nama_poi}} <br><br>
                                @endif
                                @if ($logd->action =='edit')
                                  {{$logd->created_at}} | <b>{{$logd->nama_admin}}</b> has 
                                  @if ($logd->oketerangan != $logd->keterangan)
                                  edited detail <br>{{$logd->oketerangan}} <br><br>to<br><br> {!!$logd->keterangan!!},<br><br>
                                  @endif
                                  @if ($logd->oimage != $logd->image)
                                    @if ($logd->oimage)
                                    replaced <b>{{$logd->oimage}}</b> to <b>{{$logd->image}}</b>,
                                    @else
                                    added <b>{{$logd->image}} (edit) </b>
                                    @endif
                                  @endif
                                  @if ($logd->oimage2 != $logd->image2)
                                    @if ($logd->oimage2)
                                    replaced <b>{{$logd->oimage2}}</b> to <b>{{$logd->image2}}</b>,
                                    @else
                                    added <b>{{$logd->image2}} (edit) </b>
                                    @endif
                                  @endif
                                  @if ($logd->oimage3 != $logd->image3)
                                   @if ($logd->oimage3)
                                    replaced <b>{{$logd->oimage3}}</b> to <b>{{$logd->image3}}</b>,
                                    @else
                                    added <b>{{$logd->image3}} (edit) </b>
                                    @endif
                                  @endif
                                  @if ($logd->oimage4 != $logd->image4)
                                    @if ($logd->oimage4)
                                    replaced <b>{{$logd->oimage4}}</b> to <b>{{$logd->image4}}</b>,
                                    @else
                                    added <b>{{$logd->image4}} (edit) </b>
                                    @endif
                                  @endif
                                  @if ($logd->oimage5 != $logd->image5)
                                  @if ($logd->oimage5)
                                    replaced <b>{{$logd->oimage5}}</b> to <b>{{$logd->image5}}</b>,
                                    @else
                                    added <b>{{$logd->image5}} (edit) </b>
                                    @endif
                                  @endif
                                  @if ($logd->oimage6 != $logd->image6)
                                  @if ($logd->oimage6)
                                    replaced <b>{{$logd->oimage6}}</b> to <b>{{$logd->image6}}</b>,
                                    @else
                                    added <b>{{$logd->image6}} (edit) </b>
                                    @endif
                                  @endif
                                  @if ($logd->oimage7 != $logd->image7)
                                  @if ($logd->oimage7)
                                    replaced <b>{{$logd->oimage7}}</b> to <b>{{$logd->image7}}</b>,
                                    @else
                                    added <b>{{$logd->image7}} (edit) </b>
                                    @endif
                                  @endif
                                  @if ($logd->oimage8 != $logd->image8)
                                  @if ($logd->oimage8)
                                    replaced <b>{{$logd->oimage8}}</b> to <b>{{$logd->image8}}</b>,
                                    @else
                                    added <b>{{$logd->image8}} (edit) </b>
                                    @endif
                                  @endif
                                  @if ($logd->oimage9 != $logd->image9)
                                  @if ($logd->oimage9)
                                    replaced <b>{{$logd->oimage9}}</b> to <b>{{$logd->image9}}</b>,
                                    @else
                                    added <b>{{$logd->image4}} (edit) </b>
                                    @endif
                                  @endif
                                  @if ($logd->oimage10 != $logd->image10)
                                 @if ($logd->oimage10)
                                    replaced <b>{{$logd->oimage10}}</b> to <b>{{$logd->image10}}</b>,
                                    @else
                                    added <b>{{$logd->image10}} (edit) </b>
                                    @endif
                                  @endif
                                  @if ($logd->ovideos != $logd->videos)
                                  @if ($logd->ovideos == 'videos/')
                                    replaced <b>{{$logd->ovideos}}</b> to <b>{{$logd->videos}}</b>,
                                    @else
                                    added <b>{{$logd->videos}} (edit) </b>
                                    @endif
                                  @endif
                                  @if(!$logd->oketerangan)
                                  @if($logd->keterangan == ' ')
                                  @if($logd->oimage == $logd->image)
                                  @if($logd->oimage2 == $logd->image2)
                                  @if($logd->oimage3 == $logd->image3)
                                  @if($logd->oimage4 == $logd->image4)
                                  @if($logd->oimage5 == $logd->image5)
                                  @if($logd->oimage6 == $logd->image6)
                                  @if($logd->oimage7 == $logd->image7)
                                  @if($logd->oimage8 == $logd->image8)
                                  @if($logd->oimage9 == $logd->image9)
                                  @if($logd->oimage10 == $logd->image10)
                                  @if($logd->ovideos == 'videos/')
                                  done nothing
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
                                  @endif
                                  @endif
                                  @endif
                                  on POI <b>{{$logd->nama_poi}}</b> <br><br>
                                @endif
                              </div><br>
                                @endforeach
                                @else
                                <h2>No Log(s) Available Yet </h2>
                              @endif
                            </div>
                        </div>
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
</html>