<?php 
    session_start();
    $_SESSION["menu-admin"] = "relatorios";
    require_once($_SERVER['DOCUMENT_ROOT']."/amildental/admin/template/cabecalho_admin.php");
    require_once($_SERVER['DOCUMENT_ROOT']."/amildental/admin/template/menu-superior.php");

    $dependentesDAO = new DependentesDAO($conexao);
?>

<div class="main">
  <div class="main-inner">
    <div class="container">
      <div class="row">
        <div class="span12">

          <div class="widget widget-nopad">
            <div class="widget-header"> <i class="icon-list-alt"></i>
              <h3>Dependentes Cadastrados</h3>
            </div>
            <!-- /widget-header -->
            <div class="widget-content">
              <div class="widget big-stats-container">
                <div class="widget-content" style="padding: 10px;">
                  <table class="display datatable" cellspacing="0" width="100%" >
                    <thead>
                        <tr>
                            <th>#</th>
                            <th class="text-left">Nome</th>
                            <th class="text-left">Titular</th>
                            <th>CPF</th>
                            <th>Data</th>
                            <th>Ação</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>#</th>
                            <th class="text-left">Nome</th>
                            <th class="text-left">Titular</th>
                            <th>CPF</th>
                            <th>Data</th>  
                            <th>Ação</th>
                        </tr>
                    </tfoot>
                    <tbody>
                    <?php
                      $list = $dependentesDAO->listaDependentes();

                      foreach ($list as $dep) {
                    ?>
                        <tr>
                            <td align="center"><?=$dep->id?></td>
                            <td><?=$dep->depnome?></td>
                            <td><?=$dep->clinome?></td>
                            <td align="center"><?=$dep->depcpf?></td>
                            <td align="center"><?=$dep->data?></td>  
                            <td align="center"><button style="margin-right: 5px;" class="btn btn-primary" onclick="EditarDependente(<?=$dep->id?>)" >Editar</button><button class="btn btn-danger" onclick="excluirDependente(<?=$dep->id?>)" >X</button></td>
                        </tr>
                    <?php
                      }
                    ?>
                    </tbody>
                  </table>
                </div>
                <!-- /widget-content --> 
              </div>
            </div>
        </div>
          
        
      </div>
      <!-- /row --> 
    </div>
    <!-- /container --> 
  </div>
  <!-- /main-inner --> 
</div>
<!-- /main -->
<?php
    require_once($_SERVER['DOCUMENT_ROOT']."/amildental/admin/template/rodape_admin.php");
?>
<script src="/amildental/admin/js/jquery.dataTables.min.js" type="text/javascript"></script>

<script>
    $(document).ready(function() {
      $('.datatable').dataTable({
          "language": {
            "lengthMenu": "Exibir _MENU_ Registros por Página",
            "info": "Mostrando _PAGE_ de _PAGES_ Páginas",
            "zeroRecords": "Nenhum Registro Encontrado",        
            "search": "Procurar:",
            "paginate": {
              "previous": "Anterior",
              "next": "Próximo"
            }
          }
      });
    });
    
    function excluirDependente(id){
        if(confirm("Deseja mesmo excluir o dependente?")){
          $.ajax({
            method: "GET",
            url: "/amildental/views/dependente-banco.php",
            data: { acao: "excluir", idDependente: id }
          })
          .done(function(data) {
              window.location.href = "dependentes.php";
          });s
        }
    }
    
     function EditarDependente(id_dependente){
       window.location.href = "editarDependente.php?id_dependente="+id_dependente;
    }
 
</script>
