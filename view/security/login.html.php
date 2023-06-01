<?php
$arrayError=array();

if (isset($_SESSION['arrayError'])) {
    $arrayError = $_SESSION['arrayError'];
    unset($_SESSION['arrayError']);
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Slide Navbar</title>
	<link rel="stylesheet" type="text/css" href="slide navbar style.css">
<link href="https://fonts.googleapis.com/css2?family=Jost:wght@500&display=swap" rel="stylesheet">
<link rel="stylesheet" href="css/stylelogin.css">
</head>
<body>
	<div class="main">  	
		<input type="checkbox" id="chk" aria-hidden="true">

			<div class="signup">
			<form method="post" action="<?=WEB_ROUTE?>">
                <input type="hidden" name="controller" value="userController">
                <input type="hidden" name="action" value="inscrire">
					<label for="chk" aria-hidden="true" style="color: #F2845C;">INSCRIPTION</label>
					<input type="text" name="prenomU" placeholder="Prénom" required="">
					<input type="text" name="nomU" placeholder="Nom" required="">
					<input type="email" name="email" placeholder="Email" required="">
					<input type="password" name="passwordU" placeholder="mot de passe" required="">
					<button style="background-color: white;color:green">Sign up</button>
				</form>
			</div>

			<div class="login">
            <form method="post" action="<?=WEB_ROUTE?>">
                <input type="hidden" name="controller" value="securityController">
                <input type="hidden" name="action" value="email">
					<label for="chk" aria-hidden="true" style="color: #fff;">CONNEXION</label>
					<input type="email" name="email" placeholder="Email" style="border:1px solid green;">
                    <span style="color: white;margin-left:60px"> <?php echo isset($arrayError['email']) ? $arrayError['email'] : '' ?></span>
					<input type="password" name="passwordU" placeholder="mot de passe" style="border:1px solid green;">
                    <span style="color: white;margin-left:60px"> <?php echo isset($arrayError['passwordU']) ? $arrayError['passwordU'] : '' ?></span>
					<button>Login</button>
				</form>
			</div>
	</div>
</body>
</html>