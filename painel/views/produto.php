<h1>Produtos</h1>
<a href="/painel/produto/add" class="btn btn-default">Adicionar Produto</a>
<table class="table table-striped">
    <thead>
        <tr>
            <th>Imagem</th>
            <th>Nome</th>
            <th width="80">Preço</th>
            <th>Quantidade</th>
            <th>Descrição</th>
            <th>Categoria</th>
            <th width="150">Ação</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($produtos as $produto): ?>
        <tr>
            <td><img src="../assets/images/produto/<?php echo $produto['imagem']; ?>" width="60"/></td>
            <td><?php echo $produto['nome']; ?></td>
            <td>R$ <?php echo $produto['preco']; ?></td>
            <td><?php echo $produto['quantidade']; ?></td>
            <td><?php echo $produto['descricao']; ?></td>
            <td><?php echo $produto['categoria']; ?></td>
            <td>
                <a href="/painel/produto/edit/<?php echo $produto['id']; ?>" class="btn btn-sm btn-default">Editar</a>
                <a href="/painel/produto/remove/<?php echo $produto['id']; ?>" class="btn btn-sm btn-default">Excluir</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?php
$conta = ceil($total_produtos / $limit_produtos);
for ($q=0; $q<$conta;$q++): ?>
<ul class="pagination">
    <li><a href="/painel/produto?p=<?php echo $q+1; ?>"><?php echo $q+1; ?></a></li>
</ul>
<?php endfor; ?>
