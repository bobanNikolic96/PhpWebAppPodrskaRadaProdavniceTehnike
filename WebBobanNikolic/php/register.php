<div class="page-header">
	<h2>Registrujte se</h2>
</div>
<div class="row">
	<!-- PHP -->
	<form method="post" action="registracija.php" onsubmit="validateRegForm();">
		<?php 

		$mysqli = new mysqli("localhost", "root", "", "prodavnicaTehnike");

		if($mysqli->error){
			die("Greska prilikom konektovanja s bazom: " . $mysqli->error);
		}

		$ime = "";
		$prezime = "";
		$email = "";
		$brojTelefona = "";
		$password1="";
		$password2="";
		$usertype = "user";//za user ili admin role!!!

		if (isset($_POST['dodaj'])){ //Klik na dugme "Registrujte se"

		if((!$_POST['ime']) ||  (!$_POST['prezime']) || (!$_POST['email']) || (!$_POST['brojTelefona']) || (!$_POST['password1']) || (!$_POST['password2'])){
			echo "Niste uneli sva neophodna polja u registraciji!";
		}

		else {
			//cekira ako postoji korisnik sa datim email-om vec postoji!
			$upitPostoji = $mysqli->query("SELECT * FROM korisnik WHERE email = '"
				.$_POST['email'] . "'") or die($mysqli->error);

			//znamo da korisnik sa imejlom vec postoji ako je broj redova koje vrati upit veci od 0!
			if($upitPostoji->num_rows > 0){ ?>
				<!-- alert ukoliko postoji email -->
				<div class="alert alert-danger alert-dismissible" role="alert">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<strong>Email već postoji!</strong> Email koji ste uneli je zauzet, molimo vas unesite novi.
					</div>
					<?php
			}
			else {

			$idKor = rand(0, 999999); 
			$upit = "INSERT INTO korisnik (idKorisnik, ime, prezime, password, brojTelefona, email, pol, usertype) values ('"
			.$idKor ."', '"
			.$_POST['ime'] ."', '"
			.$_POST['prezime'] ."', '"
			.sha1($_POST['password1']) ."', '"
			.$_POST['brojTelefona'] ."', '"
			.$_POST['email'] ."', '"
			.$_POST['pol'] ."', '"
			.$usertype ."')";

			$rezUpita = false;
			if($_POST['password1'] === $_POST['password2']){
					 $rezUpita = $mysqli->query($upit); //izvrsavanje upita i smestanje rezultata u promenljivu!
					}
					else  { //$rezUpita = false; ?>
						<div class="alert alert-warning alert-dismissible" role="alert">
							<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							<strong>Upozorenje!</strong> Niste uspešno potvrdili password!
						</div>
						<script>
							fokusNaPassword();
						</script>
						<?php
						//die(); //ovim prekidamo izvrsavanje toka programa te dole if uslov
						//se nece izvrsiti (da ne bismo pisali i taj alert)
					}

					if($rezUpita){
					?>
					<div class="alert alert-success alert-dismissible" role="alert">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<strong>Success!</strong> Uspešno ste se registrovali! Vaša email adresa je <b><?php  echo $_POST['email'] ?></b>. Prijavite se kako biste započeli kupovinu!
					</div>
					<?php
				}
				else{
					?>
					<div class="alert alert-danger alert-dismissible" role="alert">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<strong>Neuspešna registracija!</strong> Proverite sva polja i probajte ponovo!
					</div>
					<?php
				}

			}

		}
	}


		?>


		<!-- KRAJ PHP-A -->


		<!-- POCETAK HTML FORME -->
		<div class="col-md-6"> <!-- leva strana prikaza  -->
			<div class="form-group">
				<label for="ime">Vaše ime</label>
				<input type="text" class="form-control regInput" id="ime" name="ime" 
				value="<?php echo $ime; ?>" placeholder="Unesite ime" required>
				<p class="tipValidacije">Ime se mora sastojati samo od slova, dužine između 2 i 20, i mora početi velikim slovom</p>
			</div>
			<div class="form-group">
				<label for="email">E-mail adresa</label>
				<input type="email" class="form-control regInput" id="email" name="email" 
				value="<?php echo $email; ?>" placeholder="Unesite e-mail adresu" required>
				<p class="tipValidacije">Email mora biti validna adresa, npr. ja@mojdomen.com</p>
			</div>
			<div class="form-group">
				<label for="password1">Password</label>
				<input type="password" class="form-control regInput" id="password1" name="password1" value="<?php echo $password1 ?>"placeholder="Unesite password" required>
				<p class="tipValidacije">Password mora biti alfanumerički (@, _ i - takođe su dozvoljeni) i dužine između 5 i 20 karaktera</p>
			</div>
			<div class="form-group">
				<label>Pol</label>
				<br>
				<label class="radio-inline">
					<input type="radio" name="pol" class="regInput" id="inlineRadio1" value="M" checked> Muški
				</label>
				<label class="radio-inline">
					<input type="radio" name="pol" class="regInput" id="inlineRadio2" value="Ž"> Ženski
				</label>
			</div>
			<button type="submit" name="dodaj" value="dodaj" class="btn btn-primary btn-lg btn-block" id="registracijaBtn"><span class="glyphicon glyphicon-hand-right" aria-hidden="true"></span> Registrujte se</button>

		</div> <!-- kraj leve strane prikaza -->
		<div class="col-md-6"><!--  desna strana prikaza -->
			<div class="form-group">
				<label for="prezime">Vaše prezime</label>
				<input type="text" class="form-control regInput" id="prezime" name="prezime" value="<?php echo $prezime; ?>" placeholder="Unesite prezime" required>
				<p class="tipValidacije">Prezime se mora sastojati samo od slova, dužine minimum 2 slova i mora početi velikim slovom</p>
			</div>
			<div class="form-group">
				<label for="brojTelefona">Broj telefona</label>
				<input type="tel" class="form-control regInput" id="brojTelefona" name="brojTelefona" value="<?php echo $brojTelefona; ?>" placeholder="Unesite broj telefona" required>
				<p class="tipValidacije">Telefon mora biti validan srpski broj telefona</p>
			</div>
			<div class="form-group">
				<label for="password2">Ponovite password</label>
				<input type="password" class="form-control regInput" id="password2" name="password2" value="<?php echo $password2 ?>" placeholder="Ponovite vaš password" required>
			</div>

			<!-- KRAJ HTML FORME -->

		</div> <!-- kraj desne strane prikaza -->
	</form>
</div>





