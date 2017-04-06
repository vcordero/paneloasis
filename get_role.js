$(document).ready(function(){

$(function()
{ 
    $('#type').change(function()
    {
   		var id=$(this).val(); 
      	alert(id);
 
		$.ajax({
		  url: 'dashboard.php?p=new_user',
		  type: 'POST',
		  async: true,
		  data: 'ids='+id,
		  success: function(data)
	      {
          	//console.log("-->"+data);  
          	seleccion="<select name='city' class='inputStyle'><option value=0>Selecciona Ciudad</option>";	
 
			var obj = jQuery.parseJSON(data);	
			$(obj).each(function(indice, elemento){
 			//s=s+"<option value=0>Selecciona Jugador</option>";
			seleccion=seleccion+"<option value="+elemento.id+">"+elemento.description+"</option>";	
			//  console.log('El elemento con el índice '+elemento.id+' contiene '+elemento.name );
			});
			
			seleccion=seleccion+"</select>";	
			//alert(s);
			
			var total=$('#city select').length;
			if(total>0){
				$( "#city" ).children().remove();
			}
			//alert(total);
			$(seleccion).appendTo("#city");
 
	      }
 
		});
 
    });
    $('#country2').change(function()
    {
   		var id=$(this).val(); 
      	//alert(id);
 
		$.ajax({
		  url: 'get_city',
		  type: 'POST',
		  async: true,
		  data: 'ids='+id,
		  success: function(data)
	      {
	      	//alert("llego aquui");
          	//console.log("-->"+data);  
          	seleccion="<select name='city' class='input-register'><option value=0>Selecciona Ciudad</option>";	
 
			var obj = jQuery.parseJSON(data);	
			$(obj).each(function(indice, elemento){
 			//s=s+"<option value=0>Selecciona Jugador</option>";
			seleccion=seleccion+"<option value="+elemento.id+">"+elemento.description+"</option>";	
			//  console.log('El elemento con el índice '+elemento.id+' contiene '+elemento.name );
			});
			
			seleccion=seleccion+"</select>";	
			//alert(s);
			
			var total=$('#city select').length;
			if(total>0){
				$( "#city" ).children().remove();
			}
			//alert(total);
			$(seleccion).appendTo("#city");
 
	      }
 
		});
 
    });
});




});