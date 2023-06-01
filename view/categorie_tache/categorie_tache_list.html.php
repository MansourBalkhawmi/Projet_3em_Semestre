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
        <div class="card">
            <div class="card-header text-center">
                Liste des categories de confection
            </div>
            <div class="card-body">
                <form>
        
                <div class="row mt-4">
                        <table class="table">
                            <thead>
                                <tr>
                                <th scope="col">#</th>
                                <th scope="col">Libelle Categorie</th>
                                <th scope="col">Pojet</th>
                                <th scope="col">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php foreach($categorie_tachelist as $key => $value): ?>
                                <tr>
                                <td><?= $key+1 ?></td>
                                <td><?=$value["libelleCT"]?></td>
                                <td><?=$value["nomP"]?></td>
                                <td>
                                <a href="<?=WEB_ROUTE.'?controller=categorie_tacheController&view=edit&idCT='.$value['idCT']?>" class="btn "  style="background: none;"><i class="edit fa-solid fa-pen-to-square"title="Editer"></i></a>
                                <a href="<?=WEB_ROUTE.'?controller=categorie_tacheController&view=delete&idCT='.$value['idCT']?>" class="btn btn-danger"  style="background: none;"><i class="del fa-sharp fa-solid fa-trash" title="Archiver"></i></a>
                                </td>
                                </tr>
                                
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    <nav aria-label="Page navigation example" style="margin-top:30px;">
                         <ul class="pagination justify-content-center">
                            <?php for ($i=1; $i <=$nbrPage  ; $i++): ?>
                            <?php if ($_GET['view'] == "categorie_tache"):?>
                            <li class="page-item"><a class="page-link" href="<?=WEB_ROUTE.'?controller=categorie_tacheController&view=categorie_tache&page='.$i?>" style="background-color:#40A778; color:white">
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