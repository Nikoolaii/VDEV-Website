<?php
if (session_status() != 2) session_start();
session_destroy();

header("Location: " . $_SERVER['HTTP_REFERER']);
