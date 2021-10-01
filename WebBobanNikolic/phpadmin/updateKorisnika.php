<div id="updateKorisnika" class="tab-pane fade main">
	<!--Poruke za uspešno unapređenje korisnika u admin-a -->
	<?php if(isset($_SESSION["message1"])){ ?>
		<div class="alert alert-success alert-dismissible" role="alert">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<strong>Promene izvršene!</strong> <?php echo $_SESSION["message1"]; ?>
		</div>
	<?php 
		unset($_SESSION["message1"]);
	 }
	 ?>

	 <!-- Poruka o uspešno obrisanom korisniku -->
	 <?php if(isset($_SESSION['obrisaniKor'])){
	 	?>
	 	<div class="alert alert-danger alert-dismissible" role="alert">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<?php echo $_SESSION['obrisaniKor']; ?>
		</div>
	 <?php
	 	unset($_SESSION['obrisaniKor']);
	 } 
	 ?>
	<div class="page-header">
		<h2>Ažuriraj korisnika</h2>
	</div>


	<form action="#updateKorisnika" method="POST">
		<div class="form-group">

			<label for="kriterijumDropDown" style="margin-right: 15px;">Izaberite kriterijum pretrage:</label>
			<select name="pretragaKorisnika[]" id="kriterijumDropDown" required="true" onchange="promena();"> <!--BITNO: Definisali smo select drop down kao array
				time sto smo u name-u stavili '[]'. Sada ce $_POST['pretragaKorisnika'] da bude array! -->
				<option value>---Izaberite kriterijum---</option>
				<option value="idKorisnik">ID Korisnika</option>
				<option value="email">Email</option>
			</select>
		</div>
		<!--TO-DO: IMACEMO DVA inputa u slucaju da admin izabere opciju da bira po imenu i prezimenu, u suprotnom ce biti jedan input (PREDLOG: Mozda staviti inpute kao sakrivene, pa kad selektuje admin nesto, da mu se prikazu) -->
		<div class="form-group">
			<label for="podatak" style="margin-right: 15px;">Unesite podatak:</label>
			<input type="text" name="podatak" id="podatak" required="true" placeholder="Kriterijum" style="margin-right: 20px; width: 250px;">
			<input type="submit" name="btnTrazi" class="btn btn-primary" value="Traži" style="width: 90px; vertical-align: bottom;">
		</div>
	</form>
	<br>

	<?php include "phpadmin/updateKorisnikaMain.php" ?>


</div>