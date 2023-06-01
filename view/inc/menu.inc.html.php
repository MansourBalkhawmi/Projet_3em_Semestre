<?php 
require_once(ROUTE_DIR."view/inc/header.inc.html.php");
?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

<header class="header" id="header">
        <div class="header_toggle" > <i class='bx bx-menu' id="header-toggle" style="color:#F2B15C;"></i> </div>
        <div class="header_img"> <img src="https://i.imgur.com/hczKIze.jpg" alt=""> </div>
    </header>
    <div class="l-navbar" id="nav-bar" style="background-color: #F2B15C;">
        <nav class="nav">
            <div> 
                <a href="<?=WEB_ROUTE."?controller=securityController&view=accueil"?>" class="nav_logo"> <i class="ic fa-sharp fa-solid fa-scissors" title="Accueil"></i> <span class="nav_logo-name">SUNU TAILLEURS</span> </a>
                <div class="nav_list"> 
                    <!-- <a href="#" class="nav_link active"> <i class='bx bx-grid-alt nav_icon'></i> <span class="nav_name">Dashboard</span> </a>  -->
                    
                    <a href="<?=WEB_ROUTE."?controller=projetController&view=projet_list"?>" class="nav_link"> 
                    <i class="ic fa-solid fa-folder-open" title="Création de Projet"></i>
                        <span class="nav_name">Mes Projets</span> 
                    </a>

                    <a href="<?=WEB_ROUTE."?controller=categorie_tacheController&view=categorie_tache_list"?>" class="nav_link"> 
                    <i class=" ic fa-solid fa-tags" title="Articles Confection"></i>
                        <span class="nav_name">Catégorie de Tâches</span> 
                    </a>
                    <a href="<?=WEB_ROUTE."?controller=tacheController&view=tache"?>" class="nav_link"> 
                    <i class="ic fa-sharp fa-solid fa-boxes-stacked" title="Les Tâches"></i>
                        <span class="nav_name">Tâche</span> 
                    </a>

                    <a href="<?=WEB_ROUTE."?controller=equipeController&view=equipe"?>" class="nav_link"> 
                    <i class="ic fa-solid fa-users-gear" title="Mes Equipes"></i>
                        <span class="nav_name">Mes Equipes</span> 
                    </a>

                    <a href="<?=WEB_ROUTE."?controller=usersequipeController&view=usersequipe"?>" class="nav_link"> 
                    <i class=" ic fa-solid fa-user-tag" title="Mon équipe"></i>
                        <span class="nav_name">Groupe</span> 
                    </a>
                    <a href="<?=WEB_ROUTE."?controller=affectacheController&view=affectache_list"?>" class="nav_link"> 
                    <i class="ic fa-solid fa-list-check" title="Les des Tâches attribuées"></i>
                        <span class="nav_name">Mes Tâches</span> 
                    </a>
                    <a href="<?=WEB_ROUTE."?controller=articleventeController&view=articlevente_list"?>" class="nav_link"> 
                    <i class=" ic fa-sharp fa-solid fa-bag-shopping" title="Article de Vente"></i>
                        <span class="nav_name">Article de Vente</span> 
                    </a>
                    </a>
                    <a href="<?=WEB_ROUTE."?controller=venteController&view=vente_list"?>" class="nav_link"> 
                    <i class="ic fa-solid fa-cart-shopping" title="Vente"></i>
                        <span class="nav_name" title="Vente">Vente</span> 
                    </a>
                    <a href="<?=WEB_ROUTE."?controller=venteController&view=vente"?>" class="nav_link"> 
                    <i class="ic fa-solid fa-handshake" title="Production"></i>
                        <span class="nav_name">Production</span> 
                    </a>
                    
                </div>
            </div> 
            <a href="<?=WEB_ROUTE."?controller=securityController&view=deconnexion"?>" class="nav_link"> 
                <i class="ic bx bx-log-out nav_icon" style="font-weight:800" title="Déconnecter"></i> 
                <span class="nav_name">Se Déconnecter</span> 
            </a>
        </nav>
    </div>
    <style>
        .ic{
    font-size: 2.8vh;
    transition: transform .2s; /* Animation */
}
.ic:hover{
    color: #41769B;
    transform: scale(1.5); /* (150% zoom - Note: if the zoom is too large, it will go outside of the viewport) */
    }
    </style>
    <!--Container Main start-->
    <div class="height-100 bg-light">

 