<?php
require_once __DIR__ . '/inc/header.php';
require_once __DIR__ . '/inc/navbar.php';
require_once __DIR__ . '/functions.php';

$classes = get_classes();
?>

<main role="main" class="mt-3 text-center" id="classe">
    <h2 class="titles">Liste des classes</h2>
    <div class="classe-list row row-cols-1 row-cols-sm-1 row-cols-md-2">
        <?php foreach($classes as $classe) : ?>
        <a class="col" href="student-list.php?classe-name=<?= $classe["class_name"] ?>">
            <div class="hoverwrap classe m-2">
                <img src="assets/img/class_img/<?= $classe["class_img"] ?>" alt="<?= $classe["class_name"] ?>">
                <div class="hovercap"><?= $classe["class_name"] ?></div>
            </div>
        </a>
        <?php endforeach; ?>
    </div>
    
</main>
<div class="separator"></div>

<?php
require_once __DIR__ . '/inc/footer.php';
?>