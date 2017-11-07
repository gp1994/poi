@section('content')
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>Point Of Interest</title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <link href="http://localhost/poi/public/BSDat/assets/css/bootstrap.css" rel="stylesheet" />
    <link href="http://localhost/poi/public/BSDat/assets/css/fresh-bootstrap-table.css" rel="stylesheet" />
    <link href="http://localhost/poi/public/BSDash/assets/css/material-dashboard.css?v=1.2.0" rel="stylesheet" />
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300|Material+Icons' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="http://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">  
     
</head>
<body>
  <div id="editPoiModal" class="modal fade">
      <div class="modal-dialog modal-sm">
        <div class="modal-content">
          <div class="modal-header" style="color:#0000FF">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
              Edit <span id="namaloc"></span>
                </div>
                  <div class="modal-body" style="color:#0000FF">
                    <form method="POST" action="./editloc" id="editloc">
                      <input name="_token" type="hidden" value="{{ csrf_token() }}">
                      <input id="idlo" type="hidden" name="idloc">
                      Nama:<br>
                      <input id="namainput" type="text" name="editednama" required><br>
                      Longitude:<br>
                      <input id="longinput" type="number" step ="0.0000001" min ="-180" max ="180" name="editedlong" required><br>
                      Latitude:<br>
                      <input id="latinput" type="number" step ="0.0000001" min ="-180" max ="180." name="editedlat" required><br><br>
                      <input type="submit" value="Save" />
                    </form>
                  </div>
                </div>
              </div>
            </div>
    </div>
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
                    <li class="active">
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
                </ul>
            </div>
        </div>

        <div class="main-panel">
          <nav class="navbar navbar-transparent navbar-absolute">
                <div class="container-fluid">
                    <div class="navbar-header">
                        <div class="navbar-brand"> Datatable Utama </div>
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
<div id="addLocModal" class="modal fade">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header" style="color:#0000FF">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
          Add Loc<span id="namaloc"></span>
      </div>
      <div class="modal-body" style="color:#0000FF">
         <form method="POST" action="./storeloc" id="stloc">
            <input name="_token" type="hidden" value="{{ csrf_token() }}">
            <input id="idlo" type="hidden" name="idlocs">
            Nama:<br>
            <input id="ninput" type="text" name="newnama" required><br>
            Longitude:<br>
            <input id="linput" type="number" step ="0.0000001" min ="-180" max ="180" name="newlong" required><br>
            Latitude:<br>
            <input id="lainput" type="number" step ="0.0000001" min ="-180" max ="180" name="newlat" required><br><br>
            <input type="submit" value="Save" />
        </form>
      </div>
    </div>
  </div>
</div>  

    <div class="fresh-table full-color-orange full-screen-table">        
    <button id="addLocButton" data-toggle="modal" data-target="#addLocModal" style="position:relative;left:29px;top:70px;">Add Loc</button>       
        <table id="fresh-table" class="table">
            <thead>
            <tr>
                <th>Nama</th>
                <th>Longitude</th>
                <th>Latitude</th>
                <th></th>
            </tr>
        </thead>
            <tbody>
                @if (count($locs))
        @foreach($locs as $loc)    
            <tr>
                <td>{{$loc->lokasi}}</td>
                <td>{{$loc->longitude}}</td>
                <td>{{$loc->latitude}}</td>
                <td>
                 <div class="col-md-3">          
            <button id="editpoibutton" data-toggle="modal" data-target="#editPoiModal"
            data-id="{{$loc->id}}" data-nama="{{$loc->lokasi}}" data-longitude="{{$loc->longitude}}" data-latitude="{{$loc->latitude}}" style="color:#0000FF">Edit</button>
              </div>     
              </td>
            </tr>
            @endforeach
        @endif
          </tbody>
        </table> 
</div>
</div>  

</body>

 <script type="text/javascript" src="http://localhost/poi/public/BSDat/assets/js/jquery-1.11.2.min.js"></script>
    <script type="text/javascript" src="http://localhost/poi/public/BSDat/assets/js/bootstrap.js"></script>
    <script type="text/javascript" src="http://localhost/poi/public/BSDat/assets/js/bootstrap-table.js"></script>
        
    <script type="text/javascript">
        var $table = $('#fresh-table'), 
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
                height: table_height,
                pageSize: 10,
                pageList: [5,10,50],
                
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
    <script>
        $(function() {
            $('#editPoiModal').on('show.bs.modal', function (e) {
                var button = $(e.relatedTarget);
                var idloc = button.data('id');
                var namaloc = button.data('nama');
                var long = button.data('longitude');
                var lat = button.data('latitude');
                $('.modal-body #idlo').val(idloc);
                $('.modal-body #namainput').val(namaloc);
                $('.modal-body #longinput').val(long);
                $('.modal-body #latinput').val(lat);       
                $('#namaloc').html($(e.relatedTarget).data('nama'));
                $('#long').html($(e.relatedTarget).data('longitude'));
                $('#lat').html($(e.relatedTarget).data('latitude'));
            });
        });
    </script>
    <script>
      $(function() {
        $('#addLocModal').on('show.bs.modal', function (e) {
          var button = $(e.relatedTarget);
          $('#namaloc').html($(e.relatedTarget).data('nama'));
        });
      });
    </script>
    
<!--  Charts Plugin -->
<script src="http://localhost/poi/public/BSDash/assets/js/chartist.min.js"></script>
<!--  Dynamic Elements plugin -->
<script src="http://localhost/poi/public/BSDash/assets/js/arrive.min.js"></script>
<!--  PerfectScrollbar Library -->
<script src="http://localhost/poi/public/BSDash/assets/js/perfect-scrollbar.jquery.min.js"></script>
<!--  Notifications Plugin    -->
<script src="http://localhost/poi/public/BSDash/assets/js/bootstrap-notify.js"></script>
<!--  Google Maps Plugin    -->
<script src="http://maps.google.com/maps/api/js?key=AIzaSyC5BGMy8w4z0CZm022t08c5mLhOjslHJZQ"></script>
<!-- Material Dashboard javascript methods -->
<script src="http://localhost/poi/public/BSDash/assets/js/material-dashboard.js?v=1.2.0"></script>
</html>