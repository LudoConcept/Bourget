<script>
	var bouton_regle = document.getElementById('btn_regle');  
	bouton_regle.addEventListener('click', function(e) {
		Attribut_title = bouton_regle.getAttribute("title");
		
		if (Attribut_title == "regle")
		{
			//Change l'attribut title
			bouton_regle.setAttribute("title", "fermer");			
			//Change le libellé du bouton
			document.getElementById("btn_regle").innerHTML = "<?php echo LIB_BTN_FERMER; ?>";
			//Vire les 3 lignes d'intro
			document.getElementById("start_page").innerHTML = "<br>";	
			//Affiche les règles du jeu
			document.getElementById("affiche_start").innerHTML = "<?php echo REGLE000; ?>";
		}
		
		if (Attribut_title == "fermer")
		{
			window.location.href="./interface.php"		
		}
	});
</script>