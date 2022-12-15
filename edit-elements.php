<?php
require_once __DIR__ . '/inc/header.php';
require_once __DIR__ . '/inc/navbar.php';
require_once __DIR__ . '/functions.php';
?>

<main role="main" class="mt-3 text-center" id="editing-buttons">
    <h2 class="titles">Éditer le trombinoscope</h2>
    <div class="editing-list row row-cols-1 row-cols-sm-1 row-cols-md-2">
        <div class="col">
            <a class="grey-block" href="add-student.php">
                <div class="btnLogin bg-secondary-color bg-secondary-color-alternate btn m-2">
                    Ajouter un nouvel élève
                </div>
            </a>
        </div>
        <div class="col">
            <a class="grey-block" href="add-class.php">
                <div class="btnLogin bg-secondary-color bg-secondary-color-alternate btn m-2">
                    Ajouter une nouvelle classe
                </div>
            </a>
        </div>
        <div class="col">
            <a class="grey-block" href="remove-student.php">
                <div class="btnLogin bg-secondary-color bg-secondary-color-alternate btn m-2">
                    Supprimer un élève
                </div>
            </a>
        </div>
        <div class="col">
            <a class="grey-block" href="remove-class.php">
                <div class="btnLogin bg-secondary-color bg-secondary-color-alternate btn m-2">
                    Supprimer une classe
                </div>
            </a>
        </div>
    </div>
    
</main>
<div class="separator"></div>

<?php
require_once __DIR__ . '/inc/footer.php';
?>