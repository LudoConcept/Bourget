var blou;
$(function(){
	$("#bloc_mission").on("click", "#saveteam", function(){
		$("#responseform").hide().parent().parent().removeClass();
		event.preventDefault();
		console.log("save team");
		// tenter d'ajouter la team dans la base
		console.log($("#saveteamform").serialize());
		
		$.post('./action/bdd_save_score.php',
			$("#saveteamform").serialize(),
			function(result){
				console.log("done");
				console.log(result);
			},
			"json"
		).fail(function(erreur){
			console.log("fail");
			if (erreur.msg != null) {
				$("#responseform").html(erreur.msg).show("fast", "swing").parent().parent().addClass("bg-danger text-light");
			} else {
				$("#responseform").html(erreur.responseText).show("fast", "swing").parent().parent().addClass("bg-danger text-light");
			}
		}).always(function(res){
			console.log("always");
			console.log(res);
			/* blou = res; */
			if (!res.save){
				$("#responseform").html(res.msg).show("fast", "swing").parent().parent().addClass("bg-warning text-light");
			} else if (res.erreur) {
				$("#responseform").html(res.msg).show("fast", "swing").parent().parent().addClass("bg-danger text-light");
			} else {
				$("#responseform").html(res.msg).show("fast", "swing").parent().parent().addClass("bg-success text-light");
				createCookie(cookieteam, $("#team").val(), 7);
				setTimeout(()=>{ $("#bloc_loading").show(); document.location = "./classement.php"; }, 2000);
				// mettre fin au jeu ? Faire qu'on plus sur la map en cas de rechargement
				// ajouter un lien en début de jeu pour aller voir les scores
				// diriger vers les scores
			}
		});
		
	});
});