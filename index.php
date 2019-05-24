
<!DOCTYPE html>
<html>
<head>
	<title>Rutas</title>
	<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="bootstrap/css/daterangepicker.css">
  <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap-timepicker.css">
	<link rel="stylesheet" type="text/css" href="https://getbootstrap.com/docs/4.0/examples/floating-labels/floating-labels.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
  <style type="text/css">
  #mecanico{
    display: none;
  }
  #form{
    display: none;
  }

    
  </style>
 
  
</head>
<body>
	<div class="jumbotron" id="main">
		
 <div class="form-signin border border-primary rounded" >
      
       <div class="text-center mb-12">
    <button type="button" class="btn btn-primary" id="" onclick="mecanico();">Mecanico</button>
    <button type="button" class="btn btn-primary" id="" onclick="">Electrico</button>
    <button type="button" class="btn btn-primary" id="" onclick="">Muelles</button>

      </div>
      <br>
      <div  id="mecanico">
        
       <div class="text-center mb-12">
    <button type="button" class="btn btn-primary" id="" onclick="delanteras();">Balatas delanteras</button>
    <hr>
      </div>
      <div class="text-center mb-12">

    <button type="button" class="btn btn-primary" id="" onclick="traseras();">Balatas traseras</button>
    <hr>
      </div>
      <div class="text-center mb-12">
    <button type="button" class="btn btn-primary" id="" onclick="Suspension();">Suspension</button>
    <hr>
      </div>

      </div>

    
 
    </div>

	</div>
  <div class="jumbotron" id="form">
    
 <form class="form-signin border border-primary rounded" id="balata" >
    
   <div class="text-center mb-6">
        <h1 class="h4 mb-3 font-weight-normal card-header" id="horario">Balata</h1>
      </div>
       <div class="text-center mb-6">
        <input type="text" class="form-control" placeholder="Fecha" id="fecha">
      </div>
      <div class="text-center mb-6">
      
 
        <input type="text" class="form-control" placeholder="Hora" id="hora">
      </div>

      <div class="text-center mb-6">
    
    <select class="form-control" id="tipo">
        <option value="1">Ajuste</option>
        <option value="2">Cambio</option>
      </select>
      </div>

      <div class="text-center mb-6">
    
    <select class="form-control" id="parte">
        <option value="1">Delanteras</option>
        <option value="2">Traseras</option>
        <option value="3">Todas</option>
      </select>
      </div>
 
 <div class="text-center mb-6">
    
    <select class="form-control" id="marca">
        <option value="1">Frieck</option>
        <option value="2">Generica</option>
      </select>
      </div>
      <br>
    <button type="button" class="btn btn-primary"  onclick="guardarRegistro();">Guardar</button>
    </form>

  </div>
</body>
<script src="bootstrap/js/jquery.min.js" type="text/javascript" ></script>
<script src="bootstrap/js/bootstrap.min.js" type="text/javascript" ></script>
<script src="bootstrap/js/moment.min.js" type="text/javascript" ></script>
<script src="bootstrap/js/daterangepicker.js" type="text/javascript" ></script>
<script src="bootstrap/js/bootstrap-timepicker.min.js" type="text/javascript" ></script>
<script type="text/javascript">

   $(document).ready(function () {
     $('#fecha').daterangepicker({
    locale: {
            format: 'DD/MM/YYYY'
        },
    singleDatePicker: true,
    showDropdowns: true,
    minYear: 1901,

  })
      var f=new Date();
      cad=f.getHours()+":"+f.getMinutes()+":"+f.getSeconds(); 
       $('#hora').timepicker({
    interval: 60,
    minTime: '10',
    maxTime: '6:00pm',
    defaultTime: cad,
    minuteStep:1,
    scrollbar: true
});

  
            
             

        });
   function mecanico(){
    $("#mecanico").css("display","block");
   }
   function delanteras(){
    $("#main").css("display","none");
    $("#form").css("display","block");
    $("#opcion").val(1);


   }
   function traseras(){
    $("#main").css("display","none");
    $("#form").css("display","block");    
    $("#opcion").val(2);
   }
   function Suspension(){
    $("#main").css("display","none");
    $("#form").css("display","block");
    $("#opcion").val(3);
   }
   function guardarRegistro() {
    alert($("#balata")[0]);
            var formData = new FormData();
            formData.append("op", 1);
            formData.append("fecha", $("#fecha").val());
            formData.append("hora", $("#hora").val());
            formData.append("tipo", $("#tipo").val());
            formData.append("parte", $("#parte").val());
            formData.append("marca", $("#marca").val());
            $.ajax({
                dataType: "json",
                url: "guardarRegistro.php",
                type: "POST",
                async: false,
                cache: false,
                processData: false,
                contentType: false,
                data: formData,
                success: function(data) {
                    if (data.status == "fail") {
                        mostrarMensaje("Error", data.msg);
                        console.log(data.msg);
                        console.log("error");
                    } else {
                      alert("success")
                    }
                },
                error: function(s) {
                  alert("error")
                }
            });
    }

</script>
</html>
