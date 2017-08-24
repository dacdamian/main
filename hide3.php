<?php
        session_start();
        require_once('db.php');
          
        
		 
?>
<html lang="pl_PL">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Twoje ukryte dane</title>

    <!-- Bootstrap -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<script src="bootstrap/js/bootstrap.js" language=javascript type="text/javascript"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
</head>
<body>
      
<?php
     
    if ($_SESSION['auth'] == TRUE) {
			$page_title = 'Zmiana hasla';
			require_once('header.php');
            require_once('navmenu.php');
         
            $user = $_SESSION['user'];
          
            $wynik = mysql_query("SELECT * FROM users WHERE login='$user'") or die('bladd zapytania');
  
            if(mysql_num_rows($wynik) > 0 ) {
	  
                while($r = mysql_fetch_assoc($wynik)) {
              
                    $email = $r['email'];   
                    $imie = $r['imie'];
                    $nazwisko = $r['nazwisko'];
                    $login = $r['login'];
                    $data_ur = $r['data_urodzenia'];
                    $data_ut = $r['data_utworzenia'];
                    $stare_haslo = $r['haslo'];

                }
            }
?>
<form class="form-horizontal" action="zmiana_hasla.php" method="POST">
<fieldset>

<legend><center><h2><hr />Zmiana hasla</h2></center></legend>

<form>
<div class="container">
<div class="form-group">
  <label class="col-md-4 control-label" for="haslo3">Stare haslo</label>
  <div class="col-md-4">
    <input id="haslo3" name="haslo3" type="password" placeholder="Stare haslo" class="form-control input-md" required="" onBlur="checkAvailability()">
    <span class="komunikat" id="stare_haslo-availability-status"></span>
  </div>
</div>
   
<div class="form-group">
  <label class="col-md-4 control-label" for="haslo">Nowe haslo</label>
  <div class="col-md-4">
    <input id="haslo" name="haslo" type="password" placeholder="Haslo" class="form-control input-md" required="">
    <span class="komunikat"></span>
  </div>
</div>

<div class="form-group">
  <label class="col-md-4 control-label" for="haslo2">Powtorz nowe haslo</label>
  <div class="col-md-4">
    <input id="haslo2" name="haslo2" type="password" placeholder="Wpisz ponownie nowe haslo" class="form-control input-md" required="">
    <span class="komunikat"></span>
  </div>
</div>

<div class="form-group">
  <label class="col-md-4 control-label" for="submit"></label>
  <div class="col-md-4">
    <button id="submit" name="submit" class="btn btn-success">Edytuj</button>
  </div>
</div>
</div>

</fieldset>

</form>
<script>//walidacja js jq ajax
$(document).ready(function() {
    
    $('#haslo3').on('blur', function()
    {
	var input = $(this);
	var haslo3_length = input.val().length;
	
            if(haslo3_length >= 5 && haslo3_length <=20){
		input.removeClass("invalid").addClass("valid");
		input.next('.komunikat').text("Hasło jest poprawnej długości.").removeClass("blad").addClass("ok");
                
                    jQuery.ajax({
                            url: "sprawdz_login.php",
                            data:'haslo='+$("#haslo3").val(),
                            type: "POST",
                            success:function(data){
                            $("#stare_haslo-availability-status").html(data);
                            },
                            error:function (){
                            }
                    });
                
            }
            else{
		input.removeClass("valid").addClass("invalid");
		input.next('.komunikat').text("Hasło musi mieć powyżej 4 znaków, a nie wiecej jak 20!").removeClass("ok").addClass("blad");
			
            }
    });

    $('#haslo').on('blur', function()
	{
	var input = $(this);
	var haslo_length = input.val().length;
	
            if(haslo_length >= 5 && haslo_length <=20){
		input.removeClass("invalid").addClass("valid");
		input.next('.komunikat').text("Hasło jest poprawnej długości.").removeClass("blad").addClass("ok");
		
            }
            else{
		input.removeClass("valid").addClass("invalid");
		input.next('.komunikat').text("Hasło musi mieć powyżej 4 znaków, a nie więcej jak 20!").removeClass("ok").addClass("blad");
			
            }
	});
        
    $('#haslo2').on('blur', function(){
	var input = $(this);
	var haslo2 = document.getElementById('haslo2').value;
	var haslo = document.getElementById('haslo').value;
	
            if(haslo2 == haslo){
		input.removeClass("invalid").addClass("valid");
		input.next('.komunikat').text("Hasło jest zgodne.").removeClass("blad").addClass("ok");
		
            }
            else{
		input.removeClass("valid").addClass("invalid");
		input.next('.komunikat').text("Hasło musi być takie samo jak wyżej!").removeClass("ok").addClass("blad");
			
            }
    });
        
    $('#submit').click(function(event){
	var haslo = $('#haslo');
	var haslo2 = $('#haslo2');
	var haslo3 = $('#haslo3');
			
            if(haslo3.hasClass('valid') && haslo.hasClass('valid') && haslo2.hasClass('valid')){
		alert("Pomyślnie wysłano formularz.");	
            }
            else {
            event.preventDefault();
            alert("Uzupełnij wszystkie pola poprawnie!");	
			}
    });
});
</script>
    
<?php
    }
    else {
        echo '<meta http-equiv="refresh" content="5; URL=index.php">';
        echo '<p style="padding-top:10px;"><strong>Próba nieautoryzowanego dostępu...</strong><br>trwa przenoszenie do formularza logowania<p></p>';
    }
?>
<?php 
    require_once('footer.php');
?>
</body>
</html>