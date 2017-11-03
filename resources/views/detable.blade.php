@section('content')
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <link rel="icon" type="image/png" href="http://localhost/public/poi/BSDat/assets/img/favicon.ico">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  
  <title>Point of Interest</title>

  <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" name="viewport" />
    
    <link href="http://localhost/poi/public/BSDat/assets/css/bootstrap.css" rel="stylesheet" />
    <link href="http://localhost/poi/public/BSDat/assets/css/fresh-bootstrap-table.css" rel="stylesheet" />

    <!--     Fonts and icons     -->
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300' rel='stylesheet' type='text/css'>
        
</head>
<body>

<div class="wrapper">
    <div class="fresh-table full-color-orange full-screen-table">        
        <a href = "./" style="color:white;position:relative;top:50px;">Back to Home</a>  
        <button id="addDetButton" data-toggle="modal" data-target="#addDetModal" style="position:relative;top:50px;">Add Det</button>     
        <table id="fresh-table" class="table">
            <thead>
            <tr>
                <th>Detail</th>
                <th>Gambar</th>
                <th></th>
            </tr>
        </thead>
            <tbody>
                @if (count($dets))
        @foreach($dets as $detail)    
            <tr>
                <td>{{$detail->keterangan}}</td>
                <td>{{$detail->image}}</td>
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
                     <form method="POST" action="./editdet" id="editdt">
                      <input name="_token" type="hidden" value="{{ csrf_token() }}">
                      <input id="idds" type="hidden" name="iddts">
                      Detail:<br>
                      <textarea id="detinput"  name="editeddet" style="width:870px;height:270px;" cols="40" rows="100" required></textarea><br>
                      Image: (Insert Link)<br>
                      <input id="iminput" type="text" size ="40" name="editedim" required><br><br>
                      <input type="submit" value="Save" />
                      </form>
                    </div>
                  </div>
                </div>
              </div>
      <div class="col-md-1">
    
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
         <form method="POST" action="./storedet" id="strdt">
            <input name="_token" type="hidden" value="{{ csrf_token() }}">
            <input id="iddt" type="hidden" name="iddsc">
            Detail:<br>
            <textarea id="dinput" name="newdet" style="width:870px;height:270px;" cols="40" rows="100" required></textarea><br>
            Image: (Insert Link)<br>
            <input id="iinput" type="text" size ="40" name="newim" required><br><br>
            <input type="submit" value="Save" />
        </form>
      </div>
    </div>
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
                pageList: [10,25,50],
                
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
                var img = button.data('img');
                $('.modal-body #idds').val(iddc);
                $('.modal-body #detinput').val(dsc);
                $('.modal-body #iminput').val(img);      
                $('#dsc').html($(e.relatedTarget).data('desc'));
                $('#img').html($(e.relatedTarget).data('img'));
            });
        });
    </script>
</html>