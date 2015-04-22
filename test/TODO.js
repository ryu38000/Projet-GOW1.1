
if (remainingSeconds < 10){
	remainingSeconds = "0" + remainingSeconds;  
}
document.getElementById('countdown').innerHTML = minutes + ":" + remainingSeconds;
$(".audioDemo").trigger('play');
			document.getElementById('countdown').innerHTML = "Trop Tard !";
		saveFile();
		$("#secondPage").hide("slow");
			$("#thirdPage").show("slow");

//TODO var seconds = 15; → display

function renders(minutes, seconds){
	if(seconds == Math.floor(seconds)){
		if (seconds < 10){
			seconds = "0" + seconds;  
		}
		$('#countdown').html(minutes + ":" + seconds);
	}
}

function finChrono(){
	window.alert('terminé ta mère')
}

var monChrono = new myTimer('#countdown', renders, 15, finChrono, 5);

$('#countdown').click(monChrono.start);


/*************************************
*************************************
**************************************/
// au moment de l'appel à la méthode getUserMedia
var recorder, recordVideo;
var record = document.getElementById('record');
var valid = document.getElementById('valid');
var restartRecord = document.getElementById('restart');

var recButton;
var audio = document.querySelector('audio');

var recordAudio = document.getElementById('record-audio');
// var recordVideo = document.getElementById('record-video');
var preview = document.getElementById('preview');

var container = document.getElementById('container');
var countdownTimer;

var recordIsOn;
var audioStream;
var fileName;	



record.onclick = function() {
	
	record.disabled = true;
	
	if (!audioStream){
		navigator.getUserMedia({
			audio: true,
			video: false,
		},
		function(stream) {
            
            if (window.IsChrome){
				 stream = new window.MediaStream(stream.getAudioTracks());
            }
            
			if (stream.getAudioTracks().length === 0) {
					console.log('you have no webcam nore mic available on your device');
			}
			else {
				
				//webRTC
				audioStream = stream;
				
				recorder = window.RecordRTC(stream, {
					type:"audio",
					//leftChannel:'false',
				    onAudioProcessStarted: function() {
					document.getElementById("rec").style.visibility="visible";
					recButton = setInterval('hideRecButton()', 500);
					}
				});
				actionToDo(stream);
				//Gestion de la carte
				countdownTimer = setInterval('secondPassed()', 1000);
				$("#secondPage").show("slow");
				document.getElementById('card').innerHTML ="<table class=\"table table-hover\" style=\"text-align:center;\"><thead><tr><td title='<?php echo $lang["word_to_find"] ?>'><p><?php echo $this->res['mot']; ?><p></td></tr></thead>"+
										"<tbody style=\"background-color:#F8E1E8;\" title='<?php echo $lang["wordForbid"] ?>'>"+
										"<tr><td><p><img src='style/default.css/imgs/forbidden.png'></p><p><?php echo $this->res['tabou1'].'</p></br>'; ?></td></tr>"+
										"<tr><td><p><img src='style/default.css/imgs/forbidden.png'></p><p><?php echo $this->res['tabou2'].'</p></br>'; ?></td></tr>"+
										"<tr><td><p><img src='style/default.css/imgs/forbidden.png'></p><p><?php echo $this->res['tabou3'].'</p></br>'; ?></td></tr>"+
										"<tr><td><p><img src='style/default.css/imgs/forbidden.png'></p><p><?php echo $this->res['tabou4'].'</p></br>'; ?></td></tr>"+
										"<tr><td><p><img src='style/default.css/imgs/forbidden.png'></p><p><?php echo $this->res['tabou5'].'</p></br>'; ?></td></tr></tbody></table>";
										

			}
		},

		function(error){
			popUp();
		<!-- alert(error); -->    
		});
	}
	else{	
		actionToDo(stream);
		}
		
}

function actionToDo (stream){

	preview.src = URL.createObjectURL(stream);
	preview.muted = true;

	
	//~ recorder = RecordRTC(stream, {
//~ 
		   //~ onAudioProcessStarted: function() {
		   //~ document.getElementById("rec").style.visibility="visible";
		   //~ recButton = setInterval('hideRecButton()', 500);
//~ 
		//~ }
	//~ });

	recorder.startRecording();
	//stop.disabled = false;


	valid.onclick = function() {
		saveFile();
		clearInterval(countdownTimer);

	};
	
	restartRecord.onclick = function(){
		deleteAudioVideoFiles;
         actionToDo(audioStream);
		recorder.startRecording();

	};


}

function deleteAudioVideoFiles() {
	//deleteFiles.disabled = true;
	if (!fileName) return;
	var formData = new FormData();
	formData.append('delete-file', fileName);
	xhr('delete.php', formData, null, null, function(response) {
		console.log(response);
	});
	fileName = null;
	container.innerHTML = '';	
}



