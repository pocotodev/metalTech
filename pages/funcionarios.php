<?php
require_once "../config/config.php";

$sql = "SELECT * FROM funcionarios ORDER BY id DESC";
$stmt = $pdo->query($sql);
$funcionarios = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Funcionários</title>
    <link rel="stylesheet" href="../public/assets/css/output.css">
</head>

<body class="bg-[#1E1E1E] min-h-screen p-8">

    <h1 class="text-white text-3xl text-center font-bold mb-10">Funcionários</h1>

    <div class="bg-[#2A2A2A] rounded-xl p-6">
        <form method="POST" action="excluirFuncionario.php" onsubmit="return confirm('Tem certeza que deseja excluir os funcionários selecionados?');">

            <table class="w-full text-white">
                <thead>
                    <tr class="text-left border-b border-gray-600">
                        <th class="pb-3">Selecionar</th>
                        <th>Nome</th>
                        <th>Cargo</th>
                        <th>Salário</th>
                        <th>Carga</th>
                    </tr>
                </thead>

                <tbody>
                    <?php foreach ($funcionarios as $f): ?>
                        <tr class="border-b border-gray-700">
                            <td class="py-3">
                                <input type="checkbox" name="ids[]" value="<?= $f['id'] ?>">
                            </td>
                            <td><?= $f['nome'] ?></td>
                            <td><?= $f['cargo'] ?></td>
                            <td>R$ <?= $f['salario'] ?></td>
                            <td><?= $f['carga_horaria'] ?>h</td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <div class="fixed bottom-0 left-0 w-full bg-[#1E1E1E] border-t border-gray-700 p-4">
                <div class="max-w-5xl mx-auto flex justify-between gap-4">

                    <button type="submit"
                        class="flex-1 bg-red-600 hover:bg-red-500 text-white font-semibold py-3 rounded-xl">
                        Excluir
                    </button>

                    <a href="cadastrar.php"
                        class="flex-1 bg-green-600 hover:bg-green-500 text-white font-semibold py-3 rounded-xl text-center">
                        Adicionar
                    </a>

                </div>
            </div>

        </form>

    </div>

</body>

</html>