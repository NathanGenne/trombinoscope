<?php
require_once __DIR__ . '/inc/header.php';
require_once __DIR__ . '/inc/navbar.php';
require_once __DIR__ . '/functions.php';

if(isset($_POST['submit']) && !empty($_POST['class_name'])) {

   if(isset($_FILES['class_img']) && $_FILES['class_img']['error'] == 0){
      // On créer un nouveau nom pour l'image en utilisant la fonction uniqid
      $uniqId = uniqid();
      $tmp = $_FILES['class_img']['tmp_name'];
      $filename = $_FILES['class_img']['name'];

      $fileComleteName = $uniqId.strtolower(end(explode(".", $filename)));
      // droit min sur le dossier img 733 (rwx-wx-wx)
      $dest = '../assets/img/class_img/';
      // à faire lorsque que "tous" les risques ont été évalués
      if(move_uploaded_file($tmp, $dest . $filename)){
         $msg= "téléchargement réussie";
         // On renome l'image
         rename("../assets/img/class_img/" . $_FILES['class_img']['name'], "../assets/img/class_img/" . $fileComleteName); 
         // On enregistre les infos dans la base de donnée
         add_class($_POST['class_name'], $img_name);
         header('Location: edit-elements.php');
      }
      else {
         $msg= "échec du téléchargement";
      }
   }
   else {
      $msg= "l'image n'est pas valable";
   }
}
else {
   $msg= "Un des champs est vide";
}

?>

<main role="main" class="container site-content" id="home">
   <h1 class="d-flex justify-content-around pb-4">Ajoutez une classe</h1>
   <div class = "login-form container">
     
      <form class = "form-signin" role = "form" action = "add-class.php" method = "post">
         <h5 class = "form-signin-heading"><?= $msg; ?></h5>
         
         <div class="form-group mb-2">
            <label for="class_img">Photo de la classe</label>
            <input type="file" accept=".jpg, .jpeg, .png" class="form-control" name="class_img">
         </div>

         <label class="form-label">Nom de la classe</label>
         <input type = "text" class = "form-control" name = "class_name" placeholder = "nom de la classe" required autofocus></br>
         
         <button class= "btnLogin bg-secondary-color btn btn-block mt-2" type="submit" name= "submit">Ajouter</button>
      </form>
      
      <a class = "btnBack bg-secondary-color btn btn-block mt-2" href="edit-elements.php">Retour</a>
   </div>
</main>

<?php
require_once __DIR__ . '/inc/footer.php';
?>