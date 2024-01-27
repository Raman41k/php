<?php
require_once 'database.php';

$connection = getConnection();

if ($_POST) {
    addNewMessage($_POST['username'], $_POST['message']);
}

mysqli_close($connection);