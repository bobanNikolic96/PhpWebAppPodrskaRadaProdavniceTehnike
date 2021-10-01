<?php
session_start();



$mysqli = new mysqli("localhost", "root", "", "wp_projekat_videoigre_db");

if($mysqli->error){
	die("Greska prilikom konektovanja s bazom: " . $mysqli->error);
}



if(isset($_FILES["imgUpload"])){
	$valid_types = array("image/jpg", "image/jpeg", "image/png");

	$tipFajla = $_FILES['imgUpload']['type'];
					if(in_array($tipFajla, $valid_types)){ //ukoliko smo izabrali tip fajla sliku

						//premestimo sliku u odgovarajuci folder
						//u nasem slucaju treba je premestiti u folder img (navodimo u promenljivoj $target)
						$source = $_FILES['imgUpload']['tmp_name'];
						$target = '../img/' . $_FILES['imgUpload']['name'];

						move_uploaded_file($source, $target);
						
						// $imgStr = "Postavili ste sliku: <br>";
						// $imgStr .= "<p>
						// <img src=\"$target\" style =\"width: 150px; height: 200px;\">
						// </p>";
						// echo $imgStr;
						

						
					}
					else {
						//echo "<p>Izabrali ste pogresnu ekstenziju fajla!</p>";
					}
				}
				


				if(isset($_POST['btnDodajIgru'])){

					$nazivSlike = $_FILES['imgUpload']['name'];
					$alt_slike = "Slika " .$_POST['nazivIgre'] . " | Gamer" . "\'"  ."s shopping area";

					$upitDodaj = "INSERT INTO video_igra(idProizvoda, naziv, platforma, kolicina, opis, cena, developer, popust, slika, alt_slika, stanje, datumIzlaska, pegi, zanr) VALUES ('"
					. $_POST['productID'] . "', '"
					. $_POST['nazivIgre'] . "', '"
					. $_POST['platforma'] . "', '"
					. $_POST['kolicinaIgre'] . "', '"
					. $_POST['opis'] . "', '"
					. $_POST['cenaIgre'] . "', '"
					. $_POST['dev'] . "', '"
					. $_POST['popustIgre'] . "', '"
					. $nazivSlike . "', '"
					. $alt_slike . "', '"
					. $_POST['stanje'] . "', '"
					. $_POST['datumIzlaska'] . "', '"
					. $_POST['pegi'] . "', '"
					. $_POST['zanr'] . "')";


					$rezUpita = $mysqli->query($upitDodaj) or die($mysqli->error);

					$_SESSION['dodataIgra'] = $_POST['nazivIgre'];
					$_SESSION['kolDodateIgre'] = $_POST['kolicinaIgre'];
	header('Location: ../adminSide.php'); //redirect!!!

				//na kraju staviti redirect (header metoda) na stranicu adminSide.php, zato sto ova stranica se poziva u okviru njega. (i ova stranica ne sadrzi navBar!!!)


}


?>