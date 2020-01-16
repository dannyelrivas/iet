<div class="row">
	<div class="col-md-6">
		<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
		<script>
          jsQR(...);
        </script>
		  	<div id="loadingMessage">🎥 No se puede acceder a la transmisión de video (asegúrese de tener una cámara web habilitada)</div>
		  	<canvas id="canvas" hidden></canvas>
		  	<div id="output" hidden>
		    	<div id="outputMessage">No se detecta codigo QR.</div>
		    	<div hidden><b>QR:</b> <span id="outputData"></span></div>
		  	</div>
		  	<script>
			    var video = document.createElement("video");
			    var canvasElement = document.getElementById("canvas");
			    var canvas = canvasElement.getContext("2d");
			    var loadingMessage = document.getElementById("loadingMessage");
			    var outputContainer = document.getElementById("output");
			    var outputMessage = document.getElementById("outputMessage");
			    var outputData = document.getElementById("outputData");

			    function drawLine(begin, end, color) {
			      canvas.beginPath();
			      canvas.moveTo(begin.x, begin.y);
			      canvas.lineTo(end.x, end.y);
			      canvas.lineWidth = 4;
			      canvas.strokeStyle = color;
			      canvas.stroke();
			    }

			    // Use facingMode: environment to attemt to get the front camera on phones
			    navigator.mediaDevices.getUserMedia({ video: { facingMode: "environment" } }).then(function(stream) {
			      video.srcObject = stream;
			      video.setAttribute("playsinline", true); // required to tell iOS safari we don't want fullscreen
			      video.play();
			      requestAnimationFrame(tick);
			    });

			    function tick() {
			      loadingMessage.innerText = "⌛ Cargando video..."
			      if (video.readyState === video.HAVE_ENOUGH_DATA) {
			        loadingMessage.hidden = true;
			        canvasElement.hidden = false;
			        outputContainer.hidden = false;

			        canvasElement.height = video.videoHeight;
			        canvasElement.width = video.videoWidth;
			        canvas.drawImage(video, 0, 0, canvasElement.width, canvasElement.height);
			        var imageData = canvas.getImageData(0, 0, canvasElement.width, canvasElement.height);
			        var code = jsQR(imageData.data, imageData.width, imageData.height, {
			          inversionAttempts: "dontInvert",
			        });
			        if (code) {
			          drawLine(code.location.topLeftCorner, code.location.topRightCorner, "#FF3B58");
			          drawLine(code.location.topRightCorner, code.location.bottomRightCorner, "#FF3B58");
			          drawLine(code.location.bottomRightCorner, code.location.bottomLeftCorner, "#FF3B58");
			          drawLine(code.location.bottomLeftCorner, code.location.topLeftCorner, "#FF3B58");
			          outputMessage.hidden = true;
			          outputData.parentElement.hidden = false;
			          outputData.innerText = code.data;

			          video.pause();
					  video.src="";

			          //var WDIR = 'licipsa/'; //Local Bonilla
			          //var WDIR = 'iet/index.php/'; //local Rivas
			          var WDIR = ''; //Vacio para PROD
    				  var WROOT = location.protocol+'//'+document.location.hostname+'/' + WDIR;

			          $.ajax({
			                url: WROOT +'salidas/nueva',
			                type: 'POST',
			                data: { 'qr' : code.data }
			           }).done(function(data, textStatus, jqXHR){

			           	var salida = JSON.parse(data);

			           	if(salida === "Ya existe una salida para ese alumno.")
			           	{
			           		alert(salida);
			           		location.reload();
			           	}
			           	else
			           	{
			           		alert("Se creó la salida para el alumno: " + salida.alumno.nombre + " " + salida.alumno.apaterno + " " + salida.alumno.amaterno);
			           		location.reload();
			           	}

			           }).fail(function(jqXHR, textStatus, error){
			            console.log("Entro al fail");
			            alert("Sucedió un error. Intente de nuevo.");
			           });
			          
			        } else {
			          outputMessage.hidden = false;
			          outputData.parentElement.hidden = true;
			        }
			      }
			      requestAnimationFrame(tick);
			    }
		  	</script>
	</div>
</div>