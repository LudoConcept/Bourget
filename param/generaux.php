<?php

// DOIT-ON SAUVEGARDER LES TEMPS A LA FIN DE LA GAME ???
define("SAVESCORE", true);

//Paramètres de ce jeu spécifiquement
define("COOKIE_VIBROPHONE", "bourget_vibrophone");
define("COOKIE_POI_MAP", "bourget_poi_map");
define("COOKIE_POI_ARBRES", "bourget_poi_arbres");
define("COOKIE_MISSIONS", "bourget_missions");
define("COOKIE_ESPRIT", "bourget_esprit");
define("COOKIE_TIMER","bourget_timer");
define("COOKIE_QUESTION","bourget_question");
define("COOKIE_FINAL","bourget_temps_final");
define("COOKIE_TEAM", "bourget_team");
//define("COOKIE_ROSES","bourget_roses");

define("NBR_MISSIONS", 35); //Numéro dernière mission dans le tableau des missions

//Intitulé des paramètres du vibrophone
define("ETAT_ON_OFF",0);
define("ETAT_AIGUILLE",1);
define("ETAT_CARRE",2);
define("ETAT_POTAR1",3);
define("ETAT_POTAR2",4);

define("FICHIER_CSS","./css/bourget.css");

define("IMG_FOND","./images/background.jpg");
define("GIF_LOAD","./images/load.gif");
define("FAV_ICON","images/favicon.png");

//Images
define("IMG_COMMANDITAIRE","./images/Moutarde.png");

define("POSITION", 0);
define("ID_MAX_ESPRIT", 7);
define("IMG_ESPRIT00","./images/Esprit00.png");
define("IMG_ESPRIT01","./images/Esprit01.png");
define("IMG_ESPRIT02","./images/Esprit02.png");
define("IMG_ESPRIT03","./images/Esprit03.png");
define("IMG_ESPRIT04","./images/Esprit04.png");
define("IMG_ESPRIT05","./images/Esprit05.png");
define("IMG_ESPRIT06","./images/Esprit06.png");
define("IMG_ESPRIT07","./images/Esprit07.png");

define("ESPRIT_FINAL","Esprit_final.png");
define("SPECIAL_ESPRIT","Paramètre à placer dans VISUEL pour afficher l'esprit dans tableau_missions.php");

define("IMG_VIBROPHONE","./images/Vibrophone.png");

define("IMG_VIBRO_ECRAN_STOP","./images/Vibro_ecran_stop.png");
define("IMG_VIBRO_ECRAN_FAIBLE","./images/Vibro_ecran_faible.png");
define("IMG_VIBRO_ECRAN_NORMAL","./images/Vibro_ecran_normal.png");
define("IMG_VIBRO_ECRAN_FORT","./images/Vibro_ecran_fort.png");
define("IMG_VIBRO_BTN_ON","./images/Vibro_btn_on.png");
define("IMG_VIBRO_BTN_OFF","./images/Vibro_btn_off.png");
define("IMG_VIBRO_AIGUILLE","./images/Vibro_aiguille.png");
define("IMG_VIBRO_PAD_ON","./images/Vibro_pad_on.png");
define("IMG_VIBRO_PAD_OFF","./images/Vibro_pad_off.png");
define("IMG_VIBRO_POTAR_POS1","./images/Vibro_potar1.png");
define("IMG_VIBRO_POTAR_POS2","./images/Vibro_potar2.png");
define("IMG_VIBRO_POTAR_POS3","./images/Vibro_potar3.png");
define("IMG_VIBRO_PLAY","./images/Vibro_play.png");

define("IMG_MAP_ELT","./images/elt");	//Se complète dans le code avec id "_" param ".png"

define("IMG_PAS_ARBRE","./images/POI_pas_arbre.png");
define("IMG_EST_ARBRE","./images/POI_est_arbre.png");
define("IMG_ARBRE","./images/POI_arbre.png");
define("IMG_CERCLE","./images/POI_arbre_fini.png");

define("FOND_TRONC","./images/fond_tronc.png");

define("IMG_ROYAL","./images/RR_"); //complété dans le code

define("FOND_QUESTION","./images/fin_fond_question.png");

//Sons
define("SON_VIBRO_ON","./sons/vibro_on.mp3");
define("SON_VIBRO_OFF","./sons/vibro_off.mp3");
define("SON_VIBRO_AIG_PLUS","./sons/vibro_aig_plus.mp3");
define("SON_VIBRO_AIG_MOINS","./sons/vibro_aig_moins.mp3");
define("SON_VIBRO_CARRE1","./sons/vibro_carre1.mp3");
define("SON_VIBRO_CARRE2","./sons/vibro_carre2.mp3");
define("SON_VIBRO_CARRE3","./sons/vibro_carre3.mp3");
define("SON_VIBRO_CARRE4","./sons/vibro_carre4.mp3");
define("SON_VIBRO_CARRE5","./sons/vibro_carre5.mp3");
define("SON_VIBRO_POTAR","./sons/vibro_potar.mp3");
define("SON_VIBRO_PLAY","./sons/vibro_play.mp3");
define("SON_VIBRO_ERR_AIGU","./sons/vibro_erreur_aigu.mp3");
define("SON_VIBRO_ERR_GRAVE","./sons/vibro_erreur_grave.mp3");

