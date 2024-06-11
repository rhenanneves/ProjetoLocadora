<?php
include 'config.php';

try {
    // Conectar ao banco de dados PostgreSQL
    $pdo = pdo_connect_pgsql();
    
    // Obter a página via solicitação GET (parâmetro URL: page), se não existir, defina a página como 1 por padrão
    $page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;
    
    // Número de registros para mostrar em cada página
    $records_per_page = 5;
    
    // Preparar a instrução SQL e obter registros da tabela carro, LIMIT irá determinar a página
    $stmt = $pdo->prepare('SELECT * FROM carro WHERE disponibilidade = :disponibilidade ORDER BY placa OFFSET :offset LIMIT :limit');
    $stmt->bindValue(':disponibilidade', 'Disponível', PDO::PARAM_STR);
    $stmt->bindValue(':offset', ($page - 1) * $records_per_page, PDO::PARAM_INT);
    $stmt->bindValue(':limit', $records_per_page, PDO::PARAM_INT);
    $stmt->execute();
    
    // Buscar os registros para exibi-los em nosso modelo.
    $contacts = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    // Verificação para ver se os registros estão sendo retornados
    if (empty($contacts)) {
        echo "<p>Nenhum carro disponível encontrado.</p>";
    }
    
    // Obter o número total de carros disponíveis, isso é para determinar se deve haver um botão de próxima e anterior
    $num_contacts = $pdo->query('SELECT COUNT(*) FROM carro WHERE disponibilidade = \'Disponível\'')->fetchColumn();
    
} catch (PDOException $e) {
    echo 'Erro: ' . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Locadora de Veículos</title>
    <link rel="stylesheet" href="Carros.css">
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
                    <a href="listar_carros.php" class="letras">
                        <li>Carros</li>
                    </a>
                    <a href="" class="letras">
                        <li>Sobre Nós</li>
                    </a>
                </ul>
            </nav>
        </div>
    </header>

    <div class="containercarro">
        <h1>Grupo de carros</h1>
        <p>Os melhores carros da cidade você só encontra aqui</p>
    </div>

    <div class="container">
        <div class="row">
            <?php if (!empty($contacts)): ?>
                <?php foreach ($contacts as $contact): ?>
                <div class="col-md-4">
                    <div class="card shadow-sm">
                        <img src="img/reserva.jpg" alt="">
                        <div class="card-body">
                            <h1><?=htmlspecialchars($contact['modelo'], ENT_QUOTES)?></h1>
                            <ul>
                                <li><?=htmlspecialchars($contact['tipo'], ENT_QUOTES)?></li>
                                <li>Disponibilidade: <?=htmlspecialchars($contact['disponibilidade'], ENT_QUOTES)?></li>
                                <li>Ano: <?=htmlspecialchars($contact['ano'], ENT_QUOTES)?></li>
                                <li>Placa: <?=htmlspecialchars($contact['placa'], ENT_QUOTES)?></li>
                                <li>Preço: R$ <?=htmlspecialchars($contact['preco'], ENT_QUOTES)?></li>
                            </ul>
                            <div class="button">
                                <button class="botao"><a href="reserva.php?placa=<?=htmlspecialchars($contact['placa'], ENT_QUOTES)?>&preco=<?=htmlspecialchars($contact['preco'], ENT_QUOTES)?>" style="text-decoration:none; color:white;">Alugar</a></button>
                                <button class="botao"><a href="editar_carro.php?placa=<?=htmlspecialchars($contact['placa'], ENT_QUOTES)?>" style="text-decoration:none; color:white;">Editar</a></button>
                                <button class="botao"><a href="excluir_carro.php?placa=<?=htmlspecialchars($contact['placa'], ENT_QUOTES)?>" style="text-decoration:none; color:white;">Excluir</a></button>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>Nenhum carro disponível encontrado.</p>
            <?php endif; ?>
        </div>

        <div class="pagination">
            <?php if ($page > 1): ?>
            <a href="listar_carros.php?page=<?=$page-1?>"><i class="fas fa-angle-double-left fa-sm"></i></a>
            <?php endif; ?>
            <?php if ($page * $records_per_page < $num_contacts): ?>
            <a href="listar_carros.php?page=<?=$page+1?>"><i class="fas fa-angle-double-right fa-sm"></i></a>
            <?php endif; ?>
        </div>
    </div>

    <footer>
        <p>&copy; 2024 Locadora de Veículos</p>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>


