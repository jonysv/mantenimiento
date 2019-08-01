
<!DOCTYPE html>
<html>
<head>
	<title>Rutas</title>
	<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="bootstrap/css/daterangepicker.css">
  <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap-timepicker.css">
	<!-- <link rel="stylesheet" type="text/css" href="https://getbootstrap.scom/docs/4.0/examples/floating-labels/floating-labels.css"> -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">

  
</head>
<body>
  <div class="container ">
    <div class="row">
      <div class="col-sm-4">
        
        <h1>Ruta: Habitacional</h1>
      </div>
      <div class="col-sm-3"></div>
      <div class="col-sm-5">
        <h1>Fecha: dia/mes/año</h1>
      </div>
    </div>

      <br>
      <br>
      <br>
      <div class="row">
        
      <div class="col-sm-3">

        <table class="table table-striped table-bordered">
  <thead class="bg-primary">
    <tr class="">
      <th scope="col"->Ruta</th>
      <th scope="col"->N Vueltas</th>
    </tr>
  </thead>
  <tbody>
    <tr class="table-primary">
      <th scope="row">Arboledas</th>
      <td></td>
    </tr>
    <tr class="table-primary">
     <th scope="row">Felipe Angeles</th>
      <td></td>
    </tr>
    <tr class="table-primary">
      <th scope="row">Paxtepec</th>
      <td></td>
    </tr>
    <tr class="table-primary">
      <th scope="row">Residencial</th>
      <td></td>
    </tr>
  </tbody>
</table>
      </div>
      <div class="col-sm-1"></div>
      <div class="col-sm-4">
        <div id="map" style="width: 400px; height: 250px;"></div>
      </div>
      <div class="col-sm-4"></div>
      </div>
      <div class="row">
        <div class="col-sm-1">
          
        <img src="img/taller.png" style="width: 100px;height: 100px">
        <h3>Taller</h3>
        </div>
        <div class="col-sm-1"></div>
        <!-- &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; -->
         <div class="col-sm-1">
          
        <img src="img/siniestro.png" style="width: 100px;height: 100px;">
        <h3>Siniestro</h3>
        </div>
        <div class="col-1"></div>
        <div class="col-sm-3" >
          <div style="text-align: center;">
          <h3>Cronometro</h3>
          <h3>Hora/Minuto/Seg</h3>
          <h3>16:33:30</h3>
          </div>
        </div>
        <div class="col-sm-2"></div>
        <div class="col-sm-3">
          <h3>Puntos con demora</h3>
          <h3>1.</h3>
          <h3>2.</h3>
          <h3>3.</h3>
          <hr style="border-top: 3px solid;" />
        
          
        </div>
      </div>
  </div>

 
</body>





<script src="bootstrap/js/jquery.min.js" type="text/javascript" ></script>
<script src="bootstrap/js/bootstrap.min.js" type="text/javascript" ></script>
<script src="bootstrap/js/moment.min.js" type="text/javascript" ></script>
<script src="bootstrap/js/daterangepicker.js" type="text/javascript" ></script>
<script src="bootstrap/js/bootstrap-timepicker.min.js" type="text/javascript" ></script>
 <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyATNonS7xnQ78lldce-oOg8NT-f8ygjz8w&callback=initMap"
    async defer></script>
<script type="text/javascript">
   var map;
        var marker;
      function initMap() {
        var myLatlng = {lat: 13.9838314819563, lng: -89.55546950746032};

        map = new google.maps.Map(document.getElementById('map'), {
          zoom: 10,
          center: myLatlng
        });

        marker = new google.maps.Marker({
          position: myLatlng,
          map: map,
          title: 'Click to zoom'
        });

        map.addListener('center_changed', function() {
         
        });

        map.addListener('click', function(x,y) {


            $("#latitud").val(x.latLng.lat);
            $("#longitud").val(x.latLng.lng);
            var Ubicacion=$("#latitud").val()
            Ubicacion+=",";
            Ubicacion+=$("#longitud").val()
            $("#pos").val(Ubicacion);
            marker.setPosition(x.latLng);
        });
      }

   $(document).ready(function () {
    
  
            
             

        });

</script>
</html>
