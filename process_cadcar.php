<?php
// Conectar ao banco de dados
$host = 'localhost';
$db = 'locadora'; // Nome do banco de dados alterado para "Carro"
$user = 'postgres'; // Substitua 'seu_usuario' pelo usuário do banco de dados
$pass = 'postgres'; // Substitua 'sua_senha' pela senha do banco de dados

$conn = pg_connect("host=$host dbname=$db user=$user password=$pass");

if (!$conn) {
    die("Falha na conexão: " . pg_last_error());
}

// Obtendo dados do formulário
$placa = $_POST['placa'];
$tipo = $_POST['tipo'];
$disponibilidade = $_POST['disponibilidade'];
$ano = $_POST['ano'];
$modelo = $_POST['modelo'];
$preco = $_POST['preco']; // Novo campo adicionado

// Inserindo dados na tabela Carro
$sql = "INSERT INTO Carro (Placa, Tipo, Disponibilidade, Ano, Modelo, Preco)
        VALUES ('$placa', '$tipo', '$disponibilidade', '$ano', '$modelo', '$preco')"; // Incluído o campo Preco

$result = pg_query($conn, $sql);

if ($result) {
    // Redireciona para a página listar_carros.php
    header("Location: listar_carros.php");
    exit();
} else {
    echo "Erro ao cadastrar carro: " . pg_last_error($conn);
}

pg_close($conn);
?>
