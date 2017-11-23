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
                          <table border="solid">
                                  <tr>
                                  <th rowspan="2" style="text-align: center;">Tanggal</th>
                                  <th rowspan="2" style="text-align: center;">Nama Admin</th>
                                  <th rowspan="2" style="text-align: center;">Action</th>
                                  <th colspan="2" style="text-align: center;">POI</th>
                                  <th colspan="2" style="text-align: center;">Longitude</th>
                                  <th colspan="2" style="text-align: center;">Latitude</th>
                                  <tr>
                                  <th style="text-align: center;">Before</th>
                                  <th style="text-align: center;">After</th>
                                  <th style="text-align: center;">Before</th>
                                  <th style="text-align: center;">After</th>
                                  <th style="text-align: center;">Before</th>
                                  <th style="text-align: center;">After</th>
                                  </tr>
                                  <tr>
                                    @if(count($utama))
                                @foreach($utama as $logu)
                                @if($logu->action =='add')
                                 <tr>
                                  <td style="text-align: center;">{{$logu->created_at}}</td>
                                  <td style="text-align: center;">{{$logu->nama_admin}}</td>
                                  <td style="text-align: center;">{{$logu->action}}</td>
                                  <td style="text-align: center;">@if(!$logu->olokasi) none @endif</td>
                                  <td style="text-align: center;">{{$logu->lokasi}}</td>
                                  <td style="text-align: center;">@if(!$logu->olongitude) none @endif</td>
                                  <td style="text-align: center;">{{$logu->longitude}}</td>
                                  <td style="text-align: center;">@if(!$logu->olatitude) none @endif</td>
                                  <td style="text-align: center;">{{$logu->latitude}}</td>
                                  </tr>
                                @endif
                                 @if($logu->action =='edit')
                                 <tr>
                                 <td style="text-align: center;">{{$logu->created_at}}</td>
                                  <td style="text-align: center;">{{$logu->nama_admin}}</td>
                                  <td style="text-align: center;">{{$logu->action}}</td>
                                  <td style="text-align: center;">{{$logu->olokasi}}</td>
                                  <td style="text-align: center;">{{$logu->lokasi}}</td>
                                  <td style="text-align: center;">{{$logu->olongitude}}</td>
                                  <td style="text-align: center;">{{$logu->longitude}}</td>
                                  <td style="text-align: center;">{{$logu->olatitude}}</td>
                                  <td style="text-align: center;">{{$logu->latitude}}</td>
                                  </tr>
                                @endif
                                 @endforeach
                                @else
                                <h2>No Log(s) Available Yet </h2>
                              @endif 
                                  </tr>
                                </table>
                       
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
                                  <th style="text-align: center;">Tanggal</th>
                                  <th style="text-align: center;">Nama Admin</th>
                                  <th style="text-align: center;">POI</th>
                                  <th style="text-align: center;">Action</th>
                                  <th style="text-align: center;">Object</th>
                                  <th style="text-align: center;">Before</th>
                                  <th style="text-align: center;">After</th>
                                  </tr>
                                   @if(count($detil))
                                @foreach($detil as $logd)
                        @if ($logd->action=='edit')
                        <tr>
                          @if ($logd->oimage != $logd->image)
                            <td style="text-align: center;">{{$logd->created_at}}</td>
                                    <td style="text-align: center;" style="text-align: center;">{{$logd->nama_admin}}</td>
                                    <td style="text-align: center;">{{$logd->nama_poi}}</td>
                                    <td style="text-align: center;">{{$logd->action}}</td>
                          <td style="text-align: center;">Image #1</td>
                          <td style="text-align: center;">@if($logd->oimage)
                            {{str_replace('images/','',$logd->oimage)}}
                          @else
                        none
                      @endif</td>
                          <td style="text-align: center;">{{str_replace('images/','',$logd->image)}}</td>
                          @endif
                        </tr>
                        <tr>
                        @if ($logd->oimage2 != $logd->image2)
                          <td style="text-align: center;">{{$logd->created_at}}</td>
                                    <td style="text-align: center;">{{$logd->nama_admin}}</td>
                                    <td style="text-align: center;">{{$logd->nama_poi}}</td>
                                   <td style="text-align: center;">{{$logd->action}}</td>
                          <td style="text-align: center;">Image #2</td>
                          <td style="text-align: center;">@if($logd->oimage2)
                             {{str_replace('images/','',$logd->oimage2)}}
                          @else
                        none
                      @endif</td>
                          <td style="text-align: center;">{{str_replace('images/','',$logd->image2)}}</td>
                          @endif
                        </tr>
                        <tr>
                        @if ($logd->oimage3 != $logd->image3)
                          <td style="text-align: center;">{{$logd->created_at}}</td>
                                    <td style="text-align: center;">{{$logd->nama_admin}}</td>
                                    <td style="text-align: center;">{{$logd->nama_poi}}</td>
                                    <td style="text-align: center;">{{$logd->action}}</td>
                        <td style="text-align: center;">Image #3</td>
                            <td style="text-align: center;">@if($logd->oimage3)
                             {{str_replace('images/','',$logd->oimage3)}}
                          @else
                        none
                      @endif</td>
                          <td style="text-align: center;">{{str_replace('images/','',$logd->image3)}}</td>
                          @endif
                        </tr>
                        <tr>
                        @if ($logd->oimage4 != $logd->image4)
                          <td style="text-align: center;">{{$logd->created_at}}</td>
                                   <td style="text-align: center;">{{$logd->nama_admin}}</td>
                                   <td style="text-align: center;">{{$logd->nama_poi}}</td>
                                    <td style="text-align: center;">{{$logd->action}}</td>
                        <td style="text-align: center;">Image #4</td>
                      <td style="text-align: center;">@if($logd->oimage4)
                            {{str_replace('images/','',$logd->oimage4)}}
                          @else
                        none
                      @endif</td>
                         <td style="text-align: center;">{{str_replace('images/','',$logd->image4)}}</td>
                          @endif
                        </tr>
                        <tr>
                        @if ($logd->oimage5 != $logd->image5)
                          <td style="text-align: center;">{{$logd->created_at}}</td>
                                    <td style="text-align: center;">{{$logd->nama_admin}}</td>
                                    <td style="text-align: center;">{{$logd->nama_poi}}</td>
                                   <td style="text-align: center;">{{$logd->action}}</td>
                        <td style="text-align: center;">Image #5</td>
                           <td style="text-align: center;">@if($logd->oimage5)
                             {{str_replace('images/','',$logd->oimage5)}}
                          @else
                        none
                      @endif</td>
                          <td style="text-align: center;">{{str_replace('images/','',$logd->image5)}}</td>
                          @endif
                        </tr>
                        <tr>
                        @if ($logd->oimage6 != $logd->image6)
                          <td style="text-align: center;">{{$logd->created_at}}</td>
                                    <td style="text-align: center;">{{$logd->nama_admin}}</td>
                                    <td style="text-align: center;">{{$logd->nama_poi}}</td>
                                   <td style="text-align: center;">{{$logd->action}}</td>
                        <td style="text-align: center;">Image #6</td>
                           <td style="text-align: center;">@if($logd->oimag6)
                            {{str_replace('images/','',$logd->oimage6)}}
                          @else
                        none
                      @endif</td>
                          <td style="text-align: center;">{{str_replace('images/','',$logd->image6)}}</td>
                          @endif
                        </tr>
                        <tr>
                        @if ($logd->oimage7 != $logd->image7)
                          <td style="text-align: center;">{{$logd->created_at}}</td>
                                    <td style="text-align: center;">{{$logd->nama_admin}}</td>
                                    <td style="text-align: center;">{{$logd->nama_poi}}</td>
                                    <td style="text-align: center;">{{$logd->action}}</td>
                        <td style="text-align: center;">Image #7</td>
                            <td style="text-align: center;">@if($logd->oimage7)
                             {{str_replace('images/','',$logd->oimage7)}}
                          @else
                        none
                      @endif</td>
                          <td style="text-align: center;">{{str_replace('images/','',$logd->image7)}}</td>
                          @endif
                        </tr>
                        <tr>
                        @if ($logd->oimage8 != $logd->image8)
                          <td style="text-align: center;">{{$logd->created_at}}</td>
                                    <td style="text-align: center;">{{$logd->nama_admin}}</td>
                                    <td style="text-align: center;">{{$logd->nama_poi}}</td>
                                   <td style="text-align: center;">{{$logd->action}}</td>
                        <td style="text-align: center;">Image #8</td>
                           <td style="text-align: center;">@if($logd->oimage8)
                             {{str_replace('images/','',$logd->oimage8)}}
                          @else
                        none
                      @endif</td>
                       <td style="text-align: center;">{{str_replace('images/','',$logd->image8)}}</td>
                          @endif
                        </tr>
                        <tr>
                        @if ($logd->oimage9 != $logd->image9)
                          <td style="text-align: center;">{{$logd->created_at}}</td>
                                    <td style="text-align: center;">{{$logd->nama_admin}}</td>
                                    <td style="text-align: center;">{{$logd->nama_poi}}</td>
                                    <td style="text-align: center;">{{$logd->action}}</td>
                        <td style="text-align: center;">Image #9</td>
                            <td style="text-align: center;">@if($logd->oimage9)
                            {{str_replace('images/','',$logd->oimage9)}}
                          @else
                        none
                      @endif</td>
                          <td style="text-align: center;">{{str_replace('images/','',$logd->image9)}}</td>
                          @endif
                        </tr>
                        <tr>
                        @if ($logd->oimage10 != $logd->image10)
                          <td style="text-align: center;">{{$logd->created_at}}</td>
                                    <td style="text-align: center;">{{$logd->nama_admin}}</td>
                                    <td style="text-align: center;">{{$logd->nama_poi}}</td>
                                    <td style="text-align: center;">{{$logd->action}}</td>
                        <td style="text-align: center;">Image #10</td>
                            <td style="text-align: center;">@if($logd->oimage10)
                            {{str_replace('images/','',$logd->oimage10)}}
                          @else
                        none
                      @endif</td>
                          <td style="text-align: center;">{{str_replace('images/','',$logd->image10)}}</td>
                          @endif
                        </tr>
                        <tr>
                        @if ($logd->ovideos!= $logd->videos)
                          <td style="text-align: center;">{{$logd->created_at}}</td>
                                    <td style="text-align: center;">{{$logd->nama_admin}}</td>
                                    <td style="text-align: center;">{{$logd->nama_poi}}</td>
                                    <td style="text-align: center;">{{$logd->action}}</td>
                        <td style="text-align: center;">Video</td>
                            <td style="text-align: center;">@if($logd->ovideos)
                            {{str_replace('videos/','',$logd->ovideos)}}
                          @else
                        none
                      @endif</td>
                          <td style="text-align: center;">{{str_replace('videos/','',$logd->videos)}}</td>
                          @endif
                          @if ($logd->oketerangan != $logd->keterangan)
                          <td style="text-align: center;">{{$logd->created_at}}</td>
                                    <td style="text-align: center;">{{$logd->nama_admin}}</td>
                                    <td style="text-align: center;">{{$logd->nama_poi}}</td>
                                    <td style="text-align: center;">{{$logd->action}}</td>
                        <td style="text-align: center;">Detail</td>
                           <td style="text-align: center;">@if($logd->oketerangan)
                            {{$logd->oketerangan}}
                          @else
                        none
                      @endif</td>
                          <td style="text-align: center;">{!!$logd->keterangan!!}</td>
                          @endif
                        @endif
                        @if ($logd->action=='add')
                        <tr>
                          @if (!$logd->oimage)
                            <td style="text-align: center;">{{$logd->created_at}}</td>
                                    <td style="text-align: center;">{{$logd->nama_admin}}</td>
                                    <td style="text-align: center;">{{$logd->nama_poi}}</td>
                                    <td style="text-align: center;">{{$logd->action}}</td>
                          <td style="text-align: center;">Image #1</td>
                          <td style="text-align: center;">@if(!$logd->oimage)
                            none
                          @endif</td>
                          <td style="text-align: center;">@if(!$logd->image)
                            blank picture
                             @else
                            {{str_replace('images/','',$logd->image)}}
                          @endif</td>
                          @endif
                        </tr>
                        <tr>
                        @if (!$logd->oimage2)
                          <td style="text-align: center;">{{$logd->created_at}}</td>
                                    <td style="text-align: center;">{{$logd->nama_admin}}</td>
                                    <td style="text-align: center;">{{$logd->nama_poi}}</td>
                                    <td style="text-align: center;">{{$logd->action}}</td>
                          <td style="text-align: center;">Image #2</td>
                           <td style="text-align: center;">@if(!$logd->oimage2)
                            none
                          @endif</td>
                          <td style="text-align: center;">@if(!$logd->image2)
                            blank picture
                             @else
                            {{str_replace('images/','',$logd->image2)}}
                          @endif</td>
                          @endif
                        </tr>
                        <tr>
                        @if (!$logd->oimage3)
                          <td style="text-align: center;">{{$logd->created_at}}</td>
                                    <td style="text-align: center;">{{$logd->nama_admin}}</td>
                                    <td style="text-align: center;">{{$logd->nama_poi}}</td>
                                    <td style="text-align: center;">{{$logd->action}}</td>
                        <td style="text-align: center;">Image #3</td>
                            <td style="text-align: center;">@if(!$logd->oimage3)
                            none
                          @endif</td>
                          <td style="text-align: center;">@if(!$logd->image3)
                            blank picture
                             @else
                            {{str_replace('images/','',$logd->image3)}}
                          @endif</td>
                          @endif
                        </tr>
                        <tr>
                        @if (!$logd->oimage4)
                          <td style="text-align: center;">{{$logd->created_at}}</td>
                                    <td style="text-align: center;">{{$logd->nama_admin}}</td>
                                    <td style="text-align: center;">{{$logd->nama_poi}}</td>
                                    <td style="text-align: center;">{{$logd->action}}</td>
                        <td style="text-align: center;">Image #4</td>
                       <td style="text-align: center;">@if(!$logd->oimage4)
                            none
                          @endif</td>
                          <td style="text-align: center;">@if(!$logd->image4)
                            blank picture
                             @else
                            {{str_replace('images/','',$logd->image4)}}
                          @endif</td>
                          @endif
                        </tr>
                        <tr>
                        @if (!$logd->oimage5)
                          <td style="text-align: center;">{{$logd->created_at}}</td>
                                    <td style="text-align: center;">{{$logd->nama_admin}}</td>
                                    <td style="text-align: center;">{{$logd->nama_poi}}</td>
                                    <td style="text-align: center;">{{$logd->action}}</td>
                        <td style="text-align: center;">Image #5</td>
                          <td style="text-align: center;">@if(!$logd->oimage5)
                            none
                          @endif</td>
                          <td style="text-align: center;">@if(!$logd->image5)
                            blank picture
                             @else
                            {{str_replace('images/','',$logd->image5)}}
                          @endif</td>
                          @endif
                        </tr>
                        <tr>
                        @if (!$logd->oimage6)
                          <td style="text-align: center;">{{$logd->created_at}}</td>
                                    <td style="text-align: center;">{{$logd->nama_admin}}</td>
                                    <td style="text-align: center;">{{$logd->nama_poi}}</td>
                                    <td style="text-align: center;">{{$logd->action}}</td>
                        <td style="text-align: center;">Image #6</td>
                           <td style="text-align: center;">@if(!$logd->oimage6)
                            none
                          @endif</td>
                          <td style="text-align: center;">@if(!$logd->image6)
                            blank picture
                             @else
                            {{str_replace('images/','',$logd->image6)}}
                          @endif</td>
                          @endif
                        </tr>
                        <tr>
                        @if (!$logd->oimage7)
                          <td style="text-align: center;">{{$logd->created_at}}</td>
                                    <td style="text-align: center;">{{$logd->nama_admin}}</td>
                                    <td style="text-align: center;">{{$logd->nama_poi}}</td>
                                    <td style="text-align: center;">{{$logd->action}}</td>
                        <td style="text-align: center;">Image #7</td>
                            <td style="text-align: center;">@if(!$logd->oimage7)
                            none
                          @endif</td>
                          <td style="text-align: center;">@if(!$logd->image7)
                            blank picture
                             @else
                            {{str_replace('images/','',$logd->image7)}}
                          @endif</td>
                          @endif
                        </tr>
                        <tr>
                        @if (!$logd->oimage8)
                          <td style="text-align: center;">{{$logd->created_at}}</td>
                                    <td style="text-align: center;">{{$logd->nama_admin}}</td>
                                   <td style="text-align: center;">{{$logd->nama_poi}}</td>
                                    <td style="text-align: center;">{{$logd->action}}</td>
                        <td style="text-align: center;">Image #8</td>
                            <td style="text-align: center;">@if(!$logd->oimage8)
                            none
                          @endif</td>
                          <td style="text-align: center;">@if(!$logd->image8)
                            blank picture
                             @else
                            {{str_replace('images/','',$logd->image8)}}
                          @endif</td>
                          @endif
                        </tr>
                        <tr>
                        @if (!$logd->oimage9)
                          <td style="text-align: center;">{{$logd->created_at}}</td>
                                   <td style="text-align: center;">{{$logd->nama_admin}}</td>
                                    <td style="text-align: center;">{{$logd->nama_poi}}</td>
                                    <td style="text-align: center;">{{$logd->action}}</td>
                        <td style="text-align: center;">Image #9</td>
                          <td style="text-align: center;">@if(!$logd->oimage9)
                            none
                          @endif</td>
                          <td style="text-align: center;">@if(!$logd->image9)
                            blank picture
                            @else
                            {{str_replace('images/','',$logd->image9)}}
                          @endif</td>
                          @endif
                        </tr>
                        <tr>
                        @if (!$logd->oimage10)
                          <td style="text-align: center;">{{$logd->created_at}}</td>
                                    <td style="text-align: center;">{{$logd->nama_admin}}</td>
                                   <td style="text-align: center;">{{$logd->nama_poi}}</td>
                                    <td style="text-align: center;">{{$logd->action}}</td>
                        <td style="text-align: center;">Image #10</td>
                            <td style="text-align: center;">@if(!$logd->oimage10)
                            none
                          @endif</td>
                          <td style="text-align: center;">@if(!$logd->image10)
                            blank picture
                             @else
                            {{str_replace('images/','',$logd->image10)}}
                          @endif</td>
                          @endif
                        </tr>
                        <tr>
                        @if (!$logd->ovideos)
                          <td style="text-align: center;">{{$logd->created_at}}</td>
                                    <td style="text-align: center;">{{$logd->nama_admin}}</td>
                                    <td style="text-align: center;">{{$logd->nama_poi}}</td>
                                    <td style="text-align: center;">{{$logd->action}}</td>
                        <td style="text-align: center;">Video</td>
                           <td style="text-align: center;">@if(!$logd->ovideos)
                            none
                          @endif</td>
                          <td style="text-align: center;">@if(!$logd->videos)
                            blank video
                             @else
                            {{str_replace('videos/','',$logd->videos)}}
                          @endif</td>
                          @endif
                        </tr>
                          <tr>
                          @if (!$logd->oketerangan)
                          <td style="text-align: center;">{{$logd->created_at}}</td>
                                    <td style="text-align: center;">{{$logd->nama_admin}}</td>
                                    <td style="text-align: center;">{{$logd->nama_poi}}</td>
                                    <td style="text-align: center;">{{$logd->action}}</td>
                        <td style="text-align: center;">Detail</td>
                           <td style="text-align: center;">@if(!$logd->oketerangan)
                            none
                          @endif</td>
                         <td style="text-align: center;">@if(!$logd->keterangan)
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