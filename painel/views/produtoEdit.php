<h1>Produto - Editar</h1>
<?php if (!empty($aviso)): ?>
<div class="alert alert-danger alert-dismissible">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Aviso!! </strong><?php echo $aviso; ?>
</div>
<?php endif; ?>
<div class="col-md-12">
    <form class="form-horizontal" method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label class="control-label col-sm-2">Nome:</label>
            <div class="col-sm-8">
                <input type="text" name="nome" value="<?php echo utf8_encode($produto['nome']); ?>" class="form-control" />
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2">Categoria:</label>
            <div class="col-sm-8">
                <select name="categoria" class="form-control">
                    <?php foreach ($categorias as $categoria): ?>
                    <option <?php echo ($categoria['id'] == $produto['id_categoria'])?'selected="selected"':''; ?> value="<?php echo $categoria['id']; ?>"><?php echo $categoria['titulo']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2">Preço:</label>
            <div class="col-sm-8">
                <input type="text" name="preco" value="<?php echo $produto['preco']; ?>"  class="form-control" />
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2">Quantidade:</label>
            <div class="col-sm-8">
                <input type="text" name="quantidade" value="<?php echo $produto['quantidade']; ?>"  class="form-control" />
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2">Imagem:</label>
            <div class="col-md-6">
                <input type="file" name="imagem" class="form-control" />
            </div>
            <div class="col-md-2">
                <img src="/assets/images/produto/<?php echo $produto['imagem']; ?>" height="100" />
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2">Descrição:</label>
            <div class="col-sm-8">
                <textarea name="descricao" class="form-control"><?php echo utf8_encode($produto['descricao']); ?></textarea>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2"></label>
            <div class="col-sm-8">
                <input type="submit" value="Salvar" class="btn btn-default" />
            </div>
        </div>
    </form>
</div>