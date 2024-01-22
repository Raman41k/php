<?php
function getConnection(){
    $hostName = 'database';
    $dbUser = 'roman';
    $dbPassword = 'roman';
    $dbName = 'php';

    $connection = mysqli_connect($hostName, $dbUser, $dbPassword, $dbName);

    if (!$connection) {
        die(504);
    }

    return $connection;
}

function getMessages(): array {
    $data = [];
    $sql = 'SELECT * FROM messages';
    $result = getConnection()->query($sql);

    while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
        $data[] = $row;
    }

    return $data;
}

function addNewMessage($username, $message) {
    $sql = "INSERT INTO messages (username, message) VALUES (\"$username\", \"$message\")";

    if (!mysqli_query(getConnection(), $sql)) {
        die('Error to add message');
    }
}

function deleteMessage($messageId) {
    $sql = 'DELETE FROM messages where id=' . $messageId;

    if (!mysqli_query(getConnection(), $sql)) {
        die('Error to delete message');
    }
}