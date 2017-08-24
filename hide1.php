<?php

        session_start();
        require_once('db.php');
		$foto_size = 250;

        
		  		  
?>
<html lang="pl_PL">
<head>
    <meta http-equiv="Content-type" CONTENT="text/html; charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Formularz rejestracyjny html</title>

    <!-- Bootstrap -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<script src="bootstrap/js/bootstrap.js" language="javascript" type="text/javascript"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
</head>
<body>
      
<?php
     
    if ($_SESSION['auth'] == TRUE) {
		$page_title = 'Dane uzytkownika';
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
				
            }
            
        }
           
?>
<form class="form-horizontal">
<fieldset>

<legend><center><h2><hr />Moje dane</h2></center></legend>
<center>
<?php
require_once('zdjecie.php');
?>
</center><br>
<form>
<div class="container">

<div class="form-group">
  <label class="col-md-4 control-label" for="Login">Login</label>  
  <div class="col-md-4">
  <input id="login" name="login" type="text" placeholder="login" class="form-control input-md" required="" value="<?php echo $login; ?>" readonly>
  <span class="komunikat" id="status"></span>
  </div>
</div>

<div class="form-group">
  <label class="col-md-4 control-label" for="imie">Imie</label>  
  <div class="col-md-4">
  <input id="imie" name="imie" type="text" placeholder="imie" class="form-control input-md" required="" value="<?php echo $imie; ?>" readonly>
  <span class="komunikat"></span>
  </div>
</div>

<div class="form-group">
  <label class="col-md-4 control-label" for="nazwisko">Nazwisko</label>  
  <div class="col-md-4">
  <input id="nazwisko" name="nazwisko" type="text" placeholder="nazwisko" class="form-control input-md" required="" value="<?php echo $nazwisko; ?>" readonly>
  <span class="komunikat"></span>
  </div>
</div>

<div class="form-group">
  <label class="col-md-4 control-label" for="data_urodzenia">Data urodzenia</label>  
  <div class="col-md-4">
  <input id="data_urodzenia" name="data_urodzenia" type="date" placeholder="data" class="form-control input-md" required="" value="<?php echo $data_ur; ?>" readonly>
  <span class="komunikat"></span>  
  </div>
</div>

<div class="form-group">
  <label class="col-md-4 control-label" for="email">E-mail</label>  
  <div class="col-md-4">
  <input id="email" name="email" type="text" placeholder="email" class="form-control input-md" required="" value="<?php echo $email; ?>" readonly>
  <span class="komunikat"></span>  
  </div>
</div>

<div class="form-group">
  <label class="col-md-4 control-label" for="data_utworzenia">Data utworzenia</label>  
  <div class="col-md-4">
  <input id="data_utworzenia" name="data_utworzenia" type="date" placeholder="data" class="form-control input-md" required="" value="<?php echo $data_ut; ?>" readonly>
  <span class="komunikat"></span>  
  </div>
</div>
</div>

</fieldset>

</form>
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