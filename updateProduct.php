<?php $title = 'Atualização de Cadastro'; $fileName = basename(__FILE__); include("aux/header.php");?>
<?php
    $productId = $_GET["productId"];

    $conn = new mysqli($servername, $username, $password, $database);

    if ($conn->connect_error) {
        die("Conexão falhou: " . $conn->connect_error);
    }

    $sqlCategory = "SELECT idCategoria, nomeCategoria FROM infosCategoria";
    $resultCategory = $conn->query($sqlCategory);

    $sqlCheckProduct = "SELECT * FROM produtos WHERE idProduto = '$productId'";
    $resultCheckProduct = $conn->query($sqlCheckProduct);
?>
<div class="contentHeader">
    <h1>Atualização de Cadastro de Produto</h1>
</div>
<?php 
    if ($resultCheckProduct->num_rows == 1) {
        $product = $resultCheckProduct->fetch_assoc();
        $productName = $product['nomeProduto'];
        $productCategory = $product['idCategoria'];
        $launchDate = $product['dataLancamento'];
        $productCost = $product['custoProduto'];
        $conn->close()
        ?>
        <form action="updateProductExe.php" method="POST">
            <div class="insertProductDiv">
                <input type="hidden" name="productId" id="productId" value="<?php echo $productId; ?>">
                <div>
                    <label>ID</label>    
                    <?php echo "<div> " . $productId . "</div>"; ?>
                </div>
                <div>
                    <label for="productName">Nome</label>    
                    <input type="text" name="productName" id="productName" placeholder="Nome do Produto" required pattern="[a-zA-Z0-9\u00C0-\u00FF ]{10,100}$" value="<?php echo $productName; ?>">
                </div>
                <div>
                    <label for="productCategory">Categoria</label>    
                    <select name="productCategory" id="productCategory" required>
                        <option value=""></option>
                        <?php
                            foreach ($resultCategory as $category) {
                                if ((int) $category['idCategoria'] == (int) $productCategory) {
                                    echo "<option selected value='" . $category['idCategoria'] . "'>" . $category['nomeCategoria'] . "</option>";
                                } else {
                                    echo "<option value='" . $category['idCategoria'] . "'>" . $category['nomeCategoria'] . "</option>";
                                }
                            }
                        ?>
                    </select>
                </div>
                <div>
                    <label for="launchDate">Data de Lançamento</label>    
                    <input type="date" name="launchDate" id="launchDate" required value="<?php echo $launchDate; ?>">
                </div>
                <div>
                    <label for="productCost">Custo Estimado</label>    
                    <input type="number" name="productCost" id="productCost" step= "0.01" required value="<?php echo $productCost; ?>">
                </div>
            </div>
            <div class="insertProductSubmitDiv">
                <img src="img/priceTag.svg" alt="Price Tag" class="insertProductImage">
                <div>
                    <input type="button" value="Cancelar" onclick="window.location.href='index.php'">
                    <input type="submit" value="Atualizar">
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