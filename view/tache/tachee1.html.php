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
<a href="<?=WEB_ROUTE."?controller=tacheController&view=tache_list"?>" class="btn btn-primary mb-5 mt-5" style="background-color: #40A778;border-color:#40A778">Liste categories</a>
        <div class="card">
            <div class="card-header text-center">
                Ajouter des Tâches
            </div>
            <div class="card-body">
                <form action="<?=WEB_ROUTE?>" method="post" enctype="multipart/form-data">
                <input type="hidden" name="controller" value="tacheController">
                <?php if(!isset($tacheEdit) || $tacheEdit[0]['idT'] == null): ?>
                    <input type="hidden" name="action" value="add_tache">
                <?php endif; ?>
                <?php if(isset($tacheEdit) && $tacheEdit[0]['idT'] != null): ?>
                    <input type="hidden" name="action" value="edit1">
                    <input type="hidden" name="idT" value="<?= $tacheEdit[0]['idT'] ?>">
                <?php endif; ?>
                    <div class="row">
                       
                      <div class="col-md-4 col-sm-12">
                            <div class="mb-3">
                                <label for="categorie" class="form-label">Affectation de Categorie tâche</label>
                                <select name="idCT" id="categorie" class="form-control">
                                    <option value="0">Selectionnez une categorie</option>
                                    <?php foreach($categorie_tache as $categorie): ?>
                        
                                        <?php if(isset($tacheEdit)&&(isset($tacheEdit[0]['idCT']))&&($tacheEdit[0]['idCT']==$categorie['idCT'])):?>
                                    <option selected value="<?= $categorie['idCT'] ?>"><?= $categorie['libelleCT'] ?></option>
                                       <?php endif; ?>
                                       <?php if(!isset($tacheEdit) || isset($tacheEdit[0]['idCT'])||($tacheEdit[0]['idCT']!=$categorie['idCT'])):?>
                                    <option value="<?= $categorie['idCT'] ?>"><?= $categorie['libelleCT'] ?></option>
                                       <?php endif; ?>
                                    <?php endforeach; ?>
                                </select>
                                <span style="color: red;"> <?php echo isset($arrayError['idCT']) ? $arrayError['idCT'] : '' ?></span>
                            </div>
                        </div>

                            
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