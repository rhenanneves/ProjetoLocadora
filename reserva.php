<?php
include 'config.php';

// Verificar se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $cpf_cliente = $_POST['cpf'];
    $placa_carro = $_POST['placa'];
    $data_reserva = $_POST['data_reserva'];

    // Conectar ao banco de dados
    $pdo = pdo_connect_pgsql();

    // Verificar se o cliente está cadastrado
    $stmt_cliente = $pdo->prepare('SELECT * FROM cliente WHERE cpf = :cpf');
    $stmt_cliente->bindValue(':cpf', $cpf_cliente, PDO::PARAM_STR);
    $stmt_cliente->execute();
    $cliente = $stmt_cliente->fetch(PDO::FETCH_ASSOC);

    if (!$cliente) {
        echo '<p>Cliente não encontrado. Por favor, verifique o CPF e tente novamente.</p>';
    } else {
        // Verificar se o carro está disponível para reserva
        $stmt_carro = $pdo->prepare('SELECT * FROM carro WHERE placa = :placa AND disponibilidade = :disponibilidade');
        $stmt_carro->bindValue(':placa', $placa_carro, PDO::PARAM_STR);
        $stmt_carro->bindValue(':disponibilidade', 'Disponível', PDO::PARAM_STR);
        $stmt_carro->execute();
        $carro = $stmt_carro->fetch(PDO::FETCH_ASSOC);

        if (!$carro) {
            echo '<p>O carro com a placa fornecida não está disponível para reserva.</p>';
        } else {
            // Inserir a reserva no banco de dados
            $stmt_reserva = $pdo->prepare('INSERT INTO reserva (cpf_cliente, placa_carro, data_reserva) VALUES (:cpf_cliente, :placa_carro, :data_reserva)');
            $stmt_reserva->bindValue(':cpf_cliente', $cpf_cliente, PDO::PARAM_STR);
            $stmt_reserva->bindValue(':placa_carro', $placa_carro, PDO::PARAM_STR);
            $stmt_reserva->bindValue(':data_reserva', $data_reserva, PDO::PARAM_STR);
            
            if ($stmt_reserva->execute()) {
                echo '<p>Reserva realizada com sucesso!</p>';
            } else {
                echo '<p>Ocorreu um erro ao realizar a reserva. Por favor, tente novamente.</p>';
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reserva de Carro</title>
    <link rel="stylesheet" href="reserva.css">
</head>

<body>
    <header>
        <div class="navbar">
            <img src="img/Vrum.png" alt="Logo">
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
                    <a href="SobreNos.php" class="letras">
                        <li>Sobre Nós</li>
                    </a>
                </ul>
            </nav>
        </div>
    </header>

    <div class="container">
        <h2>Reserva de Carro</h2>
        <form action="processa_reserva.php" method="POST">
            <div class="form-group">
                <label for="placa">Placa do Carro:</label>
                <input type="text" id="placa" name="placa" required>
            </div>
            <div class="form-group">
                <label for="cpf">CPF do Cliente:</label>
                <input type="text" id="cpf" name="cpf" required>
            </div>
            <div class="form-group">
                <label for="data_locacao">Data de Locação:</label>
                <input type="date" id="data_locacao" name="data_locacao" required>
            </div>
            <div class="form-group">
                <label for="data_devolucao">Data de Devolução:</label>
                <input type="date" id="data_devolucao" name="data_devolucao" required>
            </div>
            <button type="submit" class="btn btn-primary">Reservar</button>
        </form>
    </div>
    <footer>
        &copy; 2024 Locadora de Veículos
    </footer>
</body>

</html>
