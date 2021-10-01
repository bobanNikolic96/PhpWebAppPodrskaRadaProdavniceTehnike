<?php 


//konekcija sa bazom 
$mysqli = new mysqli("localhost", "root", "", "prodavnicaTehnike");

if($mysqli->error){
	die("Greska prilikom konektovanja s bazom: " . $mysqli->error);
}

if(isset($_POST['idIzabrani'])){ //MORA, u suprotnom izbacuje warning za 'idIzabrani' not set index! (runtime error jer kada se pokrene program 'idIzabrani' nije jos setovan odnosno NISMO JOS KLIKNULI NA DUGME ZA DODAVANJE U KORPU!)
	$izabraniId = $_POST['idIzabrani'];
	$nazivProiz = null;
	$_SESSION['nazivProiz'] = $_POST['nazivProiz'];
//izvrsavanje upita
	$upit = "SELECT * FROM proizvod WHERE idProizvoda = '". $izabraniId."'";


	$rezUpita = $mysqli->query($upit);

	if(!$rezUpita){
		print("Ne moze se izvrsiti upit!");
		die("Greska:" . $mysqli->error .
			"<br>Broj greske: " . $mysqli->errno);
	}

	//OVDE SADA UPDATE-UJEMO KOLICINU U BAZI (ZA KLIK NA DUGME IZ PRODAVNICE, I ZA KLIK NAD DUGME IZ POSEBNOG PROIZ, U OBA SLUCAJA $_POST['izabranaKol'] JE POLJE SA VREDNOSCU KOLICINE KOJU SMO DODALI U KORPU I ZA KOJU TREBA DA SMANJIMO KOLICINU U BAZI)
	$upitUpdateKol = "UPDATE proizvod SET kolicina = kolicina - '".$_POST['izabranaKol']. "'"  . " WHERE idProizvoda = '" . $izabraniId . "'";
	$rezUpdateKol = $mysqli->query($upitUpdateKol) or die("Greska prilikom update-a kolicine u bazi:" . $mysqli->error);



//kraj konekcije sa bazom



	$proiz_ids = array();
	if($rezUpita){
		if($red = $rezUpita->fetch_assoc()){

			if(isset($_SESSION['shopping_cart'])){
		//keep track of how many products are in the shopping cart
				$count = count($_SESSION['shopping_cart']);

		//create sekvencijalni niz koji metchuje kljuceve niza sa id-jem proiz!!!
				$proiz_ids  = array_column($_SESSION['shopping_cart'], 'id');

		//provera da li proizvod koji se dodaje u korpu, ne postoji vec u korpi!
				if(!in_array($izabraniId, $proiz_ids )) {
				$_SESSION['shopping_cart'][$count] = array(
					'id' => $red['idProizvoda'],
					'naziv' => $red['naziv'],
					'vrsta' => $red['vrsta'],
					'kolicina' => $_POST['izabranaKol'],
					'cena' => $red['ukupnaCena']

				);
				}
				else { //ukoliko proizvod postoji vec u korpi, zelimo samo da povecamo kolicinu
			//izabranog proizvoda (umesto da ga opet dodajemo, da ga ne bi korpa smatrala kao drugi proizvod, samo povecavamo dodatu kolicinu)
					for($i = 0; $i < count($proiz_ids ); $i++){
						if($proiz_ids [$i] == $izabraniId){
						$_SESSION['shopping_cart'][$i]['kolicina'] += $_POST['izabranaKol'];
						}
					}

				}

		}
		else { //if shopping cart doesn't exist, create first product with array key 0
		//create array using submited form data, start from key 0 and fill it with values
		$_SESSION['shopping_cart'][0] = array(
			'id' => $red['idProizvoda'],
			'naziv' => $red['naziv'],
			'vrsta' => $red['vrsta'],
			'kolicina' => $_POST['izabranaKol'],
			'cena' => $red['ukupnaCena']

		);
}
}
}
}//kraj if(isset($_POST['idIzabrani']))


if(filter_input(INPUT_GET, 'action') == 'removeItem'){ //ukoliko je user kliknuo na dugme za brisanje item-a iz korpe!!!
	//loop through all products in the shopping cart until it matches with GET id variable
	foreach ($_SESSION['shopping_cart'] as $key => $value) {
		if($value['id'] == filter_input(INPUT_GET, 'id')){

			//****FIRST: UPDATE kolicina iz baze podataka tako da se doda kolicina iz array-a ($_SESSION['shopping_cart'], bice dakle $value['kolicina']) u kolicinu iz baze!
			$upitUpdateKol = "UPDATE proizvod SET kolicina = kolicina + '" .$value['kolicina']. "'" ." WHERE idProizvoda = '" .$value['id']. "'";
			$rezUpdateKol = $mysqli->query($upitUpdateKol) or die("Greska prilikom update-a kolicine u bazi: " . $mysqli->error);


			//remove product from the shopping cart
			unset($_SESSION['shopping_cart'][$key]);
		}
	}
	//reset session array keys so they match with proiz_ids  numeric array 
	//(a ovaj niz podsetimo se, koristimo za lak pristup 'id'-jevima u session varijabli $_SESSION['shopping_cart'])
	$_SESSION['shopping_cart'] = array_values($_SESSION['shopping_cart']);
	//array_values funkcija radi tako sto uzme parametar koji je array (U nasem slucaju $_SESSION['shopping_cart']) i napravi novi niz gde skladisti sve vrednosti iz prosledjenog array-a i dodeli im numericke kljuceve (indexe: 0, 1, 2, ...) za svaku od vrednosti!!!

}

