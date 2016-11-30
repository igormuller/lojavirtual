<?php global $config; ?>
<div class="container">
    <div class="row">
        <div class="col-sm-12 text-right">
            <p>Olá <?php echo $_SESSION['clinome']; ?></p>
            <a class="btn btn-success" href="<?php echo BASE_URL; ?>/login/logout">Sair</a>
        </div>
        <div class="col-sm-12 text-center">
            <h1>Pedidos</h1>
        </div>
        <div class="col-sm-12 text-center">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Nº Pedido</th>
                        <th>Valor Pago</th>
                        <th>Forma de Pgto</th>
                        <th>Status do Pgto</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($pedidos as $pedido): ?>
                    <tr>
                        <td><?php echo $pedido['id']; ?></td>
                        <td><?php echo $pedido['valor']; ?></td>
                        <td><?php echo utf8_encode($pedido['tipo_pg']); ?></td>
                        <td><?php echo $config['status_pg'][$pedido['status_pg']]; ?></td>
                        <td><a class="btn btn-info" href="/pedidos/ver/<?php echo $pedido['id']; ?>">+</a></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        
    </div>
</div>




