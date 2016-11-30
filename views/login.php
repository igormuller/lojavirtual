<div class="container">
    <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-4">
            <?php if (!empty($aviso)): ?>
            <div class="alert alert-warning text-center">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <span class="text-danger"><?php echo $aviso; ?></span>
            </div>
            <?php endif; ?>
            <form class="form-horizontal" method="POST">
                <div class="panel panel-primary">
                    <div class="panel-heading text-center">.: Login :.</div>
                    <div class="panel-body" >
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="email">Email:</label>
                            <div class="col-sm-10">
                                <input type="email" class="form-control" id="email" name="email">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="senha">Senha:</label>
                            <div class="col-sm-10">
                                <input type="password" class="form-control" id="senha" name="senha">
                            </div>
                        </div>
                        <div class="form-group text-center">
                            <div class="col-sm-offset-2 col-sm-10">
                                <input class="btn btn-success" type="submit" value="Entrar">
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-md-4"></div>
    </div>
</div>