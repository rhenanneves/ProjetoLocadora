<?php
function pdo_connect_pgsql() {
    $host = 'localhost'; // Nome do servidor
    $port = '5432'; // Porta do servidor
    $dbname = 'locadora'; // Nome do banco de dados
    $username = 'postgres'; // Nome de usuário do banco de dados
    $password = 'postgres'; // Senha do banco de dados

    try {
        $pdo = new PDO("pgsql:host=$host;port=$port;dbname=$dbname", $username, $password);
        // Configurar o PDO para lançar exceções em caso de erro
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    } catch (PDOException $e) {
        // Se a conexão falhar, exibir mensagem de erro
        die("Conexão falhou: " . $e->getMessage());
    }
}
?>
