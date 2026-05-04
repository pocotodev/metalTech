<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
</head>
<body>
    <!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cadastrar Funcionário</title>

    <!-- IMPORTANTE -->
    <link rel="stylesheet" href="../public/assets/css/output.css">
</head>

<body>
    
<div class="min-h-screen bg-slate-100 flex items-center justify-center">
    <div class="bg-white p-8 rounded-2xl shadow w-full max-w-md">

        <h2 class="text-2xl font-bold mb-6 text-slate-900">
            Cadastrar Funcionário
        </h2>

        <form method="POST" action="">

            <div class="mb-4">
                <label class="block text-sm text-slate-600">Nome</label>
                <input type="text" name="nome"
                    class="w-full mt-1 p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500">
            </div>

            <div class="mb-4">
                <label class="block text-sm text-slate-600">Cargo</label>
                <input type="text" name="cargo"
                    class="w-full mt-1 p-3 border rounded-lg">
            </div>

            <div class="mb-4">
                <label class="block text-sm text-slate-600">Salário</label>
                <input type="number" name="salario"
                    class="w-full mt-1 p-3 border rounded-lg">
            </div>

            <div class="mb-6">
                <label class="block text-sm text-slate-600">Carga horária mensal</label>
                <input type="number" name="carga"
                    class="w-full mt-1 p-3 border rounded-lg">
            </div>

            <button class="w-full bg-orange-500 text-white p-3 rounded-lg hover:bg-orange-600">
                Salvar
            </button>

        </form>
    </div>
</div>

</body>
</html>
</body>
</html>