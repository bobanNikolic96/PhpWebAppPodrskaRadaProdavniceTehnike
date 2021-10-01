<?php 

$mysqli = new mysqli("localhost", "root", "", "wp_projekat_videoigre_db");

if($mysqli->error){
	die("Greska prilikom konektovanja s bazom: " . $mysqli->error);
}

if(isset($_POST['btnTraziIgru'])){

	$sifra = $_POST['sifraUnos'];

	$upit = "SELECT * FROM video_igra WHERE idProizvoda = '" . $sifra . "'"; 

	$rezUpita = $mysqli->query($upit) or die("Greska izvrsavanja upita u bazi: " . $mysqli->error);

	if(mysqli_num_rows($rezUpita) <= 0){
		print("<b>Ne postoji proizvod u bazi sa šifrom " . $sifra . "!</b><br>");
	}
	else{
		
		if($red = $rezUpita->fetch_assoc()){//uzimamo proizvod sa tom sifrom
			?>
			<p>Detalji proizvoda (ID: <b><?php echo $red['idProizvoda']; ?></b>):</p>
			<br>
			<form enctype="multipart/form-data" action="phpadmin/updateIgreSystem.php" method="POST"> <!--enctype navodimo zbog slike!-->

				<input type="hidden" name="sifraProizvoda" value="<?php echo $red['idProizvoda'] ?>">

				<div class="form-group">
					<label for="naziv" style="margin-right: 15px;">Naziv:</label>
					<input type="text" name="naziv" id="naziv" placeholder="Naziv igre" class="form-control" required="true" value="<?php echo $red['naziv'] ?>">
				</div>
				<div class="form-group">
					<label for="platforma1" style="margin-right: 15px;">Platforma:</label>
					<input type="text" name="platforma" id="platforma1" placeholder="Platforma" style="width: 100px; border-radius: 7px;" value="<?php echo $red['platforma'] ?>" required="true">
				</div>
				<div class="form-group">
					<label for="kolicinaIgre" style="margin-right: 15px;">Količina:</label>
					<input type="number" name="kolicinaIgre" id="kolicinaIgre" style="width: 50px; border-radius: 7px;" required="true" value="<?php echo $red['kolicina'] ?>">
				</div>
				<div class="form-group">
					<label for="opisProizvoda" style="margin-right: 15px; vertical-align: top;">Opis:</label>
					<textarea name="opis" id="opisProizvoda" placeholder="Unesite opis" 
					style=" border-radius: 5px;" required="true" rows="10" cols="60"><?php echo $red['opis']; ?></textarea>
				</div>

				<div class="form-group">
					<label for="cena" style="margin-right: 15px; vertical-align: top;">Cena:</label>
					<input type="number" name="cena" id="cena" style="width: 100px; border-radius: 7px;" required="true" value="<?php echo $red['cena'] ?>"> RSD
				</div>

				<div class="form-group">
					<label for="dev" style="margin-right: 15px; vertical-align: top;">Developer:</label>
					<input type="text" name="dev" id="dev" style="width: 250px; border-radius: 7px;" required="true" value="<?php echo $red['developer'] ?>">	
				</div>

				<div class="form-group">
					<label for="popust" style="margin-right: 15px;">Popust:</label>
					<input type="number" name="popust" id="popust" style="width: 70px; border-radius: 7px;" min="0" max="80" required="true" value="<?php echo $red['popust'] ?>"> %
				</div>
				<div class="form-group">
					<label for="slika" style="vertical-align: top; margin-right: 15px;">Slika:</label>
					<img src="<?php echo "img/" . $red['slika'];?>" alt="<?php echo $red['alt_slika'] ?>" width="300" height="300">
				</div>
				<div class="form-group"> <!-- dodavanje slike -->
					<input type="hidden" name="max_file_size" value="12000000">
					<label for="imgUpload1" style="margin-right: 15px;">Promeni sliku:</label>
					<input type="file" name="imgUpload1" id="imgUpload1">	
				</div> <!-- KRAJ dodavanja slike-->
				<!--ZA SLIKU MORA PROVERA U SISTEMU DA LI JE IZABRAN FAJL (NOT NULL), UKOLIKO NIJE, NE UPDATE-UJEMO SLIKU!!!-->

				<div class="form-group">
					<label>Stanje:</label>
					<br>
					<label class="radio-inline">
						<input type="radio" name="stanje" value="nova" checked> Nova
					</label>
					<label class="radio-inline">
						<input type="radio" name="stanje" value="koriscena"> Korišćena
					</label>
				</div>

				<div class="form-group">
					<label for="datumIzlaska1">Datum izlaska:</label>
					<input type="date" name="datumIzlaska" id="datumIzlaska1" value="<?php echo $red['datumIzlaska'] ?>">
				</div>

				<div class="form-group">
					<label for="slikaPegi" style="vertical-align: top; margin-right: 15px;">Pegi rating:</label>
					<img src="<?php echo "img/" . $red['pegi'];?>" alt="pegi slika" width="100" height="100">
				</div>
				<div class="form-group">
					<label for="pegi1" style="margin-right: 10px;">Promeni pegi rating:</label>
					<input type="text" name="pegi" id="pegi1" value="<?php echo $red['pegi'] ?>"  placeholder="Unesite pegi" required="true">
				</div>
				<div class="form-group">
					<label for="zanr1" style="margin-right: 10px;">Žanr:</label>
					<input type="text" name="zanr" id="zanr1" value="<?php echo $red['zanr'] ?>"  placeholder="Unesite žanr" required="true" style="width: 250px;">
				</div>
				<br>
				<input type="submit" name="btnAzurirajIgru" value="Sačuvaj izmene" style="margin-right: 15px;"  class="btn btn-primary">
				<input type="submit" name="btnObrisiIgru" value="Obriši igru" style="margin-right: 15px;"  class="btn btn-danger">
			</form>
			<br>
			<br>
			<br>
			<?php
		}
	}

}

?>