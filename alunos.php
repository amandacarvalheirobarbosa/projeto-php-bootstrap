<?php
$dsn = 'mysql:host=nome_do_host;dbname=academico';
$usuario = 'seu_usuario';
$senha = 'sua_senha';

try {
    $conexao = new PDO($dsn, $usuario, $senha);
    
    $consulta = $conexao->query('SELECT * FROM alunos');
    $alunos = $consulta->fetchAll(PDO::FETCH_ASSOC);
    
    echo "<h1>Lista de Alunos</h1>";
    echo "<table>";
    echo "<tr><th>Nome</th><th>Matrícula</th></tr>";
    
    foreach ($alunos as $aluno) {
        echo "<tr><td>{$aluno['nome']}</td><td>{$aluno['matricula']}</td></tr>";
    }
    
    echo "</table>";
} catch (PDOException $e) {
    die('Erro ao conectar ao banco de dados: ' . $e->getMessage());
}
?>
