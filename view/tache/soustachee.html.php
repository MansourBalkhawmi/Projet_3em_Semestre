x   <?php
$arrayError=array();

if (isset($_SESSION['arrayError'])) {
    $arrayError = $_SESSION['arrayError'];
    unset($_SESSION['arrayError']);
}
if (!isset($_SESSION['userConnect'])) {
    header("location:" . WEB_ROUTE . '?controlleur=securityController&view=email');
  }

?>
<?php 
require_once(ROUTE_DIR."view/inc/menu.inc.html.php");
?>

<div class="row">
<div class="col-md-12 col-sm-12">
<a href="<?=WEB_ROUTE."?controller=projetController&view=projet_list"?>" class="btn btn-primary mb-5 mt-5" style="background-color: #40A778;border-color:#40A778">Liste Projet</a>
        <div class="card">
            <div class="card-header text-center" style="background-color: #40A778;color:white">
                Ajouter vos projet 
            </div>
            <div class="card-body">
    <form action="<?=WEB_ROUTE?>" method="post" enctype="multipart/form-data">
    <input type="hidden" name="controller" value="tacheController">
    <input type="hidden" name="action" value="soustache">
    <?php if(isset($soustacheEdit) && $soustacheEdit[0]['idST']!= null): ?>
                    <input type="hidden" name="action" value="soustacheEdit">
                    <input type="hidden" name="idST" value="<?= $soustacheEdit[0]['idST'] ?>">
<?php endif; ?>
                    <div class="row">
                        <div class="col-md-3 col-sm-12">
                            <div class="mb-3">
                                <label for="libelle" class="form-label">Nom du Projet</label>
                                <input type="text" class="form-control" name="libelleST" id="libelleST"value="<?= isset($soustacheEdit) ? $soustacheEdit[0]['libelleST'] : '' ?>">
                                <span style="color: red;"> <?php echo isset($arrayError['libelleST']) ? $arrayError['libelleST'] : '' ?></span>
                            </div>
                        </div>
                    
                        <div class="col-md-3 col-sm-12">
            
                            
                        </div>
                        
                      
                        <div class="col-md-12 col-sm-12">
                            <button class="btn btn-primary mt-5" type="submit" style="background-color: #40A778;border-color:#40A778">Enregistrer</button>
                        </div>
                    </div>
              
            </div>
        </div>
    </div>
    
</div>

<?php require_once(ROUTE_DIR."view/inc/end-menu.inc.html.php") ?>
<?php require_once(ROUTE_DIR."view/inc/footer.inc.html.php") ?>