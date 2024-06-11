<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Locadora de Veículos</title>
    <link rel="stylesheet" href="styles.css">
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

    <div id="carouselExample" class="carousel slide">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="img/carro1.jpg" class="d-block" alt="Carro 1">
            </div>
            <div class="carousel-item">
                <img src="img/carro2.jpg" class="d-block" alt="Carro 2">
            </div>
            <div class="carousel-item">
                <img src="img/carro3.png" class="d-block" alt="Carro 3">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
    <div class="banner">
        <img src="img/banner.png" alt="">
    </div>

    <div class="container">
        <div class="card shadow-sm">
            <img src="img/card1.jpg" alt="">
            <div class="card-body">
                <h1>Hyundai Veloster</h1>
                <ul>
                    <li>Gasolina, Final da placa 5.</li>
                    <li>Airbag motorista, alarme, freios ABS, airbag passageiro.</li>
                    <li>Ar-condicionado, direção elétrica, travas elétricas, retrovisores elétricos, câmbio automático, ar-quente.</li>
                    <li>Kit Multimídia, entrada USB.</li>
                    <li>Bancos de couro.</li>
                </ul>
                <div class="button">
                    <button class="botao">Alugar</button>
                </div>
            </div>
        </div>

        <div class="card shadow-sm">
            <img src="img/card2.png" alt="">
            <div class="card-body">
                <h1>Honda Civic</h1>
                <ul>
                    <li>Flex, Final da placa 0</li>
                    <li>Alarme, freios ABS, airbag passageiro</li>
                    <li>Ar-condicionado, direção elétrica, travas elétricas, retrovisores elétricos, câmbio automático, ar-quente.</li>
                    <li>Vidros elétricos dianteiros</li>
                    <li>Bancos de couro.</li>
                </ul>
                <div class="button">
                    <button class="botao">Alugar</button>
                </div>
            </div>
        </div>

        <div class="card shadow-sm">
            <img src="img/card3.png" alt="">
            <div class="card-body">
                <h1>Ford Ka</h1>
                <ul>
                    <li>Flex, Final da placa 0</li>
                    <li>Distribuição eletrônica de frenagem, airbag motorista, freios ABS, airbag passageiro</li>
                    <li>Ar-condicionado, direção elétrica, travas elétricas, retrovisores elétricos, câmbio automático, ar-quente.</li>
                    <li>Vidros elétricos dianteiros, limp. traseiro, desemb. traseiro</li>
                    <li>Pneus Trocados</li>
                </ul>
                <div class="button">
                    <button class="botao">Alugar</button>
                </div>
            </div>
        </div>
    </div>

    <footer>
        <p>&copy; 2024 Locadora de Veículos</p>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>