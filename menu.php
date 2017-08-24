<?php
		$rozmiar_obrazu = '60';
        session_start();
        require_once('db.php');
		

        
		  		  
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
		$page_title = 'Edycja menu';
        require_once('header.php');
		require_once('navmenu.php');
        
           
?>
<div class="container">
<a href="?action=addmenu">Dodaj</a>

<table class="table table-striped" border="0"  width="100%" cellspacing="20" cellpading="10" bgcolor="silver" align="center">
	<thead>
		<tr>
			<th>Zdjęcie</th> <th>ID</th> <th>Data utworzenia</th> <th>Nazwa</th> <th>Składniki</th> <th>Cena</th> <th>Opcje</th>
		</tr>
	</thead>
	<tbody>
	<?php
	$menu = "SELECT * FROM menu ORDER BY id";
	$result = mysql_query($menu) or die("Błąd zapytania:" .mysql_error());
		while ($r = mysql_fetch_array($result)) {
	?>
	<tr align="left">
		<td bgcolor="white">
			<?php if(empty($r['zdjecie'])) {
			}
			else {
				echo '<img src="data:image/jpeg;base64,'.base64_encode($r['zdjecie']).'"width="'.$rozmiar_obrazu.'"/>';
			}	
			?>
		</td>
		
		<td bgcolor="white" width="5%">
			<?php echo $r['id']; ?>
		</td>
		
		<td bgcolor="white" >
			<?php echo $r['data_utworzenia']; ?>
		</td>
		
		<td bgcolor="white" >
			<?php echo $r['nazwa']; ?>
		</td>
		
		<td bgcolor="white">
			<?php echo $r['skladniki']; ?>
		</td>
		
		<td bgcolor="white">
			<?php echo $r['cena']; ?>
		</td>
		
		<td bgcolor="white" witdth="5%" alignt="right">
			<a href="?action=edit&id=<?php
			echo $r['id']; ?>">Edytuj</a>
			<a href="?action=delete&id=<?php
			echo $r['id']; ?>&nazwa=<?php
			echo $r['nazwa']; ?>">Usuń</a>
		</td>
	</tr>
	
	<?php
		}?>
		</tbody>
			</table>

