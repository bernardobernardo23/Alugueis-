<?php
require 'conexao.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $stmt = $pdo->prepare("INSERT INTO clientes (nome, telefone, email, endereco) VALUES (?, ?, ?, ?)");
    $stmt->execute([$_POST['nome'], $_POST['telefone'], $_POST['email'], $_POST['endereco']]);
}
$clientes = $pdo->query("SELECT * FROM clientes")->fetchAll();
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <title>Clientes</title>
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
        <!-- Formulário -->
        <div class="w-full max-w-4xl bg-white rounded-xl shadow-lg p-6 border">
            <h2 class="text-2xl font-semibold text-purple-700 mb-6 text-left"> Cadastrar Cliente</h2>
            <form method="post" class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <input class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500"
                    type="text" name="nome" placeholder="Nome" required>
                <input class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500"
                    type="text" name="telefone" placeholder="Telefone">
                <input class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500"
                    type="email" name="email" placeholder="Email">
                <input class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500"
                    type="text" name="endereco" placeholder="Endereço">

                <!-- Botão ocupa toda a largura das 2 colunas -->
                <div class="col-span-1 md:col-span-2">
                    <button class="w-full bg-purple-700 text-white py-2 rounded-lg hover:bg-purple-800 transition">
                        Cadastrar
                    </button>
                </div>
            </form>
        </div>

        <!-- Listagem -->
        <div class="w-full max-w-6xl bg-white rounded-xl shadow-lg p-6 border mt-6">
            <h2 class="text-2xl font-semibold text-purple-700 mb-6 text-left">Lista de Clientes</h2>
            <div class="overflow-x-auto">
                <table class="w-full border-collapse rounded-lg overflow-hidden shadow-md">
                    <thead class="bg-purple-700 text-white">
                        <tr>
                            <th class="px-4 py-2 text-left">ID</th>
                            <th class="px-4 py-2 text-left">Nome</th>
                            <th class="px-4 py-2 text-left">Telefone</th>
                            <th class="px-4 py-2 text-left">Email</th>
                            <th class="px-4 py-2 text-left">Endereço</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($clientes as $c): ?>
                            <tr class="border-b hover:bg-purple-50 transition">
                                <td class="px-4 py-2"><?= $c['id'] ?></td>
                                <td class="px-4 py-2"><?= $c['nome'] ?></td>
                                <td class="px-4 py-2"><?= $c['telefone'] ?></td>
                                <td class="px-4 py-2"><?= $c['email'] ?></td>
                                <td class="px-4 py-2"><?= $c['endereco'] ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>


    </main>
</body>

</html>