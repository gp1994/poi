

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
                                <table id="detlogtable">
                                  <thead>
                                  <tr>
                                  <th>Tanggal</th>
                                  <th>Nama Admin</th>
                                  <th>Type</th>
                                  <th>Action</th>
                                  <th>Object</th>
                                  <th>Object ID</th>
                                  <th>Before</th>
                                  <th>After</th>
                                  </tr>
                                </thead>
                            <tbody>                   
                        @if(count($log))
                        @foreach($log as $logd)
                        @if ($logd->tipe=='POI')
                        @if ($logd->before != $logd->after)
                        <tr>
                        <td>{{$logd->created_at}}</td>
                        <td>{{$logd->nama_admin}}</td>
                        <td>{{$logd->tipe}}</td>
                        <td>{{$logd->action}}</td>
                        <td>{{$logd->object}}</td>
                        <td>{{$logd->poi_id}}</td>
                        <td>@if($logd->before){{$logd->before}}@else none @endif</td>
                        <td>{{$logd->after}}</td>
                        </tr>
                        @endif
                        @endif
                        @if ($logd->tipe=='Detail')
                        @if ($logd->action=='add')
                        <tr>
                        <td>{{$logd->created_at}}</td>
                        <td>{{$logd->nama_admin}}</td>
                        <td>{{$logd->tipe}}</td>
                        <td>{{$logd->action}}</td>
                        <td>{{$logd->object}}</td>
                        <td><a href="./showDet{{$logd->object_id}}">{{$logd->object_id}}</a></td>
                        <td>@if(!$logd->before) none @endif</td>
                        <td>@if(!$logd->after) blank detail @endif</td>
                        </tr>
                        @endif
                        @if ($logd->before != $logd->after)
                         @if ($logd->object == 'Image 1' || $logd->object == 'Image 2' || $logd->object == 'Image 3' || $logd->object == 'Image 4' || $logd->object == 'Image 5' || $logd->object == 'Image 6' || $logd->object == 'Image 7' || $logd->object == 'Image 8' || $logd->object == 'Image 9' || $logd->object == 'Image 10')
                        <tr>
                        <td>{{$logd->created_at}}</td>
                        <td>{{$logd->nama_admin}}</td>
                        <td>{{$logd->tipe}}</td>
                        <td>{{$logd->action}}</td>
                        <td>{{$logd->object}}</td>
                        <td><a href="./showDet{{$logd->object_id}}">{{$logd->object_id}}</a></td>
                        <td>@if($logd->before){{str_replace('images/','',$logd->before)}}@else none @endif</td>
                        <td>{{str_replace('images/','',$logd->after)}}</td>
                        </tr>
                        @endif
                        @if ($logd->object == 'Video')
                        <tr>
                        <td>{{$logd->created_at}}</td>
                        <td>{{$logd->nama_admin}}</td>
                        <td>{{$logd->tipe}}</td>
                        <td>{{$logd->action}}</td>
                        <td>{{$logd->object}}</td>
                        <td><a href="./showDet{{$logd->object_id}}">{{$logd->object_id}}</a></td>
                        <td>@if($logd->before){{str_replace('videos/','',$logd->before)}}@else none @endif</td>
                        <td>{{str_replace('videos/','',$logd->after)}}</td>
                        </tr>
                        @endif
                         @if ($logd->object == 'Detail')
                        <tr>
                        <td>{{$logd->created_at}}</td>
                        <td>{{$logd->nama_admin}}</td>
                        <td>{{$logd->tipe}}</td>
                        <td>{{$logd->action}}</td>
                        <td>{{$logd->object}}</td>
                        <td><a href="./showDet{{$logd->object_id}}">{{$logd->object_id}}</a></td>
                        <td>@if($logd->before)<button data-toggle="modal" data-target="#odModal" data-id="{{$logd->id}}" data-odsc="{{$logd->before}}">Before</button>@else none @endif</td>
                        <td><button data-toggle="modal" data-target="#dModal" data-id="{{$logd->id}}" data-dsc="{{$logd->after}}">After</button></td>
                        </tr>
                        @endif
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