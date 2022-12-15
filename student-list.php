<?php
require_once __DIR__ . '/inc/header.php';
require_once __DIR__ . '/inc/navbar.php';
require_once __DIR__ . '/functions.php';

$students = get_students_by_classe_name($_GET["classe-name"]);
?>

<main role="main" class="mt-3 text-center" id="student">
    <h2 class="titles">Liste des élèves de <?= $_GET["classe-name"] ?></h2>
    <div class="student-list row row-cols-1 row-cols-sm-2 row-cols-md-4">
        <?php foreach($students as $student) : ?>
        <div class="hoverwrap col m-2">
            <img src="assets/img/students_img/<?= $student["student_img"] ?>" alt="<?= $student["firstname"]." ".$student["lastname"] ?>">
            <div class="hovercap"><?= $student["firstname"]." ".$student["lastname"] ?></div>
        </div>
        <?php endforeach; ?>
    </div>
    
</main>
<div class="separator"></div>

<?php
require_once __DIR__ . '/inc/footer.php';
?>