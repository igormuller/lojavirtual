<?php global $config; ?>
<h1>Vendas</h1>
<table class="table table-striped">
    <thead>
        <tr>
            <th>ID</th>
            <th>Cliente</th>
            <th>Valor</th>
            <th>Forma Pgto</th>
            <th>Status</th>
            <th>Ações</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($vendas as $venda): ?>
        <tr>
            <td><?php echo $venda['id']; ?></td>
            <td><?php echo $venda['cliente']; ?></td>
            <td>R$ <?php echo $venda['valor']; ?></td>
            <td><?php echo $venda['pgto']; ?></td>
            <td><?php echo $config['status_pg'][$venda['status_pg']]; ?></td>
            <td>
                <a href="/painel/venda/ver/<?php echo $venda['id']; ?>" class="btn btn-sm btn-default">+</a>
                <a href="/painel/venda/excluir/<?php echo $venda['id']; ?>" class="btn btn-sm btn-default">-</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>       
</table>