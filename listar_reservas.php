<?php
include 'config.php'; // Arquivo de configuração com a conexão ao banco de dados

// Consulta SQL para selecionar todas as reservas
$sql = "SELECT * FROM Locacao";

// Executar a consulta
$result = mysqli_query($conn, $sql);

// Verificar se há resultados
if (mysqli_num_rows($result) > 0) {
    // Início da tabela HTML para exibir as reservas
    echo "<!DOCTYPE html>
            <html lang='pt-BR'>
            <head>
                <meta charset='UTF-8'>
                <meta name='viewport' content='width=device-width, initial-scale=1.0'>
                <title>Listar Reservas</title>
                <link rel='stylesheet' href='style.css'> <!-- Adicione seu arquivo de estilo CSS aqui -->
            </head>
            <body>
                <header>
                    <!-- Seu cabeçalho -->
                </header>
                <div class='container'>
                    <h2>Listagem de Reservas</h2>
                    <table>
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Data de Locação</th>
                                <th>Data de Devolução</th>
                                <th>Valor Total</th>
                                <th>Placa do Carro</th>
                                <th>CPF do Cliente</th>
                            </tr>
                        </thead>
                        <tbody>";

    // Loop através dos resultados para exibir cada reserva na tabela
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>
                <td>{$row['Id_Locacao']}</td>
                <td>{$row['Data_Locacao']}</td>
                <td>{$row['Data_Devolucao']}</td>
                <td>{$row['Valor_Total']}</td>
                <td>{$row['placa']}</td>
                <td>{$row['cpf']}</td>
              </tr>";
    }

    // Fechamento da tabela e da estrutura HTML
    echo "</tbody>
          </table>
          </div>
          <footer>
              <!-- Seu rodapé -->
          </footer>
          </body>
          </html>";

    // Liberar o resultado da consulta
    mysqli_free_result($result);
} else {
    echo "Não há reservas registradas.";
}

// Fechar a conexão com o banco de dados
mysqli_close($conn);
?>
