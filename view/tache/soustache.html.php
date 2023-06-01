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
<a href="<?=WEB_ROUTE."?controller=tacheController&view=tache"?>" class="btn btn-primary mb-5 mt-5" style="background-color: #40A778;border-color:#40A778">Liste Tâches</a>
        <div class="card">
            <div class="card-header text-center" style="background-color: #40A778;color:white">
                Ajouter vos Sous tâches 
            </div>
            <div class="card-body">
    <form action="<?=WEB_ROUTE?>" method="post" enctype="multipart/form-data">
    <input type="hidden" name="controller" value="tacheController">
    <input type="hidden" name="action" value="soustache">
    <?php if(isset($soustacheEdit) && $soustacheEdit[0]['idST']!= null): ?>
                    <input type="hidden" name="action" value="edit">
                    <input type="hidden" name="idST" value="<?= $soustacheEdit[0]['idST'] ?>">
<?php endif; ?>
                    <div class="row">
                        <div class="col-md-3 col-sm-12">
                            <div class="mb-3">
                                <label for="libelle" class="form-label">Sous tâche</label>
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
                </form>
                <form>
        
        <div class="row mt-4">
               
<?php foreach($soustachelist as $value): ?>
<div class="col-3 mt-2" >
    <div class="card shadow">
        <div class="card-body">
        <img class="img-card" src="images/tasks-banner.png" alt="">
            <div class="row pt-4" >
                <h5 >Libelle : <?=$value["libelleST"]?></h5>
            </div>
            <div class="row">
                <div class="col-6">
                <a href="<?=WEB_ROUTE.'?controller=tacheController&view=editsoustache&idST='.$value['idST']?>" class="btn btn-primary rounded-circle" style="background-color: green;border-color:green" title="Modifier">
                        <em class="fa fa-edit"></em>
                    </a>
                </div>
                <div class="col-6 text-end">
                <a href="<?=WEB_ROUTE.'?controller=tacheController&view=deletesoustache&idST='.$value['idST']?>" class="btn btn-danger rounded-circle" title="Supprimer">
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
                    <?php if ($_GET['view'] == "soustache"):?>
                    <li class="page-item"><a class="page-link" href="<?=WEB_ROUTE.'?controller=tacheController&view=soustache&page='.$i?>" style="background-color:#40A778; color:white">
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