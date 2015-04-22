navigator.getUserMedia = (navigator.getUserMedia || navigator.webkitGetUserMedia || navigator.mozGetUserMedia || navigator.msGetUserMedia);

function OracleRecorder(recordRTCOptions){
	//Constructor of a recorder that requires RecordRTC and recordRTCOptions which are mono 44,1kHz by default

	if(typeof recordRTCOptions == "undefined"){
		recordRTCOptions = {type: 'audio',
							bufferSize: 16384,
							sampleRate: 44100,
							leftChannel: false,
							disableLogs: true};
	}
	this.recordRTCOptions = recordRTCOptions ;
	this.startRecordingSuccess = function(){alert('zer');};
	this.mikeError = function(){alert('zer');};
	this.stopRecordingSuccess = function(audioURL, recBlob){alert('zer');};
	this.recorder = false ;
	this.stream = false ;

	var self = this ;

//events
	this.onStart = function(callback){
		//a function with no parameters that's executed when recording succesfully starts
		self.startRecordingSuccess = callback ;
	};

	this.onStop = function(callback){
		//a function (that takes the url of the audio and (optionnally) the blob of the recording) which is executed when recording succesfully stops
		self.stopRecordingSuccess = callback ;
	};

	this.onMikeError = function(callback){
		//a fuction called, when the microphone is not shared
		self.mikeError = callback ;
	};

//actual processes
	this.startRecording = function(){
		if(self.stream !== false){
			self.startRecordingSuccess();
			self.recorder.startRecording();
		}
		else{
			self.stream = navigator.getUserMedia({video: false, audio: true},
				function(stream){
					if(window.isChrome){
						stream = new window.MediaStream(stream.getAudioTracks());
					}
					self.recorder = RecordRTC(stream, self.recordRTCOptions);
					self.startRecordingSuccess();
					self.recorder.startRecording();
				},
				self.mikeError);
		}
	};

	this.stopRecording = function(){
		self.recorder.stopRecording(function(audioURL){
			self.stopRecordingSuccess(audioURL, self.recorder.getBlob());
		});
	};
}