<?php 
// session_start();

$mysqli = new mysqli("localhost", "root", "", "wp_projekat_videoigre_db");

if($mysqli->error){
  die("Greska prilikom konektovanja s bazom: " . $mysqli->error);
}

if (isset($_POST['btnPregledPoDatumu'])) {

	$zeljeniDatum = $_POST['datumNarudz'];
	$zeljDat = new DateTime($zeljeniDatum); //Samo zbog date_format funkcije!!!

	$upit = "SELECT n.*, k.* FROM narudzbenica n  JOIN korisnik k ON n.idKorisnik = k.idKorisnik WHERE DATE(n.datumVreme) = '" .  $zeljeniDatum  . "'";

	$rezUpita = $mysqli->query($upit);

	if(!$rezUpita){
		print("Ne moze se izvrsiti upit citanja narudzbenica za zeljeni datum.");
		die("Greska: " . $mysqli->error . "<br>"
			. "Broj greske: " . $mysqli->errno);
	}

	//provera da li uopste ima narudzbenica za trazeni datum!
	if( mysqli_num_rows($rezUpita) <= 0){
		
		print("<b>Za izabrani datum (". date_format($zeljDat, 'd/m/Y') . ") nema narudžbenica!</b><br>");
	} 
	else
	{
		?>
		
		
		<?php

		while($red = $rezUpita->fetch_assoc()){ //sve dok ima narudzbenica, ISPISI IH!!!
			?>
			<?php $dateT = new DateTime($red['datumVreme']) ?>
			<p>Detalji narudzbenice (ID: <b><?php echo $red['idNarudzbenice']; ?></b>):</p>
			<p>Primljena datuma <b> <?php echo date_format($dateT, "d/m/Y"); ?>
			</b> u <b><?php echo date_format($dateT, "H:i"); ?></b> </p>
			<p>Poručena od strane korisnika (ID: <b><?php echo $red['idKorisnik']; ?></b>): <b><?php echo $red['ime']. " " . $red['prezime']; ?></b>
			<br>Email adresa: <b><?php echo $red['email']; ?></b>
			<br>Broj telefona: <?php echo $red['brojTelefona']; ?>
			</p>
			<p>Naručeni proizvodi:</p>

			<div id="narudzbeniceDatuma">
				<div class="table-responsive">
					<table class="table tabelaStavke">

			<?php
			//izvlacimo sve stavke za tekucu narudzbenicu!!!
			$stavkeNar = $mysqli->query("SELECT s.redniBr, s.idNarudzbenice, s.idProizvoda, 
				s.izabranaKolicina, s.ukupnaCena as ukupnaCenaStavke, v.idProizvoda, v.naziv, v.platforma, v.popust, v.slika, v.alt_slika, v.ukupnaCena FROM stavka_narudzbenice s JOIN video_igra v ON s.idProizvoda = v.idProizvoda 
				WHERE s.idNarudzbenice = '". $red['idNarudzbenice'] . "'
				ORDER BY s.redniBr") or die($mysqli->error); 
			?>
			<!-- TO-DO: Napraviti da klikom na dugme "Prikazi", da ostanemo na trecem tabu za prikaz narudzbenica po datumu -->
			
					<tr>
						<th width="5%">#</th>
						<th width="10%"></th> <!--za sliku proizvoda header -->
						<th width="25%">Naziv</th>
						<th width="10%">Količina</th>
						<th width="8%">Platforma</th>
						<th width="20%">Jedinična cena</th>
						<th>Ukupna cena stavke</th>
					</tr>
			<?php 
			while($redStavki = $stavkeNar->fetch_assoc()){
			?>
					<tr>
						<td><?php echo $redStavki['redniBr']; ?></td>
						<td>
							<img src="<?php echo "img/" . $redStavki['slika']; ?>"
							 alt="<?php echo $redStavki['alt_slika']; ?>" width="65"
							 height="65">
						</td>
						<td><?php echo $redStavki['naziv'] ?></td>
						<td><?php echo $redStavki['izabranaKolicina']; ?></td>
						<td><?php echo $redStavki['platforma'] ?></td>
						<?php if($redStavki['popust'] != null && $redStavki['popust'] != 0){ ?>
						<td><?php echo $redStavki['ukupnaCena'] . " (Popust: <b>-" . 
							$redStavki['popust'] . "%</b>)"; ?></td>
					<?php }
					else{
						?>
						<td><?php echo $redStavki['ukupnaCena']; ?></td>
						<?php
					} ?>
					<td><?php echo $redStavki['ukupnaCenaStavke']; ?></td>
					</tr>
			<?php
			}
			?>
					</table>
				</div>
			</div>
			<?php

		}
	}
}


 ?>