<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
  <a class="navbar-brand" href="#" id="title">CRUD</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <div class="collapse navbar-collapse" id="navbarNavDarkDropdown">
      <ul class="navbar-nav">
        <li class="nav-item dropdown <?= empty($pg) || $pg == 'cadL' ? 'active' : ''?>">
          <a class="nav-link dropdown-toggle"  id="navbarDarkDropdownMenuLink" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Livros</span></a>
          <ul class="dropdown-menu dropdown-menu-ligth" aria-labelledby="navbarDarkDropdownMenuLink">
            <li><a class="dropdown-item <?= empty($pg) ? 'active' : ''?>" href="index.php">Listar</a></li>
            <li><a class="dropdown-item <?= $pg == 'cadL' ? 'active' : ''?>" href="cadLivros.php">Cadastrar</a></li>
          </ul>
        </li>
        <li class="nav-item dropdown <?= $pg == 'exemps' || $pg == 'cadEx' ? 'active' : ''?>">
          <a class="nav-link dropdown-toggle"  id="navbarDarkDropdownMenuLink" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Exemplares</span></a>
          <ul class="dropdown-menu dropdown-menu-ligth" aria-labelledby="navbarDarkDropdownMenuLink">
            <li><a class="dropdown-item <?= $pg == 'exemps' ? 'active' : ''?>" href="exemplares.php">Listar</a></li>
            <li><a class="dropdown-item <?= $pg == 'cadEx' ? 'active' : ''?>" href="cadExemps.php">Cadastrar</a></li>
          </ul>
        </li>
        <li class="nav-item dropdown <?= $pg == 'tipo' || $pg == 'cadT' ? 'active' : ''?>">
          <a class="nav-link dropdown-toggle"  id="navbarDarkDropdownMenuLink" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Tipo Usuários</span></a>
          <ul class="dropdown-menu dropdown-menu-ligth" aria-labelledby="navbarDarkDropdownMenuLink">
            <li><a class="dropdown-item <?= $pg == 'tipo' ? 'active' : ''?>" href="tipos.php">Listar</a></li>
            <li><a class="dropdown-item <?= $pg == 'cadT' ? 'active' : ''?>" href="cadTipos.php">Cadastrar</a></li>
          </ul>
        </li>
        <li class="nav-item dropdown <?= $pg == 'usus' || $pg == 'cadU' ? 'active' : ''?>">
          <a class="nav-link dropdown-toggle"  id="navbarDarkDropdownMenuLink" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Usuários</span></a>
          <ul class="dropdown-menu dropdown-menu-ligth" aria-labelledby="navbarDarkDropdownMenuLink">
            <li><a class="dropdown-item <?= $pg == 'usus' ? 'active' : ''?>" href="usuarios.php">Listar</a></li>
            <li><a class="dropdown-item <?= $pg == 'cadU' ? 'active' : ''?>" href="cadUsuarios.php">Cadastrar</a></li>
          </ul>
        </li>
        <li class="nav-item dropdown <?= $pg == 'emps' || $pg == 'cadE' ? 'active' : ''?>">
          <a class="nav-link dropdown-toggle"  id="navbarDarkDropdownMenuLink" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Empréstimos</span></a>
          <ul class="dropdown-menu dropdown-menu-ligth" aria-labelledby="navbarDarkDropdownMenuLink">
            <li><a class="dropdown-item <?= $pg == 'emps' ? 'active' : ''?>" href="emprestimos.php">Listar</a></li>
            <li><a class="dropdown-item <?= $pg == 'cadE' ? 'active' : ''?>" href="cadEmps.php">Cadastrar</a></li>
          </ul>
        </li>
      </ul>
    </div>
  </div>
</nav>
<br><br>