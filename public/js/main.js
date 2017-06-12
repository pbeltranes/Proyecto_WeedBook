$('#lightSetup').on('change', function(){       
    if ($(this).val() == 'Sun' ) {
        $('#lightPower').addClass('hide');
        $('input[name=light_power]').val('0');
    }else{
    	$('#lightPower').removeClass('hide');
    	$('input[name=light_power]').val('');
    }
})