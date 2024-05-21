<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Locadora de Veículos</title>
    <link rel="stylesheet" href="login.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha384-zi5vujvkRlLq8EWpqy27p08w5n7jwuPE9b5nfe3/T0qypZlqgbrbFYYcvivmybHA" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <header>
        <div class="navbar">
            <img src="img/Vrum.png" alt="">
            <nav>
                <ul>
                    <a href="Index.php" class="letras">
                        <li>Início</li>
                    </a>

                    <a href="Login.php" class="letras">
                        <li>Login</li>
                    </a>

                    <a href="Carros.php" class="letras">
                        <li>Carros</li>
                    </a>
                    <a href="" class="letras">
                        <li>Sobre Nós</li>
                    </a>
                </ul>
            </nav>
        </div>
    </header>

    <div class="login-container">
    <form action="process_login.php" method="post" class="login-form">
        <div class="form-section cliente">
            <h2>Login Cliente</h2>
            <div class="form-group">
                <label for="cliente-username">Usuário</label>
                <input type="text" id="cliente-username" name="cliente-username" required>
            </div>
            <div class="form-group">
                <label for="cliente-password">Senha</label>
                <input type="password" id="cliente-password" name="cliente-password" required>
            </div>
            <button type="submit" name="login-cliente">Entrar</button>
        </div>
    </form>
    
    <form action="process_login.php" method="post" class="login-form">
        <div class="form-section funcionario">
            <h2>Login Funcionário</h2>
            <div class="form-group">
                <label for="funcionario-username">Usuário</label>
                <input type="text" id="funcionario-username" name="funcionario-username" required>
            </div>
            <div class="form-group">
                <label for="funcionario-password">Senha</label>
                <input type="password" id="funcionario-password" name="funcionario-password" required>
            </div>
            <button type="submit" name="login-funcionario">Entrar</button>
        </div>
    </form>
</div>