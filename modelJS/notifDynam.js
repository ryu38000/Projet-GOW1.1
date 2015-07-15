function notifOn (mess,type,role,score) {
	//mess : est le message à afficher dans la notification
	//type : le type de notification, ex.error,done...
	//role : le rôle de l'utilisateur (oracle,druide,devin)
	//score : le score total dans le rôle
		var messa;

		if(isNaN(score)) {
			messa = '<div class="ns-thumb"><img width="64" height="70" src="style/ImgNot/'+type+'.png"/></div><div class="ns-content"><p>'+mess+'.</p></div>';
		}
		else{
			messa = '<div class="ns-thumb"><img width="64" height="70" src="style/ImgNot/'+type+'.png"/></div><div class="ns-content"><p> Role : '+role+' </br>'+mess+'.</br> Score '+role+' : '+score+'</p></div>';
		}


	setTimeout( function() {				
		// create the notification
		var notification = new NotificationFx({

			message : messa,
			layout : 'other',
			ttl : 6000,
			effect : 'thumbslider',
			type : 'notice', // notice, warning, error or success
			
		});

		// show the notification
		notification.show();

	}, 600 );

}