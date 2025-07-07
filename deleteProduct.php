<?php $title = 'Exclusão de Cadastro'; $fileName = basename(__FILE__); include("aux/header.php");?>
<?php
    $productId = $_GET["productId"];

    $conn = new mysqli($servername, $username, $password, $database);

    if ($conn->connect_error) {
        die("Conexão falhou: " . $conn->connect_error);
    }

    $sqlCheckProduct = "SELECT idProduto, nomeProduto, nomeCategoria, dataLancamento, custoProduto, cargaTributaria, margemContribuicao FROM produtos AS P LEFT JOIN infosCategoria AS C ON P.idCategoria = C.idCategoria WHERE idProduto = '$productId' ORDER BY idProduto DESC";
    $resultCheckProduct = $conn->query($sqlCheckProduct);
?>
<div class="contentHeader">
    <h1>Exclusão de Cadastro de Produto</h1>
</div>
<?php 
    if ($resultCheckProduct->num_rows == 1) {
        $product = $resultCheckProduct->fetch_assoc();
        $productName = $product['nomeProduto'];
        $productCategoryName = $product['nomeCategoria'];
        $launchDate = $product['dataLancamento'];
        $productCost = $product['custoProduto'];

        $conn->close()
        ?>
        <form action="deleteProductExe.php" method="POST">
            <div class="deleteProductDiv">
                <input type="hidden" name="productId" id="productId" value="<?php echo $productId; ?>">
                <input type="hidden" name="productName" id="productName" value="<?php echo $productName; ?>">
                <div>
                    <label>ID</label>    
                    <?php echo "<div> " . $productId . "</div>"; ?>
                </div>
                <div>
                    <label>Nome</label>    
                    <?php echo "<div> " . $productName . "</div>"; ?>
                </div>
                <div>
                    <label>Categoria</label>    
                    <?php echo "<div> " . $productCategoryName . "</div>"; ?>
                </div>
                <div>
                    <label>Data de Lançamento</label>    
                    <?php echo "<div>" . date('d/m/Y', strtotime($launchDate)) . "</div>"; ?>
                </div>
                <div>
                    <label>Custo Estimado</label>    
                    <?php echo "<div>R$ " . number_format($productCost, 2, ',', '.') . "</div>"; ?>
                </div>
            </div>
            <div class="deleteProductSubmitDiv">
                <div>
                    <input type="button" value="Cancelar" onclick="window.location.href='index.php'">
                    <input type="submit" value="Confirmar Exclusão" id="deleteProductButton">
                </div>   
            </div>
        </form>
        <?php
    } else {
        echo "<div class='productInsertedDiv'>
            <span>O produto de ID <b>" . $productId . "</b> não possui cadastro, tente novamente.</span>
        </div>";
    }

    $conn->close();
?>
<?php include("aux/footer.php");?>