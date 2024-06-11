<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Funcionários</title>
    <link rel="stylesheet" href="stylecadastrof.css">
</head>
<body>
    <header>
        <div class="navbar">
            <img src="img/Vrum.png" alt="Logo">
            <nav>
                <ul>
                    <a href="Index.php" class="letras"><li>Início</li></a>
                    <a href="Login.php" class="letras"><li>Login</li></a>
                    <a href="listar_carros.php" class="letras"><li>Carros</li></a>
                    <a href="SobreNos.php" class="letras"><li>Sobre Nós</li></a>
                </ul>
            </nav>
        </div>
    </header>

    <div class="container">
        <h2>Cadastro de Funcionários</h2>
        <form action="processa_cadastrofuncionario.php" method="post">
            <div class="form-group">
                <label for="nome">Nome:</label>
                <input type="text" id="nome" name="nome" required>
            </div>
            <div class="form-group">
                <label for="sobrenome">Sobrenome:</label>
                <input type="text" id="sobrenome" name="sobrenome" required>
            </div>
            <div class="form-group">
                <label for="cpf">CPF:</label>
                <input type="text" id="cpf" name="cpf" required>
            </div>
            <div class="form-group">
                <label for="senha">Senha:</label>
                <input type="password" id="senha" name="senha" required>
            </div>
            <div class="form-group">
                <label for="data_contratacao">Data de Contratação:</label>
                <input type="date" id="data_contratacao" name="data_contratacao" required>
            </div>
            <div class="form-group">
                <label for="cargo">Cargo:</label>
                <input type="text" id="cargo" name="cargo" required>
            </div>
            <div class="form-group">
                <label for="salario">Salário:</label>
                <input type="number" step="0.01" id="salario" name="salario" required>
            </div>
            <div class="form-group">
                <label for="numero_agencia">Número da Agência:</label>
                <input type="number" id="numero_agencia" name="numero_agencia" required>
            </div>
            <button type="submit">Cadastrar</button>
        </form>
    </div>

    <footer>
        &copy; 2024 Locadora de Veículos
    </footer>
</body>
</html>
