<?php
# Conectar á DB
require __DIR__ . '/infra/db/connection.php';

# Criar Tabelas
$pdo->exec(
    'CREATE TABLE IF NOT EXISTS usuario (
        id INTEGER PRIMARY KEY AUTO_INCREMENT,  
        username VARCHAR(50) UNIQUE NOT NULL,
        nome VARCHAR(50) NOT NULL,  
        email VARCHAR(128) UNIQUE NOT NULL,  
        senha VARCHAR(64) NOT NULL,
        administrador bit DEFAULT 0
    );
    CREATE TABLE IF NOT EXISTS tarefa (
        idTarefa INTEGER AUTO_INCREMENT PRIMARY KEY,
        titulo VARCHAR(100) NOT NULL,
        descricao TEXT,
        prioridade VARCHAR(10),
        dataCriacao DATE,
        prazoConclusao DATE,
        estado VARCHAR(20),
        favorito BOOLEAN,
        tarefa TEXT,
        idUsuarioCreador INTEGER NOT NULL,
        FOREIGN KEY (idUsuarioCreador) REFERENCES usuario(id) ON DELETE CASCADE
    );
    CREATE TABLE IF NOT EXISTS anexo (
        idAnexos INTEGER AUTO_INCREMENT PRIMARY KEY,
        idTarefa INTEGER,
        tipoAnexo VARCHAR(20),
        nomeAnexo VARCHAR(100),
        caminhoAnexo VARCHAR(255),
        FOREIGN KEY (idTarefa) REFERENCES tarefa(idTarefa) ON DELETE CASCADE
    );
    CREATE TABLE IF NOT EXISTS UsuarioTarefaPartilhado (
        usuarioPartilhado INTEGER,
        idTarefa INTEGER,
        PRIMARY KEY (usuarioPartilhado, idTarefa),
        FOREIGN KEY (usuarioPartilhado) REFERENCES usuario(id) ON DELETE CASCADE,
        FOREIGN KEY (idTarefa) REFERENCES tarefa(idTarefa) ON DELETE CASCADE
    );'
);



# TEMP para adicionar user

# Adicionar user padrão
$user = [
    'nome' => 'Gabriel',
    'username' => 'NihhiuOnTheBeat',
    'email' => 'nihhiu@estg.ipvc.pt',
    'administrador' => 1,
    'senha' => '123456'
];

# Encriptar a password
$user['senha'] = password_hash($user['senha'], PASSWORD_DEFAULT);

# Verificar se o username já existe
$PDOStatement = $GLOBALS['pdo']->prepare('SELECT * FROM usuario WHERE username = ? LIMIT 1;');
$PDOStatement->bindValue(1, $user['username']);
$PDOStatement->execute();
$userExists = $PDOStatement->fetch();

if (!$userExists) {
    #INSERT USER
    $sqlCreate = "INSERT INTO 
        usuario (
            nome, 
            username,
            email,
            administrador,
            senha) 
        VALUES (
            :nome, 
            :username, 
            :email,
            :administrador, 
            :senha
        )";

    #PREPARE QUERY
    $PDOStatement = $GLOBALS['pdo']->prepare($sqlCreate);

    #EXECUTE
    $success = $PDOStatement->execute([
        ':nome' => $user['nome'],
        ':username' => $user['username'],
        ':email' => $user['email'],
        ':administrador' => $user['administrador'],
        ':senha' => $user['senha']
    ]);
} else {
    echo "O nome de usuário já existe no sistema.";
}