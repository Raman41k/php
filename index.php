<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Homework 8</title>
</head>
<body>
<?php
    session_start();
    
    if (!empty($_POST["username"]) && !empty($_POST['password'])) {
        $newUser = [
            'username' => $_POST['username'],
            'password' => $_POST['password'],
        ];
    
        $_SESSION['users'][] = $newUser;
        $id = count($_SESSION['users']);
    }
?>
<div class="min-h-screen flex items-center justify-center bg-gray-200">
    <div class="w-full max-w-xs">
        <form class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4" method="post" action="">
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="username">
                    Username
                </label>
                <input required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="username" type="text" placeholder="Username" name="username">
            </div>
            <div class="mb-6">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="password">
                    Password
                </label>
                <input required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline"
                       id="password" type="password" placeholder="******************" name="password">
            </div>
            <div class="flex items-center justify-center">
                <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
                    Sign In
                </button>
            </div>
            <?php if($_SESSION['users'][$id]) : ?>
                <div class="bg-green-200 text-green-800 p-4 mt-3 rounded-md shadow-md text-xs text-center">
                    Congratulations <?php echo $_SESSION['users'][$id]['username']?>! You successfully logged in
                </div>
            <?php endif; ?>
        </form>

        <?php if(isset($_SESSION['users'])) : ?>
        <div class="h-80 overflow-y-auto">
            <h2 class="text-center font-black">Users (<?php echo count($_SESSION['users']) ?>)</h2>
            <?php foreach($_SESSION['users'] as $user){ ?>
            <div>
                <span class="font-black">Username: </span><?php echo $user['username'] ?>
            </div>
            <?php } endif; ?>
        </div>
    </div>
</div>
</body>
</html>