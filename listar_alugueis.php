<?php
include 'config.php';

// Conectar ao banco de dados
$pdo = pdo_connect_pgsql();

$cpf = isset($_GET['cpf']) ? $_GET['cpf'] : '';
$data_inicio = isset($_GET['data_inicio']) ? $_GET['data_inicio'] : '';
$data_fim = isset($_GET['data_fim']) ? $_GET['data_fim'] : '';
$placa = isset($_GET['placa']) ? $_GET['placa'] : '';

try {
    // Preparar a consulta para buscar aluguéis por CPF, datas e placa do carro
    $sql = 'SELECT locacao.*, cliente.nome AS NomeCliente, cliente.sobrenome AS SobrenomeCliente, carro.modelo 
    FROM locacao
    INNER JOIN cliente ON locacao.cpf = cliente.cpf
    INNER JOIN carro ON locacao.placa = carro.placa';

    // Restante do código...

    $params = [];

    if ($cpf) {
        $sql .= ' AND locacao.cpf = :cpf';
        $params[':cpf'] = $cpf;
    }

    if ($data_inicio && $data_fim) {
        $sql .= ' AND locacao.data_Locacao BETWEEN :data_inicio AND :data_fim';
        $params[':data_inicio'] = $data_inicio;
        $params[':data_fim'] = $data_fim;
    }

    if ($placa) {
        $sql .= ' AND carro.placa = :placa';
        $params[':placa'] = $placa;
    }


    $stmt = $pdo->prepare($sql);
    $stmt->execute($params);
    $alugueis = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo 'Erro: ' . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listagem de Aluguéis</title>
    <link rel="stylesheet" href="listar_alugueis.css">
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
        <h2>Listagem de Aluguéis</h2>
        <form action="listar_alugueis.php" method="GET">
            <div class="form-group">
                <label for="cpf">CPF do Cliente:</label>
                <input type="text" id="cpf" name="cpf" value="<?= htmlspecialchars($cpf, ENT_QUOTES) ?>">
            </div>
            <div class="form-group">
                <label for="data_inicio">Data Início:</label>
                <input type="date" id="data_inicio" name="data_inicio" value="<?= htmlspecialchars($data_inicio, ENT_QUOTES) ?>">
            </div>
            <div class="form-group">
                <label for="data_fim">Data Fim:</label>
                <input type="date" id="data_fim" name="data_fim" value="<?= htmlspecialchars($data_fim, ENT_QUOTES) ?>">
            </div>
            <div class="form-group">
                <label for="placa">Placa do Carro:</label>
                <input type="text" id="placa" name="placa" value="<?= htmlspecialchars($placa, ENT_QUOTES) ?>">
            </div>
            <button type="submit" class="btn btn-primary">Buscar</button>
        </form>

        <?php if (!empty($alugueis)) : ?>
            <table class="alugueis-table">
                <thead>
                    <tr>
                        <th>ID Locação</th>
                        <th>Nome do Cliente</th>
                        <th>Sobrenome do Cliente</th>
                        <th>Placa do Carro</th>
                        <th>Modelo do Carro</th>
                        <th>Data de Locação</th>
                        <th>Data de Devolução</th>
                        <th>Valor Total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($alugueis as $aluguel) : ?>
                        <tr>
                            <td><?= htmlspecialchars($aluguel['id_locacao'], ENT_QUOTES) ?></td>
                            <td><?= !empty($aluguel['NomeCliente']) ? htmlspecialchars($aluguel['NomeCliente'], ENT_QUOTES) : 'Nome não disponível' ?></td>
                            <td><?= !empty($aluguel['SobrenomeCliente']) ? htmlspecialchars($aluguel['SobrenomeCliente'], ENT_QUOTES) : 'Sobrenome não disponível' ?></td>
                            <td><?= !empty($aluguel['modelo']) ? htmlspecialchars($aluguel['modelo'], ENT_QUOTES) : 'Modelo não disponível' ?></td>
                            <td><?= htmlspecialchars($aluguel['placa'], ENT_QUOTES) ?></td>
                            <td><?= htmlspecialchars($aluguel['data_locacao'], ENT_QUOTES) ?></td>
                            <td><?= htmlspecialchars($aluguel['data_devolucao'], ENT_QUOTES) ?></td>
                            <td><?= htmlspecialchars($aluguel['valor_total'], ENT_QUOTES) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else : ?>
            <p>Nenhum aluguel encontrado.</p>
        <?php endif; ?>
    </div>

    <footer>
        &copy; 2024 Locadora de Veículos
    </footer>
</body>

</html>