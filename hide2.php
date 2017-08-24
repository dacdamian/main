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
        $page_title = 'Zmiana danych';
        require_once('header.php');
        require_once('navmenu.php');
         
        $user = $_SESSION['user'];
          
        $wynik = mysql_query("SELECT * FROM users WHERE login='$user'") or die('blad zapytania');
  
  
        if(mysql_num_rows($wynik) > 0 ) {
	  
            while($r = mysql_fetch_assoc($wynik)) {
              
                $email = $r['email'];   
                $imie = $r['imie'];
                $nazwisko = $r['nazwisko'];
                $login = $r['login'];
                $data_ur = $r['data_urodzenia'];
                $data_ut = $r['data_utworzenia'];
				$status = $r['aktywne'];
				

                $sqlday2 = mysql_query("SELECT * FROM users WHERE login='$user' and data_utworzenia<'08-06-2017'");

         
            }
        }
  
        $dzis = date('Y-m-d');
      
        $utworzenie = date("Y-m-d", strtotime($data_ut));

        $ile = (strtotime($dzis) - strtotime($utworzenie)) / (60*60*24);
		
        if ($ile == 1){
        echo "<h4><center>Posiadasz konto ".$ile." dzien, od ".$data_ut;
        }
        else{
        echo "<h4><center>Posiadasz konto ".$ile." dni, od ".$data_ut; 
        }
        echo '<br>Edycja zwykłego konta jest dostępna tylko przez 2 dni.</center></h4>';
       
        if (($ile <= 2) || ($status == 2)) {
        
?>
          
<form class="form-horizontal" action="edytuj.php" method="POST">
<fieldset>

<legend><center><h2><hr />Edycja moich danych</h2></center></legend>

<form>
<div class="container">
<div class="form-group" id="frmCheckLogin">
  <label class="col-md-4 control-label" for="Login">Login</label>  
  <div class="col-md-4">
  <input id="login" name="login" type="text" placeholder="login" class="form-control input-md" required="" value="<?php echo $login; ?>" onBlur="checkAvailability()"></input>
  <span class="komunikat" id="login-availability-status"></span>
 
  </div>
</div>

<div class="form-group">
  <label class="col-md-4 control-label" for="imie">Imie</label>  
  <div class="col-md-4">
  <input id="imie" name="imie" type="text" placeholder="imie" class="form-control input-md" required="" value="<?php echo $imie; ?>">
  <span class="komunikat"></span>
  </div>
</div>

<div class="form-group">
  <label class="col-md-4 control-label" for="nazwisko">Nazwisko</label>  
  <div class="col-md-4">
  <input id="nazwisko" name="nazwisko" type="text" placeholder="nazwisko" class="form-control input-md" required="" value="<?php echo $nazwisko; ?>">
  <span class="komunikat"></span>
  </div>
</div>

<div class="form-group">
  <label class="col-md-4 control-label" for="data_urodzenia">Data urodzenia</label>  
  <div class="col-md-4">
  <input id="data_urodzenia" name="data_urodzenia" type="date" placeholder="data" class="form-control input-md" required="" value="<?php echo $data_ur; ?>">
  <span class="komunikat"></span>  
  </div>
</div>

<div class="form-group" id="frmCheckEmail">
  <label class="col-md-4 control-label" for="email">E-mail</label>  
  <div class="col-md-4">
  <input id="email" name="email" type="text" placeholder="email" class="form-control input-md" required="" value="<?php echo $email; ?>" onBlur="checkAvailability()">
  <span class="komunikat" id="email-availability-status"></span>  
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
<script>//walidacja js
$(document).ready(function() {

    $('#login').on('blur', function() {
	var input = $(this);
	var login_length = input.val().length;
        
            if(login_length >= 3 && login_length <= 30){
                input.removeClass("invalid").addClass("valid");
                input.next('.komunikat').text("Wprowadzono poprawny login.").removeClass("blad").addClass("ok");
				
				jQuery.ajax({
                                url: "sprawdz_login.php",
                                data:'login='+$("#login").val(),
                                type: "POST",
                                success:function(data){
                                $("#login-availability-status").html(data);
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

    $('#imie').on('blur', function() {
	var input = $(this);
	var imie_length = input.val().length;
        
            if(imie_length >= 4 && imie_length <= 15){
		input.removeClass("invalid").addClass("valid");
		input.next('.komunikat').text("Wprowadzono poprawną nazwę.").removeClass("blad").addClass("ok");
		}
            else{
		input.removeClass("valid").addClass("invalid");
		input.next('.komunikat').text("Nazwa musi mieć więcej niż 3 i mniej niż 16 znaków!").removeClass("ok").addClass("blad");
			
            }
    });
	
    $('#nazwisko').on('blur', function() {
	var input = $(this);
	var nazwisko_length = input.val().length;
            
            if(nazwisko_length >= 2 && nazwisko_length <= 20){
		input.removeClass("invalid").addClass("valid");
		input.next('.komunikat').text("Wprowadzono poprawna nazwę.").removeClass("blad").addClass("ok");
            }
            else{
		input.removeClass("valid").addClass("invalid");
		input.next('.komunikat').text("Nazwa musi mieć wiecej niż 2 i mniej niż 21 znaków!").removeClass("ok").addClass("blad");
			
            }
    });
	
    $('#email').on('blur', function() {
	var input = $(this);
	var pattern = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
	var is_email = pattern.test(input.val());
	
            if(is_email){
		input.removeClass("invalid").addClass("valid");
		input.next('.komunikat').text("Wprowadzono poprawny email.").removeClass("blad").addClass("ok");
				 jQuery.ajax({
										url: "sprawdz_login.php",
										data:'email='+$("#email").val(),
										type: "POST",
										success:function(data){
										$("#email-availability-status").html(data);
										},
										error:function (){
										}
				});
            }
            else{
		input.removeClass("valid").addClass("invalid");
		input.next('.komunikat').text("Wprowadz niepoprawny email!").removeClass("ok").addClass("blad");
            }
    });	
	
    $('#submit').click(function(event){
	var login = $('#login');
	var imie = $('#imie');
	var nazwisko = $('#nazwisko');
	var email = $('#email');
			
            if(login.hasClass('valid') && email.hasClass('valid') && imie.hasClass('valid') && nazwisko.hasClass('valid')){
		alert("Pomyślnie wyslano formularz.");	
            }
            else {
                event.preventDefault();
		alert("Uzupełnij wszystkie pola poprawnie!");	
            }
    });
});
</script>
<?php
        }else{
            
            //echo '<meta http-equiv="refresh" content="3; URL=hide1.php">';
            echo '<p style="padding-top:10px;"><hr /><h3><center><strong>Mineły dwa dni poazwalajace na edycję Twoich danych.</strong><br>Skontaktuj się z administratorem.</center></h3></p>';
        }
        
    }
    else {
        echo '<meta http-equiv="refresh" content="1; URL=index.php">';
        echo '<p style="padding-top:10px;"><hr /><h3><center><strong>Próba nieautoryzowanego dostępu...</strong><br>trwa przenoszenie do formularza logowania</center></h3></p>';
    }
    
?>
            
<?php
    require_once('footer.php');
?>
</div>
</body>
</html>
    
    
    