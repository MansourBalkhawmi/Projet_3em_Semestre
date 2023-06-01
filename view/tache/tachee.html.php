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
                    <input type="hidden" name="action" value="edit">
                    <input type="hidden" name="idT" value="<?= $tacheEdit[0]['idT'] ?>">
                <?php endif; ?>
                    <div class="row">

                        <div class="col-md-4 col-sm-12">
                            <div class="mb-3">
                                <label for="libelle" class="form-label">Libelle Tâche</label>
                                <input type="text" class="form-control" name="libelleT" id="libelle" value="<?= isset($tacheEdit[0]['libelleT']) ? $tacheEdit[0]['libelleT'] : '' ?>">
                                <span style="color: red;"> <?php echo isset($arrayError['libelleT']) ? $arrayError['libelleT'] : '' ?></span>
                            </div>
                        </div>

                        <div class="col-md-4 col-sm-12">
                            <div class="mb-3">
                                <label for="libelle" class="form-label">Date de Début</label>
                                <input type="date" class="form-control" name="date_debut" id="libelle" value="<?= isset($tacheEdit[0]['date_debut']) ? $tacheEdit[0]['date_debut'] : '' ?>">
                                <span style="color: red;"> <?php echo isset($arrayError['date_debut']) ? $arrayError['date_debut'] : '' ?></span>
                            </div>
                        </div> <div class="col-md-4 col-sm-12">
                            <div class="mb-3">
                                <label for="libelle" class="form-label">Date de Fin</label>
                                <input type="date" class="form-control" name="date_fin" id="libelle" value="<?= isset($tacheEdit[0]['date_fin']) ? $tacheEdit[0]['date_fin'] : '' ?>">
                                <span style="color: red;"> <?php echo isset($arrayError['date_fin']) ? $arrayError['date_fin'] : '' ?></span>
                            </div>
                        </div>

                       
                        <div class="col-md-4 col-sm-12">
                            <div class="mb-3">
                                <label for="descriptionT" class="form-label">Description tâche</label>
                                <textarea  class="form-control" name="descriptionT" id="descriptionT" cols="30" rows="5" ><?= isset($tacheEdit) ? $tacheEdit[0]['descriptionT'] : '' ?></textarea>
                                <span style="color: red;"> <?php echo isset($arrayError['descriptionT']) ? $arrayError['descriptionT'] : '' ?></span>
                            </div>  
                        </div>

                        <div class="col-md-4 col-sm-12">
                            <div class="mb-3">
                                <label for="categorie" class="form-label">Affectation de Categorie tâche</label>
                                <select disabled name="idCT" id="categorie" class="form-control">
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

                        <div class="col-md-4 col-sm-12">
                            <div class="mb-3">
                                <label for="photo" class="form-label">Photo</label>
                                <input type="file" class="form-control" name="imageT" id="photo" >
                                <?= isset($tacheEdit) ? $tacheEdit[0]['imageT'] : '' ?>
                                <span style="color: red;"></span>
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