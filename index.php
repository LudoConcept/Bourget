<?php
include_once('./param/global.php');
include_once('./textes/textes.php');
include_once('./fonctions/php_mission.php');
include_once('./fonctions/php_cookies.php');

if (!cookieExists(COOKIE_MISSIONS))
{
	//Création du cookie du tableau des missions
	$m = init_cookie_mission(NBR_MISSIONS);
	createCookie(COOKIE_MISSIONS, serialize($m));
	//Création du cookie du vibrophone
	$n = init_cookie_vibro();
	createCookie(COOKIE_VIBROPHONE, $n);
	//Création du cookie des arbres
	$o = init_cookie_poi_arbres();
	createCookie(COOKIE_POI_ARBRES, $o);
	//Création du cookie des métamorphes
	$p = init_cookie_poi_map();
	createCookie(COOKIE_POI_MAP, $p);
	//Création du cookie des métamorphes
	$q = init_cookie_esprit();
	createCookie(COOKIE_ESPRIT, $q);
	//Création du cookie du timer
	$r = init_cookie_timer();
	createCookie(COOKIE_TIMER, $r);
	//Création du cookie des réponses finales
	$s = "start";
	createCookie(COOKIE_QUESTION, $s);
	//Création du cookie des réponses finales
	$t = "InGame";
	createCookie(COOKIE_FINAL, $t);
	//Ce sera notre dernier espoir d'utiliser ce qui suit :p
	//Création du cookie de la mission ROSES qui foire de manière aléatoire
	//$u = "init";
	//createCookie(COOKIE_ROSES, $u);
}

if (!cookieExists(COOKIE_MISSIONS))
{
	//Si les cookies n'ont pas été créé on sort en erreur, ça veut dire qu'on ne peut pas utiliser les cookies sur ce device
	include ('./includes/include_headerhtml.php');
	echo MSG_ERR_COOKIE;
	include ('./includes/include_endhtml.php');
	exit();
}

$etatmission = unserialize($_COOKIE[COOKIE_MISSIONS]);
if (!isActive($etatmission[GAME_ON]))
{
	//Premier passage : On lance le jeu = on active la première mission
	$etatmission = startgame($etatmission, [GAME_ON, MOT_DE_PASSE]);
	//Et on n'oublie pas de mettre à jour les cookies !
	createCookie(COOKIE_MISSIONS, serialize($etatmission));	
} else {
	/* S'ils ont terminé le jeu - Réafficher la page finale
	if ($etatmission[FIN_DE_GAME] == ACTIVE) 
	{
		header("Location: ./interface.php");
	} else {*/
		//Sinon les joueurs reprennent leur partie	
		header("Location: ./interface.php");
	//}
}

include ('./includes/include_headerhtml.php');
?>
	<!-- CONTENU -->
	<div class="row marge4">
		<div id="start_page" class="col-12 text-center"><?php echo MESSAGE001;?></div>
	</div>
	
	<div class="row marge4 text-center mt-3">
		<div class="col-12">
			<a id="btn_regle" style="max-width: 50%;" class="button fontbutton" title="regle"><?php echo LIB_BTN_REGLE; ?></a>
		</div>

		<div id="affiche_start">
		</div>
	</div>
	
	
	<!-- FIN DU CONTENU -->

<?php
include ('./includes/include_footer.php'); // le fichier est actuellement vide, mais si on veut inclure quelque chose en guise de pied de page, on aura juste à le remplir
include ('./includes/include_external_script.php');
?>
	<!-- SCRIPT PERSONNALISEE ICI -->
<?php
include('./includes/bouton_regles_script.php');			
include ('./includes/include_endhtml.php');
?>