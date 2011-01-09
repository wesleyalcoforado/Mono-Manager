<?php if(count($list) > 0):  ?>
<table id="listagem">
    <thead>
        <tr>
            <th>Semestre</th>
            <th>Início</th>
            <th>Proposta</th>
            <th>Apresentação</th>
            <th colspan="2">Ações</th>
        </tr>
    </thead>
    <tbody>
<?php
foreach($list as $semestre): ?>
        <tr>
            <td><?php echo $semestre->getNome(); ?></td>
            <td><?php echo $semestre->getDataInicio(); ?></td>
            <td><?php echo $semestre->getDataProposta(); ?></td>
            <td><?php echo $semestre->getDataApresentacao(); ?></td>
            <td><?php echo link_to('Editar', "semestre/index?id={$semestre->getId()}"); ?></td>
            <td><?php echo link_to('Exluir', "semestre/excluir?id={$semestre->getId()}"); ?></td>
        </tr>
<?php
endforeach;
?>
    </tbody>
</table>
<?php endif;
