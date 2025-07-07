<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <link rel="icon" type="image/png" href="img/tag.fill.png">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/5/w3.css">
    <link rel="stylesheet" href="style/style.css">
    <script type="text/javascript" src="script/script.js"></script>
    <title><?php echo $title; ?></title>
</head>
<body>

    <?php 
        session_start();
        require 'bd/bdConnection.php'; 
        
        if (!isset($_SESSION['userLogin']) && $fileName != "index.php") {
            header("location: index.php");
            exit();
        } else {
            if (isset($_SESSION['userLogin']) && $fileName == "index.php") {
                header("location: selectProduct.php");
                exit();
            } 
        }
    ?>

    <div class="navBar">
        <a href="index.php"><img src="img/logoPrincipalArsenal.svg" alt="Logo"></a>
        <?php 
            if ($fileName == "index.php") {
                ?>
                <div class="navBarLinks">
                    <span><a href="javascript:void(0)" onclick="openLogin()">Login</a></span> 
                    <span><a href="javascript:void(0)" onclick="openRegister()">Cadastro</a></span> 
                </div>
                <?php
            } else {
                ?>
                <div class="navBarLinks">
                    <span><a href="index.php">Produtos Cadastrados</a></span>
                    <span><a href="insertProduct.php">Novo Cadastro de Produto</a></span>
                </div>
                <div class="navBarLinks">
                    <span><a>Você está logado como <b><?php echo $_SESSION['userLogin']?></b></a></span>
                    <form class="logout" action="logout.php" method="POST">
                        <input type="submit" value="Sair da conta">
                    </form>
                </div>
                <?php
            }
        ?>
    </div>

    <div class="content">