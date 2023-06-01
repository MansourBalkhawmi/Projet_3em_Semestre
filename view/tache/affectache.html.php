<?php 
require_once(ROUTE_DIR."view/inc/menu.inc.html.php");
$arrayError = array();

if (isset($_SESSION['arrayError'])) {
  $arrayError = $_SESSION['arrayError'];
  unset($_SESSION['arrayError']);
}
if (!isset($_SESSION['userConnect'])) {
    header("location:" . WEB_ROUTE . '?controlleur=securityController&view=email');
  }


?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />


<div class="row">
<div class="col-md-12 col-sm-12">
<a href="<?=WEB_ROUTE."?controller=usersequipeController&view=detail"?>" class="btn btn-primary mb-5 mt-2"style="background-color: green;border-color:green;color:white">Liste Membres</a>
        <div class="card" style="margin-top: -3%;">
            <div class="card-header text-center">
               Affectation de Tâche
            </div>
            <div class="card-body">
                <form action="<?=WEB_ROUTE?>" method="post">
                <input type="hidden" name="controller" value="affectacheController">
                <?php if(!isset($affectacheEdit) || $affectacheEdit[0]['idUE'] == null): ?>
                    <input type="hidden" name="action" value="affectache">
                <?php endif; ?>
                <?php if(isset($affectacheEdit) && $affectacheEdit[0]['idUE'] != null): ?>
                    <input type="hidden" name="action" value="edit">
                    <input type="hidden" name="idUE" value="<?= $affectacheEdit[0]['idUE'] ?>">
                <?php endif; ?>
              
                    <div class="row">
                    <div class="col-md-8 col-sm-12">
                            <div class="mb-3">
                                <label for="equipe" class="form-label">Mes Tâches</label>
                                <div class="col-md-8 col-sm-12">
                                <?php foreach($tache as $val): ?>
                                 <?php $check = false ?>
                              <!--    <?php foreach ($affectacheEdit as $value ):?>
                                    <?php if(isset($affectacheEdit)&&(isset($affectacheEdit[0]['idU']))&&($affectacheEdit[0]['idU']==$val['idT'])):?>
                                 <?php $check = true ?>
                                <?php endif;?>
                                <?php endforeach;?> -->
                                <?php if($check == true):?>
                                    <?php echo $val['libelleT'];?>
                                <input type="checkbox" checked name="idT[]" value="<?=$val['libelleT'];?>" id="">
                                <?php else:?>
                                    <?php echo $val['libelleT'];?>
                                <input type="checkbox" name="idT[]" value="<?=$val['idT'];?>" id=""><br>
                                <?php endif;?>
                                <?php endforeach;?>
                                <span style="color: red;"> <?= isset($arrayError['idT']) ? $arrayError['idT'] : '' ?></span>
                                </div>
                            </div>
                        </div>

                       
                    </div>
                    <div class="row">
                        <div class="col-md-2 col-sm-12">
                            <button class="btn btn-primary mt-1"name="ajouter" value="ajouter" type="submit" style="background-color: green;border-color:green;color:white">Valider</button>
                        </div>
                    </div>
                </form>
                <form>
        
        <div class="row mt-4">
               
<?php foreach($affectachelist as $value): ?>
<div class="col-3 mt-2" >
    <div class="card shadow">
        <div class="card-body">
        <img class="img-card" src="images/GettyImages-941265460-1600x1039.jpg" alt="" style="width: 100%;max-width: 400px;">
            <div class="row pt-4" >
                <h5 >Tâche: <?=$value["libelleT"]?></h5>
                <h6 >Proprieté: <?=$value["prenomU"]." ".$value["nomU"]?></h6>
            </div>
          
           
        </div>
    </div>
</div>
<?php endforeach; ?>
<nav aria-label="Page navigation example" style="margin-top:30px;">
                 <ul class="pagination justify-content-center">
                    <?php for ($i=1; $i <=$nbrPage  ; $i++): ?>
                    <?php if ($_GET['view'] == "affectache"):?>
                    <li class="page-item"><a class="page-link" href="<?=WEB_ROUTE.'?controller=affectacheController&view=affectache&page='.$i?>" style="background-color:#40A778; color:white">
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