<?php
include ('./includes/include_headerhtml.php');
include ('./includes/include_menu.php');
?>

	<!-- CONTENU 
	<div id="liste_mission">		
		<div class="" id="mission_on">
		</div>
	</div>  FIN DE LA ZONE DES MISSIONS -->
	
	<div id="bloc_mission">
	</div> <!-- FIN DES INFOS DE MISSION -->
	
	<div id="bloc_carte">
	</div>
	
	<div id="bloc_resume">
	</div>
	
	<?php 	
	/*<div id="resultat"><!-- ZONE D'AFFICHAGE D'INFO LIKE A POP-UP -->
	</div> */ ?>
	<div id="bloc_loading">
		<img class="loader" src="<?php echo GIF_LOAD; ?>">
	</div>
	<!-- <button id="pressed">TEST</button>-->

<?php
include ('./includes/include_footer.php'); // le fichier est actuellement vide, mais si on veut inclure quelque chose en guise de pied de page, on aura juste à le remplir
include ('./includes/include_external_script.php');
?>
	<!-- SCRIPT PERSONNALISEE ICI -->
	<script src="./js/Cook.js"></script>
	
	<script>	
		jQuery.fn.rotate = function(degrees) {
			$(this).css({'-webkit-transform' : 'rotate('+ degrees +'deg)',
                 '-moz-transform' : 'rotate('+ degrees +'deg)',
                 '-ms-transform' : 'rotate('+ degrees +'deg)',
                 'transform' : 'rotate('+ degrees +'deg)'});
		};
	</script>
	
	<script>	
		// $('.rotate').click(function() {
			// $(this).rotate(rotation);
		// });
		
		var carte;
		//var missions_vue, aiguille;// mission vue : true -- SERT A CHECK SI ON A DEJA VU UNE MISSION OU NON, POUR L'AFFICHAGE SUR LA MAP
		//var cookie_vue 		 = "cookie_vue";
		var cookie_vibro 	 = "<?php echo COOKIE_VIBROPHONE; ?>";
		var cookie_poi_map 	 = "<?php echo COOKIE_POI_MAP; ?>";
		var cookie_poi_arbre = "<?php echo COOKIE_POI_ARBRES; ?>";
		var cookie_question  = "<?php echo COOKIE_QUESTION; ?>";
		
		$(function(){
			
			//missions_vue = init_var(init_missions_vue, cookie_vue);
			var nbr_mission = 36; //Egal au dernier id ou dernier id +1?
			
			//Déclaration des différents sons utilisés par le vibrophone
			const son_vibro_on = new Audio("<?php echo SON_VIBRO_ON; ?>");
			const son_vibro_off = new Audio("<?php echo SON_VIBRO_OFF; ?>");
			const son_vibro_aig_plus = new Audio("<?php echo SON_VIBRO_AIG_PLUS; ?>");
			const son_vibro_aig_moins = new Audio("<?php echo SON_VIBRO_AIG_MOINS; ?>");
			const son_vibro_carre1 = new Audio("<?php echo SON_VIBRO_CARRE1; ?>");
			const son_vibro_carre2 = new Audio("<?php echo SON_VIBRO_CARRE2; ?>");
			const son_vibro_carre3 = new Audio("<?php echo SON_VIBRO_CARRE3; ?>");
			const son_vibro_carre4 = new Audio("<?php echo SON_VIBRO_CARRE4; ?>");
			const son_vibro_carre5 = new Audio("<?php echo SON_VIBRO_CARRE5; ?>");
			const son_vibro_potar = new Audio("<?php echo SON_VIBRO_POTAR; ?>");
			const son_vibro_play = new Audio("<?php echo SON_VIBRO_PLAY; ?>");
			const son_vibro_err_aigu = new Audio("<?php echo SON_VIBRO_ERR_AIGU; ?>");
			const son_vibro_err_grave = new Audio("<?php echo SON_VIBRO_ERR_GRAVE; ?>");

			const son_lavoir_1 = new Audio("<?php echo SON_LAVOIR; ?>_1.mp3");
			const son_lavoir_2 = new Audio("<?php echo SON_LAVOIR; ?>_2.mp3");
			const son_lavoir_3 = new Audio("<?php echo SON_LAVOIR; ?>_3.mp3");
			const son_lavoir_4 = new Audio("<?php echo SON_LAVOIR; ?>_4.mp3");
			const son_lavoir_5 = new Audio("<?php echo SON_LAVOIR; ?>_5.mp3");

			const son_centre_1 = new Audio("<?php echo SON_CENTRE; ?>_1.mp3");
			const son_centre_2 = new Audio("<?php echo SON_CENTRE; ?>_2.mp3");
			const son_centre_3 = new Audio("<?php echo SON_CENTRE; ?>_3.mp3");
			const son_centre_4 = new Audio("<?php echo SON_CENTRE; ?>_4.mp3");
			const son_centre_5 = new Audio("<?php echo SON_CENTRE; ?>_5.mp3");

			const son_exvoto_1 = new Audio("<?php echo SON_EXVOTO; ?>_1.mp3");
			const son_exvoto_2 = new Audio("<?php echo SON_EXVOTO; ?>_2.mp3");
			const son_exvoto_3 = new Audio("<?php echo SON_EXVOTO; ?>_3.mp3");
			const son_exvoto_4 = new Audio("<?php echo SON_EXVOTO; ?>_4.mp3");
			const son_exvoto_5 = new Audio("<?php echo SON_EXVOTO; ?>_5.mp3");

			const son_fond_1 = new Audio("<?php echo SON_FOND; ?>_1.mp3");
			const son_fond_2 = new Audio("<?php echo SON_FOND; ?>_2.mp3");
			const son_fond_3 = new Audio("<?php echo SON_FOND; ?>_3.mp3");
			const son_fond_4 = new Audio("<?php echo SON_FOND; ?>_4.mp3");
			const son_fond_5 = new Audio("<?php echo SON_FOND; ?>_5.mp3");

			const son_first_1 = new Audio("<?php echo SON_FIRST; ?>_1.mp3");
			const son_first_2 = new Audio("<?php echo SON_FIRST; ?>_2.mp3");
			const son_first_3 = new Audio("<?php echo SON_FIRST; ?>_3.mp3");
			const son_first_4 = new Audio("<?php echo SON_FIRST; ?>_4.mp3");
			const son_first_5 = new Audio("<?php echo SON_FIRST; ?>_5.mp3");

			const son_dick_1 = new Audio("<?php echo SON_DICK; ?>_1.mp3");
			const son_dick_2 = new Audio("<?php echo SON_DICK; ?>_2.mp3");
			const son_dick_3 = new Audio("<?php echo SON_DICK; ?>_3.mp3");
			const son_dick_4 = new Audio("<?php echo SON_DICK; ?>_4.mp3");
			const son_dick_5 = new Audio("<?php echo SON_DICK; ?>_5.mp3");

			var son_boutons_vibro = new Audio;
						
			// carte par défaut
			carte = 1;
			var focus = 0;
			
			// On cache tous les blocs
			$("#bloc_mission").hide();
			$("#bloc_carte").hide();
			$("#bloc_resume").hide();
			$("#bloc_loading").hide();	

			////// ECOUTEURS ///////
			
			// cacher résultat (qui apparaît suite à une erreur ou un check de code)
			$("#bloc_mission").on('click', "#resultat", function(event){
				cacher_resultat();
			});
			
			// On reçoit un clique dans le bloc_carte
			$("#bloc_carte").on('click', 'a', function(event){
				event.preventDefault();
				$('#bloc_carte').hide("slow", "swing");
				var m = this.title;
				/*if (!missions_vue[m]) {
					missions_vue[m] = true;
					createCookie(cookie_vue, JSON.stringify(missions_vue), 7);
				}*/
				if ((m == <?php echo ESPRIT_FIN;?>) || (m == <?php echo FIN_DE_GAME;?>))
				{
					//On désactive les menus
					$('#onglet_1').hide("slow", "swing");
					$('#onglet_3').hide("slow", "swing");					
				}
				console.log("GO VERS MISSION "+m);
				afficher_info_mission(m);
			});
			
			// On reçoit un clique dans le menu
			$("#menuprincipal").on('click', 'a', function(event){
				event.preventDefault();
				//trucbidule = 1; // au clic sur le menu, truc bidule passe à 1. Ce qui veut dire que le fonction qui attends que trucbidule passe à 1 ne tournera plus ^^
				dialogue_on = false; // confirme que le dialogue n'est pas/plus en cours
				$("#resultat").hide();
				$('#bloc_carte').hide('slow', 'swing');
				$('#bloc_resume').hide('slow', 'swing');
				$('#bloc_mission').hide('slow', 'swing');
				//$('#liste_mission').hide('slow', 'swing');

				if (document.getElementById("vibro_valeurs")) {
					//Si l'élément vibro_valeurs est dans le DOM alors on est sur le vibro lorsqu'on clique sur un bouton du menu.
					//Dans ce cas on save en cookie les valeurs du vibro.
					var save_vibro = document.getElementById("vibro_valeurs").innerHTML;
					//console.log (save_vibro);
					createCookie(cookie_vibro, save_vibro);
				}

				if (this.title == "onglet_1") {
					//Bouton carte
					if (document.getElementById("premier_passage")) {						
						//Si l'élément premier_passage est dans le DOM alors on est sur la première rencontre avec l'esprit lorsqu'on clique sur le bouton du menu.
						//On affiche l'onglet Esprit
						document.getElementById("onglet_3").className ="button fontbutton";					
					}					
					afficher_carte(carte);
				} else if (this.title == "onglet_3") {
					//Bouton Esprit
					afficher_esprit();
				}
			});
			
			// basculer d'une mission à une autre (pour les missions qui ont un lien entre elles)
			$("#bloc_mission").on('click', '.link', function(event){
				event.preventDefault();
				console.log("CHANGEMENT DE MISSION PAR LINK ON OUVRE LA MISSION : "+event.target.title);
				//Si on vient de terminer une mission avec le vibro on sauvegarde ses éléments dans le cookie
				if (document.getElementById("vibro_valeurs")) {
					var save_vibro = document.getElementById("vibro_valeurs").innerHTML;					
					createCookie(cookie_vibro, save_vibro);
				}
				afficher_info_mission(event.target.title);
			});
			
			// affichage des indices
			$("#bloc_mission").on('click', '.revealclue', function(event){
				event.preventDefault();
				var str = $(this).attr('class').split('_');
				var clue = str[1];
				$(".displayclue").hide("slow","swing");
				$(".displayclue-"+clue).show("slow","swing");
			});
			
			$("#bloc_mission").on('click', '.displayclue', function(event){
				event.preventDefault();
				$(this).hide("slow", "swing");
			});			
			
			// Tentative de validation d'une mission via un bouton de validation
			$("#bloc_mission").on('click', '.solve', function(event){
				event.preventDefault();
				var val = $('#answer').val();
				$('#answer').val("");
				$("#solution_visible").html("");
				valider_mission($("#mission_name").val(), val);
			});			
									
			$("#bloc_mission").on('click', '.clean', function(event){
				event.preventDefault();
				$("#answer").val("");
				$("#solution_visible").html("");
			});
			
			// Gestion du loader
			$(document)
				.ajaxStart(function(){
					// console.log("ON");
					$("#loading").show();
				})
				.ajaxStop(function(){
					// console.log("OFF");
					$("#loading").hide();
				})
			;
			
			/******** FONCTIONS ********/
			function afficher_carte(m){
				$.post('./action/afficher_carte.php', {map: m, focus: focus}, function(result){
					$("#bloc_carte").html(result);
				}).fail(function(erreur){
					$("#bloc_carte").html("<p>ERREUR : "+erreur.toString()+"</p>");
				}).always(function(){
					$("#bloc_mission").hide();
					$("#liste_mission").hide();
					$("#bloc_carte").show("slow", "swing");
				});
			}
			
			function afficher_esprit(){
				$.post('./action/afficher_esprit.php', {}, function(result){
					$('#bloc_resume').html(result);
				});
				$("#bloc_resume").show("slow", "swing");
			}

			function valider_son_mission(k,t){
				//On check les règlages du vibro
				var origine = "Pas d'erreur"; //Origine de l'erreur
				var valeurs = document.getElementById("vibro_valeurs").innerHTML;
				var solution = document.getElementById("solution_mission").innerHTML;
					
				//On commence par checker les potars (le plus facile)
				var valeurs_joueur   = valeurs.substr(3,2);
				var valeurs_solution = solution.substr(3,2);
				if (valeurs_joueur != valeurs_solution) 
				{
					origine = "potars";
				} else {
					//On check l'aiguille
					valeurs_joueur   = valeurs.substr(1,1);
					valeurs_solution = solution.substr(1,1);				
					switch (valeurs_solution) {
						case "1": case "2": case "3":
							if (valeurs_joueur > 3) {								
								origine = "aiguille";
							}
							break;
						case "4": case "5":
							if (valeurs_joueur < 4 || valeurs_joueur > 5) {			
								origine = "aiguille";
							}
							break;
						case "6": case "7": case "8":
							if (valeurs_joueur < 6) {								
								origine = "aiguille";
							}
							break;
						default :												
							break;
					}
				}										
					
				if (origine == "Pas d'erreur")
				{	
					//On check les carrés
					origine = "Carrés";					
					numero_mission = document.getElementById("mission_num").innerHTML;
					switch (numero_mission) {
					case "<?php echo VIBRO1; ?>" :							
						valeurs_joueur = valeurs.substr(2,1);							
						switch (valeurs_joueur) {
						case "1" : 												
							son_action = son_first_1.src;
							break;
						case "2" : 
							son_action = son_first_2.src;
							break;
						case "3" : 
							origine = "Pas d'erreur";
							son_action = son_first_3.src;
							break;
						case "4" : 												
							son_action = son_first_4.src;
							break;
						case "5" : 
							son_action = son_first_5.src;
							break;
						default :
							//Cas particulier si les joueurs n'ont pas encore touché aux boutons carrés
							son_action = son_first_1.src;
							break;
						}
						break;

					case "<?php echo VIBRO2; ?>" :							
						valeurs_joueur = valeurs.substr(2,1);							
						switch (valeurs_joueur) {
						case "1" : 
							origine = "Pas d'erreur";
							son_action = son_exvoto_1.src;
							break;
						case "2" : 
							son_action = son_exvoto_2.src;
							break;
						case "3" : 
							son_action = son_exvoto_3.src;
							break;
						case "4" : 												
							son_action = son_exvoto_4.src;
							break;
						case "5" : 
							son_action = son_exvoto_5.src;
							break;
						default :
							//Cas particulier si les joueurs n'ont pas encore touché aux boutons carrés
							son_action = son_exvoto_5.src;
							break;
						}
						break;												
					case "<?php echo VIBRO4; ?>" :						
						valeurs_joueur = valeurs.substr(2,1);							
						switch (valeurs_joueur) {
						case "1" : 
							son_action = son_lavoir_1.src;
							break;
						case "2" : 
							son_action = son_lavoir_2.src;
							break;
						case "3" : 
							son_action = son_lavoir_3.src;
							break;
						case "4" : 
							origine = "Pas d'erreur";
							son_action = son_lavoir_4.src;
							break;
						case "5" : 
							son_action = son_lavoir_5.src;
							break;
						default :
							//Cas particulier si les joueurs n'ont pas encore touché aux boutons carrés
							son_action = son_lavoir_1.src;
							break;
						}
						break;
					case "<?php echo VIBRO5; ?>" :						
						valeurs_joueur = valeurs.substr(2,1);							
						switch (valeurs_joueur) {
						case "1" : 												
							son_action = son_dick_1.src;
							break;
						case "2" : 
							son_action = son_dick_2.src;
							break;
						case "3" : 
							son_action = son_dick_3.src;
							break;
						case "4" : 												
							son_action = son_dick_4.src;
							break;
						case "5" : 
							origine = "Pas d'erreur";
							son_action = son_dick_5.src;
							break;
						default :
							//Cas particulier si les joueurs n'ont pas encore touché aux boutons carrés
							son_action = son_dick_1.src;
							break;
						}
						break;			
					case "<?php echo VIBRO6; ?>" :						
						valeurs_joueur = valeurs.substr(2,1);							
						switch (valeurs_joueur) {
						case "1" : 												
							son_action = son_fond_1.src;
							break;
						case "2" : 
							origine = "Pas d'erreur";
							son_action = son_fond_2.src;
							break;
						case "3" : 
							son_action = son_fond_3.src;
							break;
						case "4" : 												
							son_action = son_fond_4.src;
							break;
						case "5" : 
							son_action = son_fond_5.src;
							break;
						default :
							//Cas particulier si les joueurs n'ont pas encore touché aux boutons carrés
							son_action = son_fond_5.src;
							break;
						}
						break;				
					case "<?php echo VIBRO7; ?>" :						
						valeurs_joueur = valeurs.substr(2,1);							
						switch (valeurs_joueur) {
						case "1" : 
							son_action = son_centre_1.src;
							break;
						case "2" : 
							son_action = son_centre_2.src;
							break;
						case "3" : 
							origine = "Pas d'erreur";
							son_action = son_centre_3.src;
							break;
						case "4" : 												
							son_action = son_centre_4.src;
							break;
						case "5" : 
							son_action = son_centre_5.src;
							break;
						default :
							//Cas particulier si les joueurs n'ont pas encore touché aux boutons carrés
							son_action = son_centre_1.src;
							break;
						}
						break;	
					default :
						break;								
					}
				} 

				switch (origine) {
					case "Pas d'erreur" :
						$("#zone_indices").hide();
						$("#zone_boutons_indices").hide();
						$("#zone_next").show();
						var element = document.querySelector("#zone_next");
						element.scrollIntoView();
						break;
					case "potars": case "aiguille":
						son_action = "err_grave";
						break;
					case "Carrés" : 
						//Rien à faire
						break;
					default: 
						break;
				}													
				vibro_lancer_son(son_action);
			}
			
			//Permet de tester la réponse donnée à une mission
			function valider_mission(k, t){
				var isError = false;
				$.post('./action/valider_mission.php',
					{key: k, test: t},					//Paramètres envoyés key et test
					function(data){						//Retour du fichier appelé par data					
						try {
							// data = JSON.parse(data);
							if (data.erreurcookie) {
								$("#info_mission").html(data.info);
								$("#resultat").html(data.info);
								$("#resultat").removeClass();
								$("#resultat").addClass("bg-danger");
								// $("#resultat").show();
							}
							else if (data.succes) {
								//La mission est validée
								$("#resultat").html(data.info);
								$("#resultat").removeClass();
								$("#resultat").addClass("bg-success");								
								// $("#resultat").show();
								console.log("MISSION "+k+" VALIDEE");
								console.log("GO VERS MISSION "+data.next);
								afficher_info_mission(data.next);								
							} else {
								//La mission n'est pas validée
								$("#resultat").html(data.info);
								$("#resultat").removeClass();
								$("#resultat").addClass("bourget-warning");
								console.log("MISSION "+k+" NON VALIDEE");
							}
							$("#resultat").addClass("p-2");
							if (data.display) $("#resultat").show("slow", "swing");
						}
						catch(erreur){
							isError = true;
							$("#resultat").html("<p>Une erreur est survenu durant la validation. Essayez de rafraichir la page.</p><p>"+erreur.toString()+"</p>").addClass("bg-danger").show();
						}
					},
					"json"
				).fail(function(e){
					// console.log("FAIL");
					$("#resultat").append("<p>Une erreur est survenue. Essayez de rafraichir votre page.</p><p>Erreur JXHR : "+e.toString()+"</p>").addClass("bg-danger").show();
				});
			}
			
			// la fonction ci-dessous sera utilisée pour valider les missions non standards, sans affichage supplémentaire côté client.
			// si un affichage supplémentaire doit avoir lieu, il aura lieu dans une fonction dédiée.
			function valider_mission_auto(k, t){
				$.post('./action/valider_mission.php',
					{key: k, test: t},
					function (result){
						try {
							if (result.erreurcookie) {
								$("#resultat").html(result.info);
								$("#resultat").removeClass();
								$("#resultat").addClass("bg-danger");
								$("#resultat").show();
							}
							else if (result.succes) {
								console.log("MISSION "+k+" AUTO VALIDEE");
							}
							else {
								console.log("MISSION "+k+" NON AUTO VALIDEE");
							}
						}
						catch(e){
							$("#info_mission").html("Une erreur est survenue :"+e.toString()+"</p>").show();
						}
					},
					"json"
				).fail(function(erreur){
					$("#info_mission").html("<p>Une erreur est survenue. Essayez de rafraichir votre page.</p><p>"+erreur+"</p>").show();
				});
			}
						
			/* Afficher_info_mission remplit le bloc_mission en fonction de la mission en cours */
			function afficher_info_mission(m) {
				focus = m;
				var isError = false;
				$.ajax({
					url : './action/data_mission.php',
					type : 'POST',
					dataType : 'html',
					data: {mission : m},
					success : function(resultat, statut){
						$("#bloc_mission").html(resultat);
					},
					error : function(resultat, statut, erreur){
						isError = true;
						$("#bloc_mission").html("<p class=\"text-mission\">Une erreur est survenue. Merci de recharger la page.</p><p>ERROR : "+erreur.toString()+"</p><p>"+statut.toString()+"</p>").show();
					},
					complete : function(resultat, statut){						
					}
				});				
				$('#bloc_carte').hide("slow", "swing");
				$('#bloc_mission').show("slow", "swing");
			}
			
			function cacher_resultat(){
				$("#resultat").hide("slow","swing");
				$("#resultat").removeClass();
				$("#resultat").html("");
			}
			
			function effacer_btn_dialogue(){
				$("#liste_question").html("");
				$("#liste_question").hide();
			}
			
			function effacer_dialogue() {
				$("#discussion").html("");
			}			
			
			// Appelé uniquement au chargement de la page (au cas où certains téléphone aurait un peu de mal).
			function checkjeu(){
				var isError = false;
				$.ajax({
					url : './action/check_jeu.php',
					type : 'GET',
					data : '',
					async: true, // fonction synchrone, pour initialiser les variables AVANT que l'utilisateur puisse jouer
					dataType: 'JSON',
					success : function(resultat,statut){
						console.log('CHECK JEU SUCCESS');
						try {
							if (resultat.erreur) throw resultat.erreurinfo;
							//pizza_connue = (resultat.pizza && !resultat.erreur);
							//distrib_vu = (resultat.distrib && !resultat.erreur);
							//distrib_demarre = (resultat.distrib_ok && !resultat.erreur);
							mission1 = (resultat.mission1 && !resultat.erreur);
							afficher_onglet3 = (resultat.afficher_onglet3 && !resultat.erreur);
							if (!resultat.erreur) carte = resultat.carte;
							else carte = 1;
						}
						catch(erreur){
							isError = true;
							$("#info_mission").html("<p>Une erreur est survenue, merci de rafraichir la page ou contactez un administrateur.<br>"+erreur.toString()+"</p>").show();
						}
					},
					error : function(resultat, statut, erreur){
						// que faire en cas d'erreur
						console.log('CHECK JEU ERREUR');
						isError = true;
						$("#info_mission").html("<p>Une erreur est survenue, merci de rafraichir la page ou contactez un administrateur.<br>"+erreur.toString()+"</p>").show();
					},
					complete : function(resultat, statut){
						console.log('CHECK JEU COMPLETE');
						if (!isError) {
							if (afficher_onglet3 == true)
							{
								//$("#onglet_3").show();
								document.getElementById("onglet_3").className ="button fontbutton";
							}

							if (mission1) afficher_info_mission(1);
							else afficher_carte(carte);
						}
					}
				});
			}
			
			/*function init_missions_vue() {
				var m = [];
				// on peut afficher sans passer par la carte : la mission 1 (test), la 3 (qui n'a pas de point), la 23 (qui n'a pas de point), la 8, 9, et 10 qui partagent le point de la 7
				// les 14, 15 et 16 qui partage le point de la 13.
				// Tous les autres points devront être vus sur la carte avant de pouvoir les cliquer.
				for (let i = 0; i < nbr_mission; i++){
					m[i] = (i == 1 || i == 3 || i == 24 || (i <= 17 && i >=9) || i == 39 || i == 42);
				}
				return m;
			}*/	
			
			/*function init_var(fonction_init, nomcookie){
				// Si le cookie en question existe, on récupére les infos. Sinon, on retourne une variable initialisé grâce à la fonction passée en paramètre
				var variable = readCookie(nomcookie);
				if (variable == null) {
					variable = fonction_init();
					createCookie(nomcookie, JSON.stringify(variable), 7);
				} else {
					variable = JSON.parse(variable);
				}
				// console.log(variable);
				return variable;
			}*/
			

/********************************************************************
 ********************** MISSION VIBROPHONE **************************
 ********************************************************************/				
			function vibro_lancer_son(action) {
				son_boutons_vibro.src = "";
				switch (action) {
					case "on" :
						son_boutons_vibro.src = son_vibro_on.src;					
						break;
					case "off" :
						son_boutons_vibro.src = son_vibro_off.src;
						break;
					case "aig_plus" :
						son_boutons_vibro.src = son_vibro_aig_plus.src;
						break;
					case "aig_moins" :
						son_boutons_vibro.src = son_vibro_aig_moins.src;
						break;
					case "carre1" :
						son_boutons_vibro.src = son_vibro_carre1.src;
						break;
					case "carre2" :
						son_boutons_vibro.src = son_vibro_carre2.src;
						break;
					case "carre3" :
						son_boutons_vibro.src = son_vibro_carre3.src;
						break;
					case "carre4" :
						son_boutons_vibro.src = son_vibro_carre4.src;
						break;
					case "carre5" :
						son_boutons_vibro.src = son_vibro_carre5.src;
						break;
					case "potar" :
						son_boutons_vibro.src = son_vibro_potar.src;
						break;
					case "play" :
						son_boutons_vibro.src = son_vibro_play.src;
						break;
					/*case "err_aigu" :
						son_boutons_vibro.src = son_vibro_err_aigu.src;
						break;*/
					case "err_grave" :
						son_boutons_vibro.src = son_vibro_err_grave.src;
						break;
					default :
						son_boutons_vibro.src = action;
						break;
				}
				son_boutons_vibro.play();
			}

			//Clique sur le bouton on off
			$("#bloc_mission").on('click', "#vibro_on_off", function()
			{
				event.preventDefault();	
				$("#img_vibro_on").toggle();
				$("#img_vibro_off").toggle();
				
				var valeurs = document.getElementById("vibro_valeurs").innerHTML;
				var position = 0;	//Récupération du 1er paramètre
				var valeurs_param = valeurs.substr(position,1);
				
				if (valeurs_param == "0") {	
					//On passe de Off à On									
					var son_action = "on";
					vibro_lancer_son(son_action);

					valeurs_param = "1";					
					valeurs = valeurs_param + valeurs.substr(position+1);				
					document.getElementById("vibro_valeurs").innerHTML = valeurs;
					$("#img_vibro_ecran_actif").show();
					$("#img_vibro_ecran_noir").hide();
					jQuery('.pour_desactivation').show();
					//console.log(valeurs);

				} else {	
					//On passe de On à Off
					var son_action = "off";
					vibro_lancer_son(son_action);

					document.getElementById("vibro_valeurs").innerHTML = "01011";
					
					$("#img_vibro_ecran_actif").hide();
					$("#img_vibro_ecran_noir").show();
					$("#img_vibro_aiguille").rotate(-62);
					tous_carre_hide();
					$("#img_vibro_potar1").rotate(0);
					$("#img_vibro_potar2").rotate(0);
					jQuery('.pour_desactivation').hide();
					//console.log(valeurs);

				}
			});

			$("#bloc_mission").on('click', "#vibro_moins", function(){
				event.preventDefault();
				//alert("Clique sur vibro_moins");
				var son_action = "aig_moins";
				vibro_lancer_son(son_action);

				var valeurs = document.getElementById("vibro_valeurs").innerHTML;
				var position = 1;	//Récupération du 2nd paramètre
				var valeurs_param = valeurs.substr(position,position);	
				if (valeurs_param == "2") { 
					valeurs_param = "1";
					$("#img_vibro_aiguille").rotate(-62);
				} else if (valeurs_param == "3") {
					valeurs_param = "2";
					$("#img_vibro_aiguille").rotate(-41);
				} else if (valeurs_param == "4") {
					valeurs_param = "3";
					$("#img_vibro_aiguille").rotate(-19.5);
				} else if (valeurs_param == "5") {
					valeurs_param = "4";
					$("#img_vibro_aiguille").rotate(2);
				} else if (valeurs_param == "6") {
					valeurs_param = "5";
					$("#img_vibro_aiguille").rotate(23.5);
				} else if (valeurs_param == "7") {
					valeurs_param = "6";
					$("#img_vibro_aiguille").rotate(44);
				} else if (valeurs_param == "8") {
					valeurs_param = "7";
					$("#img_vibro_aiguille").rotate(64);
				}		
				valeurs = valeurs.substr(0,position) + valeurs_param + valeurs.substr(position+1);				
				document.getElementById("vibro_valeurs").innerHTML = valeurs;
				//console.log(valeurs);
			});

			$("#bloc_mission").on('click', "#vibro_plus", function(){
				event.preventDefault();
				//alert("Clique sur vibro_plus");
				var son_action = "aig_plus";
				vibro_lancer_son(son_action);

				var valeurs = document.getElementById("vibro_valeurs").innerHTML;
				var position = 1;	//Récupération du 2nd paramètre
				var valeurs_param = valeurs.substr(position,position);	
				if (valeurs_param == "7") { 
					valeurs_param = "8";
					$("#img_vibro_aiguille").rotate(84.5);
				} else if (valeurs_param == "6") {
					valeurs_param = "7";
					$("#img_vibro_aiguille").rotate(64);
				} else if (valeurs_param == "5") {
					valeurs_param = "6";
					$("#img_vibro_aiguille").rotate(44);
				} else if (valeurs_param == "4") {
					valeurs_param = "5";
					$("#img_vibro_aiguille").rotate(23.5);
				} else if (valeurs_param == "3") {
					valeurs_param = "4";
					$("#img_vibro_aiguille").rotate(2);
				} else if (valeurs_param == "2") {
					valeurs_param = "3";
					$("#img_vibro_aiguille").rotate(-19.5);
				} else if (valeurs_param == "1") {
					valeurs_param = "2";
					$("#img_vibro_aiguille").rotate(-41);
				}		

				valeurs = valeurs.substr(0,position) + valeurs_param + valeurs.substr(position+1);				
				document.getElementById("vibro_valeurs").innerHTML = valeurs;
				//console.log(valeurs);
			});

			function tous_carre_hide() {
				$("#img_vibro_pad1_on").hide();
				$("#img_vibro_pad1_off").show();
				$("#img_vibro_pad2_on").hide();
				$("#img_vibro_pad2_off").show();
				$("#img_vibro_pad3_on").hide();
				$("#img_vibro_pad3_off").show();
				$("#img_vibro_pad4_on").hide();
				$("#img_vibro_pad4_off").show();
				$("#img_vibro_pad5_on").hide();
				$("#img_vibro_pad5_off").show();
			}

			$("#bloc_mission").on('click', ".vibro_carre", function(){
				event.preventDefault();				
				tous_carre_hide();

				var son_action = "carre";
				var valeurs = document.getElementById("vibro_valeurs").innerHTML;	
				var position = 2;	//Récupération du 3ème paramètre
				var valeurs_param = valeurs.substr(position,1);
				
				if ($(this).attr('id') == "vibro_bouton_1") {
					$("#img_vibro_pad1_on").show();
					$("#img_vibro_pad1_off").hide();
					valeurs_param = 1;
				} else if ($(this).attr('id') == "vibro_bouton_2") {
					$("#img_vibro_pad2_on").show();
					$("#img_vibro_pad2_off").hide();
					valeurs_param = 2;
				} else if ($(this).attr('id') == "vibro_bouton_3") {
					$("#img_vibro_pad3_on").show();
					$("#img_vibro_pad3_off").hide();
					valeurs_param = 3;
				} else if ($(this).attr('id') == "vibro_bouton_4") {
					$("#img_vibro_pad4_on").show();
					$("#img_vibro_pad4_off").hide();
					valeurs_param = 4;
				} else if ($(this).attr('id') == "vibro_bouton_5") {
					$("#img_vibro_pad5_on").show();
					$("#img_vibro_pad5_off").hide();
					valeurs_param = 5;
				}
				son_action += valeurs_param;
				vibro_lancer_son(son_action);
				
				valeurs = valeurs.substr(0,position) + valeurs_param + valeurs.substr(position+1);
				document.getElementById("vibro_valeurs").innerHTML = valeurs;
				//console.log(valeurs);			
			});

			$("#bloc_mission").on('click', "#vibro_potar_1", function(){
				event.preventDefault();
				//console.log($(this).attr('id'));	
				var son_action = "potar";
				vibro_lancer_son(son_action);

				var valeurs = document.getElementById("vibro_valeurs").innerHTML;	
				var position = 3;	//Récupération du 4ème paramètre
				var valeurs_param = valeurs.substr(position,1);	
				//console.log("Valeurs_param avant : " + valeurs_param);
				if (valeurs_param == "1") {	
					valeurs_param = "2";
					$("#img_vibro_potar1").rotate(90);
				} else if (valeurs_param == "2") {		
					valeurs_param = "3";
					$("#img_vibro_potar1").rotate(180);
				} else if (valeurs_param == "3") {		
					valeurs_param = "4";
					$("#img_vibro_potar1").rotate(270);			
				} else if (valeurs_param == "4") {		
					valeurs_param = "1";
					$("#img_vibro_potar1").rotate(0);
				}
				
				valeurs = valeurs.substr(0,position) + valeurs_param + valeurs.substr(position+1);	
				document.getElementById("vibro_valeurs").innerHTML = valeurs;	
				//console.log(valeurs);		
			});

			$("#bloc_mission").on('click', "#vibro_potar_2", function(){
				event.preventDefault();
				var son_action = "potar";
				vibro_lancer_son(son_action);
				//console.log($(this).attr('id'));	
				var valeurs = document.getElementById("vibro_valeurs").innerHTML;	
				var position = 4;	//Récupération du 5ème paramètre
				var valeurs_param = valeurs.substr(position,1);	
				//console.log("Valeurs_param avant : " + valeurs_param);				

				if (valeurs_param == "1") {	
					valeurs_param = "2";
					$("#img_vibro_potar2").rotate(90);
				} else if (valeurs_param == "2") {		
					valeurs_param = "3";
					$("#img_vibro_potar2").rotate(180);
				} else if (valeurs_param == "3") {		
					valeurs_param = "4";
					$("#img_vibro_potar2").rotate(270);
				} else if (valeurs_param == "4") {		
					valeurs_param = "1";
					$("#img_vibro_potar2").rotate(0);
				}
				
				valeurs = valeurs.substr(0,position) + valeurs_param + valeurs.substr(position+1);	
				document.getElementById("vibro_valeurs").innerHTML = valeurs;
				//console.log(valeurs);
			});

			$("#bloc_mission").on('click', "#vibro_play", function()
			{				
				event.preventDefault();
				numero_mission = document.getElementById("mission_num").innerHTML;					
				tentative 	   = document.getElementById("vibro_valeurs").innerHTML;
				valider_son_mission(numero_mission, tentative);
			});

			$("#bloc_mission").on('click', "#zone_next", function(){
				numero_mission = document.getElementById("mission_num").innerHTML;
				tentative 	   = document.getElementById("vibro_valeurs").innerHTML;
				valider_mission(numero_mission, tentative);
			});
		
/********************************************************************
 ********************** MISSION STATUE FOND *************************
 ********************************************************************/	

			$("#bloc_carte").on('click', ".arbre", function()
			{
				event.preventDefault();

				var element = document.getElementById($(this).attr('id'));
				var position = window.getComputedStyle(element, null)['z-index'];
				var valeurs = document.getElementById("poi_arbre_valeurs").innerHTML;
				
				position -= 100;			
				var valeurs_param = valeurs.substr(position,1);	

				//console.log('position : '+position);
				/*console.log("valeurs avant : " + valeurs);
				console.log("position avant : " + position);
				console.log("Valeurs_param avant : " + valeurs_param);*/

				if (valeurs_param == "1") {	
					valeurs_param = "2";
					document.getElementById($(this).attr('id')).src = "<?php echo IMG_PAS_ARBRE ?>";
				} else if (valeurs_param == "2") {		
					valeurs_param = "0";
					document.getElementById($(this).attr('id')).src = "<?php echo IMG_ARBRE ?>";			
				} else if (valeurs_param == "0") {		
					valeurs_param = "1";
					document.getElementById($(this).attr('id')).src = "<?php echo IMG_EST_ARBRE ?>";
				}						
				valeurs = valeurs.substr(0,position) + valeurs_param + valeurs.substr(position+1);	
				document.getElementById("poi_arbre_valeurs").innerHTML = valeurs;
				createCookie(cookie_poi_arbre, valeurs);
				
				/*console.log("valeurs après : " + valeurs);
				console.log("position après : " + position);
				console.log("Valeurs_param après : " + valeurs_param);*/
			});
		
/********************************************************************
 ********************** MISSION STATUE CENTRE ***********************
 ********************************************************************/

			$("#bloc_carte").on('click', ".map_elt", function()	{
				event.preventDefault();
				
				var element = document.getElementById($(this).attr('id'));
				var position = window.getComputedStyle(element, null)['z-index'];
				var valeurs = document.getElementById("poi_map_valeurs").innerHTML;
				position -= 22;			
				var valeurs_param = valeurs.substr(position,1);
				if (valeurs_param == "1") {	
					valeurs_param = "2";				
				} else if (valeurs_param == "2") {		
					valeurs_param = "3";				
				} else if (valeurs_param == "3") {		
					valeurs_param = "4";				
				} else if (valeurs_param == "4") {		
					valeurs_param = "1";							
				}					
				element.src = "<?php echo IMG_MAP_ELT ?>"+position+"_"+valeurs_param+".png";

				valeurs = valeurs.substr(0,position) + valeurs_param + valeurs.substr(position+1);	
				document.getElementById("poi_map_valeurs").innerHTML = valeurs;
				createCookie(cookie_poi_map, valeurs);		
			});

/********************************************************************
 **************************** MISSION REINE & ROI *******************
 ********************************************************************/

			$("#bloc_mission").on('click', ".arbres_royaux", function()	{
				event.preventDefault();

				//console.log("passe onclick");
				switch ($(this).attr('id')) {
					case "royal_haut" :
						id_royal = "haut";
						break;
					case "royal_milieu" :
						id_royal = "milieu";
						break;
					case "royal_bas" :
						id_royal = "bas";
						break;
					default :
						break;
				}

				valeur = document.getElementById(id_royal).innerHTML;
				if (valeur == 9) {
					valeur = 1;
				} else {
					valeur ++;
				}
				document.getElementById("img_"+id_royal).src = "<?php echo IMG_ROYAL; ?>"+valeur+".png";
				document.getElementById(id_royal).innerHTML = valeur;

				if (document.getElementById("origine").innerHTML == "reine")
				{
					if ((document.getElementById("haut").innerHTML == 4) && (document.getElementById("milieu").innerHTML == 7) && (document.getElementById("bas").innerHTML == 5)) {
						//Les joueurs viennent de produire la bonne forme						
						numero_mission = <?php echo REPRODUIRE_REINE; ?>;						
						solution = "475";
						valider_mission_auto(numero_mission, solution);
						$(".arbres_royaux").hide();
						$("#zone_indices").hide();
						$("#zone_boutons_indices").hide();
						$(".zone_next").show();
						var element = document.querySelector(".zone_next");
						element.scrollIntoView();
					}
				}

				if (document.getElementById("origine").innerHTML == "roi")
				{
					if ((document.getElementById("haut").innerHTML == 6) && (document.getElementById("milieu").innerHTML == 2) && (document.getElementById("bas").innerHTML == 5)) {
						//Les joueurs viennent de produire la bonne forme
						numero_mission = <?php echo REPRODUIRE_ROI; ?>;						
						solution = "625";
						valider_mission_auto(numero_mission, solution);						
						$(".arbres_royaux").hide();
						$("#zone_indices").hide();
						$("#zone_boutons_indices").hide();						
						$(".zone_next").show();
						var element = document.querySelector(".zone_next");
						element.scrollIntoView();
					}
				}
			});

/********************************************************************
 ************************* Questions finales ************************
 ********************************************************************/
 			//On enlève le menu lorsqu'on arrive à la fin.
			$("#bloc_mission").on('click', "#finale_next", function(){
				//On désactive les menus
				$('#onglet_1').hide("slow", "swing");
				$('#onglet_3').hide("slow", "swing");
			});

			$("#bloc_mission").on('click', ".select_rep", function(){
				save_rep = document.getElementById("save_rep").innerHTML;
				//On ajoute la réponse A aux réponses déjà données
				//console.log("valeur save rep avant :"+save_rep); 
				save_rep += $(this).attr('id');
				console.log("valeur save rep après + id :"+save_rep); 
				document.getElementById("save_rep").innerHTML = save_rep;
				createCookie(cookie_question, save_rep);

				etape = document.getElementById("etape_rep").innerHTML;
				//console.log("Etape lue :"+etape); 
				if (etape == <?php echo NB_QUESTIONS; ?>) {
					//C'était la dernière étape, traiter la fin de game
					//Afficher la fin + Temps + Score
					solution = "CDBBDD";					
					console.log("Validation de la mission ESPRIT FIN");
					valider_mission_auto(<?php echo ESPRIT_FIN;?>,solution);
					console.log("Affichage de la mission FIN_DE_GAME");
					afficher_info_mission(<?php echo FIN_DE_GAME; ?>);
				} else {					
					$("#bloc_question"+etape).hide();
					$("#txt_repA_"+etape).hide();
					$("#txt_repB_"+etape).hide();
					$("#txt_repC_"+etape).hide();
					$("#txt_repD_"+etape).hide();					

					etape ++;					
					//console.log("Etape après :"+etape); 
					document.getElementById("etape_rep").innerHTML = etape;

					$("#bloc_question"+etape).show();
					$("#txt_repA_"+etape).show();
					$("#txt_repB_"+etape).show();
					$("#txt_repC_"+etape).show();
					$("#txt_repD_"+etape).show();
				}

			});

/********************************************************************
 ***************************** checkjeu *****************************
 ********************************************************************/

			checkjeu();
		});
		
		
	</script>
	<script src="./js/endgame.js"></script>
<?php
include ('./includes/include_endhtml.php');
?>