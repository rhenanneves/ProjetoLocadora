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
$cpf = $_POST['cpf']; // Adicione esta linha
$senha = $_POST['senha']; // Adicione esta linha
$nome = $_POST['nome'];
$sobrenome = $_POST['sobrenome'];
$estado = $_POST['estado'];
$endereco = $_POST['endereco'];
$cidade = $_POST ['cidade'];
$email = $_POST['email'];
$telefone = $_POST['telefone'];

// Inserindo dados na tabela Funcionarios
$sql = "INSERT INTO Cliente (CPF, Senha, Nome, Sobrenome, Estado,Endereco, Cidade, Email, Telefone)
        VALUES ('$cpf', '$senha', '$nome', '$sobrenome', '$estado','$endereco','$cidade', '$email', '$telefone')";

$result = pg_query($conn, $sql);

if ($result) {
    // Redirecionando para a página de login após o cadastro
    header("Location: Login.php");
    exit();
} else {
    echo "Erro: " . pg_last_error($conn);
}

pg_close($conn);
