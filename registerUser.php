<?php
require_once 'database.php';
$connection = getConnection();
header('Content-Type: application/json; charset=utf-8');

if (isset($_POST)) {
    $userName = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $repeat_password = $_POST['repeat_password'];
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $fieldsEmpty = empty($userName) || empty($email) || empty($password) || empty($repeat_password);

    if ($fieldsEmpty) {
        echo json_encode(['success' => false, 'message' => 'Fields are empty']);
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo json_encode(['success' => false, 'message' => 'Invalid email format']);
    } elseif ($password !== $repeat_password) {
        echo json_encode(['success' => false, 'message' => 'Passwords didn\'t match']);
    } else {
        $sql = "SELECT * FROM users WHERE email = ?";
        $stmt = mysqli_stmt_init($connection);

        if (mysqli_stmt_prepare($stmt, $sql)) {
            mysqli_stmt_bind_param($stmt, "s", $email);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);

            if (mysqli_num_rows($result) > 0) {
                echo json_encode(['success' => false, 'message' => 'This email is already registered']);
            } else {
                $insertSql = "INSERT INTO users (username, email, password) VALUES (?, ?, ?)";
                $insertStmt = mysqli_stmt_init($connection);

                if (mysqli_stmt_prepare($insertStmt, $insertSql)) {
                    mysqli_stmt_bind_param($insertStmt, "sss", $userName, $email, $hashedPassword);
                    mysqli_stmt_execute($insertStmt);

                    $getUserSql = "SELECT * FROM users WHERE email = ?";
                    $getUserStmt = mysqli_stmt_init($connection);

                    if (mysqli_stmt_prepare($getUserStmt, $getUserSql)) {
                        mysqli_stmt_bind_param($getUserStmt, "s", $email);
                        mysqli_stmt_execute($getUserStmt);
                        $userResult = mysqli_stmt_get_result($getUserStmt);

                        if ($user = mysqli_fetch_assoc($userResult)) {
                            // Start session and add user to session
                            session_start();
                            $_SESSION['user'] = $user;

                            echo json_encode(['success' => true, 'message' => 'Successfully registered']);
                        } else {
                            echo json_encode(['success' => false, 'message' => 'Error retrieving user information']);
                        }
                    } else {
                        echo json_encode(['success' => false, 'message' => 'Error in prepared statement for user retrieval']);
                    }
                } else {
                    echo json_encode(['success' => false, 'message' => 'Error in prepared statement for insertion']);
                }
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'Error in prepared statement for email check']);
        }
    }
}

mysqli_close($connection);
