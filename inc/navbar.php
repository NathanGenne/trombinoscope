<nav class="bg-primary-color fixed-top">
    <div class="container-fluid d-flex flex-wrap justify-content-around align-items-center">
        <div class="">
            <a class="btnUser bg-secondary-color btn" href="<?php if(isset($_SESSION['valid'])) : ?> user-settings.php <?php endif; ?>">
                User <i class="fa-solid fa-user"></i>
            </a>
        </div>
        <div class="p-2">
            <a class="logo" href="<?php if(isset($_SESSION['valid'])) : ?> class-list.php <?php endif; ?>">
                <img src="assets/img/logo_la_manu.png" class="rounded" alt="logo-la-manu">
            </a>
        </div>
        <div class="">
            <?php if(isset($_SESSION['valid']) && $_SESSION['role'] == "admin") : ?>
                
            <a class="btnAdd bg-secondary-color btn" href="edit-elements.php">Modify +</a>
            <?php endif; ?>
        </div>
    </div>
</nav>
<div class="separator"></div>