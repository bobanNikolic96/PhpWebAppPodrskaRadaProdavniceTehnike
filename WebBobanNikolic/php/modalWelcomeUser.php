<?php   
 ?>
<div class="modal fade" id="modalWelcome" tabindex="-1" role="dialog" aria-labelledby="smallModal" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-body" id="bodyWelcome">
        <?php if($_SESSION['usertype'] == "user"){ ?>
        <h3>Dobro došli, <?php  echo "<br>". $_SESSION['ime']. " " . $_SESSION['prezime'];?>
        </h3>
        <?php } else { ?>
          <h3>Dobro došli, administrator <?php  echo "<br>". $_SESSION['ime']. " " . $_SESSION['prezime'];?>
        </h3>
        <?php } ?>
      </div>
      <div class="modal-footer" id="footerWelcome">
        <button type="button" class="btn btn-primary" id="btnWelcome" data-dismiss="modal">Hvala!</button>
      </div>
    </div>
  </div>
</div>