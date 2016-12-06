<?php global $config; ?>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Nº Pedido</th>
                        <th>Valor Pago</th>
                        <th>Forma de Pgto</th>
                        <th>Status do Pgto</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><?php echo $pedido['id']; ?></td>
                        <td><?php echo $pedido['valor']; ?></td>
                        <td><?php echo $pedido['tipo_pg']; ?></td>
                        <td><?php echo $config['status_pg'][$pedido['status_pg']]; ?></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="col-md-12">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Imagem</th>
                        <th>Produto</th>
                        <th>Preço</th>
                        <th>Quantidade</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($pedido['produtos'] as $produto): ?>
                    <tr>
                        <td><img src="<?php echo BASE_URL; ?>/assets/images/produto/<?php echo $produto['imagem']; ?>" width="60" height="60" ></td>
                        <td><?php echo $produto['nome']; ?></td>
                        <td>R$ <?php echo $produto['preco']; ?></td>
                        <td><?php echo $produto['quantidade']; ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
