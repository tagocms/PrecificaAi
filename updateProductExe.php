<?php $title = 'Atualização de Cadastro'; $fileName = basename(__FILE__); include("aux/header.php");?>
<?php
    $productId = $_POST["productId"];
    $productName = $_POST["productName"];
    $productCategory = $_POST["productCategory"];
    $launchDate = $_POST["launchDate"];
    $productCost = (float) $_POST["productCost"];
    
    $conn = new mysqli($servername, $username, $password, $database);

    if ($conn->connect_error) {
        die("Conexão falhou: " . $conn->connect_error);
    }

    $sqlCheckProduct = "SELECT * FROM produtos WHERE idProduto = '$productId'";
    $resultCheckProduct = $conn->query($sqlCheckProduct);
?>
<div class="contentHeader">
    <h1>Atualização de Cadastro de Produto</h1>
</div>
<div class="productInsertedDiv">
    <?php
        try {
            if ($resultCheckProduct->num_rows == 1) {
                $sqlUpdate = "UPDATE produtos SET nomeProduto = '$productName', dataLancamento = '$launchDate', custoProduto = '$productCost', idCategoria = '$productCategory' WHERE idProduto = '$productId'";
    
                if ($result = $conn->query($sqlUpdate)) {
                    echo "<span>O produto <b>" . $productName . "</b> foi atualizado corretamente!</span>";
                } else {
                    echo "<span>O produto <b>" . $productName . "</b> não foi atualizado corretamente, tente novamente.</span>";
                }
            } else {
                echo "<span>O produto de ID <b>" . $productId . "</b> não existe, tente novamente.</span>";
            }
        } catch (Exception $e) {
            echo "<span>O produto <b>" . $productName . "</b> não foi atualizado corretamente, tente novamente.</span>";
        }
    
        $conn->close();
    ?>
</div>
<?php include("aux/footer.php");?>