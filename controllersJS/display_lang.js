<script>
	function dispalyMoreLanguages(){
			//var dl=document.getElementById("list_lang");
			var t=document.getElementById("userlang_spoken");
			var count = t.getElementsByTagName("tr").length;
			if (count === 10) { return;}
			var tr = t.insertRow(count);
			//var tr = document.createElement("tr");
			var td = tr.insertCell(0);
			td.align = "center";
			//var td = document.createElement("td");
			var i = document.createElement('input');
			i.type = "text";
			i.required="required";
			i.setAttribute('list','iso');
			i.setAttribute('name','choix_langs_'.concat(count));	
			i.setAttribute('onchange', 'updateRadio(this);');
			//i.list="iso";
			i.size="10";
			td.appendChild(i);
			// tr.appendChild(td);
			
			var td = tr.insertCell(1);
			//td = document.createElement('td');
			td.align="center";
			i = document.createElement('input');
			i.type="text";
			i.required="required";
			i.setAttribute('list','lang_level');
			i.setAttribute('name','choix_niveau_'.concat(count));	
			i.size="10";
			td.appendChild(i);
			//tr.appendChild(td);
			
			var td = tr.insertCell(2);
			//td = document.createElement('td');
			td.align="center";
			i = document.createElement('input');
			i.type="radio";
			i.setAttribute('name','lang_game');
			td.appendChild(i);
			//tr.appendChild(td);		
			//t.appendChild(tr);
			
		}
	function dispalyLessLanguages(){
		var t=document.getElementById("userlang_spoken");
		var count = t.getElementsByTagName("tr").length;
		if (count > 2) {	t.deleteRow(count-1); }
	}
	
	function updateRadio(l) {
		var tr = l.parentNode.parentNode;
		var game = tr.cells[2].children[0];
		game.setAttribute('value', l.value);
	}	
	
</script>