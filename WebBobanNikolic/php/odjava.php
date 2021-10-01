 <?php
session_start();

//konekcija s bazom radi update-a kolicine proizvoda
$mysqli = new mysqli("localhost", "root", "", "wp_projekat_videoigre_db");

if($mysqli->error){
	die("Greska prilikom konektovanja s bazom: " . $mysqli->error);
}

if (isset($_SESSION['shopping_cart']) && !empty($_SESSION['shopping_cart'])){
	foreach ($_SESSION['shopping_cart'] as $key => $value) {
		//za svaki proizvod u korpi, prilikom odjave, update-ovati njegovu kolicinu (vratiti mu kolicinu iz korpe!!!)
		$upitUpdateKol = "UPDATE video_igra SET kolicina = kolicina + '" .$value['kolicina']. "'". " WHERE idProizvoda = '" .$value['id']. "'";
		$rezUpdateKol = $mysqli->query($upitUpdateKol) or die("Greska prilikom update-a kolicine u bazi:" . $mysqli->error);
	}
}

$_SESSION = array();
session_destroy(); 
header("Location: ../index.php");

?>