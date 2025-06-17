<<<<<<< HEAD
<<<<<<< HEAD
<div class="hero bg-base-200 min-h-screen">
  <div class="hero-content">
    <div>
    <p class="py-2">Bem vindo ao</p>
      <h1 class="text-5xl font-bold">LockBox</h1>
      <p class="py-4"> onde você guarda <span class="italic">tudo</span> com segurança.</p>
      <button class="btn btn-primary">Get Started</button>
    </div>
  </div>
</div>
=======
<form class="w-full flex space-x-2 mt-6">
    <input type="text" class="border-stone-800 border-2 rounded-md bg-stone-900 text-sm focus:outline-nome px-2 py-1"
        placeholder="Pesquisar..." name="pesquisar" />
    <button type="submit">🔎</button>
</form>
<!-- Lista de livros -->
<section class="grid gap-4 grid-cols-1 md:grid-cols-2 lg:grid-cols-3">
    <?php foreach ($livros as $livro) {
        require 'partials/_livro.php';
    } ?>
</section>
>>>>>>> parent of 065ca34 (Reaproveitando estruturas do projeto anterior)
=======
LockBox
>>>>>>> parent of 0c50e7a (Arrumando as primeiras views)