<?
		if ($_GET["action"] == "addmenu") {
			
			$id = $_GET["id"];
			
			$result = mysql_query("SELECT * FROM menu WHERE id='$id' LIMIT 1") or die(mysql_error());
			$dane = mysql_fetch_array($result);
			
			
			
			echo '
			<form enctype="multipart/form-data" class="form-horizontal" method="POST" action="addmenu.php">
			<fieldset>

			<legend><center><h4><hr />Dodaj nową pizzę</h4></center></legend>
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
				<label class="col-md-5 control-label" for="cena">Cena</label>  
				<div class="col-md-3">
				<input id="cena" name="cena" type="text" placeholder="cena" class="form-control input-md" required="">
				</div>
			</div>
			
			<div class="form-group">
				<label class="col-md-5 control-label" for="skladniki">Składnik 1</label>  
				<div class="col-md-3">
					<select name="skladnik1">
						';
	$result1 = mysql_query("SELECT * FROM skladniki") or die(mysql_error());
				while($s = mysql_fetch_array($result1)) {
					echo '
						<option> '.$s['nazwa'].' </option>
						';
				}
			echo '
					</select>
				</div>
			</div>
			
			<div class="form-group">
				<label class="col-md-5 control-label" for="skladniki">Składnik 2</label>  
				<div class="col-md-3">
					<select name="skladnik2">
						';
	$result1 = mysql_query("SELECT * FROM skladniki") or die(mysql_error());
				while($s = mysql_fetch_array($result1)) {
					echo '
						<option> '.$s['nazwa'].' </option>
						';
				}
			echo '
					</select>
				</div>
			</div>
			
			<div class="form-group">
				<label class="col-md-5 control-label" for="skladniki">Składnik 3</label>  
				<div class="col-md-3">
					<select name="skladnik3">
						';
	$result1 = mysql_query("SELECT * FROM skladniki") or die(mysql_error());
				while($s = mysql_fetch_array($result1)) {
					echo '
						<option> '.$s['nazwa'].' </option>
						';
				}
			echo '
					</select>
				</div>
			</div>
			
			<div class="form-group">
				<label class="col-md-5 control-label" for="skladniki">Składnik 4</label>  
				<div class="col-md-3">
					<select name="skladnik4">
						';
	$result1 = mysql_query("SELECT * FROM skladniki") or die(mysql_error());
				while($s = mysql_fetch_array($result1)) {
					echo '
						<option> '.$s['nazwa'].' </option>
						';
				}
			echo '
					</select>
				</div>
			</div>
			
			<div class="form-group">
			  <label class="col-md-5 control-label" for="submit"></label>
			  <div class="col-md-3">
				<input type="hidden" id="id" name="id" value="'.$dane['id'].'">
				<button id="submit" name="submit" class="btn btn-success">Dodaj</button>
				</div>
			</div>
			</fieldset>
			</form>';
			
			
		}	
		
		if ($_GET["action"] == "edit") {
			
			$id = $_GET["id"];
			
			$result = mysql_query("SELECT * FROM menu WHERE id='$id' LIMIT 1") or die(mysql_error());
			$dane = mysql_fetch_array($result);
			
			
			echo '
			<form enctype="multipart/form-data" class="form-horizontal" method="POST" action="editmenu.php">
			<fieldset>

			<legend><center><h4><hr />Edycja pizzy: '.$dane['nazwa'].'</h4></center></legend>
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
			
			<<div class="form-group">
				<label class="col-md-5 control-label" for="skladniki">Składnik 1</label>  
				<div class="col-md-3">
					<select name="skladnik1">
						';
	$result1 = mysql_query("SELECT * FROM skladniki") or die(mysql_error());
				while($s = mysql_fetch_array($result1)) {
					echo '
						<option> '.$s['nazwa'].' </option>
						';
				}
			echo '
					</select>
				</div>
			</div>
			
			<div class="form-group">
				<label class="col-md-5 control-label" for="skladniki">Składnik 2</label>  
				<div class="col-md-3">
					<select name="skladnik2">
						';
	$result1 = mysql_query("SELECT * FROM skladniki") or die(mysql_error());
				while($s = mysql_fetch_array($result1)) {
					echo '
						<option> '.$s['nazwa'].' </option>
						';
				}
			echo '
					</select>
				</div>
			</div>
			
			<div class="form-group">
				<label class="col-md-5 control-label" for="skladniki">Składnik 3</label>  
				<div class="col-md-3">
					<select name="skladnik3">
						';
	$result1 = mysql_query("SELECT * FROM skladniki") or die(mysql_error());
				while($s = mysql_fetch_array($result1)) {
					echo '
						<option> '.$s['nazwa'].' </option>
						';
				}
			echo '
					</select>
				</div>
			</div>
			
			<div class="form-group">
				<label class="col-md-5 control-label" for="skladniki">Składnik 4</label>  
				<div class="col-md-3">
					<select name="skladnik4">
						';
	$result1 = mysql_query("SELECT * FROM skladniki") or die(mysql_error());
				while($s = mysql_fetch_array($result1)) {
					echo '
						<option> '.$s['nazwa'].' </option>
						';
				}
			echo '
					</select>
				</div>
			</div>
			
			<div class="form-group">
				<label class="col-md-5 control-label" for="cena">Cena</label>  
				<div class="col-md-3">
				<input id="cena" name="cena" type="text" placeholder="cena" class="form-control input-md" required="" value="'. $dane['cena']. '">
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
			
			$result = mysql_query("SELECT * FROM menu WHERE id='$id' LIMIT 1") or die(mysql_error());
			$dane = mysql_fetch_array($result);
			
			echo '
			<form class="form-horizontal" method="POST" action="deletemenu.php">
			<fieldset>

			<legend><center><h4><hr />Usunięcie pizzy: '.$dane['nazwa'].'</h4></center></legend>
			<form>
			<div class="form-group">
			<label class="col-md-9 control-label"><h3>Czy napewno chcesz usunąć pizzę '.$nazwa.'?</h3></label>
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
		
		$page_title = 'Menu';
		require_once('header.php');
		require_once('navmenu.php');
		
	?>
		
		<div class="container">
	<div class="row">
		<div class="col-md-12">
			<table class="table table-hover">
				<thead>
					<tr>
						<th>
							Pizza
						</th>
						<th>
							ID
						</th>
						<th>
							Pizza
						</th>
						<th>
							Składniki
						</th>
						<th>
							Cena
						</th>
					</tr>
				</thead>
				<tbody>
				<?php
	$menu = "SELECT * FROM menu ORDER BY id";
	$result = mysql_query($menu) or die("Błąd zapytania:" .mysql_error());
		while ($r = mysql_fetch_array($result)) {
	?>
					<tr>
						<td>
						<?php if(empty($r['zdjecie'])) {
							}
							else {
								echo '<img src="data:image/jpeg;base64,'.base64_encode($r['zdjecie']).'"width="'.$rozmiar_obrazu.'"/>';
							}	
							?> 
						</td>
						<td>
							<?php echo $r['id']; ?>
						<td>
							<?php echo $r['nazwa']; ?>
						</td>
						<td>
							<?php echo $r['skladniki']; ?>
						</td>
						<td>
							<?php echo $r['cena']; ?> PLN
						</td>
						<?php if ($aktywne > 0){ ?>
						<td bgcolor="white" witdth="5%" alignt="right">
							<a href="?action=addzamowienie&id=<?php
							echo $r['id']; ?>">Wybierz</a>
						</td>
						<?php } ?>
					</tr>
					
	<?php
		}?>
				</tbody>
			</table>
			<?
		if ($_GET["action"] == "addzamowienie") {
			
			$id = $_GET["id"];
			
			$result = mysql_query("SELECT * FROM menu WHERE id='$id' LIMIT 1") or die(mysql_error());
			$dane = mysql_fetch_array($result);
			
			
			echo '
			<form enctype="multipart/form-data" class="form-horizontal" method="POST" action="addzamowienie.php">
			<fieldset>

			<legend><center><h4><hr />Zamów pizze '. $dane['nazwa'].' za '.$dane['cena'].' zł'.$dane['id'].'</h4></center></legend>
			<form>
			
			
			<div class="form-group">
			  <label class="col-md-5 control-label" for="submit"></label>
			  <div class="col-md-3">
				<input type="hidden" id="id" name="id" value="'.$dane['id'].'">
				<button id="submit" name="submit" class="btn btn-success">Zamów</button>
				</div>
			</div>
			</fieldset>
			</form>';
			
			
		}?>
		</div>
	</div>
</div>
 <?php  
		
    }

 


  require_once('footer.php');
  
?>
	 
</body>
</html>