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
    Placa VARCHAR(255) PRIMARY KEY,
    Tipo VARCHAR(255) NOT NULL,
    Disponibilidade VARCHAR(255) NOT NULL,
    Ano INT NOT NULL,
    Modelo VARCHAR(50) NOT NULL
);

ALTER TABLE Carro ADD COLUMN Preco NUMERIC(10,2);

SELECT * FROM Carro

CREATE TABLE Cliente (
	CPF VARCHAR(14) PRIMARY KEY,
    Sobrenome VARCHAR(255) NOT NULL,
    Nome VARCHAR(100) NOT NULL,
    Cidade VARCHAR(255) NOT NULL,
    Estado VARCHAR(255) NOT NULL,
    Endereco VARCHAR(255) NOT NULL,
    Email VARCHAR(255) NOT NULL,
    telefone VARCHAR(15) NOT NULL

);
ALTER TABLE Cliente ADD COLUMN Senha VARCHAR(255) NOT NULL;

Select * from cliente


CREATE TABLE Locacao (
Id_Locacao INT NOT NULL PRIMARY KEY,
Data_Devolucao DATE NOT NULL,
Data_Locacao DATE NOT NULL,
Valor_Total DECIMAL(7,2)  NOT NULL,
placa varchar(6) NOT NULL ,
cpf Varchar(14) NOT NULL,
FOREIGN KEY(Placa) REFERENCES Carro (placa),
FOREIGN KEY(cpf) REFERENCES Cliente (cpf)
)

Drop table locacao

CREATE TABLE Locacao (
    Id_Locacao SERIAL PRIMARY KEY,
    Data_Devolucao DATE NOT NULL,
    Data_Locacao DATE NOT NULL,
    Valor_Total DECIMAL(7,2) NOT NULL,
    placa VARCHAR(6) NOT NULL,
    cpf VARCHAR(14) NOT NULL,
    FOREIGN KEY(Placa) REFERENCES Carro(placa),
    FOREIGN KEY(cpf) REFERENCES Cliente(cpf)
);

