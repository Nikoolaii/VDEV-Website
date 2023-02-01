<?php
if (isset($_POST['first-name']) && isset($_POST['last-name']) && isset($_POST['email']) && isset($_POST['password'])) {
    $uppercase = preg_match('@[A-Z]@', $_POST['password']);
    $lowercase = preg_match('@[a-z]@', $_POST['password']);
    $number    = preg_match('@[0-9]@', $_POST['password']);
    $specialChars = preg_match('@[^\w]@', $_POST['password']);

    if (!$uppercase || !$lowercase || !$number || !$specialChars || strlen($_POST['password']) < 12) {
        header('Location: /signup');
    } else {
        include "../database/data-source.php";

        $fname = $_POST['first_name'];
        $lname = $_POST['last_name'];
        $mail = $_POST['email'];
        $psw = md5($_POST['password']);

        $fname = "Test";
        $lname = "test";
        $mail = "mail@mail.fr";
        $psw = md5("test");

        $database = new DataSource();
        $database->createUser($mail, $psw, $fname, $lname);
    }
}
?>

<p>Test</p>