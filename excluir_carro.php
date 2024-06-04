<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Excluir Carro</title>
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
        <h2>Excluir Carro</h2>
        <?php
        include 'config.php';

        // Verificar se a placa do carro foi fornecida na URL
        if (isset($_GET['placa'])) {
            $placa_carro = $_GET['placa'];

            // Conectar ao banco de dados
            $pdo = pdo_connect_pgsql();

            // Consulta para excluir o carro com a placa fornecida
            $stmt = $pdo->prepare('DELETE FROM carro WHERE placa = :placa');
            $stmt->bindValue(':placa', $placa_carro, PDO::PARAM_STR);

            if ($stmt->execute()) {
                // Exibição da mensagem de sucesso
                echo '<p>Carro excluído com sucesso!</p>';

                // Redirecionamento para listar_carros.php após 2 segundos
                echo '<meta http-equiv="refresh" content="2;url=listar_carros.php">';
                exit;
            } else {
                echo '<p>Ocorreu um erro ao excluir o carro.</p>';
            }
        } else {
            exit('Placa do carro não fornecida.');
        }
        ?>
        <p>Esta página não tem conteúdo visível porque a exclusão foi realizada com sucesso ou ocorreu um erro durante a operação.</p>
    </div>

    <footer>
        <p>&copy; 2024 Locadora de Veículos</p>
    </footer>
</body>
</html>
