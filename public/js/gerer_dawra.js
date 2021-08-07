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
    var selected = [];
    var dawra = $('#dawra_id').val();
    $(".checkboxes:checkbox:checked").each(function() {
        selected.push({
            "eleve":$(this).attr("eleve"),
            "num_seance":$(this).attr("seance")
        }
        )
    });
    console.log(selected);
    if(selected.length>0){
        $.ajax({   
            type: "POST",
            data : {dawra:dawra,data:JSON.stringify(selected)},//$(this).serialize(),
            url: "/home/single_dawra/valider_coches",   
            success: function(data){
                console.log('sasa');
                $("#results").html(data);                       
            },
            error:function(){
                console.log('error');
    //            $("#results").html(data);                       
            }
        });      
    }




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

function verif_prix_tarif(objet,tarif) 
{

	if ($(objet).val()>tarif) 
	{

		$(objet).removeClass("is-valid state-valid").addClass("is-invalid state-invalid");

		//
	}
	else
	{

		$(objet).removeClass("is-invalid state-invalid").addClass("is-valid state-valid");
		//
	}
	

	// body...
}


function afficher_payement_prof_1(objet,le_mois) 
{
	
	if($(objet).attr('class')!=="col-md-5 alert alert-success")
	{

		$("#payement_prof_effectuee"+le_mois).parent().show(1000);

		//
	}


	//
}

function afficher_payement_prof_2(objet,le_mois) 
{

	var num_mois = le_mois;
	
	var num_seance = $(objet).attr('seance');

	var id_groupe = $(objet).attr('groupe');

	var nom_prenom_prof = $(objet).attr('prof');

	var payement = $("#le_payement_du_mois"+le_mois).val();

    $.ajax({
        headers: 
        {
           'X-CSRF-TOKEN': $('input[name="_token"]').val()
        },                    
        type:"POST",
        url:"/home/single_groupe/payer_prof/ajax",
        data:{num_mois:num_mois,num_seance:num_seance,id_groupe:id_groupe,nom_prenom_prof:nom_prenom_prof,payement:payement},

        success:function(data) 
        {

        	$("#payement_prof_effectuee"+le_mois).parent().hide('slow', function() 
        	{
        		$("#payement_prof_mois"+le_mois).removeClass("alert alert-warning").hide('slow/400/fast', function() 
        		{
        			
        			$("#payement_prof_mois"+le_mois).addClass("alert alert-success").show('slow');

        			//
        		});
        	});

        	//
		}
	});	


	

	// body...
}

  	
