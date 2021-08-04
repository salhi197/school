function verif_existance() 
{
 	
 	var nom = $("#nom").val();

 	var prenom = $("#prenom").val();

 	var id_groupe = $("#nom").attr('groupe');

    $.ajax({
        headers: 
        {
           'X-CSRF-TOKEN': $('input[name="_token"]').val()
        },                    
        type:"POST",
        url:"/home/single_groupe/verif_existance/ajax",
        data:{nom:nom,prenom:prenom,id_groupe:id_groupe},

        success:function(data) 
        {

        	//alert(data);

        	if (data!==false) 
        	{

        		$("#nom").removeClass("is-invalid state-invalid").addClass("is-valid state-valid");
        		$("#prenom").removeClass("is-invalid state-invalid").addClass("is-valid state-valid");
        		
        		$("#il_existe_deja").hide('1000', function() 
        		{
        			$("#btn_ajouter").show(1000);
        		});

        		$("#num_tel").val(data);

        		//
        	}
        	else
        	{

        		$("#nom").removeClass("is-valid state-valid").addClass("is-invalid state-invalid");
        		$("#prenom").removeClass("is-valid state-valid").addClass("is-invalid state-invalid");
        		
        		$("#btn_ajouter").hide('1000', function() 
        		{
        			$("#il_existe_deja").show('1000');
        		});

        		$("#num_tel").val('');

        		//
        	}

        	//
		}
	});	



 	//
} 

function valider_coches(objet) 
{

	$(objet).hide(500, function() 
	{

		$("#valider").show(500);

		$("#ne_pas_valider").show(500);
		
	});

	// body...
}

function retour(objet) 
{
	$("#valider").hide('500');

	$(objet).hide('1000', function() 
	{	
		
		$("#valider_les_coches").show(500)	
		
	});

	//
}


function valider_tous(objet) 
{

	var eleves_groupe = JSON.parse($(objet).attr('value'));

	var groupe = JSON.parse($(objet).attr('groupe'));

	var seances_eleves = JSON.parse($(objet).attr('seances_eleves'));

	var numero_de_la_seance_dans_le_mois = JSON.parse($(objet).attr('numero_de_la_seance_dans_le_mois'));	

	var eleves_gratuits = JSON.parse($(objet).attr('eleves_gratuits'));
	
	var les_coches = [];

	var les_input_payement = [];	

	var max = [];

	var compteur_faux = 0;

	for (var i = 0; i < eleves_groupe.length; i++) 
	{

		if($("#mois1-"+eleves_groupe[i].id+"-"+numero_de_la_seance_dans_le_mois).is(":checked")) 
		{
			les_coches[i]=1;
			//
		}
		else
		{
			les_coches[i]=0;
			//
		}

		les_input_payement[i] = parseFloat($("#input_payement"+eleves_groupe[i].id).val());

		max[i] = parseFloat($("#input_payement"+eleves_groupe[i].id).attr('max'));

		if(les_input_payement[i] > max[i]) 
		{

			compteur_faux = compteur_faux+1;

			$("#input_payement"+eleves_groupe[i].id).removeClass("is-valid state-valid").addClass("is-invalid state-invalid");
			
			/*$("#valid_"+eleves_groupe[i].id).hide('1000');
			
			$("#invalid_"+eleves_groupe[i].id).show(1000);*/
				
			

			
			//
		}
		else
		{

			$("#input_payement"+eleves_groupe[i].id).removeClass("is-invalid state-invalid").addClass("is-valid state-valid");
		
			/*$("#invalid_"+eleves_groupe[i].id).hide('1000');
			$("#valid_"+eleves_groupe[i].id).show(1000);*/
				

			//			
		}


		//
	}
	console.log(seances_eleves);
	console.log(les_coches);

	if (compteur_faux>0) 
	{

		$("html, body").animate({ scrollTop: 400 }, "slow");

		return false;
	}

    $.ajax({
        headers: 
        {
           'X-CSRF-TOKEN': $('input[name="_token"]').val()
        },                    
        type:"POST",
        url:"/home/single_groupe/valider_coches/ajax",
        data:{eleves_groupe:eleves_groupe,groupe:groupe,numero_de_la_seance_dans_le_mois:numero_de_la_seance_dans_le_mois,les_coches:les_coches,les_input_payement:les_input_payement,eleves_gratuits:eleves_gratuits},

        success:function(data) 
        {
        	$("html, body").animate({ scrollTop: 140 }, "slow");
        	location.reload();

        	//
		}
	});	




	// body...
}


function goto_the_link(objet) 
{

	var id_eleve = (objet.id.substr(5));

	var id_groupe = $(objet).attr("groupe")

	window.location.href = '/home/groupes/'+id_groupe+'/eleve/'+id_eleve;
	
	// body...
}

function supprimergroupe (event,objet) 
{

	event.preventDefault();

	$id=(objet.getAttribute('id'));

	$id=($id.substr(3));

	var id_hide="#groupe"+$id;

	console.log(id_hide)

    $.ajax({
        headers: 
        {
           'X-CSRF-TOKEN': $('input[name="_token"]').val()
        },                    
        type:"POST",
        url:"/home/groupes/supprimer/ajax",
        data:{id:$id},

        success:function(data) 
        {

        	$("#nnotif").text("Groupe Archivé").attr('class','text-center alert alert-danger')

			window.location.href = '/home/groupes';

        	//
		}
	});	

	// body... 
}

function hide_payement(objet) 
{	

	if($(objet).is(":checked"))
	{

		$("#payement .form-control").val(0);

		$("#payement").show('1000', function() 
		{
			
			$(".custom-switch-description").text("L'élève paye ses cotisations");

			//	
		});

		//
	}
	else
	{

		$("#payement").hide('1000', function() 
		{
			
			$(".custom-switch-description").text("L'élève ne paye pas");

			//	
		});


		//
	}

	//
}



  	
