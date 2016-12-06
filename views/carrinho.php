<div class="container">
    <div class="row">
        <div class="col-lg-1"></div>
        <div class="col-lg-8">
            <h2>Lista de produtos:</h2>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Imagem</th>
                        <th>Produto</th>
                        <th>Preço</th>
                        <th>Ação</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $total = 0; ?>
                    <?php if (empty($produtos)){
                        
                    } else { ?>
                    <?php foreach ($produtos as $produto): ?>
                    <tr>
                        <td><img src="<?php echo BASE_URL; ?>/assets/images/produto/<?php echo $produto['imagem']; ?>" width="60" height="60" ></td>
                        <td><?php echo $produto['nome']; ?></td>
                        <td>R$ <?php echo $produto['preco'] ?></td>
                        <td><a href="<?php echo BASE_URL; ?>/carrinho/del/<?php echo $produto['id']; ?>" class="btn-sm btn-danger">Excluir</a></td>
                    </tr>
                    <?php $total += $produto['preco']; ?>
                    <?php endforeach; ?>
                    <?php } ?>
                    <tr>
                        <td></td>
                        <td align="right" class="text-info">Total: </td>
                        <td class="text-info"><?php echo $total; ?></td>
                        <td></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="col-lg-3 text-center"><a href="<?php echo BASE_URL; ?>/carrinho/finalizar" class="btn-lg btn-success">Finalizar Compra</a></div>
    </div>
</div>