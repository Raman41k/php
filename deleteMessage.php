<?php

require_once 'database.php';

$connection = getConnection();

if ($_GET) {
    deleteMessage($_GET['deleted_message_id']);
}

mysqli_close($connection);