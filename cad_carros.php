<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Carros</title>
    <link rel="stylesheet" href="stylecadcar.css">
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

                    <a href="listar_carros.php" class="letras">
                        <li>Listar Carros</li>
                    </a>

                    <a href="" class="letras">
                        <li>Sobre Nós</li>
                    </a>
                </ul>
            </nav>
        </div>
    </header>

    <div class="container">
        <h2>Cadastro de Carros</h2>
        <form action="process_cadcar.php" method="POST">
            <div class="form-group">
                <label for="placa">Placa</label>
                <input type="text" id="placa" name="placa" required>
            </div>
            <div class="form-group">
                <label for="tipo">Tipo</label>
                <input type="text" id="tipo" name="tipo" required>
            </div>
            <div class="form-group">
                <label for="disponibilidade">Disponibilidade</label>
                <select id="disponibilidade" name="disponibilidade" required>
                    <option value="Disponível">Disponível</option>
                    <option value="Alugado">Alugado</option>
                </select>
            </div>

            <div class="form-group">
                <label for="ano">Ano</label>
                <input type="number" id="ano" name="ano" required>
            </div>
            <div class="form-group">
                <label for="modelo">Modelo</label>
                <input type="text" id="modelo" name="modelo" required>
            </div>
            <div class="form-group">
                <label for="preco">Preço</label>
                <input type="text" id="preco" name="preco" required>
            </div>
            <button type="submit" class="btn btn-primary">Cadastrar Carro</button>
        </form>
    </div>

    <footer>
        <p>&copy; 2024 Locadora de Veículos</p>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>