

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
    
    <!--  Material Dashboard CSS    -->
    <link href="http://localhost/poi/public/BSDash/assets/css/material-dashboard.css?v=1.2.0" rel="stylesheet" />
    <link href="http://localhost/poi/public/BSDat/assets/css/bootstrap.css" rel="stylesheet" />
    <link href="http://localhost/poi/public/BSDat/assets/css/fresh-bootstrap-table.css" rel="stylesheet" />
    <!--  Fonts and icons     -->
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300|Material+Icons' rel='stylesheet' type='text/css'>
    <link href="http://localhost/poi/public/BSLogin/bootstrap3/css/bootstrap.css" rel="stylesheet" />
    <link href="http://localhost/poi/public/BSLogin/login-register.css" rel="stylesheet" />
    <link rel="stylesheet" href="http://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">  
    <script src="http://localhost/poi/public/BSLogin/jquery/jquery-1.10.2.js" type="text/javascript"></script>
    <script src="http://localhost/poi/public/BSLogin/bootstrap3/js/bootstrap.js" type="text/javascript"></script>
    <script src="http://localhost/poi/public/BSLogin/login-register.js" type="text/javascript"></script>
    <style>
      .btn.btn-default{
    top:-15px;
}
.btn.btn-default.dropdown-toggle{
  top:-10px;
}
    </style>
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
                        Welcome {{session('peng')}}! Click here to <a href="./logout">Logout</a> </div><br> 
                        @else
                        <a class="btn big-login" data-toggle="modal" href="javascript:void(0)" style ="position:relative;left:-10px"onclick="openLoginModal();">Login</a>
                        @endif
                        </li>
                        </ul>
                    </div>
                </div>
            </nav>
            <div class="content" style="position:relative;top:-60px">    
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
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card" id="log1">
                    <div class="card-header" data-background-color="purple"> 
                      <h4>POI Log</h4>
                    </div>
                    <div class="card-content">
                        <div id="typography">
                          <table id="poilogtable">
                            <thead>
                                  <tr>
                                  <th rowspan="2">Tanggal</th>
                                  <th rowspan="2">Nama Admin</th>
                                  <th rowspan="2">Action</th>
                                  <th colspan="2">POI</th>
                                  <th colspan="2">Longitude</th>
                                  <th colspan="2">Latitude</th>
                                  </tr>
                                  <tr>
                                  <th>Before</th>
                                  <th>After</th>
                                  <th>Before</th>
                                  <th>After</th>
                                  <th>Before</th>
                                  <th>After</th>
                                  </tr>
                            </thead>
                                <tbody>
                                @if(count($utama))
                                @foreach($utama as $logu)
                                @if($logu->action =='add')
                                 <tr>
                                  <td>{{$logu->created_at}}</td>
                                  <td>{{$logu->nama_admin}}</td>
                                  <td>{{$logu->action}}</td>
                                  <td>@if(!$logu->olokasi) none @endif</td>
                                  <td>{{$logu->lokasi}}</td>
                                  <td>@if(!$logu->olongitude) none @endif</td>
                                  <td>{{$logu->longitude}}</td>
                                  <td>@if(!$logu->olatitude) none @endif</td>
                                  <td>{{$logu->latitude}}</td>
                                  </tr>
                                @endif
                                 @if($logu->action =='edit')
                                 <tr>
                                 <td>{{$logu->created_at}}</td>
                                  <td>{{$logu->nama_admin}}</td>
                                  <td>{{$logu->action}}</td>
                                  <td>{{$logu->olokasi}}</td>
                                  <td>{{$logu->lokasi}}</td>
                                  <td>{{$logu->olongitude}}</td>
                                  <td>{{$logu->longitude}}</td>
                                  <td>{{$logu->olatitude}}</td>
                                  <td>{{$logu->latitude}}</td>
                                  </tr>
                                @endif
                                 @endforeach
                              @endif 
                                </tbody>
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
                                <table id="detlogtable">
                                  <thead>
                                  <tr>
                                  <th>Tanggal</th>
                                  <th>Nama Admin</th>
                                  <th>POI</th>
                                  <th>Action</th>
                                  <th>Object</th>
                                  <th>Before</th>
                                  <th>After</th>
                                  </tr>
                                </thead>
                            <tbody>                   
                        @if(count($detil))
                        @foreach($detil as $logd)
                        @if ($logd->action=='edit')
                        
                        @if ($logd->oimage != $logd->image)
                        <tr>
                        <td>{{$logd->created_at}}</td>
                        <td>{{$logd->nama_admin}}</td>
                        <td><a href="./showDet{{$logd->id_detail}}">{{$logd->nama_poi}}</a></td>
                        <td>{{$logd->action}}</td>
                        <td>Image #1</td>
                        <td>@if($logd->oimage)
                        {{str_replace('images/','',$logd->oimage)}}
                        @else
                        none
                        @endif
                        </td>
                        <td>{{str_replace('images/','',$logd->image)}}</td>
                        </tr>
                        @endif
                        
                        @if ($logd->oimage2 != $logd->image2)
                        <tr>
                        <td>{{$logd->created_at}}</td>
                        <td>{{$logd->nama_admin}}</td>
                        <td><a href="./showDet{{$logd->id_detail}}">{{$logd->nama_poi}}</a></td>
                        <td>{{$logd->action}}</td>
                        <td>Image #2</td>
                        <td>@if($logd->oimage2)
                        {{str_replace('images/','',$logd->oimage2)}}
                        @else
                        none
                        @endif</td>
                        <td>{{str_replace('images/','',$logd->image2)}}</td>
                        </tr>
                        @endif
                        
                        @if ($logd->oimage3 != $logd->image3)
                        <tr>
                        <td>{{$logd->created_at}}</td>
                        <td>{{$logd->nama_admin}}</td>
                        <td><a href="./showDet{{$logd->id_detail}}">{{$logd->nama_poi}}</a></td>
                        <td>{{$logd->action}}</td>
                        <td>Image #3</td>
                        <td>@if($logd->oimage3)
                        {{str_replace('images/','',$logd->oimage3)}}
                        @else
                        none
                        @endif</td>
                        <td>{{str_replace('images/','',$logd->image3)}}</td>
                        </tr>
                        @endif
                        
                        @if ($logd->oimage4 != $logd->image4)
                        <tr>
                        <td>{{$logd->created_at}}</td>
                        <td>{{$logd->nama_admin}}</td>
                        <td><a href="./showDet{{$logd->id_detail}}">{{$logd->nama_poi}}</a></td>
                        <td>{{$logd->action}}</td>
                        <td>Image #4</td>
                        <td>@if($logd->oimage4)
                        {{str_replace('images/','',$logd->oimage4)}}
                        @else
                        none
                        @endif</td>
                        <td>{{str_replace('images/','',$logd->image4)}}</td></tr>
                        @endif
                        
                        @if ($logd->oimage5 != $logd->image5) <tr>
                        <td>{{$logd->created_at}}</td>
                        <td>{{$logd->nama_admin}}</td>
                        <td><a href="./showDet{{$logd->id_detail}}">{{$logd->nama_poi}}</a></td>
                        <td>{{$logd->action}}</td>
                        <td>Image #5</td>
                        <td>@if($logd->oimage5)
                        {{str_replace('images/','',$logd->oimage5)}}
                        @else
                        none
                        @endif</td>
                        <td>{{str_replace('images/','',$logd->image5)}}</td> </tr>
                        @endif
                       
                        @if ($logd->oimage6 != $logd->image6)<tr>
                        <td>{{$logd->created_at}}</td>
                        <td>{{$logd->nama_admin}}</td>
                        <td><a href="./showDet{{$logd->id_detail}}">{{$logd->nama_poi}}</a></td>
                        <td>{{$logd->action}}</td>
                        <td>Image #6</td>
                        <td>@if($logd->oimag6)
                        {{str_replace('images/','',$logd->oimage6)}}
                        @else
                        none
                        @endif</td>
                        <td>{{str_replace('images/','',$logd->image6)}}</td></tr>
                        @endif
                        
                        @if ($logd->oimage7 != $logd->image7)<tr>
                        <td>{{$logd->created_at}}</td>
                        <td>{{$logd->nama_admin}}</td>
                        <td><a href="./showDet{{$logd->id_detail}}">{{$logd->nama_poi}}</a></td>
                        <td>{{$logd->action}}</td>
                        <td>Image #7</td>
                        <td>@if($logd->oimage7)
                        {{str_replace('images/','',$logd->oimage7)}}
                        @else
                        none
                        @endif</td>
                        <td>{{str_replace('images/','',$logd->image7)}}</td> </tr>
                        @endif
                        
                        @if ($logd->oimage8 != $logd->image8)<tr>
                        <td>{{$logd->created_at}}</td>
                        <td>{{$logd->nama_admin}}</td>
                        <td><a href="./showDet{{$logd->id_detail}}">{{$logd->nama_poi}}</a></td>
                        <td>{{$logd->action}}</td>
                        <td>Image #8</td>
                        <td>@if($logd->oimage8)
                        {{str_replace('images/','',$logd->oimage8)}}
                        @else
                        none
                        @endif</td>
                        <td>{{str_replace('images/','',$logd->image8)}}</td>
                        </tr>
                        @endif
                        
                        @if ($logd->oimage9 != $logd->image9) <tr>
                        <td>{{$logd->created_at}}</td>
                        <td>{{$logd->nama_admin}}</td>
                        <td><a href="./showDet{{$logd->id_detail}}">{{$logd->nama_poi}}</a></td>
                        <td>{{$logd->action}}</td>
                        <td>Image #9</td>
                        <td>@if($logd->oimage9)
                        {{str_replace('images/','',$logd->oimage9)}}
                        @else
                        none
                        @endif</td>
                        <td>{{str_replace('images/','',$logd->image9)}}</td> </tr>
                        @endif
                       
                        @if ($logd->oimage10 != $logd->image10)<tr>
                        <td>{{$logd->created_at}}</td>
                        <td>{{$logd->nama_admin}}</td>
                        <td><a href="./showDet{{$logd->id_detail}}">{{$logd->nama_poi}}</a></td>
                        <td>{{$logd->action}}</td>
                        <td>Image #10</td>
                        <td>@if($logd->oimage10)
                        {{str_replace('images/','',$logd->oimage10)}}
                        @else
                        none
                        @endif</td>
                        <td>{{str_replace('images/','',$logd->image10)}}</td></tr>
                        @endif
                        
                        @if ($logd->ovideos!= $logd->videos)<tr>
                        <td>{{$logd->created_at}}</td>
                        <td>{{$logd->nama_admin}}</td>
                        <td><a href="./showDet{{$logd->id_detail}}">{{$logd->nama_poi}}</a></td>
                        <td>{{$logd->action}}</td>
                        <td>Video</td>
                        <td>@if($logd->ovideos)
                        {{str_replace('videos/','',$logd->ovideos)}}
                        @else
                        none
                        @endif</td>
                        <td>{{str_replace('videos/','',$logd->videos)}}</td>
                        </tr>@endif
                        
                        @if ($logd->oketerangan != $logd->keterangan)<tr>
                        <td>{{$logd->created_at}}</td>
                        <td>{{$logd->nama_admin}}</td>
                        <td><a href="./showDet{{$logd->id_detail}}">{{$logd->nama_poi}}</a></td>
                        <td>{{$logd->action}}</td>
                        <td>Detail</td>
                        <td>@if($logd->oketerangan)
                        <button data-toggle="modal" data-target="#odModal" data-id="{{$logd->id}}" data-odsc="{{$logd->oketerangan}}">Before</button>   
                        @else
                        none
                        @endif</td>
                        <td><button data-toggle="modal" data-target="#dModal" data-id="{{$logd->id}}" data-dsc="{!!$logd->keterangan!!}">After</button>
                        </td>
                        </tr>@endif
                       
                        @endif
                        @if ($logd->action=='add')
                        
                          @if (!$logd->oimage)<tr>
                          <td>{{$logd->created_at}}</td>
                          <td>{{$logd->nama_admin}}</td>
                          <td><a href="./showDet{{$logd->id_detail}}">{{$logd->nama_poi}}</a></td>
                          <td>{{$logd->action}}</td>
                          <td>Image #1</td>
                          <td>@if(!$logd->oimage)
                          none
                          @endif</td>
                          <td>@if(!$logd->image)
                          blank picture
                          @else
                          {{str_replace('images/','',$logd->image)}}
                          @endif</td></tr>
                          @endif
                        
                          @if (!$logd->oimage2)<tr>
                          <td>{{$logd->created_at}}</td>
                          <td>{{$logd->nama_admin}}</td>
                          <td><a href="./showDet{{$logd->id_detail}}">{{$logd->nama_poi}}</a></td>
                          <td>{{$logd->action}}</td>
                          <td>Image #2</td>
                          <td>@if(!$logd->oimage2)
                          none
                          @endif</td>
                          <td>@if(!$logd->image2)
                          blank picture
                          @else
                          {{str_replace('images/','',$logd->image2)}}
                          @endif</td></tr>
                          @endif
                        
                          @if (!$logd->oimage3)<tr>
                          <td>{{$logd->created_at}}</td>
                          <td>{{$logd->nama_admin}}</td>
                          <td><a href="./showDet{{$logd->id_detail}}">{{$logd->nama_poi}}</a></td>
                          <td>{{$logd->action}}</td>
                          <td>Image #3</td>
                          <td>@if(!$logd->oimage3)
                          none
                          @endif</td>
                          <td>@if(!$logd->image3)
                          blank picture
                          @else
                          {{str_replace('images/','',$logd->image3)}}
                          @endif</td></tr>
                          @endif
                        
                          @if (!$logd->oimage4)<tr>
                          <td>{{$logd->created_at}}</td>
                          <td>{{$logd->nama_admin}}</td>
                          <td><a href="./showDet{{$logd->id_detail}}">{{$logd->nama_poi}}</a></td>
                          <td>{{$logd->action}}</td>
                          <td>Image #4</td>
                          <td>@if(!$logd->oimage4)
                          none
                          @endif</td>
                          <td>@if(!$logd->image4)
                          blank picture
                          @else
                          {{str_replace('images/','',$logd->image4)}}
                          @endif</td></tr>
                          @endif
                        
                          @if (!$logd->oimage5) <tr>
                          <td>{{$logd->created_at}}</td>
                          <td>{{$logd->nama_admin}}</td>
                          <td><a href="./showDet{{$logd->id_detail}}">{{$logd->nama_poi}}</a></td>
                          <td>{{$logd->action}}</td>
                          <td>Image #5</td>
                          <td>@if(!$logd->oimage5)
                          none
                          @endif</td>
                          <td>@if(!$logd->image5)
                          blank picture
                          @else
                          {{str_replace('images/','',$logd->image5)}}
                          @endif</td></tr>
                          @endif
                        
                          @if (!$logd->oimage6)<tr>
                          <td>{{$logd->created_at}}</td>
                          <td>{{$logd->nama_admin}}</td>
                          <td><a href="./showDet{{$logd->id_detail}}">{{$logd->nama_poi}}</a></td>
                          <td>{{$logd->action}}</td>
                          <td>Image #6</td>
                          <td>@if(!$logd->oimage6)
                          none
                          @endif</td>
                          <td>@if(!$logd->image6)
                          blank picture
                          @else
                          {{str_replace('images/','',$logd->image6)}}
                          @endif</td> </tr>
                          @endif
                      
                          @if (!$logd->oimage7)<tr>
                          <td>{{$logd->created_at}}</td>
                          <td>{{$logd->nama_admin}}</td>
                          <td><a href="./showDet{{$logd->id_detail}}">{{$logd->nama_poi}}</a></td>
                          <td>{{$logd->action}}</td>
                          <td>Image #7</td>
                          <td>@if(!$logd->oimage7)
                          none
                          @endif</td>
                          <td>@if(!$logd->image7)
                          blank picture
                          @else
                          {{str_replace('images/','',$logd->image7)}}
                          @endif</td></tr>
                          @endif
                        
                          @if (!$logd->oimage8)<tr>
                          <td>{{$logd->created_at}}</td>
                          <td>{{$logd->nama_admin}}</td>
                          <td><a href="./showDet{{$logd->id_detail}}">{{$logd->nama_poi}}</a></td>
                          <td>{{$logd->action}}</td>
                          <td>Image #8</td>
                          <td>@if(!$logd->oimage8)
                          none
                          @endif</td>
                          <td>@if(!$logd->image8)
                          blank picture
                          @else
                          {{str_replace('images/','',$logd->image8)}}
                          @endif</td></tr>
                          @endif
                        
                          @if (!$logd->oimage9)<tr>
                          <td>{{$logd->created_at}}</td>
                          <td>{{$logd->nama_admin}}</td>
                          <td><a href="./showDet{{$logd->id_detail}}">{{$logd->nama_poi}}</a></td>
                          <td>{{$logd->action}}</td>
                          <td>Image #9</td>
                          <td>@if(!$logd->oimage9)
                          none
                          @endif</td>
                          <td>@if(!$logd->image9)
                          blank picture
                          @else
                          {{str_replace('images/','',$logd->image9)}}
                          @endif</td></tr>
                          @endif
                        
                          @if (!$logd->oimage10)<tr>
                          <td>{{$logd->created_at}}</td>
                          <td>{{$logd->nama_admin}}</td>
                          <td><a href="./showDet{{$logd->id_detail}}">{{$logd->nama_poi}}</a></td>
                          <td>{{$logd->action}}</td>
                          <td>Image #10</td>
                          <td>@if(!$logd->oimage10)
                          none
                          @endif</td>
                          <td>@if(!$logd->image10)
                          blank picture
                          @else
                          {{str_replace('images/','',$logd->image10)}}
                          @endif</td></tr>
                          @endif
                      
                          @if (!$logd->ovideos)<tr>
                          <td>{{$logd->created_at}}</td>
                          <td>{{$logd->nama_admin}}</td>
                          <td><a href="./showDet{{$logd->id_detail}}">{{$logd->nama_poi}}</a></td>
                          <td>{{$logd->action}}</td>
                          <td>Video</td>
                          <td>@if(!$logd->ovideos)
                          none
                          @endif</td>
                          <td>@if(!$logd->videos)
                          blank video
                          @else
                          {{str_replace('videos/','',$logd->videos)}}
                          @endif</td></tr>
                          @endif
                        
                          @if (!$logd->oketerangan)<tr>
                          <td>{{$logd->created_at}}</td>
                          <td>{{$logd->nama_admin}}</td>
                          <td><a href="./showDet{{$logd->id_detail}}">{{$logd->nama_poi}}</a></td>
                          <td>{{$logd->action}}</td>
                          <td>Detail</td>
                          <td>@if(!$logd->oketerangan)
                          none
                          @endif</td>
                          <td>@if(!$logd->keterangan)
                          blank detail
                          @else <button data-toggle="modal" data-target="#dModal" data-id="{{$logd->id}}" data-dsc="{{$logd->keterangan}}">After</button> @endif</td> </tr> 
                          @endif
                      
                        @endif
                      @endforeach
                    @endif
                      </tbody>
                    </table>
                  </div>  
                </div>
              </div>
            </div>
          </div>
        </div>     
      </div>
    </div>
    <div class="modal fade" id="dModal">
                              <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">After</h4>
                                  </div>
                                <div class="modal-body">
                                  <p><span id="desc"></span></p>
                                </div>
                              </div>   
                            </div>
                          </div>
                      <div class="modal fade" id="odModal">
                              <div class="modal-dialog">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">Before</h4>
                                  </div>
                                <div class="modal-body">
                                  <p><span id="odesc"></span></p>
                                </div>
                              </div>   
                            </div>
                          </div>              
