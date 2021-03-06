<?php if(count($list) > 0):  ?>
<table id="listagem">
    <thead>
        <tr>
            <th>Nome</th>
            <th>Sobrenome</th>
            <th>Matrícula</th>
            <th>Telefone</th>
            <th>Email</th>
            <th colspan="2">Ações</th>
        </tr>
    </thead>

<?php
foreach($list as $estudante): ?>
        <tr>
            <td><?php echo $estudante->getUsuario()->getFirstName(); ?></td>
            <td><?php echo $estudante->getUsuario()->getLastName(); ?></td>
            <td><?php echo $estudante->getUsuario()->getUsername(); ?></td>
            <td><?php echo $estudante->getTelefone(); ?></td>
            <td><?php echo $estudante->getUsuario()->getEmailAddress(); ?></td>
            <td><?php echo link_to(editButton(), "estudante/index?id={$estudante->getId()}"); ?></td>
            <td><?php echo link_to(deleteButton(), "estudante/excluir?id={$estudante->getId()}", array('confirm' => 'Você tem certeza de que deseja excluir este registro?')); ?></td>
        </tr>
<?php
endforeach;
?>
    </tbody>
</table>
<?php endif;