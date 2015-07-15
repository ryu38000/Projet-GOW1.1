
//Initialisation du chrono
function renders(minutes, seconds){
	if(seconds == Math.floor(seconds)){
		if (seconds < 10){
			seconds = "0" + seconds;  
		}
		$('#countdown').html(minutes + ":" + seconds);
	}
}
function pressurise(){
	$('#countdown').css('background-color', '#'+(Math.random()*0xFFFFFF<<0).toString(16));
}

function finChrono(){
	zeRecorder.stopRecording();
	if(!monChrono.isRunning()){
		$('#countdown').css('background-color', 'white');
		$('#countdown').html("Buzz Buzz");
	}
}





//Bouton Rec qui clignote					   
function FaireClignoterImage (){ 
     $( "#rec1" ).fadeTo( "fast", 0, function() {
     	$( "#rec1" ).fadeTo( "fast" , 1, function() {
	  	});
  	});
} 

// au moment de l'appel à la méthode getUserMedia
var recorder, recordVideo;
var recButton;


var record = document.getElementById('record'); //Bouton d'enregistrement
var valid = document.getElementById('valid'); //Bouton pour valider
var restartRecord = document.getElementById('restart'); //Bouton pour recommencer l'enregistrement
var audio = document.querySelector('audio');
var recordAudio = document.getElementById('record-audio');
// var recordVideo = document.getElementById('record-video');
var preview = document.getElementById('preview'); //emplacement de l'enregistrement
var container = document.getElementById('container');

var recordIsOn;
var audioStream;
var fileName;	



$("#secondPage").hide();
$("#thirdPage").hide();



//Test Oracle recorder

var zeRecorder = new OracleRecorder() ;

function mikeError(){
	var redirect = "index.php";
	popUp(redirect);
	
}


function startRecording(){
	$("#firstPage").hide("slow");
	$("#secondPage").show("slow");
	if(!monChrono.isRunning()){
		monChrono.start();
	}	
	$(document).ready(function(){ 
    setInterval('FaireClignoterImage()',800); 
	});
}


function stopRecording(url, bob){
	$("#secondPage").hide("slow");
	$("#thirdPage").show("slow");
	if(monChrono.isRunning()){
		window.clearTimeout(monChrono.timer);

	}
	$("#form-cmd").hide("slow");
}



zeRecorder.onMikeError(mikeError);
zeRecorder.onStart(startRecording);
zeRecorder.onStop(stopRecording);

$("#record").click(zeRecorder.startRecording);
$("#valid").click(zeRecorder.stopRecording);
$("#restart").click(zeRecorder.startRecording);
