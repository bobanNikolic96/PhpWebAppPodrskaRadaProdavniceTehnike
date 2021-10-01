<?php 
session_start();

$mysqli = new mysqli("localhost", "root", "", "prodavnicatehnike");

if($mysqli->error){
	die("Greska prilikom konektovanja s bazom: " . $mysqli->error);
}


if(isset($_POST['checkoutBtn'])){

	//TO-DO UPDATE INSERT NAREDBE DA SE UPISUJE I idKorisnika koji je izvrsio porudzbinu,
	//kao i zip_code koji smo naknadno dodali u tabelu. I UBACITI ZIP CODE POLJE U  formu
	//na stranici korpe (po ugledu na PPP projekat)
	$idNarudzbenice = "NAR" . rand(0, 999999);
	$upitDodajNarudzbenicu = "INSERT INTO narudzbenica (idNarudzbenice, idKorisnik, datumVreme, adresa_za_isporuku, grad, zip_code,  totalCena) VALUES ('" . $idNarudzbenice . "', '" . $_SESSION['idKorisnik'] . "', '"
		. $_POST['currDateTime'] . "', '" . $_POST['adresa'] . "', '" . $_POST['grad'] . 
		"', '" .  $_POST['zip_code'] . "', '" . $_SESSION['totalPrice'] . "')";

	$rezUpitaNar = $mysqli->query($upitDodajNarudzbenicu) or die($mysqli->error);
	
	$redniBr = 1; 
	foreach ($_SESSION['shopping_cart'] as $key => $value) {
		//******sad za svaki proizvod u korpi pravimo stavku narudzbenice******
		$ukupnaCena = $value['cena'] * $value['kolicina'];
		$upitDodajStavkuNar = "INSERT INTO stavka_narudzbenice(idNarudzbenice, idProizvoda, redniBr, izabranaKolicina, ukupnaCena) VALUES ('" . $idNarudzbenice . "', '" 
			. $value['id']. "', '" . $redniBr . "', '" . $value['kolicina'] . "', '" . 
			$ukupnaCena . "')";

		$rezUpitaStavka = $mysqli->query($upitDodajStavkuNar) or die($mysqli->error);

		$redniBr += 1;

	}

	$_SESSION['orderSucceed'] = true;
	$_SESSION['isporuka'] = $_POST['adresa'] . ", " . $POST['zip_code'] ." " . $_POST['grad'];
	$_SESSION['idNarudzbenice'] = $idNarudzbenice; //ovo nam treba za kasniji ispis narudzbenice (kako bismo pristupili njoj i svim njenim stavkama)!

	unset($_SESSION['shopping_cart']);

	header('Location: ../narudzbenicaPage.php');

}


?>