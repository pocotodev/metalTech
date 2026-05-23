<?php
require_once "../config/config.php";

if ($_SERVER["REQUEST_METHOD"] !== "POST" || empty($_POST["ids"])) {
    header("Location: funcionarios.php");
    exit;
}

$ids = $_POST["ids"];
$placeholders = implode(",", array_fill(0, count($ids), "?"));

$sql = "DELETE FROM funcionarios WHERE id IN ($placeholders)";
$stmt = $pdo->prepare($sql);
$stmt->execute($ids);

header("Location: funcionarios.php");
exit;