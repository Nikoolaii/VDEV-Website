<?php

include_once "./controllers/user.php";
if ($user["admin"] == 0) {
    header('Location: /home');
}
