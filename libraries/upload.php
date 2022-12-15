<?php 
$_SESSION['error'] = '';

// check if the user has clicked the button "UPLOAD" 
if (isset($_POST['submit']) && isset($_GET['img_type'])) {
    echo '0';
    $file = $_FILES["file"];

    $fileName = $file["name"];
    $fileTmpName = $file["tmp_name"];
    $fileSize = $file["size"];
    $fileError = $file["error"];

    $fileExt = strtolower(end(explode(".", $fileName)));

    $allowed = array('jpg','jpeg','png');

    if(in_array($fileExt,$allowed)) {
        echo '1';
        if ($fileError === 0) {
            echo '2';
            if ($fileSize < 1000000) {
                echo '3';
                if ($_GET['img_type'] == "userProfil") {
                    $fileNameNew = 'profil_'.$_SESSION['id'].'.'.$fileExt;
                    $fileDestination = '../assets/img/user_img/'.$fileNameNew;
                    if (file_exists($fileDestination)) { unlink($fileDestination); }
                    move_uploaded_file($fileTmpName, $fileDestination);
                    $_SESSION['userImg'] = $fileNameNew;
                    header('location : user-settings.php?uploadsuccess');
                }
                elseif ($_GET['img_type'] == "classImage") {
                    $fileNameNew = 'bachelor_'.$_GET['id'].'.'.$fileExt;
                    $fileDestination = '../assets/img/class_img/'.$fileNameNew;
                    if (file_exists($fileDestination)) { unlink($fileDestination); }
                    move_uploaded_file($fileTmpName, $fileDestination);
                    header('location : add-class.php?uploadsuccess');
                }
                elseif ($_GET['img_type'] == "studentImage") {
                    $fileNameNew = 'student_'.$_GET['id'].'.'.$fileExt;
                    $fileDestination = '../assets/img/student_img/'.$fileNameNew;
                    if (file_exists($fileDestination)) { unlink($fileDestination); }
                    move_uploaded_file($fileTmpName, $fileDestination);
                    header('location : add-student.php?uploadsuccess');
                }

            } else {
            $msg = "Votre image est trop volumineuse";
            }
        } else {
            $msg = "Une erreur est apparue lors de l'upload de votre image";
        }
    }
    else {
        $msg = "Votre fichier n'est pas une image";
    }
}

$_SESSION['error'] = $msg;
if ($_GET['img_type'] == "userProfil") {
    header('location : user-settings.php');
}
elseif ($_GET['img_type'] == "classImage") {
    header('location : add-class.php');
}
elseif ($_GET['img_type'] == "studentImage") {
    header('location : add-student.php');
}
?>