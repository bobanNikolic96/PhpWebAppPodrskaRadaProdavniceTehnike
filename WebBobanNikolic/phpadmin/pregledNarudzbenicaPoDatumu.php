<div id="pregledNarudzPoDatumu" class="tab-pane fade main">
	<div class="page-header">
		<h2>Pregled narudžbenica po datumu</h2>
	</div>

	<form action="#pregledNarudzPoDatumu" method="POST">
		<div class="form-group">

			<label for="datumNarudz"  style="margin-right: 15px;">Izaberite datum:</label>
			<input type="date" name="datumNarudz" id="datumNarudz" style="width: 170px; border-radius: 5px;" required="true">
			<input type="submit" name="btnPregledPoDatumu" class="btn btn-primary" value="Prikaži" style="margin-left: 10px;">
		</div>
	</form>
	<br>
	<!--<div id="narudzbeniceDatuma">-->
	<?php include "phpadmin/NarudzbenicePoDatumuMain.php" ?> <!--Stavljamo ovu putanju, jer ovaj fajl pozivamo iz adminSide.php fajla, a putanja sa adminSide.php do zeljenog fajla je preko phpadmin foldera!!! -->
	<!-- </div> -->


</div>