CREATE TABLE Funcionarios (
    Id_Funcionario SERIAL PRIMARY KEY,
    Nome VARCHAR(255) NOT NULL,
    Sobrenome VARCHAR(255) NOT NULL,
    Data_Contratacao DATE NOT NULL,
    Cargo VARCHAR(255) NOT NULL,
    Salario DECIMAL(7,2) NOT NULL,
    NumeroAgencia INT NOT NULL
);
SELECT * FROM Funcionarios

INSERT INTO Funcionarios (Data_Contratacao, Sobrenome, Salario, Cargo, Nome, Id_Funcionario, NumeroAgencia)
VALUES 
('2023-01-15', 'Silva', 5000.00, 'Gerente de Vendas', 'João', 11, 101),
('2022-11-20', 'Oliveira', 3500.50, 'Assistente Administrativo', 'Maria', 2, 102),
('2023-05-10', 'Santos', 2800.80, 'Analista de Marketing', 'Pedro', 3, 103),
('2023-03-08', 'Souza', 4200.30, 'Desenvolvedor de Software', 'Ana', 4, 104),
('2023-09-17', 'Costa', 3200.30, 'Analista Financeiro', 'Lucas', 5, 105),
('2022-12-05', 'Ferreira', 4500.00, 'Engenheiro de Produção', 'Juliana', 6, 106),
('2023-07-30', 'Araujo', 3700.20, 'Designer Gráfico', 'Luiza', 7, 107),
('2023-04-25', 'Barbosa', 3000.50, 'Analista de Recursos Humanos', 'Gustavo', 8, 108),
('2023-08-12', 'Ribeiro', 3400.80, 'Analista de Qualidade', 'Camila', 9, 109),
('2023-06-18', 'Martins', 2900.60, 'Técnico de Suporte', 'Fernando', 10, 110);

DROP TABLE FUNCIONARIOS;

CREATE TABLE Funcionarios (
    CPF VARCHAR(14) PRIMARY KEY,
    Nome VARCHAR(255) NOT NULL,
    Sobrenome VARCHAR(255) NOT NULL,
    Data_Contratacao DATE NOT NULL,
    Cargo VARCHAR(255) NOT NULL,
    Salario DECIMAL(7,2) NOT NULL,
    NumeroAgencia INT NOT NULL,
    Senha VARCHAR(255) NOT NULL
);

CREATE TABLE Carro (
Placa VARCHAR(255) NOT NULL,
Tipo VARCHAR(255) NOT NULL,
Disponibilidade VARCHAR(255) NOT NULL,
Ano INT NOT NULL,
Modelo VARCHAR(50) NOT NULL,
Id_Carro INT NOT NULL  PRIMARY KEY
)

DROP TABLE carro

CREATE TABLE Carro (
    Placa VARCHAR(255) PRIMARY KEY,
    Tipo VARCHAR(255) NOT NULL,
    Disponibilidade VARCHAR(255) NOT NULL,
    Ano INT NOT NULL,
    Modelo VARCHAR(50) NOT NULL
);

ALTER TABLE Carro ADD COLUMN Preco NUMERIC(10,2);

SELECT * FROM Carro