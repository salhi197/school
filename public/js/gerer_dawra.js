function verif_existance() 
{
 	
 	var nom = $("#nom").val();

 	var prenom = $("#prenom").val();

 	var id_dawra = $("#nom").attr('dawra');

    $.ajax({
        headers: {
           'X-CSRF-TOKEN': $('input[name="_token"]').val()
        },                    
        type:"POST",
        url:"/home/single_dawra/verif_existance/ajax",
        data:{nom:nom,prenom:prenom,id_dawra:id_dawra},
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
				location.reload();


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









  	
