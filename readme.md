# Sistema de Gerenciamento de Funcionários

Este projeto é um sistema de gerenciamento de funcionários, desenvolvido em PHP, que permite criar, editar e excluir informações de funcionários, como nome, CPF, email, salário e data de cadastro. O sistema também calcula automaticamente a bonificação de acordo com os anos de serviço do funcionário.

## Funcionalidades

- **Login**: Login com o usuário pré definido: teste@gmail.com.br senha: 1234.
- **Cadastrar Empresa**: Adicionar novas empresas.
- **Cadastrar Funcionários**: Adicionar novos funcionários com as informações necessárias.
- **Editar Funcionários**: Atualizar as informações de um funcionário existente.
- **Excluir Funcionários**: Remover um funcionário do sistema.
- **Cálculo de Bonificação**: Calcular a bonificação de funcionários com base no tempo de serviço:
  - **Mais de 5 anos**: Bonificação de 20% do salário.
  - **Entre 1 e 5 anos**: Bonificação de 10% do salário.
  - **Menos de 1 ano**: Sem bonificação.

## Pré-requisitos

Antes de rodar o projeto, verifique se você possui os seguintes itens instalados:

- [PHP](https://www.php.net/) (Recomendado versão 7.4 ou superior)
- [MySQL](https://www.mysql.com/)
- Servidor Web (como [XAMPP](https://www.apachefriends.org/pt_br/index.html), [WAMP](http://www.wampserver.com/), ou um servidor web de sua preferência)
  
## Configuração do Banco de Dados

```sql
CREATE DATABASE desafio_php;
USE desafio_php;

CREATE TABLE tbl_usuario (
    id_usuario INT AUTO_INCREMENT PRIMARY KEY,
    login VARCHAR(50) NOT NULL,
    senha VARCHAR(32) NOT NULL
);

CREATE TABLE tbl_empresa (
    id_empresa INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(40) NOT NULL
);

CREATE TABLE tbl_funcionario (
    id_funcionario INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(50) NOT NULL,
    cpf VARCHAR(11) NOT NULL,
    rg VARCHAR(20),
    email VARCHAR(30) NOT NULL,
    id_empresa INT NOT NULL,
    data_cadastro DATE NOT NULL,
    salario DOUBLE(10,2) NOT NULL,
    bonificacao DOUBLE(10,2) DEFAULT 0,
    FOREIGN KEY (id_empresa) REFERENCES tbl_empresa(id_empresa)
);

INSERT INTO tbl_usuario (login, senha) VALUES ("teste@gmail.com.br", "1234");
```

## Dependências do Projeto
O projeto utiliza as seguintes dependências:

dompdf/dompdf (para geração de PDFs)

Estas dependências estão especificadas no arquivo composer.json

para instalar a depencia: 

```bash
composer install
