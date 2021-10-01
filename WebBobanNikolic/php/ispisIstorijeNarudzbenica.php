<?php

	// konektovanje sa bazom
$mysqli = new mysqli("localhost", "root", "", "prodavnicatehnike");

if($mysqli->error){
	die("Greska prilikom konektovanja s bazom: " . $mysqli->error);
}
	//kraj konektovanja sa bazom


$upitNarudzbenice = "SELECT n.*, k.* FROM narudzbenica n JOIN korisnik k on n.idKorisnik = k.idKorisnik WHERE k.idKorisnik = '" .$_SESSION['idKorisnik']. "'";

$rezNarudz = $mysqli->query($upitNarudzbenice) or die("Greska izvrsenja upita: " . $mysqli->error);
//prvo ispisemo naslov
?>
<div class="page-header">
	<h2>Vaša istorija kupovine</h2>
</div>

<?php

//moramo prvo da proverimo da li uopste ima narudzbenica za datog korisnika!
if($rezNarudz->num_rows > 0){
?>
<p>Kliknite da se vratite na <a href="index.php">početnu stranu</a>.</p>
<br>
<?php
while($redNar = $rezNarudz->fetch_assoc()){
		//treba nam ova promenljiva zbog formatiranja ispisa datuma i vremena!
	$dateT = new DateTime($redNar['datumVreme']);

	?>

	<p>Narudžbenica (ID: <b><?php echo $redNar['idNarudzbenice'] ?></b>)</p>
	<p>Datum izvršenja: <b><?php echo date_format($dateT, "d/m/Y"); ?></b> u <b><?php echo date_format($dateT, "h:i A"); ?></b>.</p>
	<p>Adresa isporuke: <b><?php echo $redNar['adresa_za_isporuku'] . ", " . $redNar['grad']
	. " " . $redNar['zip_code']; ?></b></p>


	<p>Naručeni proizvodi:</p>

	<div id="narudzbeniceDatuma">
		<div class="table-responsive">
			<table class="table tabelaStavke">
				<?php 
					$stavkeNar = $mysqli->query("SELECT s.redniBr, s.idNarudzbenice, s.idProizvoda, s.izabranaKolicina, s.ukupnaCena as ukupnaCenaStavke, v.idProizvoda, v.naziv, v.platforma, v.popust, v.slika, v.alt_slika, v.ukupnaCena, v.stanje FROM stavka_narudzbenice s JOIN proizvod p
						ON s.idProizvoda = p.idProizvoda
						WHERE s.idNarudzbenice = '" .$redNar['idNarudzbenice']. "' 
						ORDER BY s.redniBr") or die("Greska izvrsenja upita: " . $mysqli->error);
				 ?>
				 <tr>
					<th width="5%">#</th>
					<th width="10%"></th> <!--za sliku proizvoda header -->
					<th width="25%">Naziv</th>
					<th width="10%">Količina</th>
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


						<?php if($redStavki['popust'] != null && $redStavki['popust'] != 0){ ?>
						<td><?php echo number_format($redStavki['ukupnaCena'], 2, ",", ".") . " (Popust: <b>-" . $redStavki['popust'] . "%</b>)"; ?> RSD</td>
					<?php }
						else{
						?>
						<td><?php echo number_format($redStavki['ukupnaCena'], 2, ",", "."); ?> RSD</td>
						<?php
					} ?>
						<td><?php echo number_format($redStavki['ukupnaCenaStavke'], 2, ",", "."); ?> RSD</td>
				</tr>
				<?php 
				} //kraj while-a za izvlacenje stavki
				?>
				<tr id="poslednjiRed">
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td>Ukupno:<br><b><?php echo number_format($redNar['totalCena'], 2, ",", "."); ?> RSD</b><br>(+250 din za cenu dostave)</td>
				</tr>

			</table>
			<hr style="height: 2px; border-width: 0; color: gray; background-color: #a48425; margin-bottom: 40px; margin-top: 40px;">
		</div>
	</div>
	<?php
}//kraj while-a za svaku narudzbenicu
?>
<p>Kliknite da se vratite na <a href="index.php">početnu stranu</a>.</p>
<?php
}//kraj if-a gde se proverava da li uopste ima narudzbenica korisnika
else{
	?>
	<p>Niste izvršili nijednu porudžbinu do sada, kliknite <a href="prodavnicaPC.php">ovde</a> da odete na prodavnicu!</p>
	<?php
}

?>