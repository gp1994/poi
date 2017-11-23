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
                                <table border="solid">
                                  <tr>
                                  <th>Tanggal</th>
                                  <th>Nama Admin</th>
                                  <th>POI</th>
                                  <th>Action</th>
                                  <th>Object</th>
                                  <th>Before</th>
                                  <th>After</th>
                                  </tr>
                                   @if(count($detil))
                                @foreach($detil as $logd)
                        @if ($logd->action=='edit')
                        <tr>
                          @if ($logd->oimage != $logd->image)
                            <td>{{$logd->created_at}}</td>
                                    <td>{{$logd->nama_admin}}</td>
                                    <td>{{$logd->nama_poi}}</td>
                                    <td>{{$logd->action}}</td>
                          <td>Image #1</td>
                          <td>{{$logd->oimage}}</td>
                          <td>{{$logd->image}}</td>
                          @endif
                        </tr>
                        <tr>
                        @if ($logd->oimage2 != $logd->image2)
                          <td>{{$logd->created_at}}</td>
                                    <td>{{$logd->nama_admin}}</td>
                                    <td>{{$logd->nama_poi}}</td>
                                    <td>{{$logd->action}}</td>
                          <td>Image #2</td>
                          <td>{{$logd->oimage2}}</td>
                          <td>{{$logd->image2}}</td>
                          @endif
                        </tr>
                        <tr>
                        @if ($logd->oimage3 != $logd->image3)
                          <td>{{$logd->created_at}}</td>
                                    <td>{{$logd->nama_admin}}</td>
                                    <td>{{$logd->nama_poi}}</td>
                                    <td>{{$logd->action}}</td>
                        <td>Image #3</td>
                           <td>{{$logd->oimage3}}</td>
                          <td>{{$logd->image3}}</td>
                          @endif
                        </tr>
                        <tr>
                        @if ($logd->oimage4 != $logd->image4)
                          <td>{{$logd->created_at}}</td>
                                    <td>{{$logd->nama_admin}}</td>
                                    <td>{{$logd->nama_poi}}</td>
                                    <td>{{$logd->action}}</td>
                        <td>Image #4</td>
                       <td>{{$logd->oimage4}}</td>
                          <td>{{$logd->image4}}</td>
                          @endif
                        </tr>
                        <tr>
                        @if ($logd->oimage5 != $logd->image5)
                          <td>{{$logd->created_at}}</td>
                                    <td>{{$logd->nama_admin}}</td>
                                    <td>{{$logd->nama_poi}}</td>
                                    <td>{{$logd->action}}</td>
                        <td>Image #5</td>
                          <td>{{$logd->oimage5}}</td>
                          <td>{{$logd->image5}}</td>
                          @endif
                        </tr>
                        <tr>
                        @if ($logd->oimage6 != $logd->image6)
                          <td>{{$logd->created_at}}</td>
                                    <td>{{$logd->nama_admin}}</td>
                                    <td>{{$logd->nama_poi}}</td>
                                    <td>{{$logd->action}}</td>
                        <td>Image #6</td>
                           <td>{{$logd->oimage6}}</td>
                          <td>{{$logd->image6}}</td>
                          @endif
                        </tr>
                        <tr>
                        @if ($logd->oimage7 != $logd->image7)
                          <td>{{$logd->created_at}}</td>
                                    <td>{{$logd->nama_admin}}</td>
                                    <td>{{$logd->nama_poi}}</td>
                                    <td>{{$logd->action}}</td>
                        <td>Image #7</td>
                           <td>{{$logd->oimage7}}</td>
                          <td>{{$logd->image7}}</td>
                          @endif
                        </tr>
                        <tr>
                        @if ($logd->oimage8 != $logd->image8)
                          <td>{{$logd->created_at}}</td>
                                    <td>{{$logd->nama_admin}}</td>
                                    <td>{{$logd->nama_poi}}</td>
                                    <td>{{$logd->action}}</td>
                        <td>Image #8</td>
                           <td>{{$logd->oimage8}}</td>
                          <td>{{$logd->image8}}</td>
                          @endif
                        </tr>
                        <tr>
                        @if ($logd->oimage9 != $logd->image9)
                          <td>{{$logd->created_at}}</td>
                                    <td>{{$logd->nama_admin}}</td>
                                    <td>{{$logd->nama_poi}}</td>
                                    <td>{{$logd->action}}</td>
                        <td>Image #9</td>
                           <td>{{$logd->oimage9}}</td>
                          <td>{{$logd->image9}}</td>
                          @endif
                        </tr>
                        <tr>
                        @if ($logd->oimage10 != $logd->image10)
                          <td>{{$logd->created_at}}</td>
                                    <td>{{$logd->nama_admin}}</td>
                                    <td>{{$logd->nama_poi}}</td>
                                    <td>{{$logd->action}}</td>
                        <td>Image #10</td>
                           <td>{{$logd->oimage10}}</td>
                          <td>{{$logd->image10}}</td>
                          @endif
                        </tr>
                        <tr>
                        @if ($logd->ovideos!= $logd->videos)
                          <td>{{$logd->created_at}}</td>
                                    <td>{{$logd->nama_admin}}</td>
                                    <td>{{$logd->nama_poi}}</td>
                                    <td>{{$logd->action}}</td>
                        <td>Video</td>
                           <td>{{$logd->ovideos}}</td>
                          <td>{{$logd->videos}}</td>
                          @endif
                          @if ($logd->oketerangan != $logd->keterangan)
                          <td>{{$logd->created_at}}</td>
                                    <td>{{$logd->nama_admin}}</td>
                                    <td>{{$logd->nama_poi}}</td>
                                    <td>{{$logd->action}}</td>
                        <td>Detail</td>
                           <td>{{$logd->oketerangan}}</td>
                          <td>{!!$logd->keterangan!!}</td>
                          @endif
                        @endif
                        @if ($logd->action=='add')
                        <tr>
                          @if (!$logd->oimage)
                            <td>{{$logd->created_at}}</td>
                                    <td>{{$logd->nama_admin}}</td>
                                    <td>{{$logd->nama_poi}}</td>
                                    <td>{{$logd->action}}</td>
                          <td>Image #1</td>
                          <td>@if(!$logd->oimage)
                            none
                          @endif</td>
                          <td>@if(!$logd->image)
                            blank picture
                             @else
                            {{$logd->image}}
                          @endif</td>
                          @endif
                        </tr>
                        <tr>
                        @if (!$logd->oimage2)
                          <td>{{$logd->created_at}}</td>
                                    <td>{{$logd->nama_admin}}</td>
                                    <td>{{$logd->nama_poi}}</td>
                                    <td>{{$logd->action}}</td>
                          <td>Image #2</td>
                           <td>@if(!$logd->oimage2)
                            none
                          @endif</td>
                          <td>@if(!$logd->image2)
                            blank picture
                             @else
                            {{$logd->image2}}
                          @endif</td>
                          @endif
                        </tr>
                        <tr>
                        @if (!$logd->oimage3)
                          <td>{{$logd->created_at}}</td>
                                    <td>{{$logd->nama_admin}}</td>
                                    <td>{{$logd->nama_poi}}</td>
                                    <td>{{$logd->action}}</td>
                        <td>Image #3</td>
                            <td>@if(!$logd->oimage3)
                            none
                          @endif</td>
                          <td>@if(!$logd->image3)
                            blank picture
                             @else
                            {{$logd->image3}}
                          @endif</td>
                          @endif
                        </tr>
                        <tr>
                        @if (!$logd->oimage4)
                          <td>{{$logd->created_at}}</td>
                                    <td>{{$logd->nama_admin}}</td>
                                    <td>{{$logd->nama_poi}}</td>
                                    <td>{{$logd->action}}</td>
                        <td>Image #4</td>
                       <td>@if(!$logd->oimage4)
                            none
                          @endif</td>
                          <td>@if(!$logd->image4)
                            blank picture
                             @else
                            {{$logd->image4}}
                          @endif</td>
                          @endif
                        </tr>
                        <tr>
                        @if (!$logd->oimage5)
                          <td>{{$logd->created_at}}</td>
                                    <td>{{$logd->nama_admin}}</td>
                                    <td>{{$logd->nama_poi}}</td>
                                    <td>{{$logd->action}}</td>
                        <td>Image #5</td>
                          <td>@if(!$logd->oimage5)
                            none
                          @endif</td>
                          <td>@if(!$logd->image5)
                            blank picture
                             @else
                            {{$logd->image5}}
                          @endif</td>
                          @endif
                        </tr>
                        <tr>
                        @if (!$logd->oimage6)
                          <td>{{$logd->created_at}}</td>
                                    <td>{{$logd->nama_admin}}</td>
                                    <td>{{$logd->nama_poi}}</td>
                                    <td>{{$logd->action}}</td>
                        <td>Image #6</td>
                           <td>@if(!$logd->oimage6)
                            none
                          @endif</td>
                          <td>@if(!$logd->image6)
                            blank picture
                             @else
                            {{$logd->image6}}
                          @endif</td>
                          @endif
                        </tr>
                        <tr>
                        @if (!$logd->oimage7)
                          <td>{{$logd->created_at}}</td>
                                    <td>{{$logd->nama_admin}}</td>
                                    <td>{{$logd->nama_poi}}</td>
                                    <td>{{$logd->action}}</td>
                        <td>Image #7</td>
                            <td>@if(!$logd->oimage7)
                            none
                          @endif</td>
                          <td>@if(!$logd->image7)
                            blank picture
                             @else
                            {{$logd->image7}}
                          @endif</td>
                          @endif
                        </tr>
                        <tr>
                        @if (!$logd->oimage8)
                          <td>{{$logd->created_at}}</td>
                                    <td>{{$logd->nama_admin}}</td>
                                    <td>{{$logd->nama_poi}}</td>
                                    <td>{{$logd->action}}</td>
                        <td>Image #8</td>
                            <td>@if(!$logd->oimage8)
                            none
                          @endif</td>
                          <td>@if(!$logd->image8)
                            blank picture
                             @else
                            {{$logd->image8}}
                          @endif</td>
                          @endif
                        </tr>
                        <tr>
                        @if (!$logd->oimage9)
                          <td>{{$logd->created_at}}</td>
                                    <td>{{$logd->nama_admin}}</td>
                                    <td>{{$logd->nama_poi}}</td>
                                    <td>{{$logd->action}}</td>
                        <td>Image #9</td>
                           <td>@if(!$logd->oimage9)
                            none
                          @endif</td>
                          <td>@if(!$logd->image9)
                            blank picture
                            @else
                            {{$logd->image9}}
                          @endif</td>
                          @endif
                        </tr>
                        <tr>
                        @if (!$logd->oimage10)
                          <td>{{$logd->created_at}}</td>
                                    <td>{{$logd->nama_admin}}</td>
                                    <td>{{$logd->nama_poi}}</td>
                                    <td>{{$logd->action}}</td>
                        <td>Image #10</td>
                            <td>@if(!$logd->oimage10)
                            none
                          @endif</td>
                          <td>@if(!$logd->image10)
                            blank picture
                             @else
                            {{$logd->image10}}
                          @endif</td>
                          @endif
                        </tr>
                        <tr>
                        @if (!$logd->ovideos)
                          <td>{{$logd->created_at}}</td>
                                    <td>{{$logd->nama_admin}}</td>
                                    <td>{{$logd->nama_poi}}</td>
                                    <td>{{$logd->action}}</td>
                        <td>Video</td>
                           <td>@if(!$logd->ovideos)
                            none
                          @endif</td>
                          <td>@if(!$logd->videos)
                            blank video
                             @else
                            {{$logd->videos}}
                          @endif</td>
                          @endif
                        </tr>
                          <tr>
                          @if (!$logd->oketerangan)
                          <td>{{$logd->created_at}}</td>
                                    <td>{{$logd->nama_admin}}</td>
                                    <td>{{$logd->nama_poi}}</td>
                                    <td>{{$logd->action}}</td>
                        <td>Detail</td>
                           <td>@if(!$logd->oketerangan)
                            none
                          @endif</td>
                          <td>@if(!$logd->keterangan)
                            blank detail
                             @else
                            {{$logd->keterangan}}
                          @endif</td>
                          @endif
                        @endif
                      @endforeach
                      </tr>
                      </table>
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
</body>
<script>
        $(function() {
            $('#mediaModal').on('show.bs.modal', function (e) {
                $('#im').html($(e.relatedTarget).data('img'));
                $('#im2').html($(e.relatedTarget).data('img2'));
                $('#im3').html($(e.relatedTarget).data('img3'));
                $('#im4').html($(e.relatedTarget).data('img4'));
                $('#im5').html($(e.relatedTarget).data('img5'));
                $('#im6').html($(e.relatedTarget).data('img6'));
                $('#im7').html($(e.relatedTarget).data('img7'));
                $('#im8').html($(e.relatedTarget).data('img8'));
                $('#im9').html($(e.relatedTarget).data('img9'));
                $('#im10').html($(e.relatedTarget).data('img10'));
                $('#vi').html($(e.relatedTarget).data('vid'));
                $('#oim').html($(e.relatedTarget).data('oimg'));
                $('#oim2').html($(e.relatedTarget).data('oimg2'));
                $('#oim3').html($(e.relatedTarget).data('oimg3'));
                $('#oim4').html($(e.relatedTarget).data('oimg4'));
                $('#oim5').html($(e.relatedTarget).data('oimg5'));
                $('#oim6').html($(e.relatedTarget).data('oimg6'));
                $('#oim7').html($(e.relatedTarget).data('oimg7'));
                $('#oim8').html($(e.relatedTarget).data('oimg8'));
                $('#oim9').html($(e.relatedTarget).data('oimg9'));
                $('#oim10').html($(e.relatedTarget).data('oimg10'));
                $('#ovi').html($(e.relatedTarget).data('ovid'));
            });
        });
    </script>
    <script>
        $(function() {
            $('#detailModal').on('show.bs.modal', function (e) {
                $('#des').html($(e.relatedTarget).data('desc'));
                $('#odes').html($(e.relatedTarget).data('odesc'));
            });
        });
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
</html>