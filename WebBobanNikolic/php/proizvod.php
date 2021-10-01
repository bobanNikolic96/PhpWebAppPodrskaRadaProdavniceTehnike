<?php 
//---------POCETAK konekcije sa bazom i izvrsavanje upita---------
$mysqli = new mysqli("localhost", "root", "", "prodavnicatehnike");

if($mysqli->error){
	die("Greska prilikom konektovanja sa bazom: " . $mysqli->error);
}

if(isset($_POST['idIzabraniPogledaj']) || isset($_SESSION['idIzabrani'])){
	if(isset($_POST['idIzabraniPogledaj'])){
	$idIzabrani = $_POST['idIzabraniPogledaj'];
	}
	else{
		$idIzabrani = $_SESSION['idIzabrani']; //ova varijabla je nakon dodavanja u korpu da bi znao koji proizvod da prikaze!
	}

	$upit = "SELECT * FROM proizvod WHERE idProizvoda = '" .$idIzabrani. "'";

	$rezultat = $mysqli->query($upit) or die("Greska: " . $mysqli->error . "<br>Broj greske: ". $mysqli->errno);
//---------KRAJ konekcije sa bazom i izvrsavanje upita---------

	if($proiz = $rezultat->fetch_assoc()){
		?>
		<div class="page-header">
			<h2> <?php echo $proiz['naziv']; ?> </h2>
		</div>

		<div class="row">
			<div class="col-md-6">
				<!-- staviti sliku proizvoda -->
				<img class="slikaProizvoda" src="<?php  echo "img/". $proiz['slika'];?>" alt="<?php echo $proiz['alt_slika'] ?>">
			</div>
			<div class="col-md-6">
				<div class="row"> <!-- prvi red -->
					<div class="drugiEl">
					<span id="stanjeProiz">Stanje:</span>
					<?php if($proiz['kolicina'] <= 0){ //PROVERA KOLICINE (DA LI JE NA STANJU)!!!
						?>
						<span style="color: red; font-size: 25px;">Nema na stanju</span>
					<?php }else{ ?>
						<span style="color: green; font-size: 25px;">Na stanju</span>
					<?php } ?>
				</div>
				</div> <!-- kraj prvi red -->

				<div class="row ElementiRed"> <!-- drugi red -->
					<div class="prviEl">
						<div class="el1">
						<?php if($proiz['popust'] == null || $proiz['popust'] == 0){ ?>
							<span id="popustProiz">Popust: </span>
							<span style="color: #237072; font-size: 25px; margin-left: 5px;">NEMA</span>
							<?php 
						}
						else { ?>
							<span id="popustProiz">Popust: </span>
							<span style="color: #237072; font-size: 25px; margin-left: 5px;"><?php echo $proiz['popust']; ?>%</span>
							<?php  
						}?>
						</div>
					</div>
					<div class="drugiEl">
					<span id="cenaProiz">Cena: </span>
					<span style="color: #237072; font-size: 25px"><b><?php echo number_format($proiz["ukupnaCena"], 2, ',', '.'); ?></b> RSD</span>
					</div>
				</div> <!-- kraj drugi red -->
				<div class="row ElementiRed"> <!-- treci red -->
					<div class="drugiEl">
					<?php if(isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] == true){ ?>
							<?php $_SESSION['pageName'] = 'proizvodFront.php' ?> <!-- postavljanje session variable za REDIRECT u header metodi!
							Da bi se vratili na ovu stranu posle ubacivanja u korpu -->
					<form method="post" action="korisnickaKorpa.php" class="form-inline">
						<input type="hidden" name="idIzabrani" value="<?php echo $proiz['idProizvoda']; ?>">
					 <input type="hidden" name="nazivProiz" value="<?php echo $proiz['naziv'] ?>"> 
						<input type="number" name="izabranaKol" min ="1" value="1" max="<?php echo $proiz['kolicina'] ?>" style="margin-right: 10px; border-radius:6px; width: 45px; height: 40px; text-align: center;" required>
					<?php if($proiz['kolicina'] > 0) { ?>
						<input type="submit" name="btnUbaciUKorpuProiz"  class="btn btn-primary" value="Stavi u korpu">
					<?php }
						else{ ?> <!-- ukoliko nema na stanju! -->
						<input type="submit" name="btnUbaciUKorpu"  class="btn btn-primary" value="Stavi u korpu" disabled="true" data-toggle="tooltip" title="Proizvoda nema na stanju!" data-animation="true">
					<?php } ?>
					</form>
					<?php } ?>
				</div>

				</div> <!-- kraj treci red -->
				<div class="row ElementiRed"> <!-- cetvrti red -->
					<div class="prviEl">
						<div class="page-header" style="margin-top: 0px;">
							<h3>Opis</h3>
						</div>
						<p style="padding: 10px;"><?php echo $proiz['opis']; ?></p>
					</div>
				</div> <!--kraj cetvrti red -->
			</div>
		</div>
		<div class="row"> 
			<div class="col-md-6">
				<p style="margin-top: 30px; font-size: 18px;"><b>Specifikacije:</b></p>
				<p>
					<?php

					 echo $proiz['specifikacije'];

					?>

				</p>
			</div>
		</div>

		<?php
	}

}



?>
