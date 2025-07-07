<?php $title = 'Novo Cadastro'; $fileName = basename(__FILE__); include("aux/header.php");?>
<?php
    $productName = $_POST["productName"];
    $productCategory = $_POST["productCategory"];
    $launchDate = $_POST["launchDate"];
    $productCost = (float) $_POST["productCost"];
    
    $conn = new mysqli($servername, $username, $password, $database);

    if ($conn->connect_error) {
        die("Conexão falhou: " . $conn->connect_error);
    }

    $sql = "INSERT INTO produtos (nomeProduto, dataLancamento, custoProduto, idCategoria) VALUES ('$productName', '$launchDate', '$productCost', '$productCategory')";
?>
<div class="contentHeader">
    <h1>Novo Cadastro de Produto</h1>
</div>
<div class="productInsertedDiv">
    <?php
        try {
            if ($result = $conn->query($sql)) {
                echo "<span>O produto <b>" . $productName . "</b> foi cadastrado corretamente!</span>";
            } else {
                echo "<span>O produto <b>" . $productName . "</b> não foi cadastrado corretamente, tente novamente.</span>";
            }
        } catch (Exception $e) {
            echo "<span>O produto <b>" . $productName . "</b> não foi cadastrado corretamente, tente novamente.</span>";
        }

        $conn->close();
    ?>
</div>
<?php include("aux/footer.php");?>