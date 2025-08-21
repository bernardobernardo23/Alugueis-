<?php
require 'conexao.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $stmt = $pdo->prepare("INSERT INTO trajes (descricao, tamanho, valor_aluguel) VALUES (?, ?, ?)");
    $stmt->execute([$_POST['descricao'], $_POST['tamanho'], $_POST['valor']]);
}
$trajes = $pdo->query("SELECT * FROM trajes")->fetchAll();
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <title>Trajes</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-white text-gray-800 min-h-screen flex flex-col">

    <!-- Navbar -->
    <nav class="bg-purple-700 text-white shadow-md">
        <div class="max-w-7xl mx-auto px-4 py-3 flex justify-between items-center">
            <h1 class="text-xl font-bold">Aluguel de Trajes</h1>
            <ul class="flex space-x-6">
                <li><a href="index.php" class="hover:text-gray-200">Home</a></li>
                <li><a href="clientes.php" class="hover:text-gray-200">Clientes</a></li>
                <li><a href="trajes.php" class="hover:text-gray-200">Trajes</a></li>
                <li><a href="alugueis.php" class="hover:text-gray-200">Aluguéis</a></li>
            </ul>
        </div>
    </nav>

    <!-- Conteúdo principal -->
    <main class="flex-grow flex flex-col items-center px-6 py-10 space-y-10">

        <!-- Formulário -->
        <div class="w-full max-w-4xl bg-white rounded-xl shadow-lg p-6 border">
            <h2 class="text-2xl font-semibold text-purple-700 mb-6 text-left">Cadastrar Traje</h2>
            <form method="post" class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <!-- Descrição ocupa 2 colunas -->
                <input class="col-span-1 md:col-span-2 w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500"
                       type="text" name="descricao" placeholder="Descrição" required>
                <input class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500"
                       type="text" name="tamanho" placeholder="Tamanho">
                <input class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500"
                       type="number" step="0.01" name="valor" placeholder="Valor Aluguel" required>

                <!-- Botão ocupa toda a largura -->
                <div class="col-span-1 md:col-span-2">
                    <button class="w-full bg-purple-700 text-white py-2 rounded-lg hover:bg-purple-800 transition">
                        Cadastrar
                    </button>
                </div>
            </form>
        </div>

        <!-- Listagem -->
        <div class="w-full max-w-6xl bg-white rounded-xl shadow-lg p-6 border mt-6">
            <h2 class="text-2xl font-semibold text-purple-700 mb-6 text-left">Lista de Trajes</h2>
            <div class="overflow-x-auto">
                <table class="w-full border-collapse rounded-lg overflow-hidden shadow-md">
                    <thead class="bg-purple-700 text-white">
                        <tr>
                            <th class="px-4 py-2 text-left">ID</th>
                            <th class="px-4 py-2 text-left">Descrição</th>
                            <th class="px-4 py-2 text-left">Tamanho</th>
                            <th class="px-4 py-2 text-left">Valor</th>
                            <th class="px-4 py-2 text-left">Disponível</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($trajes as $t): ?>
                            <tr class="border-b hover:bg-purple-50 transition">
                                <td class="px-4 py-2"><?= $t['id'] ?></td>
                                <td class="px-4 py-2"><?= $t['descricao'] ?></td>
                                <td class="px-4 py-2"><?= $t['tamanho'] ?></td>
                                <td class="px-4 py-2">R$ <?= number_format($t['valor_aluguel'], 2, ',', '.') ?></td>
                                <td class="px-4 py-2"><?= $t['disponivel'] ? 'Sim' : 'Não' ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>

    </main>
</body>
</html>
