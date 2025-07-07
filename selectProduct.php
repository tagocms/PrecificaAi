<?php $title = 'Produtos Cadastrados'; $fileName = basename(__FILE__); include("aux/header.php");?>
<?php
    $conn = new mysqli($servername, $username, $password, $database);

    if ($conn->connect_error) {
        die("Conexão falhou: " . $conn->connect_error);
    }

    $sql = "SELECT idProduto, nomeProduto, nomeCategoria, dataLancamento, custoProduto, cargaTributaria, margemContribuicao FROM produtos AS P LEFT JOIN infosCategoria AS C ON P.idCategoria = C.idCategoria ORDER BY idProduto DESC";

    $result = $conn->query($sql);
    $conn->close();
?>
<div class="contentHeader">
    <h1>Produtos Cadastrados</h1>
</div>
<?php 
    if ($result->num_rows == 0) {
        echo "<div class='productInsertedDiv'>
            <span>Não há produtos cadastrados.</span>
        </div>";
    } else {
?>
        <table class="contentTable">
    
        <tr class="contentTableHeader">
            <th>ID</th>
            <th>Nome</th>
            <th>Data de Lançamento</th>
            <th>Categoria</th>
            <th>Custo</th>
            <th>Carga Tributária</th>
            <th>Margem de Contribuição</th>
            <th>Preço</th>
            <th>Editar</th>
            <th>Excluir</th>
        </tr>
        <?php
            foreach($result as $row) {
                echo "<tr>";
                echo "<td>" . $row['idProduto'] . "</td>";
                echo "<td>" . $row['nomeProduto'] . "</td>";
                echo "<td>" . date('d/m/Y', strtotime($row['dataLancamento'])) . "</td>";
                echo "<td>" . $row['nomeCategoria'] . "</td>";
                echo "<td>R$ " . number_format($row['custoProduto'], 2, ',', '.') . "</td>";
                echo "<td>" . number_format($row['cargaTributaria'] * 100, 2, ',', '.') . "%</td>";
                echo "<td>" . number_format($row['margemContribuicao'] * 100, 2, ',', '.') . "%</td>";
                echo "<td>R$ " . number_format((float) $row['custoProduto'] / (1 - (float) $row['cargaTributaria'] - (float) $row['margemContribuicao']), 2, ',', '.'). "</td>";
                echo "<td><a href='updateProduct.php?productId=" . $row['idProduto'] . "'>EDITAR</a></td>";
                echo "<td><a href='deleteProduct.php?productId=" . $row['idProduto'] . "'>EXCLUIR</a></td>";
                echo "</tr>";
            }
        ?>
        </table>
<?php 
    }
?>
<?php include("aux/footer.php");?>