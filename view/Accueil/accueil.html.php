<link rel="stylesheet" href="css/accueil.css">
<?php 
if (!isset($_SESSION['userConnect'])) {
  header("location:" . WEB_ROUTE . '?controlleur=securityController&view=email');
}
require_once(ROUTE_DIR."view/inc/menu.inc.html.php");
?>

<body>

<!-- Header -->
<div style="text-align:center;">
  <h1>Bienvenue chez Nous</h1>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>

<section class="bg-light pt-5 pb-5 shadow-sm">
  <div class="container">
    <div class="row pt-5">
      <div class="col-12">
        <h3 class="text-uppercase border-bottom mb-4">Equal height Bootstrap 5 cards example</h3>
      </div>
    </div>
    <div class="row">
      <!--ADD CLASSES HERE d-flex align-items-stretch-->
      <div class="col-lg-4 mb-3 d-flex align-items-stretch">
        <div class="card">
          <img src="https://tinypic.host/images/2023/02/21/pikrepo.com-2.jpg" class="card-img-top" alt="Card Image">
          <div class="card-body d-flex flex-column">
            <h5 class="card-title">Dōtonbori Canal</h5>
            <p class="card-text mb-4">Is a manmade waterway dug in the early 1600's and now displays many landmark commercial locals and vivid neon signs.</p>
            <a href="#" class="btn btn-primary text-white mt-auto align-self-start">Book now</a>
          </div>
        </div>
      </div>
      <!--ADD CLASSES HERE d-flex align-items-stretch-->
      <div class="col-lg-4 mb-3 d-flex align-items-stretch">
        <div class="card">
          <img src="https://tinypic.host/images/2023/02/21/pikrepo.com-2.jpg" class="card-img-top" alt="Card Image">
          <div class="card-body d-flex flex-column">
            <h5 class="card-title">Porto Timoni Double Beach</h5>
            <p class="card-text mb-4">Near Afionas village, on the west coast of Corfu island. The two beaches form two unique bays. The turquoise color of the sea contrasts to the high green hills surrounding it.</p>
            <a href="#" class="btn btn-primary text-white mt-auto align-self-start">Book now</a>
          </div>
        </div>
      </div>
      <!--ADD CLASSES HERE d-flex align-items-stretch-->
      <div class="col-lg-4 mb-3 d-flex align-items-stretch">
        <div class="card">
          <img src="https://tinypic.host/images/2023/02/21/pikrepo.com-2.jpg" class="card-img-top" alt="Card Image">
          <div class="card-body d-flex flex-column">
            <h5 class="card-title">Tritons Fountain</h5>
            <p class="card-text mb-4">Located just outside the City Gate of Valletta, Malta. It consists of three bronze Tritons holding up a large basin, balanced on a concentric base built out of concrete and clad in travertine slabs.</p>
            <a href="#" class="btn btn-primary text-white mt-auto align-self-start">Book now</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

</body>
</html>

<?php require_once(ROUTE_DIR."view/inc/end-menu.inc.html.php") ?>
<?php require_once(ROUTE_DIR."view/inc/footer.inc.html.php") ?>