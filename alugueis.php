<?php
require 'conexao.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $stmt = $pdo->prepare("SELECT valor_aluguel FROM trajes WHERE id=? AND disponivel=1");
    $stmt->execute([$_POST['traje_id']]);
    $traje = $stmt->fetch();

    if ($traje) {
        $stmt = $pdo->prepare("INSERT INTO alugueis (cliente_id, traje_id, data_retirada, data_devolucao, valor_total) 
                               VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([
            $_POST['cliente_id'], 
            $_POST['traje_id'], 
            $_POST['data_retirada'], 
            $_POST['data_devolucao'], 
            $traje['valor_aluguel']
        ]);
        $pdo->prepare("UPDATE trajes SET disponivel=0 WHERE id=?")->execute([$_POST['traje_id']]);
    }
}

$clientes = $pdo->query("SELECT * FROM clientes")->fetchAll();
$trajes = $pdo->query("SELECT * FROM trajes WHERE disponivel=1")->fetchAll();
$alugueis = $pdo->query("SELECT a.id, c.nome AS cliente, t.descricao AS traje, a.data_retirada, a.data_devolucao, a.valor_total
                         FROM alugueis a 
                         JOIN clientes c ON a.cliente_id = c.id 
                         JOIN trajes t ON a.traje_id = t.id")->fetchAll();
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <title>Aluguéis</title>
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
            <h2 class="text-2xl font-semibold text-purple-700 mb-6 text-left">Registrar Aluguel</h2>
            <form method="post" class="grid grid-cols-1 md:grid-cols-2 gap-4">

                <select name="cliente_id" required
                    class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500">
                    <option value="">Selecione o Cliente</option>
                    <?php foreach ($clientes as $c): ?>
                        <option value="<?= $c['id'] ?>"><?= $c['nome'] ?></option>
                    <?php endforeach; ?>
                </select>

                <select name="traje_id" required
                    class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500">
                    <option value="">Selecione o Traje</option>
                    <?php foreach ($trajes as $t): ?>
                        <option value="<?= $t['id'] ?>"><?= $t['descricao'] ?> - R$<?= $t['valor_aluguel'] ?></option>
                    <?php endforeach; ?>
                </select>

                <input type="date" name="data_retirada" required
                    class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500">

                <input type="date" name="data_devolucao" required
                    class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500">

                <div class="col-span-1 md:col-span-2">
                    <button class="w-full bg-purple-700 text-white py-2 rounded-lg hover:bg-purple-800 transition">
                        Registrar
                    </button>
                </div>
            </form>
        </div>

        <!-- Listagem -->
        <div class="w-full max-w-6xl bg-white rounded-xl shadow-lg p-6 border mt-6">
            <h2 class="text-2xl font-semibold text-purple-700 mb-6 text-left">Lista de Aluguéis</h2>
            <div class="overflow-x-auto">
                <table class="w-full border-collapse rounded-lg overflow-hidden shadow-md">
                    <thead class="bg-purple-700 text-white">
                        <tr>
                            <th class="px-4 py-2 text-left">ID</th>
                            <th class="px-4 py-2 text-left">Cliente</th>
                            <th class="px-4 py-2 text-left">Traje</th>
                            <th class="px-4 py-2 text-left">Data Retirada</th>
                            <th class="px-4 py-2 text-left">Data Devolução</th>
                            <th class="px-4 py-2 text-left">Valor Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($alugueis as $a): ?>
                            <tr class="border-b hover:bg-purple-50 transition">
                                <td class="px-4 py-2"><?= $a['id'] ?></td>
                                <td class="px-4 py-2"><?= $a['cliente'] ?></td>
                                <td class="px-4 py-2"><?= $a['traje'] ?></td>
                                <td class="px-4 py-2"><?= $a['data_retirada'] ?></td>
                                <td class="px-4 py-2"><?= $a['data_devolucao'] ?></td>
                                <td class="px-4 py-2">R$ <?= $a['valor_total'] ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>

    </main>
</body>
</html>
