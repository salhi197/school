function hide_or_show_tarif(objet) 
{

	var mois = (objet.id.substr(7));

	if($(objet).is(':checked'))
	{
		$("#complement"+mois).hide(1000);
		$("#le_retard"+mois).hide(1000);
		$("#suur"+mois).show(1000);
		
	}
	else
	{
		$("#complement"+mois).show(1000);
		$("#le_retard"+mois).show(1000);
		$("#suur"+mois).hide(1000);			
	}

	//
}

function suur(objet) 
{

	var mois = (objet.id.substr(3));

	if($(objet).is(':checked'))
	{

		var tarif = $(objet).attr("tarif");

		$("#complement"+mois).hide(1000);

		$("#suur"+mois).hide(1000);

		$("#Payement_Complet"+mois).hide(1000);

		$("#le_retard"+mois).addClass('text-center').css('color','green').text('Payement Complet').show(1000);

		var id_groupe = $(objet).attr("groupe");

		var id_eleve = $(objet).attr("eleve");

		console.log(id_groupe);
		
		console.log(id_eleve)
		
	    $.ajax({
	        headers: 
	        {
	           'X-CSRF-TOKEN': $('input[name="_token"]').val()
	        },                    
	        type:"POST",
	        url:"/home/single_eleve/exoneree/ajax",
	        data:{id_eleve:id_eleve,id_groupe:id_groupe,num_mois:mois},

	        success:function(data) 
	        {

	        	//location.reload();

	        	//
			}
		});	



		//
	}

	//
}

function completer_payement(objet) 
{


	var num_mois = (objet.id.substr(7));

	var payement = ($("#mois"+num_mois).val());

	var current_seance = $(objet).attr("current_seance");

	var id_eleve = $(objet).attr("id_eleve");

	var id_groupe = $(objet).attr("id_groupe");

    $.ajax({
        headers: 
        {
           'X-CSRF-TOKEN': $('input[name="_token"]').val()
        },                    
        type:"POST",
        url:"/home/single_eleve/completer_payement/ajax",
        data:{id_eleve:id_eleve,id_groupe:id_groupe,num_mois:num_mois,current_seance:current_seance,payement:payement},

        success:function(data) 
        {

        	location.reload();

        	//
		}
	});	


	//
}