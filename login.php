
<?php
    session_start();
    require 'bd/bdConnection.php'; 

    $conn = new mysqli($servername, $username, $password, $database);
    $username = $conn->real_escape_string($_POST["loginUsername"]);
    $password = $conn->real_escape_string($_POST["loginPassword"]);

    $storedPassword = md5($password);

    if ($conn->connect_error) {
        die("Conexão falhou: " . $conn->connect_error);
    }

    $sqlCheckUser = "SELECT * FROM usuario WHERE login = '$username'";
    $resultCheckUser = $conn->query($sqlCheckUser);

    if ($resultCheckUser->num_rows == 1) {
        $row = $resultCheckUser->fetch_assoc();
        if ($row['senha'] == $storedPassword) {
            $_SESSION['userLogin'] = $row['login'];
            $conn->close();
            header("location: index.php");
            exit();
        } else {
            $conn->close();
            header("location: index.php?error=invalidcredentials");
            exit();
        }
    } else {
        $conn->close();
        header("location: index.php?error=invalidcredentials");
        exit();
    }
?>