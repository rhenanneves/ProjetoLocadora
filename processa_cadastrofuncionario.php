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
$data_contratacao = $_POST['data_contratacao'];
$cargo = $_POST['cargo'];
$salario = $_POST['salario'];
$numero_agencia = $_POST['numero_agencia'];

// Inserindo dados na tabela Funcionarios
$sql = "INSERT INTO Funcionarios (CPF, Senha, Nome, Sobrenome, Data_Contratacao, Cargo, Salario, NumeroAgencia)
        VALUES ('$cpf', '$senha', '$nome', '$sobrenome', '$data_contratacao', '$cargo', '$salario', '$numero_agencia')";

$result = pg_query($conn, $sql);

if ($result) {
    // Redirecionando para a página de login após o cadastro
    header("Location: Login.php");
    exit();
} else {
    echo "Erro: " . pg_last_error($conn);
}

pg_close($conn);
?>
