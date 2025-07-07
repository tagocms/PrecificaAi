<?php $title = 'Precifica Aí!'; $fileName = basename(__FILE__); include("aux/header.php");?>

<?php
    $errorType = $_GET['error'];
    switch ($errorType) {
        case "invalidcredentials":
            echo "<script>alert('Login ou senha incorretos.');</script>";
            break;
        case "userexists":
            echo "<script>alert('Usuário já cadastrado. Tente realizar o cadastro novamente com outro Login.');</script>";
            break;
        case "passwordmismatch":
            echo "<script>alert('As senhas não coincidem. Por favor, tente realizar o cadastro novamente.');</script>";
            break;
        case "insertfailed":
            echo "<script>alert('Falha ao inserir usuário. Tente realizar o cadastro novamente.');</script>";
            break;
        case "invalidphonenumber":
            echo "<script>alert('Número de celular inválido. Tente realizar o cadastro novamente.');</script>";
            break;
        default:
            // Sem erro
            break;
    }
?>
<div class="mainHeader">
    <h1>Precifica Aí</h1>
</div>
<div class="mainDiv">
    <div class="column">
        <h3>Entre no sistema</h3>
        <p>Se não tiver uma conta, crie um novo cadastro.</p>
        <p>Se já tiver uma conta, faça seu login.</p>
    </div>
    <div class="column">
        <div class="mainImgDiv">
            <img src="img/priceTag.svg" alt="Price Tag">
        </div> 
    </div>
</div>

<!-- Modal para Login -->
<div id="login" class="w3-modal">
  <div class="w3-modal-content modalContent">
    <div class="w3-container modalContainer">
      <span onclick="closeLogin()"
      class="w3-button w3-display-topright close">&times;</span>
      <form action="login.php" method="post" class="userModal" id="loginForm">
        <h2>Login</h2>
        <div>
            <label for="loginUsername">Login de usuário</label>
            <input type="text" id="loginUsername" name="loginUsername" required placeholder="nome.sobrenome">
        </div>
        <div>
            <label for="loginPassword">Senha</label>
            <input type="password" id="loginPassword" name="loginPassword" required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,8}" placeholder="Sua senha" title="Deve conter ao menos um número, uma letra maiúscula, uma letra minúscula, um caracter especial, e ter de 6 a 8 caracteres.">
        </div>
        <div>
            <label for="showLogin">Mostrar a senha</label>
            <input type="checkbox" id="showLogin" name="showLogin" onclick="togglePasswordVisibility(this)">
        </div>
        <input type="submit" value="Entrar">
        <p>Não tem uma conta? <a href="javascript:void(0)" onclick="openRegister()">Cadastre-se</a></p>
    </form>
    </div>
  </div>
</div>

<!-- Modal para Cadastro -->
<div id="register" class="w3-modal">
  <div class="w3-modal-content modalContent">
    <div class="w3-container modalContainer">
      <span onclick="closeRegister()"
      class="w3-button w3-display-topright close">&times;</span>
      <form action="register.php" method="post" class="userModal" id="registerForm">
        <h2>Cadastro</h2>
        <div>
            <label for="name">Nome</label>
            <input type="text" id="name" name="name" required placeholder="Nome Sobrenome" pattern="[a-zA-Z\s]{2,100}">
        </div>
        <div>
            <label for="username">Login de usuário</label>
            <input type="text" id="username" name="username" required placeholder="nome.sobrenome" pattern="[a-zA-Z]{2,50}\.[a-zA-Z]{2,50}">
        </div>
        <div>
            <label for="phoneNumber">Celular</label>
            <input type="text" id="phoneNumber" name="phoneNumber" required placeholder="(XX) XXXXX-XXXX" pattern="\(\d{2}\)\s\d{4,5}-\d{4}$">
        </div>
        <div>
            <label for="password">Senha</label>
            <input type="password" id="password" name="password" required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,8}" placeholder="Sua senha" title="Deve conter ao menos um número, uma letra maiúscula, uma letra minúscula, um caracter especial, e ter de 6 a 8 caracteres.">
        </div>
        <div>
            <label for="confirmPassword">Confirme sua senha</label>
            <input type="password" id="confirmPassword" name="confirmPassword" required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,8}" placeholder="Confirme sua senha" title="Deve conter ao menos um número, uma letra maiúscula, uma letra minúscula, um caracter especial, e ter de 6 a 8 caracteres.">
        </div>
        <div>
            <label for="showRegister">Mostrar a senha</label>
            <input type="checkbox" id="showRegister" name="showRegister" onclick="togglePasswordVisibility(this)">
        </div>
        <input type="submit" value="Cadastrar" onclick="validateRegisterForm()">
        <p>Já tem uma conta? <a href="javascript:void(0)" onclick="openLogin()">Entre</a></p>
    </form>
    </div>
  </div>
</div>

<?php include("aux/footer.php");?>