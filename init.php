<?php
session_start();

require 'phpqrcode/qrlib.php';

try {
    $pdo = new PDO('sqlite2:'.__DIR__.'/db/mydb.sq2');

    $result = $pdo->query('CREATE TABLE Sesam (
    SesamId INTEGER PRIMARY KEY,
    SesamRandomCode TEXT NOT NULL,
    LoggedInUserId INTEGER)');
} catch (PDOException $e) {
    die('Connection failed: ' . $e->getMessage());
}