<?php
require_once __DIR__ . '/libraries/db.php';


/* **********************************************************
Fonctions relatives aux utilisateurs
********************************************************** */

/* Récupértion de toutes les informations de la table users */
function get_users()
{
    $db = db_connect();

    $sql = <<<EOD
    SELECT * FROM `users`
    EOD;
    $usersStmt = $db->query($sql);
    $users = $usersStmt->fetchAll(PDO::FETCH_ASSOC);
    return $users;
}

/* Récupértion d'un user à partir de son username et password */
function get_user($username, $password)
{
    $db = db_connect();

    $sql = <<<EOD
    SELECT
        `username`,
        `password`,
        `role`
    FROM
        `users`
    WHERE username = :user_name AND password = :user_pwd
    EOD;

    $userStmt = $db->prepare($sql);
    $userStmt->bindValue(':user_name', $username);
    $userStmt->bindValue(':user_pwd', $password);

    $userStmt->execute();
    
    $user = $userStmt->fetch(PDO::FETCH_ASSOC);
    return $user;
}


/* **********************************************************
Fonctions relatives aux classes
********************************************************** */

/* Récupértion de toutes les informations de la table classes */
function get_classes()
{
    $db = db_connect();

    $sql = <<<EOD
    SELECT *
    FROM `classes`
    EOD;

    $classesStmt = $db->query($sql);
    return $classesStmt->fetchAll(PDO::FETCH_ASSOC);
}

/* Ajout d'une nouvelle classe */
function add_class($name, $img)
{
    $db = db_connect();

    $sql = <<<EOD
    INSERT INTO `classes` (`class_name`, `class_img`)
    VALUES (:name_input, :img_input);
    EOD;
    $classStmt = $db->prepare($sql);
    $classStmt->bindValue(':name_input', $name);
    $classStmt->bindValue(':img_input', $img);

    $classStmt->execute();

    return true;
}


/* **********************************************************
Fonctions relatives aux utilisateurs
********************************************************** */

/* Récupértion de toutes les informations des étudiants appartenant à la classe passée en paramètre */
function get_students_by_classe_name($class)
{
    $db = db_connect();

    $sql = <<<EOD
    SELECT `firstname`,`lastname`,`student_img`
    FROM `students` JOIN `student_class` JOIN `classes`
    WHERE students.student_id = student_class.student_id AND
    student_class.class_id = classes.class_id AND
    classes.class_name = :input_class
    EOD;
    
    $studentsStmt = $db->prepare($sql);
    $studentsStmt->bindValue(':input_class', $class);

    $studentsStmt->execute();

    return $studentsStmt->fetchAll(PDO::FETCH_ASSOC);
}

/* Ajout d'un nouvel étudiant et mise en lien avec une classe */
function add_student($class_id, $firstname, $lastname, $img)
{
    $db = db_connect();

    $sql = <<<EOD
    INSERT INTO `students` (`firstname`, `lastname`, `student_img`)
    VALUES (:firstname_input, :lastname_input, :img_input);
    EOD;
    $studentStmt = $db->prepare($sql);
    $studentStmt->bindValue(':firstname_input', $firstname);
    $studentStmt->bindValue(':lastname_input', $lastname);
    $studentStmt->bindValue(':img_input', $img);

    $studentStmt->execute();

    $student_id = get_student_id_by_name($firstname, $lastname);

    $sql = <<<EOD
    INSERT INTO `student_class` (`student_id`, `class_id`)
    VALUES (:student_input, :class_input);
    EOD;
    $studentStmt = $db->prepare($sql);
    $studentStmt->bindValue(':student_input', $student_id);
    $studentStmt->bindValue(':class_input', $class_id);

    $studentStmt->execute();

    return true;
}

/* Récupération de l'index d'un étudiant à partir de son nom et prénom */
function get_student_id_by_name($firstname, $lastname) {

    $db = db_connect();

    $sql = <<<EOD
    SELECT `student_id`
    FROM `students`
    WHERE `firstname` = :firstname_input AND `lastname` = :lastname_input
    EOD;
    $studentStmt = $db->prepare($sql);
    $studentStmt->bindValue(':firstname_input', $firstname);
    $studentStmt->bindValue(':lastname_input', $lastname);

    $studentStmt->execute();

    return $studentStmt;
}
