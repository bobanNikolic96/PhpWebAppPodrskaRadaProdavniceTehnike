<?php  
//konekcija sa bazom 
$mysqli = new mysqli("localhost", "root", "", "wp_projekat_videoigre_db");

if($mysqli->error){
  die("Greska prilikom konektovanja s bazom: " . $mysqli->error);
}

//izvrsavanje upita
$upitPC = "SELECT * FROM video_igra WHERE stanje = 'koriscena'";

$rezUpita = $mysqli->query($upitPC);

if(!$rezUpita){
  print("Ne moze se izvrsiti upit!");
  die("Greska:" . $mysqli->error .
    "<br>Broj greske: " . $mysqli->errno);
}

?>
<div class="page-header">
  <h2>Korišćene igre (50% popust)</h2>
</div>

<?php if(isset($_SESSION['dodatoUKorpu']) && isset($_SESSION['nazivIgre'])){//novo
  ?>
  <div class="alert alert-success alert-dismissible fade in" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    Igru <strong><?php echo $_SESSION['nazivIgre']; ?></strong> (Količina: 1) ste uspešno dodali u vašu korpu!
  </div>
  <?php 
  unset($_SESSION['dodatoUKorpu']);
} 
?><!-- novo -->

<div class="row">
  <?php  if($rezUpita->num_rows == 0){
    echo "Nema nijedna korišćena video igra!";
  }
  else{

    while($red = $rezUpita->fetch_assoc()){

    $_SESSION['idProizvoda'] = $red['idProizvoda'];//novo
    //!!!!!!izracunavanje ukupne cene!!!!!!
      if(($red['popust'] != null) && ($red['popust'] != 0)){ //ako ima popusta (nije null i nije nula)
        $ukupCena = $red['cena'] * (1 - $red['popust']/100);
      }
      else{
        $ukupCena = $red['cena'];
      }
      $red["ukupnaCena"] = $ukupCena;
      $updateUkupnaCena = "UPDATE video_igra SET "
      . "ukupnaCena = '" .$ukupCena . "'"
      . " WHERE idProizvoda = '" . $red['idProizvoda'] . "'";
      $rez = $mysqli->query($updateUkupnaCena) or die($mysqli->error);
      //!!!!!!KRAJ izracunavanja ukupne cene!!!!!!

      ?>

      <?php 
      //***ovde sada odredjujemo koja je igra u pitanju (da li pc, ps4 ili xbox)
      //i na osnovu toga prikazati odgovarajuci thumbnail!!!
      if($red['platforma'] == 'pc'){
       ?>
       <div class="col-sm-6 col-md-4"> <!-- pocetak prvog -->
        <div class="thumbnail thumbpc">
          <h3 class="headerShop"> <?php echo $red['naziv']; ?><!-- Naziv proizvoda 1 --></h3>
        <?php if($red['kolicina'] <= 0){ //PROVERA KOLICINE (DA LI JE NA STANJU)!!!
          ?>
          <div class="slikaKor">
            <img src="img/koriscena.jpg" class="img-responsive koriscenaSlika">
            <span class="label label-danger labelaStanje" style="font-size: 13px;">Nema na stanju!</span>
            <img src="<?php echo "img/" . $red['slika']; ?>" alt="<?php echo $red['alt_slika']; ?>" class="thumbSlika">
          </div>
          <?php
            } else{ //ukoliko ima na stanju prikazi samo sliku (bez uvlacenja u div "nemaNaStanju")
            ?>
            <div class="slikaKor">
              <img src="img/koriscena.jpg" class="img-responsive koriscenaSlika">
              <img src="<?php echo "img/" . $red['slika']; ?>" alt="<?php echo $red['alt_slika']; 
              ?>" class="thumbSlika">
            </div>
          <?php } ?>
          <p align="center" style="margin-top: 15px"><i class="fa fa-windows fa-2x" aria-hidden="true"></i><b><big> Windows</big></b></p>
          <div class="caption">
            <p>Datum izlaska: <?php echo date("d.m.Y", strtotime($red['datumIzlaska'])); ?></p>
            <p>Cena:<strong> <?php echo number_format($red["ukupnaCena"], 2, ',', '.') ?> RSD </strong> <?php if(($red['popust'] != null) && ($red['popust'] != 0)) {
              ?>
              <s style="color: #4d2727;"><?php echo $red['cena'];?> rsd</s>
              <?php
            }
            ?>
          </p>
          <div style="display: flex; justify-content: center;"> 
            <!-- prva forma pogledajte video igru-->
            <form action="videoIgra.php" method="post" class="form-inline">
              <input type="hidden" name="idIzabraniPogledaj" value="<?php echo $red['idProizvoda']; ?>">
              <button type="submit" class="btn btn-info" name="btnPogledaj" style="width: 180px;">Pogledajte <i class="fa fa-arrow-circle-right"></i></button>
            </form>
            <!-- druga forma dodavanje u korpu -->
            <form action="korisnickaKorpa.php" method="post" class="form-inline">
              <?php $_SESSION['pageName'] = 'prodavnicaKorisceno.php'; ?> <!-- za redirect na nasu stranicu!!! *******PROMENITI ZA shopPS4.php i ostale*******-->
              <input type="hidden" name="izabranaKol" value="1"> <!-- da po defaultu ako kliknemo na dugme za dodavanje u korpu, dodata kolicina bude 1? -->
              <input type="hidden" name="idIzabrani" value="<?php echo $red['idProizvoda']; ?>">
              <input type="hidden" name="nazivIgre" value="<?php echo $red['naziv'] ?>"> 
              <?php if (isset($_SESSION['loggedIn'])) { ?>
                <?php if($red['kolicina'] <= 0){ ?> <!-- ukoliko nema igre na stanju, onemoguciti dugme za stavljanje u korpu!!! -->
                <button type="submit" name="btnUbaciUKorpu" class="btn btn-primary" style="margin-left: 5px;" disabled="true"><span class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span></button>
              <?php } else{
                ?>
                <button type="submit" name="btnUbaciUKorpu" class="btn btn-primary" style="margin-left: 5px;"><span class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span></button>
                <?php
              }
            }
            ?>
          </form>
        </div>
        
      </div>
    </div>
  </div> <!-- kraj prvog -->
<?php }
if($red['platforma'] == 'ps4') { ?>
  <div class="col-sm-6 col-md-4"> <!-- pocetak prvog -->
    <div class="thumbnail thumbps4">
      <h3 class="headerShop"> <?php echo $red['naziv']; ?><!-- Naziv proizvoda 1 --></h3>
          <?php if($red['kolicina'] <= 0){ //PROVERA KOLICINE (DA LI JE NA STANJU)!!!
            ?>
            <div class="slikaKor">
              <img src="img/koriscena.jpg" class="img-responsive koriscenaSlika">
              <span class="label label-danger labelaStanje" style="font-size: 13px;">Nema na stanju!</span>
              <img src="<?php echo "img/" . $red['slika']; ?>" alt="<?php echo $red['alt_slika']; ?>" class="thumbSlika">
            </div>
            <?php
            } else{ //ukoliko ima na stanju prikazi samo sliku (bez uvlacenja u div "nemaNaStanju")
            ?>
            <div class="slikaKor">
              <img src="img/koriscena.jpg" class="img-responsive koriscenaSlika">
              <img src="<?php echo "img/" . $red['slika']; ?>" alt="<?php echo $red['alt_slika']; 
              ?>" class="thumbSlika">
            </div>
          <?php } ?>
          <p align="center" style="margin-top: 15px"><i class="fab fa-playstation fa-2x"></i><b><big> PS4</big></b></p>
          <div class="caption">
            <p>Datum izlaska: <?php echo date("d.m.Y", strtotime($red['datumIzlaska'])); ?></p>
            <p>Cena:<strong> <?php echo number_format($red["ukupnaCena"], 2, ',', '.') ?> RSD </strong> <?php if(($red['popust'] != null) && ($red['popust'] != 0)) {
              ?>
              <s style="color: #4d2727;"><?php echo $red['cena'];?> rsd</s>
              <?php
            }
            ?>
          </p>
          <div style="display: flex; justify-content: center;"> 
            <!-- prva forma pogledajte video igru-->
            <form action="videoIgra.php" method="post" class="form-inline">
              <input type="hidden" name="idIzabraniPogledaj" value="<?php echo $red['idProizvoda']; ?>">
              <button type="submit" class="btn btn-info" name="btnPogledaj" style="width: 180px;">Pogledajte <i class="fa fa-arrow-circle-right"></i></button>
            </form>
            <!-- druga forma dodavanje u korpu -->
            <form action="korisnickaKorpa.php" method="post" class="form-inline">
              <?php $_SESSION['pageName'] = 'prodavnicaKorisceno.php'; ?> <!-- za redirect na nasu stranicu (Da ostane na toj stranici nakon dodavanja u korpu)!!! *******PROMENITI ZA shopPS4.php i ostale*******-->
              <input type="hidden" name="izabranaKol" value="1"> <!-- da po defaultu ako kliknemo na dugme za dodavanje u korpu, dodata kolicina bude 1? -->
              <input type="hidden" name="idIzabrani" value="<?php echo $red['idProizvoda']; ?>">
              <input type="hidden" name="nazivIgre" value="<?php echo $red['naziv'] ?>"> 
              <?php if (isset($_SESSION['loggedIn'])) { ?>
                <?php if($red['kolicina'] <= 0){ ?> <!-- ukoliko nema igre na stanju, onemoguciti dugme za stavljanje u korpu!!! -->
                <button type="submit" name="btnUbaciUKorpu" class="btn btn-primary" style="margin-left: 5px;" disabled="true"><span class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span></button>
              <?php } else{
                ?>
                <button type="submit" name="btnUbaciUKorpu" class="btn btn-primary" style="margin-left: 5px;"><span class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span></button>
                <?php
              }
            }
            ?>
          </form>
        </div>
        
      </div>
    </div>
  </div> <!-- kraj prvog -->
<?php }
if($red['platforma'] == 'xbox1') { ?>
 <div class="col-sm-6 col-md-4"> <!-- pocetak prvog -->
  <div class="thumbnail thumbxbox">
    <h3 class="headerShop"> <?php echo $red['naziv']; ?><!-- Naziv proizvoda 1 --></h3>
           <?php if($red['kolicina'] <= 0){ //PROVERA KOLICINE (DA LI JE NA STANJU)!!!
            ?>
            <div class="slikaKor">
              <img src="img/koriscena.jpg" class="img-responsive koriscenaSlika">
              <span class="label label-danger labelaStanje" style="font-size: 13px;">Nema na stanju!</span>
              <img src="<?php echo "img/" . $red['slika']; ?>" alt="<?php echo $red['alt_slika']; ?>" class="thumbSlika">
            </div>
            <?php
            } else{ //ukoliko ima na stanju prikazi samo sliku (bez uvlacenja u div "nemaNaStanju")
            ?>
            <div class="slikaKor">
              <img src="img/koriscena.jpg" class="img-responsive koriscenaSlika">
              <img src="<?php echo "img/" . $red['slika']; ?>" alt="<?php echo $red['alt_slika']; 
              ?>" class="thumbSlika">
            </div>
          <?php } ?>
          <p align="center" style="margin-top: 15px"><i class="fab fa-xbox fa-2x"></i><b><big> XBOX ONE</big></b></p>
          <div class="caption">
            <p>Datum izlaska: <?php echo date("d.m.Y", strtotime($red['datumIzlaska'])); ?></p>
            <p>Cena:<strong> <?php echo number_format($red["ukupnaCena"], 2, ',', '.') ?> RSD </strong> <?php if(($red['popust'] != null) && ($red['popust'] != 0)) {
              ?>
              <s style="color: #4d2727;"><?php echo $red['cena'];?> rsd</s>
              <?php
            }
            ?>
          </p>
          <div style="display: flex; justify-content: center;"> 
            <!-- prva forma pogledajte video igru-->
            <form action="videoIgra.php" method="post" class="form-inline">
              <input type="hidden" name="idIzabraniPogledaj" value="<?php echo $red['idProizvoda']; ?>">
              <button type="submit" class="btn btn-info" name="btnPogledaj" style="width: 180px;">Pogledajte <i class="fa fa-arrow-circle-right"></i></button>
            </form>
            <!-- druga forma dodavanje u korpu -->
            <form action="korisnickaKorpa.php" method="post" class="form-inline">
              <?php $_SESSION['pageName'] = 'prodavnicaKorisceno.php'; ?> <!-- za redirect na nasu stranicu (Da ostane na toj stranici nakon dodavanja u korpu)!!! *******PROMENITI ZA shopPS4.php i ostale*******-->
              <input type="hidden" name="izabranaKol" value="1"> <!-- da po defaultu ako kliknemo na dugme za dodavanje u korpu, dodata kolicina bude 1? -->
              <input type="hidden" name="idIzabrani" value="<?php echo $red['idProizvoda']; ?>">
              <input type="hidden" name="nazivIgre" value="<?php echo $red['naziv'] ?>"> 
              <?php if (isset($_SESSION['loggedIn'])) { ?>
                <?php if($red['kolicina'] <= 0){ ?> <!-- ukoliko nema igre na stanju, onemoguciti dugme za stavljanje u korpu!!! -->
                <button type="submit" name="btnUbaciUKorpu" class="btn btn-primary" style="margin-left: 5px;" disabled="true"><span class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span></button>
              <?php } else{
                ?>
                <button type="submit" name="btnUbaciUKorpu" class="btn btn-primary" style="margin-left: 5px;"><span class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span></button>
                <?php
              }
            }
            ?>
          </form>
        </div>

      </div>
    </div>
  </div> <!-- kraj prvog -->

<?php } ?>

<?php
    } //kraj while-a
  }//kraj else-a
  ?>
</div>
