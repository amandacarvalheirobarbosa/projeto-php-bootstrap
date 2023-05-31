<?php
$dsn = 'mysql:host=nome_do_host;dbname=academico';
$usuario = 'seu_usuario';
$senha = 'sua_senha';

try {
    $conexao = new PDO($dsn, $usuario, $senha);
    
    $consulta = $conexao->query('SELECT * FROM professores');
    $professores = $consulta->fetchAll(PDO::FETCH_ASSOC);
    
    echo "<h1>Lista de Professores</h1>";
    echo "<table>";
    echo "<tr><th>Nome</th><th>Disciplina</th></tr>";
    
    foreach ($professores as $professor) {
        echo "<tr><td>{$professor['nome']}</td><td>{$professor['disciplina']}</td></tr>";
    }
    
    echo "</table>";
} catch (PDOException $e) {
    die('Erro ao conectar ao banco de dados: ' . $e->getMessage());
}
?>
