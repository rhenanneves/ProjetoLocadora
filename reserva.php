<?php
include 'config.php';

// Obter a placa do carro e o preço a partir do parâmetro na URL
$placa_carro = isset($_GET['placa']) ? htmlspecialchars($_GET['placa'], ENT_QUOTES) : '';
$preco_carro = isset($_GET['preco']) ? htmlspecialchars($_GET['preco'], ENT_QUOTES) : '';

// Verificar se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $cpf_cliente = $_POST['cpf'];
    $placa_carro = $_POST['placa'];
    $data_locacao = $_POST['data_locacao'];
    $data_devolucao = $_POST['data_devolucao'];
    $valor_total = $_POST['valor_total'];

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
        // Verificar se o carro está disponível para locação
        $stmt_carro = $pdo->prepare('SELECT * FROM carro WHERE placa = :placa AND disponibilidade = :disponibilidade');
        $stmt_carro->bindValue(':placa', $placa_carro, PDO::PARAM_STR);
        $stmt_carro->bindValue(':disponibilidade', 'Disponível', PDO::PARAM_STR);
        $stmt_carro->execute();
        $carro = $stmt_carro->fetch(PDO::FETCH_ASSOC);

        if (!$carro) {
            echo '<p>O carro com a placa fornecida não está disponível para locação.</p>';
        } else {
            // Atualizar a disponibilidade do carro
            $stmt_update_carro = $pdo->prepare('UPDATE carro SET disponibilidade = :disponibilidade WHERE placa = :placa');
            $stmt_update_carro->bindValue(':disponibilidade', 'Reservado', PDO::PARAM_STR);
            $stmt_update_carro->bindValue(':placa', $placa_carro, PDO::PARAM_STR);
            if ($stmt_update_carro->execute()) {
                // Inserir a locação no banco de dados
                $stmt_locacao = $pdo->prepare('INSERT INTO locacao (cpf, placa, data_locacao, data_devolucao, valor_total) VALUES (:cpf_cliente, :placa_carro, :data_locacao, :data_devolucao, :valor_total)');
                $stmt_locacao->bindValue(':cpf_cliente', $cpf_cliente, PDO::PARAM_STR);
                $stmt_locacao->bindValue(':placa_carro', $placa_carro, PDO::PARAM_STR);
                $stmt_locacao->bindValue(':data_locacao', $data_locacao, PDO::PARAM_STR);
                $stmt_locacao->bindValue(':data_devolucao', $data_devolucao, PDO::PARAM_STR);
                $stmt_locacao->bindValue(':valor_total', $valor_total, PDO::PARAM_STR);

                if ($stmt_locacao->execute()) {
                    echo '<p>Locação realizada com sucesso!</p>';
                } else {
                    $errorInfo = $stmt_locacao->errorInfo();
                    echo '<p>Ocorreu um erro ao realizar a locação. Erro: ' . htmlspecialchars($errorInfo[2]) . '</p>';
                }
            } else {
                echo '<p>Erro ao atualizar a disponibilidade do carro.</p>';
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
                    <a href="listar_carros.php" class="letras">
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
        <form action="processa_reserva.php" method="POST" onsubmit="return enviarReserva()">
            <div class="form-group">
                <label for="placa">Placa do Carro:</label>
                <input type="text" id="placa" name="placa" value="<?= $placa_carro ?>" readonly required>
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
            <div class="form-group">
                <label for="preco">Preço Diário:</label>
                <input type="number" step="0.01" id="preco" name="preco" value="<?= $preco_carro ?>" readonly required>
            </div>
            <div class="form-group">
                <label for="valor_total">Valor Total:</label>
                <input type="text" id="valor_total" name="valor_total" readonly>
            </div>
            <button type="submit" class="btn btn-primary">Reservar</button>
        </form>
        <span id="msgReserva"></span> <!-- Aqui será exibida a mensagem -->
    </div>
    <footer>
        &copy; 2024 Locadora de Veículos
    </footer>

    <!-- Adicionando o JavaScript -->
    <script>
        document.getElementById('data_devolucao').addEventListener('change', function() {
            const dataLocacao = new Date(document.getElementById('data_locacao').value);
            const dataDevolucao = new Date(document.getElementById('data_devolucao').value);
            const precoDiario = parseFloat(document.getElementById('preco').value);

            const diffTime = Math.abs(dataDevolucao - dataLocacao);
            const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));

            const valorTotal = diffDays * precoDiario;
            document.getElementById('valor_total').value = valorTotal.toFixed(2);
        });

       
    </script>
</body>
</html>
