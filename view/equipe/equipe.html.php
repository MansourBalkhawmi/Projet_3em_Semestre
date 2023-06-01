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
<a href="<?=WEB_ROUTE."?controller=equipeController&view=equipe_list"?>" class="btn btn-primary mb-5 mt-5" style="background-color: #40A778;border-color:#40A778">Liste projets</a>
        <div class="card">
            <div class="card-header text-center">
                Ajouter des Tâches
            </div>
            <div class="card-body">
                <form action="<?=WEB_ROUTE?>" method="post" >
                <input type="hidden" name="controller" value="equipeController">
                <?php if(!isset($equipeEdit) || $equipeEdit[0]['idE'] == null): ?>
                    <input type="hidden" name="action" value="add_equipe">
                <?php endif; ?>
                <?php if(isset($equipeEdit) && $equipeEdit[0]['idE'] != null): ?>
                    <input type="hidden" name="action" value="edit">
                    <input type="hidden" name="idE" value="<?= $equipeEdit[0]['idE'] ?>">
                <?php endif; ?>
                    <div class="row">

                        <div class="col-md-4 col-sm-12">
                            <div class="mb-3">
                                <label for="libelle" class="form-label">Nom de l'Equipe</label>
                                <input type="text" class="form-control" name="nomE" id="libelle" value="<?= isset($equipeEdit[0]['nomE']) ? $equipeEdit[0]['nomE'] : '' ?>">
                                <span style="color: red;"> <?php echo isset($arrayError['nomE']) ? $arrayError['nomE'] : '' ?></span>
                            </div>
                        </div>

                        <div class="col-md-4 col-sm-12">
                            <div class="mb-3">
                                <label for="projet" class="form-label">Affectation de Projet</label>
                                <select name="idP" id="projet" class="form-control">
                                    <option value="0">Selectionnez le Projet</option>
                                    <?php foreach($projet_list as $projet): ?>
                        
                                        <?php if(isset($equipeEdit)&&(isset($equipeEdit[0]['idP']))&&($equipeEdit[0]['idP']==$projet['idP'])):?>
                                    <option selected value="<?= $projet['idP'] ?>"><?= $projet['nomP'] ?></option>
                                       <?php endif; ?>
                                       <?php if(!isset($equipeEdit) || isset($equipeEdit[0]['idP'])||($equipeEdit[0]['idP']!=$projet['idP'])):?>
                                    <option value="<?= $projet['idP'] ?>"><?= $projet['nomP'] ?></option>
                                       <?php endif; ?>
                                    <?php endforeach; ?>
                                </select>
                                <span style="color: red;"> <?php echo isset($arrayError['idP']) ? $arrayError['idP'] : '' ?></span>
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
                       
        <?php foreach($equipelist as $value): ?>
        <div class="col-3 mt-2" >
            <div class="card shadow">
                <div class="card-body">
                <img class="img-card" src="images/Team-Work.png" alt="" style="width: 100%;max-width: 400px;">
                    <div class="row pt-4" >
                        <h5 >Administrateur: <?=$value["prenomU"]." ".$value["nomU"]?></h5>
                        <h5 >Nom de l'équipe: <?=$value["nomE"]?></h5>
                        <h6 >Nom du Projet: <?=$value["nomP"]?></h6>
                    </div>
                    <div class="row">
                        <div class="col-6">
                        <a href="<?=WEB_ROUTE.'?controller=equipeController&view=edit&idE='.$value['idE']?>" class="btn btn-primary rounded-circle" style="background-color: green;border-color:green" title="Modifier">
                                <em class="fa fa-edit"></em>
                            </a>
                        </div>
                        <div class="col-6 text-end">
                        <a href="<?=WEB_ROUTE.'?controller=equipeController&view=delete&idE='.$value['idE']?>" class="btn btn-danger rounded-circle" title="Supprimer">
                                <em class="fa fa-trash"></em>
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
                            <?php if ($_GET['view'] == "equipe"):?>
                            <li class="page-item"><a class="page-link" href="<?=WEB_ROUTE.'?controller=equipeController&view=equipe&page='.$i?>" style="background-color:#40A778; color:white">
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