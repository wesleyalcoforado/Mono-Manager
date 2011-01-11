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
            <td><?php echo truncate_text($projeto->getTitulo(), 50); ?></td>
            <td><?php if($projeto->hasAttachedProposta()){
                        echo link_to(attachButton(), 'default/index');
                      }else{
                        echo link_to(viewButton(), 'default/index');
                      }
                ?>
            </td>
            <td><?php echo link_to(presentationButton(), 'projeto/index'); ?></td>
            <td><?php echo link_to(editButton(), "projeto/index?id={$projeto->getId()}"); ?></td>
            <td><?php echo link_to(deleteButton(), "projeto/excluir?id={$projeto->getId()}"); ?></td>
        </tr>
<?php
endforeach;
?>
    </tbody>
</table>
<?php endif;