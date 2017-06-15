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
<<<<<<< HEAD


$(document).ready(function () {
  var navListItems = $('div.setup-panel div a'),
          allWells = $('.setup-content'),
          allNextBtn = $('.nextBtn');

  allWells.hide();

  navListItems.click(function (e) {
      e.preventDefault();
      var $target = $($(this).attr('href')),
              $item = $(this);

      if (!$item.hasClass('disabled')) {
          navListItems.removeClass('btn-primary').addClass('btn-default');
          $item.addClass('btn-primary');
          allWells.hide();
          $target.show();
          $target.find('input:eq(0)').focus();
      }
  });

  allNextBtn.click(function(){
      var curStep = $(this).closest(".setup-content"),
          curStepBtn = curStep.attr("id"),
          nextStepWizard = $('div.setup-panel div a[href="#' + curStepBtn + '"]').parent().next().children("a"),
          curInputs = curStep.find("input[type='text'],input[type='url']"),
          isValid = true;

      $(".form-group").removeClass("has-error");
      for(var i=0; i<curInputs.length; i++){
          if (!curInputs[i].validity.valid){
              isValid = false;
              $(curInputs[i]).closest(".form-group").addClass("has-error");
          }
      }

      if (isValid)
          nextStepWizard.removeAttr('disabled').trigger('click');
  });

  $('div.setup-panel div a.btn-primary').trigger('click');
});


=======
>>>>>>> db2279628facb07bdd674f6b367f997ba5725a42
