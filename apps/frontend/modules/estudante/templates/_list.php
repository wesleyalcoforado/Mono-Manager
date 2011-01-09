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
            <td><?php echo link_to('Editar', "estudante/index?id={$estudante->getId()}"); ?></td>
            <td><?php echo link_to('Exluir', "estudante/excluir?id={$estudante->getId()}"); ?></td>
        </tr>
<?php
endforeach;
?>
    </tbody>
</table>
<?php endif;