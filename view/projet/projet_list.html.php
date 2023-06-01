<?php 
if (!isset($_SESSION['userConnect'])) {
    header("location:" . WEB_ROUTE . '?controlleur=securityController&view=email');
  }
require_once(ROUTE_DIR."view/inc/menu.inc.html.php");
?>
<link rel="stylesheet" href="css/bouton.css">
<style>
</style>
<div class="row">
<form method="GET" action="<?php echo WEB_ROUTE ?>" enctype="multipart/form-data">
<input type="hidden" name="controller" value="projetController">
<input type="hidden" name="view" value="filtrer" >
<div class="col-md-12 col-sm-12"> 
<a href="<?=WEB_ROUTE."?controller=projetController&view=projet"?>" class="btn btn-primary mb-5 mt-5" style="background-color: #40A778;border-color:#40A778">Créer Projet</a>
<div class="mb-3">
      <input  class="search" type="text" name="lib" id=" " placeholder="Rechercher" style="outline: none;border:2px solid #40A778"> 
      <button type="submit" name="submit" style="background:none;border:none" ><i class=" sear fa-solid fa-magnifying-glass" style="color:#40A778;font-size:1.3em"></i></button>

      </div> 
    <div class="row">
        <?php foreach($Projetlist as $projet): ?>
        <div class="col-3 mt-2" >
            <div class="card shadow">
                <div class="card-body">
                    <img class="img-card" src="images/intro.jpg" alt="" style="width: 100%;max-width: 400px;">
                    <div class="row pt-4" >
                        <h5 >Nom du Projet:  <?=$projet['nomP']?></h5>
                        <h5 >Description: <?=$projet['descriptionP']?></h5>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <a href="<?=WEB_ROUTE.'?controller=projetController&view=edit&idP='.$projet['idP']?>" class="btn btn-primary rounded-circle" style="background-color: green;border-color:green" title="Modifier">
                                <em class="fa fa-edit"></em>
                            </a>
                        </div>
                        <div class="col-6 text-end">
                            <a href="<?= WEB_ROUTE.'/?controller=projetController&view=delete&idP='.$projet['idP']?>" class="btn btn-danger rounded-circle" title="Supprimer">
                                <em class="fa fa-trash"></em>
                            </a>
                        </div>
                    </div>
                    <div class="mt-4 ml-5">
                        <a href="<?=WEB_ROUTE.'?controller=categorie_tacheController&view=categorie_tache&idP='.$projet['idP']?>" class="bb btn btn-primary mb-2 mt-2" style="background-color: black;border-color:#0000 !important">Ajouter Categorie
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
        <nav aria-label="Page navigation example" style="margin-top:30px;">
            <ul class="pagination justify-content-center">
                <?php for ($i=1; $i <=$nbrPage  ; $i++): ?>
                    <?php if ($_GET['view'] == "projet_list"):?>
                <li class="page-item"><a class="page-link" href="<?=WEB_ROUTE.'?controller=projetController&view=projet_list&page='.$i?>" style="background-color:green; color:white">
                    <?= $i ?></a></li>
                    <?php endif;?>
                <?php endfor;?>
            </ul>
        </nav>
    </div>
    </div>
    </form>  
</div>

<style>


    @media all and (max-width : 320px) {
        .row{
            display: flex;
            flex-wrap: wrap;
        }
        .col-3{
            width: 100%;
        }
        input.search{
            width: 55%;
        }
    }
    @media all and (max-width : 375px) {
        .row{
            display: flex;
            flex-wrap: wrap;
        }
        .col-3{
            width: 100%;
        }
        input.search{
            width: 70%;
        }
    }
    @media all and (min-width : 425px) {
        .row{
            display: flex;
            flex-wrap: wrap;
        }
        .col-3{
            width: 100%;
        }
    }
      @media all and (max-width : 425px) {
        .row{
            display: flex;
            flex-wrap: wrap;
        }
        .col-3{
            width: 100%;
        }
        input.search{
            width: 80%;
        }
    }
    @media all and (min-width : 768px) {
        .row{
            display: flex;
            flex-wrap: wrap;
        }
        .col-3{
            width: 50%;
        }
        input.search{
            width: 43%;
        }
    }
    @media all and (min-width : 1024px) {
        .row{
            display: flex;
            flex-wrap: wrap;
        }
        .col-3{
            width: 33%;
        }
        input.search{
            width: 28%;
        }
    }
    @media all and (min-width : 1440px) {
        .row{
            display: flex;
            flex-wrap: wrap;
        }
        .col-3{
            width: 25%;
        }
        input.search{
            width: 22%;
        }
    }
        
</style>

<?php require_once(ROUTE_DIR."view/inc/end-menu.inc.html.php") ?>
<?php require_once(ROUTE_DIR."view/inc/footer.inc.html.php") ?>