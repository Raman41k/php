<?php
require_once 'database.php';
header('Content-Type: application/json; charset=utf-8');
$connection = getConnection();

if (isset($_POST)) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE email = '$email'";
    $result = mysqli_query($connection, $sql);
    $user = mysqli_fetch_array($result, MYSQLI_ASSOC);
    if ($user) {
        if (password_verify($password, $user['password'])) {
            session_start();
            $_SESSION['user'] = $user;
            echo json_encode(['success' => true, 'message' => 'Login successful']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Incorrect password']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'User not found']);
    }
}

mysqli_close($connection);