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
			$page_title = 'Zmiana zdjecia';
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
                    $stare_haslo = $r['haslo'];
					

                }
            }
?>
<form enctype="multipart/form-data" class="form-horizontal" action="zmiana_zdjecia.php" method="POST">
<fieldset>

<legend><center><h2><hr />Zmiana zdjecia</h2></center></legend>

<form>
<div class="container">
<div class="form-group">
  <label class="col-md-4 control-label" for="zdjecie">Zdjęcia</label>  
  <div class="col-md-4">
  <input id="zdjecie" name="zdjecie" type="file" placeholder="zdjecie" class="form-control input-md">
  <span class="komunikat"></span>  
  </div>
</div>


<div class="form-group">
  <label class="col-md-4 control-label" for="submit"></label>
  <div class="col-md-4">
    <button id="submit" name="submit" class="btn btn-success">Zmień</button>
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