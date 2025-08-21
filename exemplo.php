<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sistema de Aluguel de Trajes</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-white text-gray-800">

  <!-- Navbar -->
  <nav class="bg-purple-700 text-white shadow-md">
    <div class="max-w-7xl mx-auto px-4 py-3 flex justify-between items-center">
      <h1 class="text-xl font-bold">Aluguel de Trajes</h1>
      <ul class="flex space-x-6">
        <li><a href="index.php" class="hover:text-beige-200">Home</a></li>
        <li><a href="clientes.php" class="hover:text-beige-200">Clientes</a></li>
        <li><a href="trajes.php" class="hover:text-beige-200">Trajes</a></li>
        <li><a href="alugueis.php" class="hover:text-beige-200">Aluguéis</a></li>
      </ul>
    </div>
  </nav>

  <!-- Conteúdo principal -->
  <main class="flex items-center justify-center min-h-[calc(100vh-64px)] px-4">
    <div class="w-full max-w-md bg-white rounded-xl shadow-lg p-8 border">
      <h2 class="text-2xl font-semibold text-purple-700 mb-6 text-center">Cadastro de Cliente</h2>
      
      <form action="clientes.php" method="POST" class="space-y-4">
        <div>
          <label class="block text-gray-700 mb-1">Nome</label>
          <input type="text" name="nome" required
            class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500">
        </div>
        <div>
          <label class="block text-gray-700 mb-1">Email</label>
          <input type="email" name="email" required
            class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500">
        </div>
        <div>
          <label class="block text-gray-700 mb-1">Telefone</label>
          <input type="text" name="telefone" required
            class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500">
        </div>
        <button type="submit"
          class="w-full bg-purple-700 text-white py-2 rounded-lg hover:bg-purple-800 transition">
          Cadastrar
        </button>
      </form>
    </div>
  </main>

</body>
</html>
