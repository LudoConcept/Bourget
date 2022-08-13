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
			$("#responseform").addClass("bg-danger text-light").html(erreur.msg).show();
		}).always(function(res){
			console.log("always");
			console.log(res);
			blou = res;
			if (!res.save){
				$("#responseform").html(res.msg).show("fast", "swing").parent().parent().addClass("bg-warning text-light");
			} else if (res.erreur) {
				$("#responseform").html(res.msg).show("fast", "swing").parent().parent().addClass("bg-danger text-light");
			} else {
				$("#responseform").html(res.msg).show("fast", "swing").parent().parent().addClass("bg-success text-light");
			}
		});
		
		// traiter la réponse : la team n'est pas ajouté dans la base ----> on reste et on affiche un petit mot
		// traiter la réponse : team enregistrée ----> on chrge la suite, trois étapes pour afficher les scores.
	});
});