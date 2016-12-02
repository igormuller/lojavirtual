<html lang="pt-br">
<head>
    <title>.: Loja Virtual :.</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>/assets/css/bootstrap.min.css">
    <script src="<?php echo BASE_URL; ?>/assets/js/jquery-3.1.1.min.js"></script>
    <script src="<?php echo BASE_URL; ?>/assets/js/bootstrap.min.js"></script>
    <style>
    /* Remove the navbar's default rounded borders and increase the bottom margin */ 
    .navbar {
      margin-bottom: 50px;
      border-radius: 0;
    }
    
    /* Remove the jumbotron's default bottom margin */ 
     .jumbotron {
      margin-bottom: 0;
      padding: 10px;
      height: 250px;
    }
   
    /* Add a gray background color and some padding to the footer */
    footer {
      background-color: #f2f2f2;
      padding: 25px;
    }
    </style>
</head>
<body>
    <div class="jumbotron text-center">
        <img src="<?php echo BASE_URL; ?>/assets/images/LogoFinal.png">
    </div>
    <nav class="navbar navbar-inverse">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>                        
                </button>
            </div>
            <div class="collapse navbar-collapse" id="myNavbar">
                <ul class="nav navbar-nav">
                    <li class=""><a href="<?php echo BASE_URL; ?>">Home</a></li>
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">Categoria
                        <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <?php foreach ($menu as $menuitem): ?>
                            <li><a href="<?php echo BASE_URL."/categoria/ver/".$menuitem['id']; ?>"><?php echo $menuitem['titulo']; ?></a></li>
                            <?php endforeach; ?>                            
                        </ul>                           
                    </li>
                    
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li>
                        <a href="<?php echo BASE_URL; ?>/carrinho"><img src="<?php echo BASE_URL; ?>/assets/images/carrinho.png" width="24" height="24">
                            <span class="badge">
                                <?php echo (isset($_SESSION['carrinho']))? count($_SESSION['carrinho']) : '0'; ?>
                            </span>
                        </a>
                    </li>
                    <li><a href="<?php echo BASE_URL; ?>/pedidos">Pedidos</a></li>
                    <li><a href="<?php echo BASE_URL; ?>/painel">Admin</a></li>
                </ul>
            </div>
        </div>
    </nav>
    
    <?php $this->loadViewInTemplate($viewName, $viewData); ?>

    <br><br>
    <footer class="container-fluid text-center">
        <p>Loja Virtual Copyright</p>
        <a href="http://www.idmweb.com.br" class="text-success">Desenvolvido por IDMWeb - Soluções</a>
    </footer>
    <script src="<?php echo BASE_URL; ?>/assets/js/script.js"></script>
</body>
</html>
