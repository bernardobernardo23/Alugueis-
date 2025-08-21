<?php
require 'conexao.php';

$stmt = $pdo->query("SELECT a.id, c.nome AS cliente, t.descricao AS traje, a.data_retirada, a.data_devolucao, a.status 
                     FROM alugueis a
                     JOIN clientes c ON a.cliente_id = c.id
                     JOIN trajes t ON a.traje_id = t.id
                     ORDER BY a.data_retirada DESC");
$alugueis = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title>Sistema de Aluguel de Trajes</title>
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
  <main class="flex-grow flex flex-col items-center justify-start px-6 py-10">
    <div class="w-full max-w-6xl bg-white rounded-xl shadow-lg p-6 border">
      <h2 class="text-2xl font-semibold text-purple-700 mb-6 text-left"> Aluguéis Ativos</h2>

      <div class="overflow-x-auto">
        <table class="w-full border-collapse rounded-lg overflow-hidden shadow-md">
          <thead class="bg-purple-700 text-white">
            <tr>
              <th class="px-4 py-2 text-left">ID</th>
              <th class="px-4 py-2 text-left">Cliente</th>
              <th class="px-4 py-2 text-left">Traje</th>
              <th class="px-4 py-2 text-left">Retirada</th>
              <th class="px-4 py-2 text-left">Devolução</th>
              <th class="px-4 py-2 text-left">Status</th>
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
                <td class="px-4 py-2 font-semibold <?= $a['status'] == 'Ativo' ? 'text-green-600' : 'text-gray-600' ?>">
                  <?= $a['status'] ?>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
  </main>

</body>
</html>
