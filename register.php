
<?php
    session_start();
    require 'bd/bdConnection.php'; 

    $conn = new mysqli($servername, $username, $password, $database);
    $name = $conn->real_escape_string($_POST["name"]);
    $username = $conn->real_escape_string($_POST["username"]);
    $phoneNumber = $conn->real_escape_string($_POST["phoneNumber"]);
    $password = $conn->real_escape_string($_POST["password"]);
    $confirmPassword = $conn->real_escape_string($_POST["confirmPassword"]);

    if ($password !== $confirmPassword) {
        $conn->close();
        header("location: index.php?error=passwordmismatch");
        exit();
    }

    $storedPassword = md5($password);

    if ($conn->connect_error) {
        die("Conexão falhou: " . $conn->connect_error);
    }

    $sqlCheckUser = "SELECT * FROM usuario WHERE login = '$username'";
    $resultCheckUser = $conn->query($sqlCheckUser);

    $sqlInsertUser = "INSERT INTO usuario (nomeUsuario, celularUsuario, login, senha) VALUES ('$name', '$phoneNumber', '$username', '$storedPassword')";
    $phoneNumberPattern = "/\(\d{2}\)\s\d{4,5}-\d{4}$/";

    if ($resultCheckUser->num_rows > 0) {
        $conn->close();
        header("location: index.php?error=userexists");
        exit();
    } else {
        if (preg_match($phoneNumberPattern, $phoneNumber) == 1) {
            try {
                if ($resultInsertUser = $conn->query($sqlInsertUser)) {
                    $conn->close();
                        $_SESSION['userLogin'] = $username;
                        header("location: index.php");
                        exit();
                } else {
                    $conn->close();
                    header("location: index.php?error=insertfailed");
                    exit();
                }
            } catch (Exception $e) {
                $conn->close();
                header("location: index.php?error=insertfailed");
                exit();
            }
        } else {
            $conn->close();
            header("location: index.php?error=invalidphonenumber");
            exit();
        }
    }
?>