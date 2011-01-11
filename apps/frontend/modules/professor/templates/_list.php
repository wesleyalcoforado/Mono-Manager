<?php if(count($list) > 0):  ?>
<table id="listagem">
    <thead>
        <tr>
            <th>Nome</th>
            <th>Sobrenome</th>
            <th>Nome de usuário</th>
            <th>Email</th>
            <th colspan="2">Ações</th>
        </tr>
    </thead>

<?php
foreach($list as $professor): ?>
        <tr>
            <td><?php echo $professor->getUsuario()->getFirstName(); ?></td>
            <td><?php echo $professor->getUsuario()->getLastName(); ?></td>
            <td><?php echo $professor->getUsuario()->getUsername(); ?></td>
            <td><?php echo $professor->getUsuario()->getEmailAddress(); ?></td>
            <td><?php echo link_to(editButton(), "professor/index?id={$professor->getId()}"); ?></td>
            <td><?php echo link_to(deleteButton(), "professor/excluir?id={$professor->getId()}"); ?></td>
        </tr>
<?php
endforeach;
?>
    </tbody>
</table>
<?php endif;