?>


<!--  sada pravimo tabelu da prikazemo podatke!!! -->
<div class="page-header">
	<h2>Proizvodi u vašoj korpi</h2>
</div>
<!-- prikazujemo tabelu samo ako ima proizvoda u korpi!!! -->
<?php if(isset($_SESSION['shopping_cart']) && !empty($_SESSION['shopping_cart'])) {	 ?>
	<div class="table-responsive">
		<table class="table table-striped">
			<tr>
				<th width="40%">Naziv</th>
				<th width="10%">Količina</th>
				<th>Vrsta</th>
				<th width="15%">Cena</th>
				<th width="15%">Ukupna cena</th> <!-- ovo znaci cena * kolicina -->
				<th>Action</th>
			</tr>
			<?php 
			if(!empty($_SESSION['shopping_cart'])){

				$totalPrice = 0; //ukupna cena svih proizvoda

				foreach ($_SESSION['shopping_cart'] as $key => $value) {
					?>
					<tr>
						<td><?php echo $value['naziv']; ?></td>
						<td><?php echo $value['kolicina'] ?></td>
						<td><?php echo $value['vrsta'] ?></td>
						<td><?php echo number_format(($value['cena']), 2, ",", ".") ?> RSD</td>
						<td><?php echo number_format(($value['cena'] * $value['kolicina']), 2, "," , ".") ?> RSD</td>
						<td>
							<a href="korisnickaKorpa.php?action=removeItem&id=
								<?php echo $value['id'] ?>"> <!-- BITNO!!! -->
								<button class="btn-danger"><i class="fa fa-trash-alt fa-lg"></i></button>
							</a>
						</td>
					</tr>

					<?php
					$totalPrice += $value['kolicina'] * $value['cena'];
				} //kraj foreach-a
				?>
				<tr>
					<td></td>
					<td></td>
					<td></td>
					<td><b>Total:</b></td>
					<td align=""><b><?php echo number_format($totalPrice, 2, ",", "."); ?> RSD </b></td>
					<td></td>
					

				</tr>
			</table>
		</div>
		<?php
		if(isset($_SESSION['shopping_cart']) && 
			count($_SESSION['shopping_cart']) > 0){
				?>
				<form action="php/orderSystem.php" method="POST" onsubmit="validateCheckOutForm();">
					<div style="position: relative;"> <!-- samo za pozicioniranje buttona -->
						<div style="position: absolute; right:140px; vertical-align: middle; top: 6px;">
							<?php $_SESSION['totalPrice'] =  $totalPrice; ?>
							Adresa za isporuku: <input type="text" name="adresa" size="30" maxlength="50" class="inputCheckout" placeholder="Adresa" style="margin-right: 5px;" required="true">
							<p style="position: absolute; top: 25px; left: 35px; width: 270px;" class="tipValidacije">Adresa mora biti validna kućna adresa, npr. Kneza Miloša 15</p>
							
							Grad: <input type="text" name="grad" size="12" maxlength="25" placeholder="Grad" class="inputCheckout" required="true" style="margin-right: 5px;">
							<p style="position: absolute; top: 25px; left:355px;" class="tipValidacije">Grad se mora sastojati samo od slova</p>

							Zip code: <input type="number" name="zip_code" class="inputCheckout" min="1" placeholder="Zip" required="true" style="width: 65px;">
							<p style="position: absolute; top: 25px; right:-145px;" class="tipValidacije">Poštanski broj mora sadržati 5 cifara</p>
						</div>
						<input type="hidden" name="currDateTime" id="currDateTime">
						<button type="submit" name="checkoutBtn" id="checkoutBtn" class="btn btn-primary" onclick="DatumVremeIsporuke()">Check out</button>
					</div>
				</form>
				<?php
			}  
		}
		echo "<br><br>";

		?>



<!-- 	</table>
</div> -->


<?php
} //kraj if(isset($_SESSION['shopping_cart'])) 
else {
	echo "Vaša korpa je prazna.";
}

?>

