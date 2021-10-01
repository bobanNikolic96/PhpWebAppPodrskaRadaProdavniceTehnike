<?php 

session_start();

//konektovanje sa bazom!
$mysqli = new mysqli("localhost", "root", "", "wp_projekat_videoigre_db");

if($mysqli->error){
	die("Greska prilikom konektovanja s bazom: " . $mysqli->error);
}
//kraj konektovanja sa bazom


//Ukoliko smo kliknuli da promenimo sliku
if(isset($_FILES['imgUpload1'])){
	$valid_types = array("image/jpg", "image/jpeg", "image/png");

	$tipFajla = $_FILES['imgUpload1']['type'];
					if(in_array($tipFajla, $valid_types)){ //ukoliko smo izabrali tip fajla da je slika

						//premestimo sliku u odgovarajuci folder
						//u nasem slucaju treba je premestiti u folder img (navodimo u promenljivoj $target)
						$source = $_FILES['imgUpload1']['tmp_name'];
						$target = '../img/' . $_FILES['imgUpload1']['name'];

						move_uploaded_file($source, $target);
						
						// $imgStr = "Postavili ste sliku: <br>";
						// $imgStr .= "<p>
						// <img src=\"$target\" style =\"width: 150px; height: 200px;\">
						// </p>";
						// echo $imgStr;
						

						
					}
					else{
						$_FILES['imgUpload1']['name'] = null;
					}

				}// kraj ubacivanja slike!

				if(isset($_POST['btnAzurirajIgru'])){

					$nazivSlike = $_FILES['imgUpload1']['name'];
					$alt_slike = "Slika " .$_POST['naziv'] . " | Gamer" . "\'"  ."s shopping area";
					$naziv = str_replace("'", "\'", $_POST["naziv"]);

					$updateIgra = "UPDATE video_igra SET "
					. "naziv = '". $naziv . "', "
					. "platforma = '" . $_POST['platforma'] . "', "
					. "kolicina = '" . $_POST['kolicinaIgre'] . "', "
					. "opis = '" . $_POST['opis'] . "', "
					. "cena = '" . $_POST['cena'] . "', "
					. "developer = '" . $_POST['dev'] . "', "
					. "popust = '" . $_POST['popust'] . "', "
					. "alt_slika = '" . $alt_slike . "', " //sliku cu dodati ukoliko nazivSlike nije null, naknadno!
					. "stanje = '" . $_POST['stanje'] . "', "
					. "datumIzlaska = '" . $_POST['datumIzlaska'] . "', "
					. "pegi = '" . $_POST['pegi'] . "', "
					. "zanr = '" . $_POST['zanr'] . "' "
					."WHERE idProizvoda = '" . $_POST['sifraProizvoda'] . "'";

					$rezUpita = $mysqli->query($updateIgra) or die("Greska sa izvrsavanjem upita u bazi: " . $mysqli->error);


					//ukoliko smo promenili sliku, pravimo jos jedan upit da je ubacimo u bazu
					if($nazivSlike != null){
						$upitUpdateSlike = "UPDATE video_igra SET "
						. "slika = '" . $nazivSlike . "' "
						. "WHERE idProizvoda = '" . $_POST['sifraProizvoda'] . "'";

						$rezUpita1 = $mysqli->query($upitUpdateSlike) or die("Greska sa upitom za dodavanjem slike u bazu: " . $mysqli->error);
					}

					//session za uspesno azuriranje
					$_SESSION['uspehUpdateIgra'] = "<b>". $_POST['naziv'] . "</b> (ID: <b>" . $_POST['sifraProizvoda'] . "</b>)";
					header('Location: ../adminSide.php#updateIgre');


				} //kraj azuriranja igre



				//deo za BRISANJE igre
				if(isset($_POST['btnObrisiIgru'])){
					$upitBrisiIgru = "DELETE FROM video_igra WHERE idProizvoda = '" 
					. $_POST['sifraProizvoda'] . "'";

					$upitRez = $mysqli->query($upitBrisiIgru) or die("Greska sa izvrsavanjem upita za brisanje proizvoda u bazi: " . $mysqli->error);
				

				if($mysqli->affected_rows != 0){

					$_SESSION['obrisanaIgra'] = "<strong>Uspeh!</strong> Proizvod <b>". $_POST['naziv'] . "</b> (ID: <b>" . $_POST['sifraProizvoda'] . "</b>) je obrisan.";
				}
				else {
					$_SESSION['obrisanaIgra'] = "Brisanje proizvoda nije uspelo! Probajte ponovo.";
				}

				header('Location: ../adminSide.php#updateIgre');

				}//kraj dela za BRISANJE igre

				?>