</body>
 <script type="text/javascript" src="http://localhost/poi/public/BSDat/assets/js/jquery-1.11.2.min.js"></script>
    <script type="text/javascript" src="http://localhost/poi/public/BSDat/assets/js/bootstrap.js"></script>
    <script type="text/javascript" src="http://localhost/poi/public/BSDat/assets/js/bootstrap-table.js"></script>
        
    <script type="text/javascript">
        var $table = $('#poilogtable'), 
            full_screen = false,
            window_height;
            
        $().ready(function(){
            
            window_height = $(window).height();
            table_height = window_height - 20;
            
            
            $table.bootstrapTable({
                toolbar: ".toolbar",

                showRefresh: true,
                search: true,
                showToggle: true,
                showColumns: true,
                pagination: true,
                striped: true,
                sortable: true,
                pageSize: 5,
                pageList: [5,10,15],
                
                formatShowingRows: function(pageFrom, pageTo, totalRows){
                    //do nothing here, we don't want to show the text "showing x of y from..." 
                },
                formatRecordsPerPage: function(pageNumber){
                    return pageNumber + " rows visible";
                },
                icons: {
                    refresh: 'fa fa-refresh',
                    toggle: 'fa fa-th-list',
                    columns: 'fa fa-columns',
                    detailOpen: 'fa fa-plus-circle',
                    detailClose: 'fa fa-minus-circle'
                }
            });
                      
            $(window).resize(function () {
                $table.bootstrapTable('resetView');
            });    
        }); 
    </script>

    <script type="text/javascript">
        var $table1 = $('#detlogtable'), 
            full_screen = false,
            window_height;
            
        $().ready(function(){
            
            window_height = $(window).height();
            table_height = window_height - 20;
            
            
            $table1.bootstrapTable({
                toolbar: ".toolbar",

                showRefresh: true,
                search: true,
                showToggle: true,
                showColumns: true,
                pagination: true,
                striped: true,
                sortable: true,
                pageSize: 5,
                pageList: [5,10,15],
                
                formatShowingRows: function(pageFrom, pageTo, totalRows){
                    //do nothing here, we don't want to show the text "showing x of y from..." 
                },
                formatRecordsPerPage: function(pageNumber){
                    return pageNumber + " rows visible";
                },
                icons: {
                    refresh: 'fa fa-refresh',
                    toggle: 'fa fa-th-list',
                    columns: 'fa fa-columns',
                    detailOpen: 'fa fa-plus-circle',
                    detailClose: 'fa fa-minus-circle'
                }
            });
                      
            $(window).resize(function () {
                $table1.bootstrapTable('resetView');
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
<script>
  $(function() {
            $('#dModal').on('show.bs.modal', function (e) {
                $('#desc').html($(e.relatedTarget).data('dsc'));
            });
        });
  </script>
  <script>
     $(function() {
            $('#odModal').on('show.bs.modal', function (e) {
                $('#odesc').html($(e.relatedTarget).data('odsc'));
            });
        });
  </script>
</html>