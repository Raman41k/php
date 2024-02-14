<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Registration</title>
</head>
<body>
<?php
    require_once 'database.php';
    $pdo = getPDO();
    if (isset($_POST)) {
        $userName = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $repeatPassword = $_POST['repeat_password'];

        $fieldsEmpty = false;

        if (empty($userName) || empty($email) || empty($password) || empty($repeatPassword)) {
            $fieldsEmpty = true;
        } else {
            if ($password !== $repeatPassword) {
                $passwordsError = true;
            } else {
                $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

                try {
                    $sql = "SELECT * FROM users WHERE email = :email";
                    $queryRunner = $pdo->prepare($sql);
                    $queryRunner->execute(['email' => $email]);
                    $user = $queryRunner->fetch();

                    if ($user) {
                        $emailError = true;
                    } else {
                        $sql = "INSERT INTO users (username, email, password) VALUES (:username, :email, :password)";
                        $stmt = $pdo->prepare($sql);
                        $stmt->execute(['username' => $userName, 'email' => $email, 'password' => $hashedPassword]);

                        header('Location: login.php');
                        exit;
                    }
                } catch (PDOException $e) {
                    echo $e->getMessage();
                }
            }
        }
    }
$pdo = null;
?>

<header>
    <nav class="bg-white border-gray-200 px-4 lg:px-6 py-2.5 dark:bg-gray-800">
        <div class="flex flex-wrap justify-between items-center mx-auto max-w-screen-xl">
            <div class="flex items-center lg:order-2">
                <a href='index.php' class='text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-4 lg:px-5 py-2 lg:py-2.5 mr-2 dark:bg-primary-600 dark:hover:bg-primary-700 focus:outline-none dark:focus:ring-primary-800'>Chat</a>

                <button data-collapse-toggle="mobile-menu-2" type="button" class="inline-flex items-center p-2 ml-1 text-sm text-gray-500 rounded-lg lg:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600" aria-controls="mobile-menu-2" aria-expanded="false">
                    <span class="sr-only">Open main menu</span>
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"></path></svg>
                    <svg class="hidden w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                </button>
            </div>
            <div class="hidden justify-between items-center w-full lg:flex lg:w-auto lg:order-1" id="mobile-menu-2">
                <ul class="flex flex-col mt-4 font-medium lg:flex-row lg:space-x-8 lg:mt-0">
                    <li>
                        <a href="register.php" class="block py-2 pr-4 pl-3 text-gray-700 border-b border-gray-100 hover:bg-gray-50 lg:hover:bg-transparent lg:border-0 lg:hover:text-primary-700 lg:p-0 dark:text-gray-400 lg:dark:hover:text-white dark:hover:bg-gray-700 dark:hover:text-white lg:dark:hover:bg-transparent dark:border-gray-700">Register</a>
                    </li>
                    <li>
                        <a href="login.php" class="block py-2 pr-4 pl-3 text-gray-700 border-b border-gray-100 hover:bg-gray-50 lg:hover:bg-transparent lg:border-0 lg:hover:text-primary-700 lg:p-0 dark:text-gray-400 lg:dark:hover:text-white dark:hover:bg-gray-700 dark:hover:text-white lg:dark:hover:bg-transparent dark:border-gray-700">Login</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>

<div class="flex h-screen justify-center items-center">
    <div class="w-full max-w-xs">
        <form class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4" action="register.php" method="post">
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="username">
                    Username
                </label>
                <input class="shadow appearance-none border <?php echo ($fieldsEmpty and $_POST) ? 'border-red-500' : '' ?> rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                       id="username" type="text" placeholder="Username" name="username">
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="email">
                    Email
                </label>
                <input class="shadow appearance-none border <?php echo (($emailError and $_POST) or $fieldsEmpty and $_POST) ? 'border-red-500' : '' ?> rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                       id="email" type="text" placeholder="Email" name="email">
                <?php if ($emailError and $_POST and !$fieldsEmpty) echo "<p class='text-red-500 text-xs italic my-3'>Email is incorrect!</p>";?>
            </div>
            <div class="">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="password">
                    Password
                </label>
                <input class="shadow appearance-none border <?php echo (($passwordsError and $_POST) or $fieldsEmpty and $_POST) ? 'border-red-500' : '' ?> rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline"
                       id="password" type="password" placeholder="******************" name="password">
            </div>
            <div class="">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="repeat_password">
                    Repeat password
                </label>
                <input class="shadow appearance-none border <?php echo ($passwordsError or $fieldsEmpty and $_POST) ? 'border-red-500' : '' ?> rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline"
                       id="repeat_password" type="password" placeholder="******************" name="repeat_password">
            </div>

            <?php if ($fieldsEmpty and $_POST) echo "<p class='text-red-500 text-xs italic mb-3'>Fields are empty!</p>";?>
            <?php if ($passwordsError and $_POST) echo "<p class='text-red-500 text-xs italic mb-3'>Passwords didn't match!</p>";?>

            <div class="flex items-center justify-between">
                <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                        type="submit">
                    Sign Up
                </button>
            </div>

<!--            --><?php
//                if ($prepareStmt && !($rowCount)) {
//                    mysqli_stmt_bind_param($stmt, "sss", $userName, $email, $hashedPassword);
//                    mysqli_stmt_execute($stmt);
//                    echo "
//                    <div class='p-4 text-center mt-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400' role='alert'>
//                        <span class='font-medium'>You successfully signed up!
//                    </div>
//                    ";
//                    header('Location: login.php');
//                }
//
//                if ($rowCount > 0) {
//                    echo "
//                    <div class='p-4 text-center mt-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400' role='alert'>
//                        <span class='font-medium'>This email is already registered!
//                    </div>
//                    ";
//                }
//
//                mysqli_close($connection);
//            ?>
        </form>
    </div>
</div>
</body>
</html>