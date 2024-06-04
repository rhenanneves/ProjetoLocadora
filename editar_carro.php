<?php
include 'config.php';

// Verificar se a placa do carro foi fornecida na URL
if (isset($_GET['placa'])) {
    $car_placa = $_GET['placa'];

    // Conectar ao banco de dados
    $pdo = pdo_connect_pgsql();

    // Consulta para obter os dados do carro com a placa fornecida
    $stmt = $pdo->prepare('SELECT * FROM carro WHERE placa = :placa');
    $stmt->bindValue(':placa', $car_placa, PDO::PARAM_STR);
    $stmt->execute();
    $carro = $stmt->fetch(PDO::FETCH_ASSOC);

    // Verificar se o carro existe no banco de dados
    if (!$carro) {
        exit('Carro não encontrado!');
    }

    // Verificar se o formulário foi enviado
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Capturar os dados do formulário
        $tipo = $_POST['tipo'];
        $disponibilidade = $_POST['disponibilidade'];
        $ano = $_POST['ano'];
        $modelo = $_POST['modelo'];
        $preco = $_POST['preco'];

        // Atualizar os dados do carro no banco de dados
        $stmt = $pdo->prepare('UPDATE carro SET tipo = :tipo, disponibilidade = :disponibilidade, ano = :ano, modelo = :modelo, preco = :preco WHERE placa = :placa');
        $stmt->bindValue(':tipo', $tipo, PDO::PARAM_STR);
        $stmt->bindValue(':disponibilidade', $disponibilidade, PDO::PARAM_STR);
        $stmt->bindValue(':ano', $ano, PDO::PARAM_INT);
        $stmt->bindValue(':modelo', $modelo, PDO::PARAM_STR);
        $stmt->bindValue(':preco', $preco, PDO::PARAM_STR);
        $stmt->bindValue(':placa', $car_placa, PDO::PARAM_STR);
        if ($stmt->execute()) {
            echo '<p>Carro atualizado com sucesso!</p>';
            // Redirecionar para listar carros após 2 segundos
            echo '<meta http-equiv="refresh" content="2;url=listar_carros.php">';
            exit;
        } else {
            echo '<p>Ocorreu um erro ao atualizar o carro.</p>';
        }
    }
} else {
    exit('Placa do carro não fornecida.');
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Carro</title>
    <link rel="stylesheet" href="stylecadcar.css">
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
                    <a href="cad_carros.php" class="letras">
                        <li>Cadastrar Carro</li>
                    </a>
                    <a href="" class="letras">
                        <li>Sobre Nós</li>
                    </a>
                </ul>
            </nav>
        </div>
    </header>

    <div class="container">
        <h2>Editar Carro</h2>
        <form action="" method="POST">
            <div class="form-group">
                <label for="tipo">Tipo</label>
                <input type="text" id="tipo" name="tipo" value="<?=htmlspecialchars($carro['tipo'], ENT_QUOTES)?>" required>
            </div>
            <div class="form-group">
                <label for="disponibilidade">Disponibilidade</label>
                <select id="disponibilidade" name="disponibilidade" required>
                    <option value="Disponível" <?=($carro['disponibilidade'] == 'Disponível') ? 'selected' : ''?>>Disponível</option>
                    <option value="Alugado" <?=($carro['disponibilidade'] == 'Alugado') ? 'selected' : ''?>>Alugado</option>
                </select>
            </div>

            <div class="form-group">
                <label for="ano">Ano</label>
                <input type="number" id="ano" name="ano" value="<?=htmlspecialchars($carro['ano'], ENT_QUOTES)?>" required>
            </div>
            <div class="form-group">
                <label for="modelo">Modelo</label>
                <input type="text" id="modelo" name="modelo" value="<?=htmlspecialchars($carro['modelo'], ENT_QUOTES)?>" required>
            </div>
            <div class="form-group">
                <label for="preco">Preço</label>
                <input type="text" id="preco" name="preco" value="<?=htmlspecialchars($carro['preco'], ENT_QUOTES)?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Salvar Alterações</button>
        </form>
    </div>

    <footer>
        <p>&copy; 2024 Locadora de Veículos</p>
    </footer>
</body>
</html>
