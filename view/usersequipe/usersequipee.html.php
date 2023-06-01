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
                                <label for="produit" class="form-label">Produit</label>
                                <select class="form-select" name="idE" id="produit">
                                    <option value="0">Selectionnez un users</option>
                                    <?php  foreach($equipe_list as $equipe): ?>
                                    <?php if (isset($idequipe) && $idequipe == $equipe['idE'] || isset($usersequipeEdit)&&(isset($usersequipeEdit[0]['idE']))&&($usersequipeEdit[0]['idE']==$equipe['idE'])): ?>
                               
                                        <option selected value="<?=$equipe["idE"]?>" ><?=$equipe["nomE"]?></option>
                                        <?php endif ?>
                            
                                    <?php if (!isset($idequipe) || $idequipe != $equipe['idE'] || !isset($usersequipeEdit)||(isset($usersequipeEdit[0]['idE']))||($usersequipeEdit[0]['idE']!=$equipe['idE'])): ?>
                                        <option value="<?=$equipe["idE"]?>" ><?=$equipe["nomE"]?></option>
                                    <?php endif ?>
                                    <?php endforeach; ?>
                                 
                                </select>
                                <span style="color: red;"> <?= isset($arrayError['idE']) ? $arrayError['idE'] : '' ?></span>
                            </div>
                        </div>
                     
                        <div class="col-md-2 col-sm-12">
                             
                        </div>
                    </div>
                    <div class="row">
                    <div class="col-md-8 col-sm-12">
                            <div class="mb-3">
                                <label for="equipe" class="form-label">Utilisateurs</label>
                                <div class="col-md-8 col-sm-12">
                                <?php foreach($users_list as $val): ?>
                                 <?php $check = false ?>
                              
                                 <?php foreach ($usersequipeEdit as $value ):?>
                                    <?php if(isset($value)&&(isset($value['idU']))&&($value['idU']==$val['idU'])):?>
                                 <?php $check = true ?>
                                <?php endif;?>
                                <?php endforeach;?>
                                <?php if($check == true):
                                   ?>
                                    <?php echo $val['prenomU']." ".$val['nomU'];?>
                                <input type="checkbox" checked name="idU[]" value="<?=$val['idU'];?>" id="">
                                <?php else:?>
                                    <?php echo $val['prenomU']." ".$val['nomU'];?>
                                <input type="checkbox" name="idU[]" value="<?=$val['idU'];?>" id="">
                                <?php endif;?>
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
               
            </div>
        </div>
    </div>
    
</div>

<?php require_once(ROUTE_DIR."view/inc/end-menu.inc.html.php") ?>
<?php require_once(ROUTE_DIR."view/inc/footer.inc.html.php") ?>