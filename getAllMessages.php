<?php
require_once 'database.php';

$connection = getConnection();

$messages = getMessages();

mysqli_close($connection);

header('Content-Type: application/json; charset=utf-8');
echo json_encode(['data' => $messages]);