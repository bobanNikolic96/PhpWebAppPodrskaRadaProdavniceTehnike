<?php 

//konektovanje sa bazom!
$mysqli = new mysqli("localhost", "root", "", "wp_projekat_videoigre_db");

if($mysqli->error){
	die("Greska prilikom konektovanja s bazom: " . $mysqli->error);
}
//kraj konektovanja sa bazom



if(isset($_POST["btnTrazi"])){

	//za svaku opciju u select drop down meniju!
	foreach ($_POST['pretragaKorisnika'] as $selekovanaVr) {
		$upitKorisnik = "SELECT * FROM korisnik WHERE $selekovanaVr = '" . $_POST['podatak'] . "'";
	}

	$rezUpita = $mysqli->query($upitKorisnik) or die($mysqli->error . " " . $mysqli->errno);

	if($red = $rezUpita->fetch_assoc()){

		?>
		<!--Ispis korisnika! -->
		<p>Podaci korisnika(ID: <b><?php echo $red['idKorisnik']; ?></b>):</p>
		<p>Ime i prezime: <b><?php echo $red['ime'] . " " . $red['prezime']; ?></b></p>
		<p>Email: <b><?php echo $red['email']; ?></b></p>
		<p>Broj telefona: <b><?php echo $red['brojTelefona'] ?></b></p>
		<p>Pol: <b><?php if($red['pol'] == "M") echo "Muški"; else echo "Ženski"; ?></b></p>
		<p style="margin-bottom: 20px;">Tip korisnika: <b><?php echo $red['usertype'] ?></b></p>

		<form action="phpadmin/updateKorisnikaSystem.php" method="POST" style="margin-bottom: 15px;">
			<?php if($red['usertype'] == "user") { ?>
			<input type="submit" name="btnAdmin" value="Unapredi u administratora" style="margin-right: 15px;"  class="btn btn-warning">
			<?php } else { ?>
			<input type="submit" name="btnAdmin" value="Unapredi u administratora" style="margin-right: 15px;" disabled="true" data-toggle = "tooltip" title="Korisnik je već administrator!"  class="btn btn-warning">
			<?php } ?>
			<?php $_SESSION['izabraniKorisnik'] = $red['idKorisnik'];
				  $_SESSION['imePrezime123'] = $red['ime'] . " " . $red['prezime']; ?>
			<?php if( $_SESSION['idKorisnik'] != $red['idKorisnik']) { ?> <!--Ako nismo mi odna mozemo da ga brisemo -->
			<input type="submit" name="btnObrisi" value="Obriši korisnika" class="btn btn-danger">
			<?php } ?>
		</form>
		<?php


	}
	else{
		foreach ($_POST['pretragaKorisnika'] as $selekovanaVr) {
		echo "Nema traženog korisnika sa zadatim kriterijumom (<b>" 
		. $selekovanaVr . " = " . $_POST['podatak'] . "</b>)";
		}
	}



}


 ?>