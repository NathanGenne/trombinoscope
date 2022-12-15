<?php
require_once __DIR__ . '/inc/header.php';
require_once __DIR__ . '/inc/navbar.php';
require_once __DIR__ . '/functions.php';
?>

<main role="main" class="mt-3 text-center" id="settings">
    <h2 class="titles">Paramètres de l'utilisateur</h2>
    <div class="container text-center">
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-2">
            <div class="col">
                <!-- Permet l'upload d'une image de profile pour l'utilisateur -->
                <form method="POST" action="libraries/upload.php?img_type=userProfil" enctype="multipart/form-data">
                    <input type="file" name="file"/>
                    <div>
                        <button type="submit" name="submit">
                        Changer l'image de profile
                        </button>
                    </div>
                </form>
                <p><?php if(isset($_SESSION['error'])) { echo $_SESSION['error']; } ?></p>
            </div>
            <div class="col d-flex">
                <!-- Permet l'upload d'une image de profile pour l'utilisateur -->
                <div><a href="libraries/logout.php">se déconnecter</a></div>
            </div>
        </div>
    </div>
</main>
<div class="separator"></div>

<?php
require_once __DIR__ . '/inc/footer.php';
?>