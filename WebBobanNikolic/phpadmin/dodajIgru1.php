

		<div id="dodajIgru" class="tab-pane fade main">
			<div class="page-header">
				<h2>Dodaj novu igru</h2>
			</div>

			<form enctype="multipart/form-data" action = "phpadmin/dodajIgruMain.php" method="POST">
				<div class="form-group">
					<label for="platformaDropDown" style="margin-right: 15px;">Platforma:</label>
					<select name="platforma" id = "platformaDropDown" onchange="on_change()" required="true">
						<option value>---izaberite platformu---</option>
						<option value="pc">PC</option>
						<option value="ps4">PS4</option>
						<option value="xbox1">XBOX ONE</option>
					</select>
				</div>
				<input type="hidden" name="productID" id="productID"> <!--Generise se u on_change() metodi kada se selektuje platforma!-->
				<div class="form-group">
					<label for="nazivIgre" style="margin-right: 15px;">Naziv:</label>
					<input type="text" name="nazivIgre" id="nazivIgre" placeholder="Naziv igre" class="form-control" required="true" onfocus>
				</div>

				<div class="form-group"> <!-- dodavanje slike -->
					<input type="hidden" name="max_file_size" value="12000000">

					<label for="imgUpload" style="margin-right: 15px;">Postavi sliku:</label>
					<input type="file" name="imgUpload" id="imgUpload" required="true">

					
			</div> <!-- KRAJ dodavanja slike -->

			<div class="form-group">
				<label for="kolicinaIgre" style="margin-right: 15px;">Količina:</label>
				<input type="number" name="kolicinaIgre" id="kolicinaIgre" min="1" style="width: 45px; border-radius: 7px;" required="true">
			</div>

			<div class="form-group">
				<label for="cenaIgre" style="margin-right: 15px;">Cena:</label>
				<input type="number" name="cenaIgre" id="cenaIgre" min="1" max="20000" style="width: 90px; height: 34px; font-size: 14px; color: #555;" required="true"> RSD
			</div>

			<div class="form-group">
				<label for="popustIgre" style="margin-right: 15px;">Popust:</label>
				<input type="number" name="popustIgre" id="popustIgre" min="0" max="80" style="width: 50px; height: 34px; font-size: 14px; color: #555;"> %
			</div>

			<div class="form-group">
				<label>Stanje:</label>
				<br>
				<label class="radio-inline">
					<input type="radio" name="stanje" id="stanjeNova" value="nova" checked> Nova
				</label>
				<label class="radio-inline">
					<input type="radio" name="stanje" id="stanjeKoriscena" value="koriscena"> Korišćena
				</label>
			</div>

			<div class="form-group">
				<label for="dev"  style="margin-right: 15px;">Developer:</label>
				<input type="text" name="dev" id="dev" placeholder="developer" style="width: 250px; border-radius: 5px;">
			</div>

			<div class="form-group">
				<label>Pegi:</label>
				<br>
				<label class="radio-inline">
					<input type="radio" name="pegi" id="pegi18" value="pegi/18.png" checked> 18
				</label>
				<label class="radio-inline">
					<input type="radio" name="pegi" id="pegi16" value="pegi/16.png"> 16
				</label>
				<label class="radio-inline">
					<input type="radio" name="pegi" id="pegi16" value="pegi/12.png"> 12
				</label>
				<label class="radio-inline">
					<input type="radio" name="pegi" id="pegi7" value="pegi/7.png"> 7
				</label>
				<label class="radio-inline">
					<input type="radio" name="pegi" id="pegi3" value="pegi/3.png"> 3
				</label>
			</div>

			<div class="form-group">
				<label for="datumIzlaska1"  style="margin-right: 15px;">Datum izlaska:</label>
				<input type="date" name="datumIzlaska" id="datumIzlaska1" style="width: 250px; border-radius: 5px;" required="true">
			</div>
			<div class="form-group">
				<label for="zanr"  style="margin-right: 15px;">Žanr:</label>
				<input type="text" name="zanr" id="zanr" placeholder="Žanr" style="width: 250px; border-radius: 5px;" required="true">
			</div>

			<div class="form-group">
				<label for="opisProizvoda" style="margin-right: 15px; vertical-align: top;">Opis:</label>
				<textarea name="opis" id="opisProizvoda" placeholder="Unesite opis" 
				style=" border-radius: 5px;" required="true" rows="10" cols="50"></textarea>
			</div>

			<input type="submit" name="btnDodajIgru" class="btn btn-primary btn-lg" value="Dodaj igru" style="margin-left: 50px; width: 200px;">
		</form>
	</div>