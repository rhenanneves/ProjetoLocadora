<?php
// Conectar ao banco de dados
$host = 'localhost';
$db = 'locadora';
$user = 'postgres';
$pass = 'postgres';

$conn = pg_connect("host=$host dbname=$db user=$user password=$pass");

if (!$conn) {
    die("Falha na conexão: " . pg_last_error());
}

// Obtendo dados do formulário
$cpf = $_POST['cliente-cpf']; // Alterado de funcionario-username para funcionario-cpf
$senha = $_POST['cliente-senha']; // Alterado de funcionario-password para funcionario-senha

// Consulta no banco de dados para verificar o login do funcionário
$sql = "SELECT * FROM Cliente WHERE CPF = '$cpf' AND Senha = '$senha'";
$result = pg_query($conn, $sql);

if ($result) {
    $row = pg_fetch_assoc($result);
    if ($row) {
        // Login bem-sucedido, redireciona para a página do funcionário
        header("Location: indexcliente.php");
        exit();
    } else {
        // Usuário ou senha incorretos, redireciona de volta para o login
        header("Location: Login.php?error=1");
        exit();
    }
} else {
    echo "Erro: " . pg_last_error($conn);
}

pg_close($conn);
?>
