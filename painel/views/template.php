<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>.: Painel de Controle :. - Loja Virtual</title>

        <!-- Bootstrap Core CSS -->
        <link href="<?php echo BASE_URL_ADM; ?>/assets/css/bootstrap.min.css" rel="stylesheet">
        <!-- Custom CSS -->
        <link href="<?php echo BASE_URL_ADM; ?>/assets/css/sb-admin.css" rel="stylesheet">
        <!-- Custom Fonts -->
        <link href="<?php echo BASE_URL_ADM; ?>/assets/css/font-awesome.min.css" rel="stylesheet" type="text/css">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>

        <div id="wrapper">
            <!-- Navigation -->
            <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="/painel">Administração Loja Virtual</a>
                </div>
                <!-- Top Menu Items -->
                <ul class="nav navbar-right top-nav">
                    <li>
                        <a href="/">Loja</a>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Usuário<b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li>
                                <a href="#">Perfil</a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a href="/painel/login/sair">Sair</a>
                            </li>
                        </ul>
                    </li>
                </ul>
                <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
                <div class="collapse navbar-collapse navbar-ex1-collapse">
                    <ul class="nav navbar-nav side-nav">
                        <li><a href="/painel/">Home Painel</a></li>
                        <li><a href="/painel/categoria">Categoria</a></li>
                        <li><a href="/painel/produto">Produto</a></li>
                        <li><a href="/painel/pagamento">Pagamento</a></li>
                        <li><a href="/painel/venda">Venda</a></li>
                        <li><a href="/painel/usuario">Usuário</a></li>
                        <li><a href="/painel/admin">Admin</a></li>
                    </ul>
                </div>
                <!-- /.navbar-collapse -->
            </nav>

            <div id="page-wrapper">
                <div class="container-fluid">
                    <!-- Page Heading -->
                    <div class="row">
                        <?php $this->loadViewInTemplate($viewName, $viewData); ?>
                    </div>
                    <!-- /.row -->

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- /#page-wrapper -->

        </div>
        <!-- /#wrapper -->

        <!-- jQuery -->
        <script src="<?php echo BASE_URL_ADM; ?>/assets/js/jquery-3.1.1.min.js"></script>
        <!-- Bootstrap Core JavaScript -->
        <script src="<?php echo BASE_URL_ADM; ?>/assets/js/bootstrap.min.js"></script>

    </body>
</html>