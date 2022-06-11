(function () {
  if (
    !"mediaDevices" in navigator ||
    !"getUserMedia" in navigator.mediaDevices
  ) {
    alert("Camera API is not available in your browser");
    return;
  }

  // get page elements
  const video = document.querySelector("#video");
  const btnPlay = document.querySelector("#btnPlay");
  const Salvar = document.querySelector("#btnScreenshot");
  const btnPause = document.querySelector("#btnPause");
  const btnScreenshot = document.querySelector("#btnScreenshot");
  const btnChangeCamera = document.querySelector("#btnChangeCamera");
  const screenshotsContainer = document.querySelector("#screenshots");
  const canvas = document.querySelector("#canvas");
  const devicesSelect = document.querySelector("#devicesSelect");

  // video constraints
  const constraints = {
    video: {
      width: {
        min: 1280,
        ideal: 1920,
        max: 2560,
      },
      height: {
        min: 720,
        ideal: 1080,
        max: 1440,
      },
    },
  };

  // use front face camera
  let useFrontCamera = true;

  // current video stream
  let videoStream;

  // handle events
  // play
  btnPlay.addEventListener("click", function () {
    video.play();
    btnPlay.classList.add("is-hidden");
    btnPause.classList.remove("is-hidden");
  });
  
  
	$('.validate').keyup(function() {
		console.log("Mudou");
		if($("#nome").val() != "" && $("#idt").val() != ""){
			Salvar.disabled = false;
		}else{
			Salvar.disabled = true;
		}
    });
	
	$('#cpf').keyup(function() {
		$(this).val(this.value.replace(/\D/g, ''));
    });
  

  // pause
  btnPause.addEventListener("click", function () {
    video.pause();
    btnPause.classList.add("is-hidden");
    btnPlay.classList.remove("is-hidden");
  });

  // take screenshot
  btnScreenshot.addEventListener("click", function () {
    const img = document.createElement("img");
    
	
	// Redimensionamento da imagem
	width = video.videoWidth,
	height = video.videoHeight;
	tamanho = 600;
		if (width > height) {
			if (width > tamanho) {
				height *= tamanho / width;
				width = tamanho;
			}
		} else {
			if (height > tamanho) {
				width *= tamanho / height;
				height = tamanho;
			}
		}
	canvas.width = width;
    canvas.height = height;
    canvas.getContext("2d").drawImage(video, 0, 0, width, height);
	
    img.src = canvas.toDataURL("image/png");
	// Conteudo da Imagem
	console.log(img);
	var dados = { 
		imagem: img.src, 
		metodo: "foto",
		nome:$("#nome").val(),
		obs:$("#obs").val(),
		cpf:$("#cpf").val(),
		om:$("#om").val(),
		destino:$("#destino").val(),
		placa:$("#placa").val()
	}
	$.post('database.php', dados, function(retorno) {

		setTimeout(function () {
			// Passa para a próxima imagem
			window.location.reload(true);
		}, 1000);
	console.log(retorno);
	});
	screenshotsContainer.prepend(img);
	
    // screenshotsContainer.prepend(img);
  });

  // switch camera
  btnChangeCamera.addEventListener("click", function () {
    useFrontCamera = !useFrontCamera;

    initializeCamera();
  });

  // stop video stream
  function stopVideoStream() {
    if (videoStream) {
      videoStream.getTracks().forEach((track) => {
        track.stop();
      });
    }
  }

  // initialize
  async function initializeCamera() {
    stopVideoStream();
    constraints.video.facingMode = useFrontCamera ? "user" : "environment";

    try {
      videoStream = await navigator.mediaDevices.getUserMedia(constraints);
      video.srcObject = videoStream;
    } catch (err) {
      alert("Could not access the camera");
    }
  }
  


  initializeCamera();
})();

