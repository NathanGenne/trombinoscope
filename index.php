<?php
require_once __DIR__ . '/inc/header.php';
require_once __DIR__ . '/inc/navbar.php';
require_once __DIR__ . '/functions.php';

$msg = '';
if (isset($_POST['login']) && !empty($_POST['username']) 
   && !empty($_POST['password'])) {
      /* Sécurité supplémentaire */
      $username = htmlspecialchars($_POST['username']);
      $pwd      = htmlspecialchars($_POST['password']);
      $user = get_user($username, $pwd);
   if ( $user ) {
      $_SESSION['valid'] = true;
      $_SESSION['role'] = $user['role'];
      $_SESSION['id'] = $user['id'];
      $_SESSION['username'] = $username;
      
      header('Location: class-list.php');
   } else {
      $msg = "Mauvais pseudo ou mot de passe";
   }
}
?>

<main role="main" class="pt-5 container mt-3 site-content" id="home">
    <h1 class="d-flex justify-content-around pt-5 pb-4">Connectez-vous !</h1>
    <div class = "login-form container">
      
        <form class = "form-signin" role = "form"
        action = "<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" 
        method = "post">
           <h5 class = "form-signin-heading"><?php echo $msg; ?></h5>
           <input type = "text" class = "form-control" 
              name = "username" placeholder = "pseudo = admin/user" 
              required autofocus></br>
           <input type = "password" class = "form-control"
              name = "password" placeholder = "mot de passe = admin/user" required>
           <button class = "btnLogin bg-secondary-color btn btn-lg btn-block mt-4" type = "submit" 
              name = "login">Connexion</button>
        </form>
         
    </div>
</main>
<?php
require_once __DIR__ . '/inc/footer.php';