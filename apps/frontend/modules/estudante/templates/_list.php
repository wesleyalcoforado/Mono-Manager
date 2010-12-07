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
            <td><?php echo $estudante->getMatricula(); ?></td>
            <td><?php echo $estudante->getTelefone(); ?></td>
            <td><?php echo $estudante->getUsuario()->getEmail(); ?></td>
        </tr>
<?php
endforeach;
?>
    </tbody>
</table>
