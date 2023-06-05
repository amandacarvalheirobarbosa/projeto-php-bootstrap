<?php

if (isset($_POST['email']) && isset($_POST['senha'])) {
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    //Consulta banco de dados


    $validaEmail = 'email';
    $validaSenha = 'senha';

    if ($email === $validaEmail && $senha === $validaSenha) {
        header('Location: upload.html');
        exit();
    } else {
        echo 'Usuário ou senha inválidos!';
    }
}
?>