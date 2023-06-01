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
                <?php if(!isset($tacheEdit) || $tacheEdit['idT'] == null): ?>
                    <input type="hidden" name="action" value="add_tache">
                <?php endif; ?>
                <?php if(isset($tacheEdit) && $tacheEdit['idT'] != null): ?>
                    <input type="hidden" name="action" value="edit">
                    <input type="hidden" name="id" value="<?= $tacheEdit['idT'] ?>">
                <?php endif; ?>
                    <div class="row">

                        <div class="col-md-4 col-sm-12">
                            <div class="mb-3">
                                <label for="libelle" class="form-label">Libelle Tâche</label>
                                <input type="text" class="form-control" name="libelleT" id="libelle" value="<?= isset($tacheEdit['libelleT']) ? $tacheEdit['libelleCT'] : '' ?>">
                                <span style="color: red;"> <?php echo isset($arrayError['libelleT']) ? $arrayError['libelleT'] : '' ?></span>
                            </div>
                        </div>

                        <div class="col-md-4 col-sm-12">
                            <div class="mb-3">
                                <label for="libelle" class="form-label">Date de Début</label>
                                <input type="date" class="form-control" name="date_debut" id="libelle" value="<?= isset($tacheEdit['date_debut']) ? $tacheEdit['date_debut'] : '' ?>">
                                <span style="color: red;"> <?php echo isset($arrayError['date_debut']) ? $arrayError['date_debut'] : '' ?></span>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-12">
                            <div class="mb-3">
                                <label for="date_fin" class="form-label">Date de Fin</label>
                                <input type="date" class="form-control" name="date_fin" id="date_fin" value="<?= isset($tacheEdit['date_fin']) ? $tacheEdit['date_fin'] : '' ?>">
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
                                <select name="idCT" id="categorie" class="form-control">
                                    <option value="0">Selectionnez une categorie</option>
                                    <?php foreach($categorie_tache as $categorie): ?>
                        
                                        <?php if(isset($tacheEdit)&&(isset($tacheEdit[0]['idT']))&&($tacheEdit[0]['idT']==$categorie['idCT'])):?>
                                    <option selected value="<?= $categorie['idCT'] ?>"><?= $categorie['libelleCT'] ?></option>
                                       <?php endif; ?>
                                       <?php if(!isset($tacheEdit) || isset($tacheEdit[0]['idT'])||($tacheEdit[0]['idT']!=$categorie['idCT'])):?>
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
                                <?= isset($tacheEdit) ? $tacheEdit['imageT'] : '' ?>
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
                <form>
        
                <div class="row mt-4">
                       
        <?php foreach($tachelist as $value): ?>
        <div class="col-3 mt-2" >
            <div class="card shadow">
                <div class="card-body">
                <img class="img-card" src="<?=WEB_ROUTE.'/images/Tache/'.$value['imageT']?>" alt="">
                    <div class="row pt-4" >
                        <h5 >Nom: <?=$value["libelleT"]?></h5>
                        <h6 >Description tache: <?=$value["descriptionT"]?></h6>
                        <h6 >Catégorie: <?=$value["libelleCT"]?></h6>
                        <h6 >Nom du Projet: <?=$value["nomP"]?></h6>
                        <h6 >Date début:<?=$value["date_debut"]?></h6>
                        <h6 >Date de Fin:<?=$value["date_fin"]?></h6>
                    </div>
                    <div class="row">
                        <div class="col-5">
                        <a href="<?=WEB_ROUTE.'?controller=tacheController&view=edit&idT='.$value['idT']?>" class="btn btn-primary rounded-circle" style="background-color: green;border-color:green" title="Modifier">
                                <em class="fa fa-edit"></em>
                            </a>
                        </div>
                        <div class="col-4">
                        <a href="<?=WEB_ROUTE.'?controller=tacheController&view=soustache&idT='.$value['idT']?>" class="btn btn-primary rounded-circle" style="background-color: green;border-color:green" title="Sous Tâches">
                                <em class="fa fa-add"></em>
                            </a>
                        </div>
                        <div class="col-3 text-end">
                        <a href="<?=WEB_ROUTE.'?controller=tacheController&view=delete&idT='.$value['idT']?>" class="btn btn-danger rounded-circle" title="Supprimer">
                                <em class="fa fa-trash"></em>
                            </a>
                        </div>
                        <div class="mt-4 ml-5">
                        <a href="<?=WEB_ROUTE.'?controller=tacheController&view=edit1&idT='.$value['idT']?>" class="bb btn btn-primary mb-2 mt-2" style="background-color: black;border-color:#0000 !important">Tranfert Catégorie
                        </a>
                    </div>
                    </div>
                   
                </div>
            </div>
        </div>
        <?php endforeach; ?>
        <nav aria-label="Page navigation example" style="margin-top:30px;">
                         <ul class="pagination justify-content-center">
                            <?php for ($i=1; $i <=$nbrPage  ; $i++): ?>
                            <?php if ($_GET['view'] == "tache"):?>
                            <li class="page-item"><a class="page-link" href="<?=WEB_ROUTE.'?controller=tacheController&view=tache&page='.$i?>" style="background-color:#40A778; color:white">
                            <?= $i ?></a></li>
                            <?php endif;?>
                            <?php endfor;?>
                        </ul>
         </nav>
    </div>

                    </form>
            </div>
        </div>
    </div>
    
</div>

<?php require_once(ROUTE_DIR."view/inc/end-menu.inc.html.php") ?>
<?php require_once(ROUTE_DIR."view/inc/footer.inc.html.php") ?>