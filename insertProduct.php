<?php $title = 'Novo Cadastro'; $fileName = basename(__FILE__); include("aux/header.php");?>
<?php
    $conn = new mysqli($servername, $username, $password, $database);

    if ($conn->connect_error) {
        die("Conexão falhou: " . $conn->connect_error);
    }

    $sql = "SELECT idCategoria, nomeCategoria FROM infosCategoria";

    $result = $conn->query($sql);
?>
<div class="contentHeader">
    <h1>Novo Cadastro de Produto</h1>
</div>
<form action="insertProductExe.php" method="POST">
    <div class="insertProductDiv">
        <div>
            <label for="productName">Nome</label>    
            <input type="text" name="productName" id="productName" placeholder="Nome do Produto" required pattern="[a-zA-Z0-9\u00C0-\u00FF ]{10,100}$">
        </div>
        <div>
            <label for="productCategory">Categoria</label>    
            <select name="productCategory" id="productCategory" required>
                <option value=""></option>
                <?php
                    foreach ($result as $category) {
                        echo "<option value='" . $category['idCategoria'] . "'>" . $category['nomeCategoria'] . "</option>";
                    }

                    $conn->close();
                ?>
            </select>
        </div>
        <div>
            <label for="launchDate">Data de Lançamento</label>    
            <input type="date" name="launchDate" id="launchDate" required>
        </div>
        <div>
            <label for="productCost">Custo Estimado</label>    
            <input type="number" name="productCost" id="productCost" step= "0.01" required>
        </div>
    </div>
    <div class="insertProductSubmitDiv">
        <img src="img/priceTag.svg" alt="Price Tag" class="insertProductImage">
        <div>
            <input type="button" value="Cancelar" onclick="window.location.href='index.php'">
            <input type="submit" value="Cadastrar">
        </div>
    </div> 
</form>
<?php include("aux/footer.php");?>