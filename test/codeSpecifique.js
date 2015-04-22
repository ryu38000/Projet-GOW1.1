
//Test Oracle recorder
var zeRecorder = new OracleRecorder() ;
	//Test Timer
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
			$('#countdown').html("On recommence ?");
		}
	}

	var monChrono = new MyTimer(renders, 5, finChrono, 3, pressurise);


function mikeError(){
	window.alert('Mais tu vas le partager ton micro ?!!');
}

function startRecording(){
	$("#image").attr("src", "stop.png");
	$("#rec_stop").unbind("click");
	$("#rec_stop").click(zeRecorder.stopRecording);
	if(!monChrono.isRunning()){
		monChrono.start();
	}
}

function stopRecording(url, bob){
	$("#audio").attr("src", url);
	$("#image").attr("src", "record.png");
	$("#rec_stop").unbind("click");
	$("#rec_stop").click(zeRecorder.startRecording);
	$("#blob").html("<p>"+URL.createObjectURL(bob) +"</p><p>Size: " + bob.size + "<br />Type: "+bob.type+"</p>");
}

zeRecorder.onMikeError(mikeError);
zeRecorder.onStart(startRecording);
zeRecorder.onStop(stopRecording);

function init(){
	$("#rec_stop").click(zeRecorder.startRecording);
}

window.onload=init;