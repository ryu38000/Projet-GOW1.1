function MyTimer(render, duration, callback, pressure, pressuriser){
	//constructor of a timer, displayed in element selected by "timerSelector"
	//which calls "render(minutes, seconds)" every second
	//lasts "duration" (in seconds)
	//calls "callback" (with no parameters)
	//if "pressure" is a number, it will add pressure to the user during the last pressure seconds
	//in this case it will apply pressure with the pressuriser function
	this.duration = duration ;
	this.callback = callback ;
	this.clickDuration = 1 ; //in seconds
	this.clickUnderPressureDuration = 0.25 ; //clickDuration is a multiple of
	this.timeRemaining = 0;
	this.render = render;
	this.timer = {};
	this.running = false;

	if(isNaN(pressure)){
		this.pressure = 0;
	}
	else{
		this.pressure = pressure ;
	}

	if(typeof pressuriser != "function"){
		this.pressurise = function(){};
	}
	else{
		this.pressurise = pressuriser;
	}

	var self = this;

	this.isRunning = function(){
		return self.running;
	}

	this.secondPassed = function() {

		var minutes = Math.floor(self.timeRemaining/60);
		if(self.nextClick !== false){
			self.timeRemaining = self.timeRemaining - self.nextClick ;
		}
		self.render(minutes, self.timeRemaining % 60);
		if (self.timeRemaining <= self.pressure){
			self.pressurise();
			self.nextClick = self.clickUnderPressureDuration;
		}
		else{
			self.nextClick = self.clickDuration ;
		}
		if (self.timeRemaining <= 0) {
			self.stop();		
		}
		else{//because we're using seconds…
			self.timer = window.setTimeout(self.secondPassed, self.nextClick * 1000);
		}
	};

	this.start = function(){
		self.timeRemaining = self.duration;
		self.nextClick = false;
		self.running = true ;
		if( (self.clickDuration*1000) % (self.clickUnderPressureDuration * 1000) === 0){
			self.secondPassed();
		}
		else{
			console.log("Durations should be multiples…", self.clickDuration, "and", self.clickUnderPressureDuration, "are not");
		}
	};

	this.stop = function(){
		self.running = false;
		window.clearTimeout(self.timer);
		self.callback();
	};
}