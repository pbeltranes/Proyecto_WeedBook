//esconde las opciones de luz en caso de que elija outdoor dejando el sol por defecto
$('#growSetup').on('change', function(){
	if($(this).val() == 'Outdoor'){
		$('#lightSetupClass').addClass('hide');
		$('#lightSetup').val('Sun');
        $('#lightPower').addClass('hide');
        $('input[name=light_power]').val('0');
	}else{
		$('#lightSetupClass').removeClass('hide');
		$('#lightPower').removeClass('hide');
	}
})

//esconde la opcion de wataje si elijio que sera el sol su fuente principal de luz
$('#lightSetup').on('change', function(){       
    if ($(this).val() == 'Sun' ) {
        $('#lightPower').addClass('hide');
        $('input[name=light_power]').val('0');
    }else{
    	$('#lightPower').removeClass('hide');
    	$('input[name=light_power]').val('');
    }
})