<script>
		function myFunction(variable) {
			var choixLang = document.getElementById("chooseLang").value;

			//alert(choixLang);

			
			var req = new XMLHttpRequest();
			req.open("GET","update_userlang_game.php?userlang_game="+choixLang+"&page_not="+variable, true);
			req.onreadystatechange = function(aEvt){
				if (req.readyState == 4) {
				     if(req.status == 200)
				     {
				      console.log(req.responseText);
				  	void window.location.reload();
				     }
				     else
				     {
				      console.log("Erreur pendant le chargement de la page.\n");
				  	 }
				  }

			};
			req.send(null);
		}
	</script>