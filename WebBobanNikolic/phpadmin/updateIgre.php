<div id="updateIgre" class="tab-pane fade main">

	<!--Poruka o uspesnom azuriranju proizvoda!-->
	<?php if(isset($_SESSION['uspehUpdateIgra'])) { ?>
		<div class="alert alert-success alert-dismissible" role="alert">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<strong>Promene izvršene!</strong> Igra <?php echo $_SESSION['uspehUpdateIgra']; ?> je uspešno ažurirana.
		</div>
	<?php
		unset($_SESSION['uspehUpdateIgra']);
	} ?>
	<!--KRAJ poruke o uspesnom azuriranju proizvoda!-->

	<?php if(isset($_SESSION['obrisanaIgra'])) { ?>
		<div class="alert alert-danger alert-dismissible" role="alert">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<?php echo $_SESSION['obrisanaIgra']; ?>
		</div>
	<?php 
		unset($_SESSION['obrisanaIgra']);
	} ?>

	<div class="page-header">
		<h2>Ažuriraj igru</h2>
	</div>

	<form action="#updateIgre" method="POST">
		<div class="form-group">
			<label for="sifraUnos"  style="margin-right: 10px;">Unesite šifru:</label>
			<input type="text" name="sifraUnos" id="sifraUnos" placeholder="šifra" required="true">
			<input type="submit" name="btnTraziIgru" class="btn btn-primary" value="Traži igru" style="margin-left: 10px;">
		</div>
	</form>
	<br>
	<?php include "phpadmin/UpdateIgrePregled.php" ?>

</div>