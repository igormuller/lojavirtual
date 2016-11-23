<div class="container">
    <div class="row">
        <h2>Lista de produtos:</h2>
        <p>Apresenta abaixo a lista de produtos selecionados.</p>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Produto</th>
                    <th>Preço</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($produtos as $produto): ?>
                <tr>
                    <td><?php echo utf8_encode($produto['nome']); ?></td>
                    <td>R$ <?php echo $produto['preco'] ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>