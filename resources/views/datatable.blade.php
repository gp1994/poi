

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
    <a href = "./" style="color:white;position:relative;top:50px">Back to Home</a>
    <button id="addLocButton" data-toggle="modal" data-target="#addLocModal" style="position:relative;top:50px;">Add Loc</button>       
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
<div id="editPoiModal" class="modal fade">
                <div class="modal-dialog modal-sm">
                  <div class="modal-content">
                  <!-- Script modal load -->
                  
                  <!-- DIV Modal Edit Term -->
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
  <!-- DIV Modal Add Term 1-->
  <div id="addLocModal" class="modal fade">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
    <!-- Script modal load -->
    
    <!-- DIV Modal Add Term 2-->
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

</html>