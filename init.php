<?php
session_start();

require 'phpqrcode/qrlib.php';

try {
    $pdo = new PDO('sqlite:'.__DIR__.'/temp/sesame.sqlite');

    $result = $pdo->query('CREATE TABLE Sesame (
    SesameId INTEGER PRIMARY KEY,
    SesameRandomCode TEXT NOT NULL,
    LoggedInUserId INTEGER)');
} catch (PDOException $e) {
    die('Connection failed: ' . $e->getMessage());
}