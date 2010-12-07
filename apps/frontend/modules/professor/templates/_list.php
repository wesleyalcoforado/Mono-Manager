<table id="listagem">
    <thead>
        <tr>
            <th>Semestre</th>
            <th>Início</th>
            <th>Proposta</th>
            <th>Apresentação</th>
        </tr>
    </thead>
    <tbody>
<?php
foreach($semestres as $semestre): ?>
        <tr>
            <td><?php echo $semestre->getNome(); ?></td>
            <td><?php echo $semestre->getDataInicio(); ?></td>
            <td><?php echo $semestre->getDataProposta(); ?></td>
            <td><?php echo $semestre->getDataApresentacao(); ?></td>
        </tr>
<?php
endforeach;
?>
    </tbody>
</table>
