function valider_coches(objet) 
{

	$(objet).hide(100);

	var eleves_groupe = JSON.parse($(objet).attr('value'));

	var groupe = JSON.parse($(objet).attr('groupe'));

	var seances_eleves = JSON.parse($(objet).attr('seances_eleves'));

	var numero_de_la_seance_dans_le_mois = JSON.parse($(objet).attr('numero_de_la_seance_dans_le_mois'));	

	var les_coches = [];

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
		
	}
	console.log(seances_eleves);
	console.log(les_coches);

    $.ajax({
        headers: 
        {
           'X-CSRF-TOKEN': $('input[name="_token"]').val()
        },                    
        type:"POST",
        url:"/home/single_groupe/valider_coches/ajax",
        data:{eleves_groupe:eleves_groupe,groupe:groupe,seances_eleves:seances_eleves,numero_de_la_seance_dans_le_mois:numero_de_la_seance_dans_le_mois,les_coches:les_coches},

        success:function(data) 
        {

        	location.reload();

        	//
		}
	});	

	// body...
}


  	
