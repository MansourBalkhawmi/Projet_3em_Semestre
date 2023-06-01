<?php 
if (!isset($_SESSION['userConnect'])) {
    header("location:" . WEB_ROUTE . '?controlleur=securityController&view=email');
  }
require_once(ROUTE_DIR."view/inc/menu.inc.html.php");
?>

<div class="row">
<div class="col-md-12 col-sm-12">
<a href="<?=WEB_ROUTE."?controller=usersequipeController&view=usersequipe"?>" class="btn btn-primary mb-5 mt-5" style="background-color: green;border-color:green">Affectation Tâches</a>
<form method="GET" action="<?php echo WEB_ROUTE ?>" style="margin-left: 60%;"> 
    <input type="hidden" name="controller" value="approvisionnementController">
    <input type="hidden" name="view" value="filtrer" >
        </form>
        <div class="card">
            <div class="card-header text-center">
                Tâches Attribuées
            </div>
            <div class="card-body">
                <table class="table table-striped col-12 table-responsive">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Réalisateur</th>
                            <th>Tâche</th>
                            <th>Catégorie Tâche</th>
                            <th>Projet</th>
                            <th>Début</th>
                            <th>Fin</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($affectachelist as $key => $value): ?>
                        <tr>
                            <td><?= $key+1 ?></td>
                            <td><?= $value["prenomU"]."  ".$value['nomU'] ?></td>
                            <td><?= $value["libelleT"] ?></td>
                            <td><?= $value["libelleCT"] ?></td>
                            <td><?= $value["nomP"] ?></td>
                            <td><?= $value["date_debut"] ?></td>
                            <td><?= $value["date_fin"] ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </body>
                </table>
                <nav aria-label="Page navigation example" style="margin-top:30px;">
    <ul class="pagination justify-content-center">
        <?php for ($i=1; $i <=$nbrPage  ; $i++): ?>
        <li class="page-item"><a class="page-link" href="<?=WEB_ROUTE.'?controller=affectacheController&view=affectache_list&page='.$i?>"  style="background-color:#40A778; color:white">
            <?= $i ?></a></li>

        <?php endfor;?>
    </ul>
</nav>
            </div>
        </div>
    </div>
    
</div>

<?php require_once(ROUTE_DIR."view/inc/end-menu.inc.html.php") ?>
<?php require_once(ROUTE_DIR."view/inc/footer.inc.html.php") ?>