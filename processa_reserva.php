<?php
include 'config.php';

// Verificar se o formulário foi submetido
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obter e validar os dados do formulário
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
        // Cliente não encontrado, redirecionar de volta com mensagem de erro
        header("Location: reserva.php?error=cliente_nao_encontrado");
        exit();
    }

    // Verificar se o carro está disponível para locação
    $stmt_carro = $pdo->prepare('SELECT * FROM carro WHERE placa = :placa AND disponibilidade = :disponibilidade');
    $stmt_carro->bindValue(':placa', $placa_carro, PDO::PARAM_STR);
    $stmt_carro->bindValue(':disponibilidade', 'Disponível', PDO::PARAM_STR);
    $stmt_carro->execute();
    $carro = $stmt_carro->fetch(PDO::FETCH_ASSOC);

    if (!$carro) {
        // Carro não disponível, redirecionar de volta com mensagem de erro
        header("Location: reserva.php?error=carro_nao_disponivel");
        exit();
    }

    // Atualizar a disponibilidade do carro
    $stmt_update_carro = $pdo->prepare('UPDATE carro SET disponibilidade = :disponibilidade WHERE placa = :placa');
    $stmt_update_carro->bindValue(':disponibilidade', 'Reservado', PDO::PARAM_STR);
    $stmt_update_carro->bindValue(':placa', $placa_carro, PDO::PARAM_STR);
    $stmt_update_carro->execute();

    // Inserir a locação no banco de dados
    $stmt_locacao = $pdo->prepare('INSERT INTO locacao (cpf, placa, data_locacao, data_devolucao, valor_total) VALUES (:cpf_cliente, :placa_carro, :data_locacao, :data_devolucao, :valor_total)');
    $stmt_locacao->bindValue(':cpf_cliente', $cpf_cliente, PDO::PARAM_STR);
    $stmt_locacao->bindValue(':placa_carro', $placa_carro, PDO::PARAM_STR);
    $stmt_locacao->bindValue(':data_locacao', $data_locacao, PDO::PARAM_STR);
    $stmt_locacao->bindValue(':data_devolucao', $data_devolucao, PDO::PARAM_STR);
    $stmt_locacao->bindValue(':valor_total', $valor_total, PDO::PARAM_STR);
    $stmt_locacao->execute();

    // Redirecionar para a página de listagem de carros
    header("Location: listar_carros.php");
    exit();
} else {
    // Se o formulário não foi submetido corretamente, redirecionar de volta
    header("Location: reserva.php?error=formulario_nao_submetido");
    exit();
}
?>
