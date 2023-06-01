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
<a href="<?=WEB_ROUTE."?controller=categorieController&view=categorie_list"?>" class="btn btn-primary mb-5 mt-5" style="background-color: #40A778;border-color:#40A778">Liste categories</a>
        <div class="card">
            <div class="card-header text-center">
                Ajouter une categorie de confection
            </div>
            <div class="card-body">
                <form action="<?=WEB_ROUTE?>" method="post">
                <input type="hidden" name="controller" value="categorie_tacheController">
                <?php if(!isset($categorie_tacheEdit) || $categorie_tacheEdit[0]['idCT'] == null): ?>
                    <input type="hidden" name="action" value="add_categorie_tache">
                <?php endif; ?>
                <?php if(isset($categorie_tacheEdit) && $categorie_tacheEdit[0]['idCT'] != null): ?>
                    <input type="hidden" name="action" value="edit">
                    <input type="hidden" name="idCT" value="<?= $categorie_tacheEdit[0]['idCT'] ?>">
                <?php endif; ?>
                    <div class="row">
                        <div class="col-md-4 col-sm-12">
                            <div class="mb-3">
                                <label for="libelle" class="form-label">Categorie Tâche</label>
                            <input type="text" class="form-control" name="libelleCT" id="libelle" value="<?= isset($categorie_tacheEdit[0]['libelleCT']) ? $categorie_tacheEdit[0]['libelleCT'] : '' ?>">
                                <span style="color: red;"> <?php echo isset($arrayError['libelleCT']) ? $arrayError['libelleCT'] : '' ?></span>
                            </div>
                        </div>
                        <div class="col-md-2 col-sm-12">
                            <button class="btn btn-primary mt-4" type="submit" style="background-color: #40A778;border-color:#40A778">Enregistrer</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
</div>

<?php require_once(ROUTE_DIR."view/inc/end-menu.inc.html.php") ?>
<?php require_once(ROUTE_DIR."view/inc/footer.inc.html.php") ?>