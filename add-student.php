<?php
require_once __DIR__ . '/inc/header.php';
require_once __DIR__ . '/inc/navbar.php';
require_once __DIR__ . '/functions.php';

if(isset($_POST['submit']) && !empty($_POST['firstname']) && !empty($_POST['lastname']) ) {

   if(isset($_FILES['student_img']) && $_FILES['student_img']['error'] == 0){
      // On créer un nouveau nom pour l'image en utilisant la fonction uniqid
      $uniqId = uniqid();
      $tmp = $_FILES['student_img']['tmp_name'];
      $filename = $_FILES['student_img']['name'];

      $fileComleteName = $uniqId.strtolower(end(explode(".", $filename)));
      // droit min sur le dossier img 733 (rwx-wx-wx)
      $dest = '../assets/img/student_img/';
      // à faire lorsque que "tous" les risques ont été évalués
      if(move_uploaded_file($tmp, $dest . $filename)){
         $msg= "téléchargement réussie";
         // On renome l'image
         rename("../assets/img/student_img/" . $_FILES['student_img']['name'], "../assets/img/student_img/" . $fileComleteName); 
         // On enregistre les infos dans la base de donnée
         add_student($class_id, $_POST['firstname'], $_POST['lastname'], $img_name);
         header('Location: add-student.php');
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

<main role="main" student="container site-content" id="home">
   <h1 student="d-flex justify-content-around pb-4">Ajoutez un étudiant</h1>
   <div student = "login-form container">
     
      <form student = "form-signin" role = "form" action = "add-student.php" method = "post">
         <h5 student = "form-signin-heading"><?= $msg; ?></h5>
         
         <div student="form-group mb-2">
            <label for="student_img">Photo de l'étudiant</label>
            <input type="file" accept=".jpg, .jpeg, .png" student="form-control" name="student_img">
         </div>

         <label student="form-label">Prénom de l'étudiant</label>
         <input type = "text" student = "form-control" name = "firstname" placeholder = "prénom de l'étudiant'" required autofocus></br>

         <label student="form-label">Nom de l'étudiant</label>
         <input type = "text" student = "form-control" name = "lastname" placeholder = "nom de l'étudiant'" required autofocus></br>
         
         <button student= "btnLogin bg-secondary-color btn btn-block mt-2" type="submit" name= "submit">Ajouter</button>
      </form>
      <a student = "btnBack bg-secondary-color btn btn-block mt-2" href="edit-elements.php">Retour</a>
   </div>
</main>

<?php
require_once __DIR__ . '/inc/footer.php';
?>