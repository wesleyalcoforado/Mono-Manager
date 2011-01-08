<?php if(count($estudantes) > 0):  ?>
<table id="listagem">
    <thead>
        <tr>
            <th>Nome</th>
            <th>Sobrenome</th>
            <th>Matrícula</th>
            <th>Telefone</th>
            <th>Email</th>
        </tr>
    </thead>

<?php
foreach($estudantes as $estudante): ?>
        <tr>
            <td><?php echo $estudante->getUsuario()->getFirstName(); ?></td>
            <td><?php echo $estudante->getUsuario()->getLastName(); ?></td>
            <td><?php echo $estudante->getUsuario()->getUsername(); ?></td>
            <td><?php echo $estudante->getTelefone(); ?></td>
            <td><?php echo $estudante->getUsuario()->getEmailAddress(); ?></td>
        </tr>
<?php
endforeach;
?>
    </tbody>
</table>
<?php endif;