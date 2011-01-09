<?php if(count($list) > 0):  ?>
<table id="listagem">
    <thead>
        <tr>
            <th>Orientador</th>
            <th>Título</th>
            <th>Proposta</th>
            <th>Defesa</th>
            <th colspan="2">Ações</th>
        </tr>
    </thead>

<?php
foreach($list as $projeto): ?>
        <tr>
            <td><?php echo $projeto->getProfessor()->getUsuario()->getFullname(); ?></td>
            <td><?php echo $projeto->getTitulo(); ?></td>
            <td><?php if($projeto->hasAttachedProposta()){
                        echo link_to('Anexar proposta', 'default/index');
                      }else{
                        echo link_to('Visualizar proposta', 'default/index');
                      }
                ?>
            </td>
            <td><?php echo link_to('Solicitar defesa', 'projeto/index'); ?></td>
            <td><?php echo link_to('Editar', "projeto/index?id={$projeto->getId()}"); ?></td>
            <td><?php echo link_to('Exluir', "projeto/excluir?id={$projeto->getId()}"); ?></td>
        </tr>
<?php
endforeach;
?>
    </tbody>
</table>
<?php endif;