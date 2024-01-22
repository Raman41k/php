<?php
    session_start();
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Messages</title>
</head>
<body>

<?php
    require_once 'database.php';
    $connection = getConnection();

    if ($_POST) {
        if ($_SESSION['user']) {
            addNewMessage($_SESSION['user']['username'], $_POST['message']);
        } else {
            addNewMessage($_POST['name'], $_POST['message']);
        }
    }

    if ($_GET) {
        deleteMessage($_GET['deleted_message_id']);
    }
?>

<header>
    <nav class="bg-white border-gray-200 px-4 lg:px-6 py-2.5 dark:bg-gray-800">
        <div class="flex flex-wrap justify-between items-center mx-auto max-w-screen-xl">
            <div class="flex items-center lg:order-2">
                <?php
                    if ($_SESSION['user']) echo "
                    <div class='text-gray-800 dark:text-white hover:bg-gray-50 focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-4 lg:px-5 py-2 lg:py-2.5 mr-2 dark:hover:bg-gray-700 focus:outline-none dark:focus:ring-gray-800'>
                        {$_SESSION['user']['username']}
                    </div>
                    <a href='logout.php' class='text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-4 lg:px-5 py-2 lg:py-2.5 mr-2 dark:bg-primary-600 dark:hover:bg-primary-700 focus:outline-none dark:focus:ring-primary-800'>Logout</a>
                    ";
                ?>
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

<?php

?>

<div class="w-4/5 mx-auto my-5 max-w-xs">
    <form class="bg-white w-full shadow-md rounded px-8 pt-6 pb-8 mb-4" action="" method="post">
        <?php if (!$_SESSION['user']) : ?>
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="name">
                Name
            </label>
            <input class="shadow appearance-none border  rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                   id="name" type="text" placeholder="Name" name="name">
        </div>
        <?php endif; ?>
        <div class="">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="message">
                Message
            </label>
            <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline"
                   id="message" type="text" placeholder="Message" name="message">
        </div>

        <div class="flex items-center justify-between">
            <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                    type="submit">
                Send
            </button>
        </div>
    </form>
</div>

<?php if (getMessages()): ?>
<div class="w-4/5 mx-auto my-10">
    <ul class="w-full text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white">
        <?php
        foreach (getMessages() as $message) {
            echo "<li class='relative w-full px-4 py-2 border-b border-gray-200 rounded-t-lg dark:border-gray-600'>
            <strong>{$message['username']}</strong>
            {$message['created']}:
            <i>{$message['message']}</i>";
            if ($_SESSION['user']['is_admin']) {
                echo "<a href='?deleted_message_id={$message['id']}' class='absolute top-0 right-0 px-2 py-1 text-red-500 hover:text-red-700'>X</a>";
            }
            echo '</li>';
        }
        ?>
    </ul>
</div>
<?php endif;?>

<?php
    mysqli_close($connection);
?>

</body>
</html>