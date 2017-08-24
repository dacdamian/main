<?php
	require_once('db.php');
	
	$page_title = 'Nowe hasło';
	require_once('header.php');
	require_once('navmenu.php');
	
	?>
	
<form class="form-horizontal" method="POST" action="nowe_haslo1.php">
<fieldset>

<!-- Form Name -->
<legend><center>Generowanie nowego hasła</center></legend>

<!-- Text input-->
<div class="container">

<div class="form-group" id="frmCheckLogin">
  <label class="col-md-4 control-label" for="login_generuj">Podaj swój login</label>  
  <div class="col-md-4">
  <input id="login_generuj" name="login_generuj" type="text" placeholder="login" class="form-control input-md" required="" onBlur="checkAvailability()">
    <span class="komunikat" id="user-availability-status"></span>
  </div>
</div>


<div class="form-group">
  <label class="col-md-4 control-label" for="submit"></label>
  <div class="col-md-4">
    <button id="submit" name="submit" class="btn btn-primary">Generuj nowe hasło</button>
  </div>
</div>

</div>
</fieldset>
</form>
<script>
$(document).ready(function() {
 
	
	$('#login_generuj').on('blur', function() {
		var input = $(this);
		var login_length = input.val().length;
		if(login_length >= 3 && login_length <= 30){
			input.removeClass("invalid").addClass("valid");
			input.next('.komunikat').text("Wprowadzono poprawny login.").removeClass("blad").addClass("ok");
				 jQuery.ajax({
                                url: "sprawdz_login.php",
                                data:'login1='+$("#login_generuj").val(),
                                type: "POST",
                                success:function(data){
                                $("#user-availability-status").html(data);
                                },
                                error:function (){
                                }
                                });
		}
		else{
			input.removeClass("valid").addClass("invalid");
			input.next('.komunikat').text("Login musi mieć więcej niż 3 i mniej niż 30 znaków!").removeClass("ok").addClass("blad");
			
		}
	});
});

</script>

	
<?php
	require_once('footer.php');
?>