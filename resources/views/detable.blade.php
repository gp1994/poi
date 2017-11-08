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
                    <li>
                        <a href="./datatable">
                            <i class="material-icons">content_paste</i>
                            <p>Datatable Utama</p>
                        </a>
                    </li>
                    <li  class="active">
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
                        <div class="navbar-brand"> Datatable Detail </div>
                    </div>
                    <div class="collapse navbar-collapse">
                        <ul class="nav navbar-nav navbar-right">
                        <li> @if ( Request::session()->has('usrn') )
                        <div id="sess" style ="position:relative;top:15px">
                        Welcome {{session('usrn')}}! Click here to <a href="./logout3">Logout</a> </div><br> 
                        @else
                        <a class="btn big-login" data-toggle="modal" href="javascript:void(0)" style ="position:relative;left:-10px"onclick="openLoginModal();">Login</a>
                        @endif
                        </li>
                        </ul>
                    </div>
                </div>
            </nav>
    <div class="fresh-table full-color-orange full-screen-table">          
        <button id="addDetButton" data-toggle="modal" data-target="#addDetModal" style="position:relative;left:29px;top:70px;">Add Det</button>     
        <table id="fresh-table" class="table">
            <thead>
            <tr>
                <th>ID</th>
                <th>Detail</th>
                <th>Gambar</th>
                <th></th>
            </tr>
        </thead>
            <tbody>
                @if (count($dets))
        @foreach($dets as $detail)    
            <tr>
              <td>{{$detail->id}}</td>
              <td>{{$detail->keterangan}}</td>
              <td><img src="{{$detail->image}}" width="400" height="200"/></td>
              <td>
                <div class="col-md-3">          
                  <button id="editpoibutton" data-toggle="modal" data-target="#editPoiModal" data-id="{{$detail->id}}" data-desc="{{$detail->keterangan}}" data-img="{{$detail->image}}" style="color:#0000FF">Edit Detail</button>
                </div>   
              </div>    
                </td>
            </tr>
          @endforeach
        @endif
          </tbody>
    </table>
    <div id="editPoiModal" class="modal fade">
                <div class="modal-dialog modal-lg">
                  <div class="modal-content">
                  <!-- Script modal load -->
                  
                  <!-- DIV Modal Edit Term -->
                  <div class="modal-header" style="color:#0000FF">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    Edit <span id="namadet"></span>
                  </div>
                    <div class="modal-body" style="color:#0000FF">
                     <form method="POST" action="./editdet" enctype="multipart/form-data" id="editdt">
                      <input name="_token" type="hidden" value="{{ csrf_token() }}">
                      <input id="idds" type="hidden" name="iddts">
                      Detail:<br>
                      <textarea id="detinput"  name="editeddet" style="width:870px;height:270px;" cols="40" rows="100" required></textarea><br>
                      Image: (Upload Image)<br>
                      <input id="iminput" type="file" name="editedim" onchange="$('#pik').val($(this).val());">
                      <input id="pik" name="edtim" size ="40" type="text" readonly>
                      <br><br>
                      <input type="submit" value="Save" />
                      </form>
                    </div>
                  </div>
                </div>
              </div>
     
  <!-- DIV Modal Add Term 1-->
  <div id="addDetModal" class="modal fade">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
    <!-- Script modal load -->
    
    <!-- DIV Modal Add Term 2-->
      <div class="modal-header" style="color:#0000FF">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
          Add Detail<span id="namadet"></span>
      </div>
      <div class="modal-body" style="color:#0000FF">
         <form method="POST" action="./storedet" enctype="multipart/form-data" id="strdt">
            <input name="_token" type="hidden" value="{{ csrf_token() }}">
            <input id="iddt" type="hidden" name="iddsc">
            Detail:<br>
            <textarea id="dinput" name="newdet" style="width:870px;height:270px;" cols="40" rows="100" required></textarea><br>
            Image: (Upload Image)<br>
            <input id="iinput" type="file" name="newim" required><br><br>
            <input type="submit" value="Save" />
        </form>
      </div>
    </div>
  </div>
</div>
</div>
</div>
</body>
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
        $('#addDetModal').on('show.bs.modal', function (e) {
          var button = $(e.relatedTarget);
        });
      });
    </script>
    <script>
        $(function() {
            $('#editPoiModal').on('show.bs.modal', function (e) {
                var button = $(e.relatedTarget);
                var iddc = button.data('id');
                var dsc = button.data('desc');
                var im = button.data('img');
                $('.modal-body #idds').val(iddc);
                $('.modal-body #detinput').val(dsc);    
                $('.modal-body #pik').val(im);   
                $('#dsc').html($(e.relatedTarget).data('desc'));
                $('#im').html($(e.relatedTarget).data('im'));
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