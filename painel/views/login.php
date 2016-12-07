<html>
    <head>
        <title>.: Login Painel :.</title>
        <link href="<?php echo BASE_URL_ADM; ?>/assets/css/bootstrap.min.css" rel="stylesheet">
    </head>
    <body style="margin-top: 100px; background-image: url(/painel/assets/images/fundologin.jpg);">
        <div class="container">
            <div class="row">
                <?php if (!empty($aviso)): ?>
                <div class="alert alert-warning text-center">
                    <a class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <span class="text-danger"><?php echo $aviso; ?></span>
                </div>
                <?php endif; ?>
                <div class="col-md-4 col-md-offset-4">
                    <div class="panel panel-default">
                        <div class="panel-heading text-center">
                            <span class="panel-title">Login Loja Virtual</span>
                        </div>
                        <div class="panel-body">
                            <form method="POST">
                                <div class="form-group">
                                    <input class="form-control" placeholder="Usuário" name="usuario" type="text">
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Senha" name="senha" type="password" value="">
                                </div>
                                <input class="btn btn-lg btn-success btn-block" type="submit" value="Login">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>