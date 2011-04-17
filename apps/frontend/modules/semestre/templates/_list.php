<?php if(count($list) > 0):  ?>
<table id="listagem" style="font-size: 9pt">
    <thead>
        <tr>
            <th>Semestre</th>
            <th>Proposta</th>
            <th>Copião</th>
            <th>Defesa</th>
            <th>Colação</th>
            <th>Proposta (esp.)</th>
            <th>Copião (esp.)</th>
            <th>Defesa (esp.)</th>
            <th>Colação (esp.)</th>
            <th colspan="2">Ações</th>
        </tr>
    </thead>
    <tbody>
<?php
foreach($list as $semestre): ?>
        <tr>
            <td><?php echo $semestre->getNome(); ?></td>
            <td><?php echo formatDate($semestre->getDataMaxProposta()); ?></td>
            <td><?php echo formatDate($semestre->getDataMaxCopiao()); ?></td>
            <td><?php echo formatDate($semestre->getDataMaxDefesa()); ?></td>
            <td><?php echo formatDate($semestre->getDataColacao()); ?></td>
            <td><?php echo formatDate($semestre->getDataMaxPropostaEspecial()); ?></td>
            <td><?php echo formatDate($semestre->getDataMaxCopiaoEspecial()); ?></td>
            <td><?php echo formatDate($semestre->getDataMaxDefesaEspecial()); ?></td>
            <td><?php echo formatDate($semestre->getDataColacaoEspecial()); ?></td>
            <td><?php echo link_to(editButton(), "semestre/index?id={$semestre->getId()}"); ?></td>
            <td><?php echo link_to(deleteButton(), "semestre/excluir?id={$semestre->getId()}", array('confirm' => 'Você tem certeza de que deseja excluir este registro?')); ?></td>
        </tr>
<?php
endforeach;
?>
    </tbody>
</table>
<?php endif;
