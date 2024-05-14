<ul class="nav nav-tabs">
  <li class="nav-item">
    <a class="nav-link <?php echo ($_GET['acao']==='ListarContato'?"active":"") ?>" href="./index.php?class=Contato&acao=ListarContato">Contato</a>
  </li>
  <li class="nav-item">
    <a class="nav-link <?php echo ($_GET['class']==='Cadastro'?"active":"") ?>" href="./index.php?class=Cadastro&acao=ListarCadastro">Cadastro</a>
  </li>
  <li class="nav-item">
    <a class="nav-link <?php echo ($_GET['class']==='Responsavel'?"active":"") ?>" href="index.php?class=Responsavel&acao=ListarResponsavel">Responsavel</a>
  </li>
  <li class="nav-item">
    <a class="nav-link <?php echo ($_GET['class']==='Curso'?"active":"") ?>" href="index.php?class=Curso&acao=ListarCurso">Curso</a>
  </li>
  <li class="nav-item">
    <a class="nav-link <?php echo ($_GET['acao']==='ContatosPorCadastro'?"active":"") ?>" href="index.php?class=Contato&acao=ContatosPorCadastro">Homes</a>
  </li>
</ul>