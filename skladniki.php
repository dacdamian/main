<?php

        session_start();
        require_once('db.php');
		$rozmiar_obrazu = '50';

        
		  		  
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

	$user = $_SESSION['user'];
    $sql = mysql_num_rows(mysql_query("SELECT * FROM `users` WHERE `login` = '$user' AND aktywne='2'"));
	 
    if (($_SESSION['auth'] == TRUE) && ($sql != 0 )) {
		$page_title = 'Składniki';
        require_once('header.php');
		require_once('navmenu.php');
           
?>
<div class="container">
<a href="?action=add">Dodaj</a>
<table class="table table-striped" border="0"  width="100%" cellspacing="20" cellpading="10" bgcolor="silver" align="center">
	<thead>
		<tr>
			 <th>ID</th> <th>Zdjęcie</th> <th>Data aktualizacji</th> <th>Nazwa</th> <th>Stan</th> <th>Opcje</th>
		</tr>
	</thead>
	<tbody>
	<?php
	$menu = "SELECT * FROM skladniki ORDER BY id";
	$result = mysql_query($menu) or die("Błąd zapytania:" .mysql_error());
		while ($r = mysql_fetch_array($result)) {
	?>
	<tr align="left">
		<td bgcolor="white" width="5%">
			<?php echo $r['id']; ?>
		</td>
		
		<td bgcolor="white">
			<?php if(empty($r['zdjecie'])) { 
			echo '';
			}
			else{
				echo '<img src="data:image/jpeg;base64,'.base64_encode($r['zdjecie']).'"width="'.$rozmiar_obrazu.'"/>';
			}
			?>
		</td>
		
		<td bgcolor="white" >
			<?php echo $r['data_utworzenia']; ?>
		</td>
		
		<td bgcolor="white" >
			<?php echo $r['nazwa']; ?>
		</td>
		
		<td bgcolor="white">
			<?php if($r['stan'] == 0) {
			echo '<b>brak</b>';
			}elseif($r['stan'] < 2) {
			echo ' końcówka';
			}else{
			echo 'jest sporo';}?>
		</td>
		
		<td bgcolor="white" witdth="10%" alignt="right">
			<a href="?action=edit&id=<?php
			echo $r['id']; ?>">Edytuj</a>
			<a href="?action=delete&id=<?php
			echo $r['id']; ?>&login=<?php
			echo $r['login']; ?>">Usuń</a>
		</td>
	</tr>
	
	<?php
		}?>
		</tbody>
			</table>

<?
		if ($_GET["action"] == "add") {
			
			$id = $_GET["id"];
			
			$result = mysql_query("SELECT * FROM skladniki WHERE id='$id' LIMIT 1") or die(mysql_error());
			$dane = mysql_fetch_array($result);
			
			
			echo '
			<form enctype="multipart/form-data" class="form-horizontal" method="POST" action="addskladniki.php">
			<fieldset>

			<legend><center><h4><hr />Dodaj składnik</h4></center></legend>
			<form>
			
			<div class="form-group">
			  <label class="col-md-5 control-label" for="zdjecie">Zdjęcie</label>  
			  <div class="col-md-3">
			  <input id="zdjecie" name="zdjecie" type="file" placeholder="zdjecie" class="form-control input-md">  
			  </div>
			</div>
			
			<div class="form-group">
				<label class="col-md-5 control-label" for="nazwa">Nazwa</label>  
				<div class="col-md-3">
				<input id="nazwa" name="nazwa" type="text" placeholder="nazwa" class="form-control input-md" required="">
				</div>
			</div>
			
			<div class="form-group">
				<label class="col-md-5 control-label" for="stan">Dostępność</label>  
				<div class="col-md-3">
				<select name="stan">
					<option>0</option>
					<option>1</option>
					<option>2</option>
				</select>
				</div>
			</div>
			
			<div class="form-group">
			  <label class="col-md-5 control-label" for="submit"></label>
			  <div class="col-md-3">
				<input type="hidden" id="id" name="id">
				<button id="submit" name="submit" class="btn btn-success">Dodaj</button>
				</div>
			</div>
			</fieldset>
			</form>';
			
			
		}

		if ($_GET["action"] == "edit") {
			
			$id = $_GET["id"];
			
			$result = mysql_query("SELECT * FROM skladniki WHERE id='$id' LIMIT 1") or die(mysql_error());
			$dane = mysql_fetch_array($result);
			
			
			echo '
			<form enctype="multipart/form-data" class="form-horizontal" method="POST" action="editskladniki.php">
			<fieldset>

			<legend><center><h4><hr />Edycja składników: '.$dane['nazwa'].'</h4></center></legend>
			<form>
			
			<div class="form-group">
			  <label class="col-md-5 control-label" for="zdjecie">Zdjęcie</label>  
			  <div class="col-md-3">
			  <input id="zdjecie" name="zdjecie" type="file" placeholder="zdjecie" class="form-control input-md">  
			  </div>
			</div>
			
			<div class="form-group">
				<label class="col-md-5 control-label" for="nazwa">Nazwa</label>  
				<div class="col-md-3">
				<input id="nazwa" name="nazwa" type="text" placeholder="nazwa" class="form-control input-md" required="" value="'.$dane['nazwa'].'">
				</div>
			</div>
			
			<div class="form-group">
				<label class="col-md-5 control-label" for="stan">Dostępność</label>  
				<div class="col-md-3">
				<input id="stan" name="stan" type="text" placeholder="stan" class="form-control input-md" required="" value="'.$dane['stan'].'">
				</div>
			</div>
			
			<div class="form-group">
			  <label class="col-md-5 control-label" for="submit"></label>
			  <div class="col-md-3">
				<input type="hidden" id="id" name="id" value="'.$dane['id'].'">
				<button id="submit" name="submit" class="btn btn-success">Edytuj</button>
				</div>
			</div>
			</fieldset>
			</form>';
			
			
		}
		if($_GET['action']  == "delete") {
			$id = $_GET['id'];
			$nazwa = $_GET['nazwa'];
			
			$result = mysql_query("SELECT * FROM skladniki WHERE id='$id' LIMIT 1") or die(mysql_error());
			$dane = mysql_fetch_array($result);
			
			echo '
			<form class="form-horizontal" method="POST" action="deleteskladniki.php">
			<fieldset>

			<legend><center><h4><hr />Usunięcie składniku '.$dane['nazwa'].'</h4></center></legend>
			<form>
			<div class="form-group">
			<label class="col-md-9 control-label"><h3>Czy napewno chcesz usunąć składnik '.$nazwa.'?</h3></label>
			</div>
			
			<div class="form-group">
			  <label class="col-md-8 control-label" for="submit"></label>
			  <div class="col-md-4">
				<input type="hidden" id="login" name="login" value="'.$dane['nazwa'].'">
				<input type="hidden" id="id" name="id" value="'.$dane['id'].'">
				<button id="submit" name="submit" class="btn btn-success"> TAK </button>
				</div>
			</div>
			</fieldset>
		</form>
		</div>';}
			
			
	?>

			
<?php
    }
    else {
		if ($_SESSION['auth'] == TRUE)  {
		$page_title = 'Strona startowa';
		require_once('header.php');
		require_once('navmenu.php');
        echo '<meta http-equiv="refresh" content="5; URL=index.php">';
        echo '<div class="container"><h3><p style="padding-top:10px;"><center><strong>Próba nieautoryzowanego dostępu...</strong><br>
		trwa przenoszenie do strony głównej</center></p></h3></div>';}
		
		else{
		$page_title = 'Strona startowa';
		require_once('header.php');
		require_once('navmenulogout.php');
        echo '<meta http-equiv="refresh" content="5; URL=index.php">';
        echo '<div class="container"><h3><p style="padding-top:10px;"><center><strong>Próba nieautoryzowanego dostępu...</strong><br>
		trwa przenoszenie do formularza logowania</center></p></h3></div>';
    }}
?>
 
<?php

  require_once('footer.php');
  
?>
	 
</body>
</html>
<?
/*$wynik = "SELECT login, imie, nazwisko, email, data_urodznia, zdjecie FROM users";
 
echo ".$wynik.";
?>*/