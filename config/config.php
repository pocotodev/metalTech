<?php

$host = "localhost";
$banco = "metaltech";
$usuario = "root";
$senha = "";

try {
    $pdo = new PDO("mysql:host=$host;dbname=$banco;charset=utf8", $usuario, $senha);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $erro) {
    die("Erro ao conectar com o banco: " . $erro->getMessage());
}