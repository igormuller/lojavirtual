<div class="container">
    <div class="row">
        <div class="col-sm-3">
            <img src="<?php echo BASE_URL."/assets/images/produto/".$produto['imagem']; ?>" class="img-responsive  center-block" >
        </div>
        <div class="col-sm-6">
            <h2><?php echo $produto['nome']; ?></h2>
            <span><?php echo $produto['descricao']; ?></span><br/>
            <span>R$ <?php echo $produto['preco']; ?></span><br/><br/>
            <a href="<?php echo BASE_URL; ?>/carrinho/add/<?php echo $produto['id']; ?>" class="btn btn-success">Adicionar ao Carrinho</a>
        </div>
    </div>
</div>