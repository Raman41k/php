<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Homework 7</title>
</head>
<body>
<?php
    $username = 'Roman';
    $password = 'roman123';

    $username_error = true;
    $password_error = true;

    if (!empty($_POST['username'] and $_POST['username'] == $username)) $username_error = false;
    if (!empty($_POST['password'] and $_POST['password'] == $password)) $password_error = false;
?>
<div class="min-h-screen flex items-center justify-center bg-gray-200">
    <div class="w-full max-w-xs">
        <form class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4" method="post" action="">
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="username">
                    Username
                </label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline
                    <?php echo ($_POST and $username_error) ? 'border-red-500' : ''; ?>"" id="username" type="text" placeholder="Username" name="username">
                <?php if ($_POST and $username_error) : ?>
                    <p class="text-red-500 text-xs italic my-3">Username is incorrect.</p>
                <?php endif; ?>
            </div>
            <div class="mb-6">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="password">
                    Password
                </label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline
                 <?php echo ($_POST and $password_error) ? 'border-red-500' : ''; ?>"
                "
                       id="password" type="password" placeholder="******************" name="password">
                <?php if ($_POST and $password_error) : ?>
                    <p class="text-red-500 text-xs italic">Password is incorrect.</p>
                <?php endif; ?>
            </div>
            <div class="flex items-center justify-center">
                <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
                    Sign In
                </button>
            </div>
            <?php if(!$username_error and !$password_error) : ?>
                <div class="bg-green-200 text-green-800 p-4 mt-3 rounded-md shadow-md text-xs text-center">
                    Congratulations <?php echo $username?>! You successfully logged in
                </div>
            <?php endif; ?>

        </form>
    </div>
</div>
</body>
</html>