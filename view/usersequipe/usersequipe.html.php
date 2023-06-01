<?php 
require_once(ROUTE_DIR."view/inc/menu.inc.html.php");
$arrayError = array();

if (isset($_SESSION['arrayError'])) {
  $arrayError = $_SESSION['arrayError'];
  unset($_SESSION['arrayError']);
}
if (isset($_SESSION["idE"])) {
    $idequipe = $_SESSION["idE"];
    unset($_SESSION["idE"]);
}
if (isset($_SESSION["idU"])) {
    $iduser = $_SESSION["idU"];
    unset($_SESSION["idU"]);
}
if (!isset($_SESSION['userConnect'])) {
    header("location:" . WEB_ROUTE . '?controlleur=securityController&view=email');
  }

?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />


<div class="row">
<div class="col-md-12 col-sm-12">
<a href="<?=WEB_ROUTE."?controller=usersequipeController&view=approvisionnement_list"?>" class="btn btn-primary mb-5 mt-2"style="background-color: green;border-color:green;color:white">Liste Approvisionnements</a>
        <div class="card" style="margin-top: -3%;">
            <div class="card-header text-center">
                Ajouter les membres d'équipe
            </div>
            <div class="card-body">
                <form action="<?=WEB_ROUTE?>" method="post">
                <input type="hidden" name="controller" value="usersequipeController">
                <?php if(!isset($usersequipeEdit) || $usersequipeEdit[0]['idUE'] == null): ?>
                    <input type="hidden" name="action" value="usersequipe">
                <?php endif; ?>
                <?php if(isset($usersequipeEdit) && $usersequipeEdit[0]['idUE'] != null): ?>
                    <input type="hidden" name="action" value="edit">
                    <input type="hidden" name="idUE" value="<?= $usersequipeEdit[0]['idUE'] ?>">
                <?php endif; ?>
              
                
                    <div class="row">
                    <div class="col-md-4 col-sm-12">
                            <div class="mb-3">
                                <label for="produit" class="form-label">Equipe</label>
                                <select class="form-select" name="idE" id="produit">
                                    <option value="0">Selectionnez un users</option>
                                    <?php foreach($equipe_list as $equipe): ?>
                                    <?php if (isset($idequipe) && $idequipe == $equipe['idE']) : ?>
                                        <option selected value="<?=$equipe["idE"]?>" ><?=$equipe["nomE"]?></option>
                                    <?php endif ?>
                                    <?php if (!isset($idequipe) || $idequipe != $equipe['idE']) : ?>
                                        <option value="<?=$equipe["idE"]?>" ><?=$equipe["nomE"]?></option>
                                    <?php endif ?>
                                    <?php endforeach; ?>
                                 
                                </select>
                                <span style="color: red;"> <?= isset($arrayError['idE']) ? $arrayError['idE'] : '' ?></span>
                            </div>
                        </div>
                     
                        <div class="col-md-2 col-sm-12">
                            <div class="mt-4">
                                <button class="btn btn-outline-secondary" name="valider" type="submit" value="valider" style="background-color: green;color:white;margin-top:7px">Valider</button>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                    <div class="col-md-8 col-sm-12">
                            <div class="mb-3">
                                <label for="equipe" class="form-label">Utilisateurs</label>
                                <div class="col-md-8 col-sm-12">
                                <?php foreach($users_list as $val): ?>
                                    <?php echo $val['prenomU']." ".$val['nomU'];?>
                                <input type="checkbox" name="idU[]" value="<?=$val['idU'];?>" id="">
                                <?php endforeach;?>
                                <span style="color: red;"> <?= isset($arrayError['idU']) ? $arrayError['idU'] : '' ?></span>
                                </div>
                            </div>
                        </div>

                       
                    </div>
                    <div class="row">
                        <div class="col-md-2 col-sm-12">
                            <button class="btn btn-primary mt-1"name="ajouter" value="ajouter" type="submit" style="background-color: green;border-color:green;color:white">Enregistrer</button>
                        </div>
                    </div>
                </form>
                <form>
        
        <div class="row mt-4">
               
<?php foreach($userequipelist as $value): ?>
<div class="col-3 mt-2" >
    <div class="card shadow">
        <div class="card-body">
        <img class="img-card" src="images/GettyImages-941265460-1600x1039.jpg" alt="" style="width: 100%;max-width: 400px;">
            <div class="row pt-4" >
                <h5 >Nom de l'équipe: <?=$value["nomE"]?></h5>
                <h6 >Nom du Projet: <?=$value["nomP"]?></h6>
            </div>
            <div class="row">
                <div class="col-6">
                <a href="<?=WEB_ROUTE.'?controller=usersequipeController&view=edit&idE='.$value['idE']?>" class="btn btn-primary rounded-circle" style="background-color: green;border-color:green" title="Modifier">
                        <em class="fa fa-edit"></em>
                    </a>
                </div>
                <div class="col-6 text-end">
        
                </div>
                <div class="mt-4 ml-5">
                        <a href="<?=WEB_ROUTE.'?controller=usersequipeController&view=detail&idE='.$value['idE']?>" class="bb btn btn-primary mb-2 mt-2" style="background-color: black;border-color:#0000 !important">Voir membres 
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