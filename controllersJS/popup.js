function popUp(redirect){

	 // Script pour le PopUp  l'ouverture de la page
	$(document).ready(function() {
	// select the overlay element - and "make it an overlay"
	$("#facebox").overlay({

	// some mask tweaks suitable for facebox-looking dialogs
	mask: {
	// you might also consider a "transparent" color for the mask
	color: '#000000',
	// load mask a little faster
	loadSpeed: 1000,
	// very transparent
	opacity: 0.7
	},
	// disable this for modal dialog-type of overlays
	closeOnClick: false,
	// we want to use the programming API
	api: true

	// load it after delay
	})
	var ol = $("#facebox").overlay({api: true});

 	setTimeout(function() {
	ol.load();
	}, 0);
	setTimeout(function() {
		if(redirect !== undefined){
				document.location.href="index.php?mode="+redirect;
		}
	ol.close();
	}, 5000);
	}); 
}