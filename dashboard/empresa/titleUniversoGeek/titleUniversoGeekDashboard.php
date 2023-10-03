<?php
include_once './funcDashboard/funcdashboard.php';
include_once 'config/conexao.php';
include_once 'config/constantes.php';


?>

<table class="table table-striped">
  <thead>
    <tr>
      <th scope="col" width="20%">ID</th>
      <th scope="col" width="50%">Title</th>
      <th scope="col" width="30%">Ação</th>

    </tr>
  </thead>
  <tbody>
    <?php
    $listarTituloGeek = listarDashboard('titleuniversogeek', 'idtitleUniversoGeek, title, cadastro, alteracao, ativo');
    foreach ($listarTituloGeek as $itemTitleGeekDash) {
      $idTitleGeekDash = $itemTitleGeekDash->idtitleUniversoGeek;
      $titleGeekDash = $itemTitleGeekDash->title;


      $cadastroTitleGeek = $itemTitleGeekDash ->cadastro;
      $ativoTitleGeek = $itemTitleGeekDash->ativo;

    ?>

      <tr>
        <th scope="row"><?php echo $idTitleGeekDash; ?></th>


        <td><?php echo $titleGeekDash; ?></td>

        <td>
          <button type="button" class="btn btn-primary">Ativar</button>
          <button type="button" class="btn btn-danger">Excluir</button>
        </td>

      

      </tr>
    <?php    } ?>
  </tbody>
</table>