<?php
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
    <input type="hidden" name="controller" value="projetController">
    <input type="hidden" name="action" value="add_projet">
    <?php if(isset($projetEdit) && $projetEdit[0]['idP']!= null): ?>
                    <input type="hidden" name="action" value="edit">
                    <input type="hidden" name="idP" value="<?= $projetEdit[0]['idP'] ?>">
<?php endif; ?>
                    <div class="row">
                        <div class="col-md-3 col-sm-12">
                            <div class="mb-3">
                                <label for="libelle" class="form-label">Nom du Projet</label>
                                <input type="text" class="form-control" name="nomP" id="nomP"value="<?= isset($projetEdit) ? $projetEdit[0]['nomP'] : '' ?>">
                                <span style="color: red;"> <?php echo isset($arrayError['nomP']) ? $arrayError['nomP'] : '' ?></span>
                            </div>
                        </div>
                    
                        <div class="col-md-3 col-sm-12">
                            <div class="mb-3">
                                <label for="quantite" class="form-label">Description du Projet</label>
                                <textarea  class="form-control" name="descriptionP" id="descriptionP" cols="30" rows="5" ><?= isset($projetEdit) ? $projetEdit[0]['descriptionP'] : '' ?></textarea>
                                <span style="color: red;"> <?php echo isset($arrayError['descriptionP']) ? $arrayError['descriptionP'] : '' ?></span>
                            </div>
                            
                        </div>
                        
                      
                        <div class="col-md-12 col-sm-12">
                            <button class="btn btn-primary mt-5" type="submit" style="background-color: #40A778;border-color:#40A778">Enregistrer</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
</div>

<?php require_once(ROUTE_DIR."view/inc/end-menu.inc.html.php") ?>
<?php require_once(ROUTE_DIR."view/inc/footer.inc.html.php") ?>