define("SON_LAVOIR","./sons/Lavoir");
define("SON_CENTRE","./sons/Centre");
define("SON_EXVOTO","./sons/Exvoto");
define("SON_FOND","./sons/Fond");
define("SON_FIRST","./sons/First");
define("SON_DICK","./sons/Dick");

define("TITRE","Les Murmures des Murs"); 
define("ACCROCHE","Un voyage en plein coeur des Jardins du Prieuré ça vous tente ? Venez relever le défi !");

define("LIB_ONGLET_1","Carte");
define("LIB_ONGLET_2","Missions");
define("LIB_ONGLET_3","Esprit");

//Textes génériques tous jeux
define("MSG_ERR_COOKIE", "<p class=\"text-mission\">Il semble que votre navigateur n'accepte pas les cookies. Ce jeu ne peut fonctionner que grâce aux cookies : veuillez les accepter dans les paramètres de votre navigateur puis <a href=\"./\">revenez par ici !</a></p>");
define("LIB_BTN_REGLE","Règles du jeu");
define("LIB_BTN_REGLE2","Retour aux règles");
define("LIB_BTN_FERMER","Fermer");
define("LIB_BTN_VALIDER","Valider");
define("INDICE", "Indice");

//Constantes tous jeu
define("PATH", "/");
define("COOKIESECURE", FALSE);
define("COOKIEHTTPONLY", TRUE);

define("INACTIVE", 0);
define("ACTIVE", 1);
define("FINISH", 2);

// REDIRECTION VERS UN ESPACE DE COMMENTAIRE
define("REDIRECT_AVIS", false);
define("LIEN_AVIS", "");

//Types missions
define("CODE_STANDARD", 0);
define("CODE_COULEUR", 1);
define("CODE_DIRECTION", 2);

//Intitulé des paramètres des missions
define("TITLE", "title"); // titre de la mission, affiché dans la liste des missions
define("DESC", "desc"); // description plus précise, avec peut-être un indice dans la description
define("CLUE", "clue"); // indice pour résoudre la tâche
define("X", "x");
define("Y", "y"); // position sur la carte
define("GEANT", "geant"); // le point sur la map est-il géant ?
define("HAS_CODE", "has_code"); // La mission a-t-elle un code pour passer à la suite ?
define("QUESTION", "question"); // Question affichée pour la saisie du CODE
define("CODE", "code"); // code pour passer à la suite.
define("WIN_TITLE", "win"); // texte affichée dans la liste des missions terminées
define("WIN_DESC", "win_desc");
define("CARTE", "carte"); // carte sur laquelle la mission se trouve
define("AFFICHER_FINISH_LIST", "afficher finish"); // la mission doit-elle s'afficher dans la liste des missions finies
define("AFFICHER_FINISH_MAP","afficher map"); // le point s'affiche-t-il une fois la mission terminée ?
define("STANDARD", "standard"); // l'affichage de la mission est-il standard ?
define("MISSION_SUIVANTE", "mission_suivante"); // la mission a afficher lorsqu'on fini cette mission, à condition qu'elle soit active
define("VISUEL", "src"); // Source de l'image à afficher sur la carte
define("AUTOFINISH", "autofinish"); // La mission se termine-t-elle automatiquement à l'ouverture ?
define("HAS_MISSION_LINK", "has_mission_link"); // La mission a-t-elle un lien vers une autre mission ?
define("MISSION_LINK", "mission_link"); // Lien vers l'autre mission
define("MISSION_LINK_BUTTON_NAME", "Texte du bouton link"); // Affiché sur la mission en bas de page
define("IMG_ALT", "img_alt");
define("TYPE_CODE", "type_code");
define("SPEC_CODE", "spec_code");
define("DISPLAY_VALIDATION_FAIL", "display_validation_fail"); // Affiche-t-on un message en cas d'erreur  de code ?
define("DISPLAY_VALIDATION_SUCCESS", "display_validation_success"); // affiche-t-on un message en cas de validation de saisie ?
define("VALIDATION_SUCCESS", "validation_success"); // message à afficher en cas de code correct
define("VALIDATION_FAIL", "validation_fail"); // messages à afficher en cas d'erreur de saisie
define("PLACEHOLDER","placeholder"); // message à afficher dans les inputs text
define("ERREUR_CODE", "erreur");
define("PUISSANCE_VIBRO","entre faible normal et fort");
define("IMG_PUISSANCE_VIBRO","Image vibro");
?>