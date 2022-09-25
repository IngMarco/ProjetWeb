
<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" href="styles.css" />
</head>
<body class="login ">
<?php
require('connexion.php');
session_start();
if (isset($_POST['username'])){
  $username = stripslashes($_REQUEST['username']);
  $username = mysqli_real_escape_string($conn, $username);
  $password = stripslashes($_REQUEST['password']);
  $password = mysqli_real_escape_string($conn, $password);
$query = "SELECT * FROM `users` WHERE username='$username' and password='$password'";
  $result = mysqli_query($conn,$query) or die(mysql_error());
  $data=mysqli_fetch_assoc($result);
  $rows = mysqli_num_rows($result);

  if($rows==1){
    if($data['type']==1){
      $_SESSION['username'] = $data['username'];
      header("Location: vendeur.php");
    }

    if($data['type']==2){
      $_SESSION['username'] = $data['username'];
      header("Location: comptable.php");
    }

  }
  else{
    $message = "Le nom d'utilisateur ou le mot de passe est incorrect.";
  }
}
?>
<form class="box" action="" method="post" name="login">
<h1 class="box-title">Connexion</h1>
<input type="text" class="box-input" name="username" placeholder="Username">
<input type="password" class="box-input" name="password" placeholder="Password">
<input type="submit" value="Sign In " name="submit" class="box-button">
<p class="box-register">Vous êtes nouveau ici? <a href="register.php">S'inscrire</a></p>
<?php if (! empty($message)) { ?>
    <p class="errorMessage"><?php echo $message; ?></p>
<?php } ?>
</form>
</body>
</html>
