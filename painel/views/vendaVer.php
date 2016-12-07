<h1>Detalhes da Venda - id(<?php echo $venda['id']; ?>)</h1>
<table class="table table-striped">
    <thead>
        <tr>
            <th width="80">Imagem</th>
            <th>Nome</th>
            <th>Quantidade</th>
            <th width="80">Preço</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($produtos as $produto): ?>
        <tr>
            <td><img src="/assets/images/produto/<?php echo $produto['imagem']; ?>" width="60"/></td>
            <td><?php echo $produto['nome']; ?></td>
            <td><?php echo $produto['quantidade']; ?></td>
            <td>R$ <?php echo $produto['preco']; ?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>