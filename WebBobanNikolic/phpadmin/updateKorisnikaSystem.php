<?php 
session_start();

//konektovanje sa bazom!
$mysqli = new mysqli("localhost", "root", "", "wp_projekat_videoigre_db");

if($mysqli->error){
	die("Greska prilikom konektovanja s bazom: " . $mysqli->error);
}
//kraj konektovanja sa bazom


if(isset($_POST['btnAdmin'])){

	$upitAdmin = "UPDATE korisnik SET usertype = 'admin' WHERE idKorisnik = '"
		. $_SESSION['izabraniKorisnik'] . "'";

	$rezUpita = $mysqli->query($upitAdmin) or die($mysqli->error . " " . $mysqli->errno);
	
	$_SESSION['message1'] = "Korisnika <b>" . $_SESSION['imePrezime123'] . "</b> (ID: <b>" . $_SESSION['izabraniKorisnik'] . "</b>) ste uspešno unapredili u <b>admina</b>!";

	header('Location: ../adminSide.php#updateKorisnika'); //BITNO: Redirect to the specific part of the page you want to redirect to! 

}


if(isset($_POST['btnObrisi'])){

	$upitBrisanje = "DELETE FROM korisnik WHERE idKorisnik = '" 
		. $_SESSION['izabraniKorisnik'] . "'";

	$rezBrisanja = $mysqli->query($upitBrisanje) or die($mysqli->error ." ". $mysqli->errno);

	if($mysqli->affected_rows != 0){
		$_SESSION['obrisaniKor'] = "Korisnik <b>" . $_SESSION['imePrezime123'] . "</b> (ID: <b>" . $_SESSION['izabraniKorisnik'] . "</b>) je <b>obrisan!</b>";
	}else{
		$_SESSION['obrisaniKor'] = "<b>Brisanje nije uspelo!</b> Probajte ponovo.";
	}

	header('Location: ../adminSide.php#updateKorisnika');


}


 ?>
