<?php
require_once "../config/config.php";

$mensagem = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nome = $_POST["nome"];
    $cargo = $_POST["cargo"];
    $salario = $_POST["salario"];
    $carga = $_POST["carga"];

    $sql = "INSERT INTO funcionarios (nome, cargo, salario, carga_horaria)
            VALUES (:nome, :cargo, :salario, :carga_horaria)";

    $stmt = $pdo->prepare($sql);

    $stmt->execute([
        ":nome" => $nome,
        ":cargo" => $cargo,
        ":salario" => $salario,
        ":carga_horaria" => $carga
    ]);

    $mensagem = "Funcionário cadastrado com sucesso!";
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Cadastrar Funcionário</title>

    <link rel="stylesheet" href="../public/assets/css/output.css">
</head>

<body class="bg-[#1E1E1E] min-h-screen flex items-center justify-center">

    <div class="w-full max-w-md">

        <!-- LOGO -->
        <div class="flex justify-center mb-6">
            <img src="../public/assets/images/logo.jpg" class="w-40">
        </div>

        <!-- CARD -->
        <div class="bg-[#1E1E1E] p-8 rounded-2xl shadow-lg">

            <h2 class="text-2xl font-bold mb-6 text-white text-center">
                Cadastrar Funcionário
            </h2>

            <?php if (!empty($mensagem)): ?>
                <div class="mb-4 bg-green-500 text-white p-3 rounded-lg text-center">
                    <?= $mensagem ?>
                </div>
            <?php endif; ?>

            <form method="POST">

                <div class="mb-4">
                    <label class="block text-sm text-slate-200">Nome</label>
                    <input type="text" name="nome"
                        class="w-full mt-1 p-3 border border-white rounded-lg text-white bg-transparent focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500">
                </div>

                <div class="mb-4">
                    <label class="block text-sm text-slate-200">Cargo</label>
                    <input type="text" name="cargo"
                        class="w-full mt-1 p-3 border border-white rounded-lg text-white bg-transparent focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500"">
                </div>

                <div class=" mb-4">
                    <label class="block text-sm text-slate-200">Salário</label>
                    <input type="number" name="salario"
                        class="w-full mt-1 p-3 border border-white rounded-lg text-white bg-transparent focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500">
                </div>

                <div class="mb-6">
                    <label class="block text-sm text-slate-200">Carga horária mensal</label>
                    <input type="number" name="carga"
                        class="w-full mt-1 p-3 border border-white rounded-lg text-white bg-transparent focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500">
                </div>

                <button class="w-full bg-amber-400 text-white font-semibold p-3 rounded-lg hover:bg-yellow-400 transition">
                    Salvar
                </button>

            </form>
        </div>
    </div>

</body>

</html>