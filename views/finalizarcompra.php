<div class="container">
    <div class="row">
        <div class="col-md-12">
            <?php if(!empty($erro)): ?>
            <span class="text-danger"><?php echo $erro; ?></span>
            <?php endif; ?>
        </div>
        <form method="POST" class="form-horizontal">
            <div class="col-md-4">
                <div class="panel panel-primary">
                    <div class="panel-heading">Informações do Usuário</div>
                    <div class="panel-body">
                        <div class="form-group">
                            <label class="control-label col-sm-2">Nome:</label>
                            <div class="col-sm-10">
                                <input type="text" name="nome" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2">E-mail:</label>
                            <div class="col-sm-10">
                                <input type="email" name="email" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2">Senha:</label>
                            <div class="col-sm-10">
                                <input type="password" name="senha" class="form-control">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="panel panel-primary">
                    <div class="panel-heading">Informações de Endereço</div>
                    <div class="panel-body">
                        <div class="form-group">
                            <label class="control-label col-sm-3">Endereço:</label>
                            <div class="col-sm-9">
                                <textarea name="endereco" class="form-control"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="panel panel-primary">
                    <div class="panel-heading">Informações de Pagamento</div>
                    <div class="panel-body">
                        <?php foreach ($pagamentos as $pg): ?>
                        <div class="radio">
                            <label class="radio"><input type="radio" name="pg" value="<?php echo $pg['id'] ?>" /><?php echo utf8_encode($pg['nome']); ?></label>
                        </div>
                        <?php endforeach; ?>
                        <p>Total: <?php echo $total; ?></p>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <button class="btn btn-success">Finalizar Pedido</button>
            </div>
        </form>
    </div>
</div>