function saveFile(){
                document.getElementById('form-cmd').style.visibility="visible";
                //record.disabled = true;
                //stop.disabled = true;
                clearInterval(recButton);
                document.getElementById("rec").style.visibility="hidden";
                preview.src = '';

                fileName = 'oracle' + Math.round(Math.random() * 999999) + 1;


				recorder.stopRecording(function(url) {
					
					preview.src=url;
				   var fileReader = new FileReader();
				   fileReader.onload = function(event) {
					   var newBlob = new Blob([event.target.result], {type:"audio/ogg", endings:"native"});
					   //~ POST_using_XHR( newBlob );
					   PostBlob(newBlob, 'audio', fileName + ".ogg");

				   };
				   fileReader.readAsArrayBuffer(recorder.blob);
				});
}




// Enregistrement d'un fichiers audio .wav sur le serveur

// PostBlob method uses XHR2 and FormData to submit 
// recorded blob to the PHP server
function PostBlob(blob, fileType, fileName) {
	// FormData
	var formData = new FormData();
	formData.append(fileType + '-filename', fileName);
	formData.append(fileType + '-blob', blob);

	console.log(blob,"ici");

	// progress-bar
	var hr = document.createElement('hr');
	container.appendChild(hr);
	var strong = document.createElement('strong');
	strong.id = 'percentage';
	strong.innerHTML = fileType + ' oracleupload progress: ';
	container.appendChild(strong);
	var progress = document.createElement('progress');
	container.appendChild(progress); 


//Récupération des identifiants pour insertion dans la table enregistrement TODO passer dans le display
var userid = $("#userid").attr("data-userid");
var userlang = $("#userlang").attr("data-userlang");
var cardid = $("#cardid").attr("data-cardid");
var levelcard = $("#levelcard").attr("data-levelcard");

	// POST the Blob using XHR2
xhr('save.php?userid="'+userid+'"&userlang="'+userlang+'"&cardid="'+cardid+'"&levelcard="'+levelcard+'"', formData, progress, percentage, function(fileURL) {
		console.log("POST!!!");
		container.appendChild(document.createElement('hr'));

		var mediaElement = document.createElement(fileType);

		var source = document.createElement('source');
		var href = location.href.substr(0, location.href.lastIndexOf('/') + 1);
		source.src = href + fileURL;  //enregistrements/oracle9794261.mp3

   if (fileType == 'audio') source.type = 'audio/mp3';


		mediaElement.appendChild(source);
		mediaElement.muted = false;
		mediaElement.controls = true;
		container.appendChild(mediaElement);
		mediaElement.play();

		progress.parentNode.removeChild(progress);
		strong.parentNode.removeChild(strong);
		hr.parentNode.removeChild(hr);
	});
}



function xhr(url, data, progress, percentage, callback) {
	var request = new XMLHttpRequest();
	request.onreadystatechange = function() {
		if (request.readyState == 4 && request.status == 200) {
			callback(request.responseText);
		}
	};

	// TODO : si firefox alors addeventlistener ; si chrome alors onloadstart/progress/load

	
	if (url.indexOf('delete.php') == -1) {
		if(!isChrome){
			request.upload.addEventListener("loadstart", function() {	
			percentage.innerHTML = 'Upload started...';
			},false);
	
		     request.upload.addEventListener("progress", function(event){
                      progress.max = event.total;
                      progress.value = event.loaded;
                      percentage.innerHTML = 'Upload Progress ' + Math.round(event.loaded / event.total * 100) + "%"; },false);
	
	      request.upload.addEventListener("load",function(){
                      percentage.innerHTML = 'Saved!';
              },false);

		
		}
		else {
			request.upload.onloadstart = function() {
			percentage.innerHTML = 'Upload started...';
			};
			        request.upload.onprogress = function(event) {
        		        progress.max = event.total;
        		        progress.value = event.loaded;
               			 percentage.innerHTML = 'Upload Progress ' + Math.round(event.loaded / event.total * 100) + "%";
       				 };
			request.upload.onload = function() {
        	        percentage.innerHTML = 'Saved!';
	       		 };

		}
	
	}

	request.open('POST', url);
	request.send(data); 
}

//Test Oracle recorder

<button type="button" id='rec_stop'><img style="width:64px" id="image" src="http://www.polyrythmic.org/picts/REC.png"></button>

<audio id="audio" autoplay controls></audio>

var zeRecorder = new OracleRecorder() ;

function mikeError(){
	window.alert('Mais tu vas le partager ton micro ?!!');
}

function startRecording(){
	$("#image").attr("src", "http://www.veryicon.com/icon/png/System/Crystal%20Clear%20Actions/Player%20Stop.png");
	$("#rec_stop").unbind("click");
	$("#rec_stop").click(zeRecorder.stopRecording);
}

function stopRecording(url, bob){
	$("#audio").attr("src", url);
	$("#image").attr("src", "http://www.polyrythmic.org/picts/REC.png");
	$("#rec_stop").unbind("click");
	$("#rec_stop").click(zeRecorder.startRecording);
}

zeRecorder.onMikeError(mikeError);
zeRecorder.onStart(startRecording);
zeRecorder.onStop(stopRecording);
$("#rec_stop").click(zeRecorder.startRecording);