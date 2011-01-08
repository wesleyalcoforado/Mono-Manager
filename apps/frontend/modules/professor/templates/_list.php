<?php if(count($professores) > 0):  ?>
<table id="listagem">
    <thead>
        <tr>
            <th>Nome</th>
            <th>Sobrenome</th>
            <th>Nome de usuário</th>
            <th>Telefone</th>
            <th>Email</th>
        </tr>
    </thead>

<?php
foreach($professores as $professor): ?>
        <tr>
            <td><?php echo $professor->getUsuario()->getFirstName(); ?></td>
            <td><?php echo $professor->getUsuario()->getLastName(); ?></td>
            <td><?php echo $professor->getUsuario()->getUsername(); ?></td>
            <td><?php echo $professor->getTelefone(); ?></td>
            <td><?php echo $professor->getUsuario()->getEmailAddress(); ?></td>
        </tr>
<?php
endforeach;
?>
    </tbody>
</table>
<?php endif;