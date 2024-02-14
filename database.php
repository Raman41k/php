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

function getPDO() : PDO{
    $hostName = 'database';
    $dbUser = 'roman';
    $dbPassword = 'roman';
    $dbName = 'php';

    $pdo = new PDO("mysql:host=$hostName;dbname=$dbName", $dbUser, $dbPassword);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    return $pdo;
}

function getMessages(PDO $pdo): array {
    $data = [];
    $sql = 'SELECT * FROM messages';

    $queryRunner = $pdo->query($sql);
    $queryRunner->setFetchMode(PDO::FETCH_ASSOC);

    while($row = $queryRunner->fetch()) {
        $data[] = $row;
    }

    return $data;
}

function addNewMessage(PDO $pdo, string $username, string $message) {

    $sql = "INSERT INTO messages (username, message) VALUES (:username, :message)";

    $queryRunner = $pdo->prepare($sql);
    $params = compact('username', 'message');

    if (!$queryRunner->execute($params)) {
        die('Error to add message');
    }
}

function deleteMessage(PDO $pdo, int $messageId) {
    $sql = 'DELETE FROM messages where id=:id';

    $queryRunner = $pdo->prepare($sql);

    if (!$queryRunner->execute(['id' => $messageId])) {
        die('Error to delete message');
    }
}