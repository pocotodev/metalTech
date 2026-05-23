<?php
require_once "../config/config.php";

$sql = "SELECT * FROM funcionarios ORDER BY nome ASC";
$stmt = $pdo->query($sql);
$funcionarios = $stmt->fetchAll(PDO::FETCH_ASSOC);

$mensagem = "";
$erro = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $funcionario_id = $_POST["funcionario"];
    $data = $_POST["data"];
    $entrada = $_POST["entrada"];
    $saida = $_POST["saida"];
    $intervalo = (int) $_POST["intervalo"];
    $diaSemana = date('w', strtotime($data));

    if ($diaSemana == 6) {
        $tipo = "sabado";
        $tipoTexto = "Sábado 50%";
    } elseif ($diaSemana == 0) {
        $tipo = "domingo";
        $tipoTexto = "Domingo 100%";
    } else {
        $tipo = "normal";
        $tipoTexto = "Normal";
    }
    $diaSemana = date('w', strtotime($data));

    if ($diaSemana == 6) {
        $tipo = "sabado";
    } elseif ($diaSemana == 0) {
        $tipo = "domingo";
    } else {
        $tipo = "normal";
    }

    $entradaHora = new DateTime($entrada);
    $saidaHora = new DateTime($saida);

    $diferenca = $entradaHora->diff($saidaHora);
    $totalMinutos = ($diferenca->h * 60) + $diferenca->i;
    $totalMinutosTrabalhados = $totalMinutos - $intervalo;

    if ($totalMinutosTrabalhados <= 0) {
        $erro = "O horário informado é inválido. Verifique entrada, saída e intervalo.";
    } else {
        $horas = $totalMinutosTrabalhados / 60;

        $sqlFuncionario = "SELECT * FROM funcionarios WHERE id = ?";
        $stmtFuncionario = $pdo->prepare($sqlFuncionario);
        $stmtFuncionario->execute([$funcionario_id]);

        $funcionario = $stmtFuncionario->fetch(PDO::FETCH_ASSOC);

        $salario = $funcionario["salario"];
        $carga = $funcionario["carga_horaria"];

        $valorHora = $salario / $carga;

        if ($tipo === "sabado") {
            $valorHora = $valorHora * 1.5;
        }

        if ($tipo === "domingo") {
            $valorHora = $valorHora * 2;
        }

        $valorTotal = $valorHora * $horas;

        $sqlInsert = "INSERT INTO horas
        (funcionario_id, data_trabalho, entrada, saida, intervalo_minutos, quantidade_horas, tipo_dia, valor_hora, valor_total)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $stmtInsert = $pdo->prepare($sqlInsert);

        $stmtInsert->execute([
            $funcionario_id,
            $data,
            $entrada,
            $saida,
            $intervalo,
            $horas,
            $tipo,
            $valorHora,
            $valorTotal
        ]);

        $mensagem = "Horas lançadas com sucesso! Total trabalhado: " . number_format($horas, 2, ',', '.') . "h";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Lançar Horas</title>
    <link rel="stylesheet" href="../public/assets/css/output.css">
</head>

<body class="bg-[#1E1E1E] min-h-screen flex items-center justify-center p-6">

    <div class="w-full max-w-xl">

        <div class="bg-[#2A2A2A] p-8 rounded-2xl shadow-lg">

            <h1 class="text-white text-3xl font-bold mb-6 text-center">
                Lançar Horas
            </h1>

            <?php if (!empty($mensagem)): ?>
                <div class="bg-green-600 text-white p-3 rounded-lg mb-4 text-center">
                    <?= $mensagem ?>
                </div>
            <?php endif; ?>

            <?php if (!empty($erro)): ?>
                <div class="bg-red-600 text-white p-3 rounded-lg mb-4 text-center">
                    <?= $erro ?>
                </div>
            <?php endif; ?>

            <form method="POST">

                <div class="mb-4">
                    <label class="text-white block mb-2">Funcionário</label>

                    <select name="funcionario" required
                        class="w-full p-3 rounded-lg bg-[#1E1E1E] border border-white text-white">

                        <?php foreach ($funcionarios as $f): ?>
                            <option value="<?= $f['id'] ?>">
                                <?= $f['nome'] ?>
                            </option>
                        <?php endforeach; ?>

                    </select>
                </div>

                <div class="mb-4">
                    <label class="text-white block mb-2">Data</label>

                    <input type="date" name="data" required
                        class="w-full p-3 rounded-lg bg-[#1E1E1E] border border-white text-white">
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">

                    <div>
                        <label class="text-white block mb-2">Entrada</label>
                        <input type="time" name="entrada" required
                            class="w-full p-3 rounded-lg bg-[#1E1E1E] border border-white text-white">
                    </div>

                    <div>
                        <label class="text-white block mb-2">Saída</label>
                        <input type="time" name="saida" required
                            class="w-full p-3 rounded-lg bg-[#1E1E1E] border border-white text-white">
                    </div>

                    <div>
                        <label class="text-white block mb-2">Intervalo</label>
                        <select name="intervalo" required
                            class="w-full p-3 rounded-lg bg-[#1E1E1E] border border-white text-white">
                            <option value="0">Sem intervalo</option>
                            <option value="30">30 minutos</option>
                            <option value="60" selected>1 hora</option>
                            <option value="90">1h30</option>
                            <option value="120">2 horas</option>
                        </select>
                    </div>

                </div>
                <div class="mb-6">
                    <label class="text-white block mb-2">Tipo do Dia</label>

                    <input
                        type="text"
                        id="tipoDia"
                        readonly
                        tabindex="-1"
                        value="Selecione uma data"

                        class="w-full p-3 rounded-lg bg-[#1E1E1E] border border-white text-white pointer-events-none">
                </div>
                <button
                    class="w-full bg-yellow-500 hover:bg-yellow-400 text-white font-bold py-3 rounded-xl">
                    Salvar Horas
                </button>

            </form>

        </div>

    </div>
    <script>
        const inputData = document.querySelector('input[name="data"]');
        const tipoDia = document.getElementById('tipoDia');

        inputData.addEventListener('change', function() {
            const data = new Date(this.value + 'T00:00:00');
            const dia = data.getDay();

            if (dia === 6) {
                tipoDia.value = 'Sábado 50%';
            } else if (dia === 0) {
                tipoDia.value = 'Domingo 100%';
            } else {
                tipoDia.value = 'Normal';
            }
        });
    </script>

</body>

</html>