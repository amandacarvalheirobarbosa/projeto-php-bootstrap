<?php
// Verifica se foi feito o upload do arquivo
if (isset($_FILES['arquivo']) && $_FILES['arquivo']['error'] === UPLOAD_ERR_OK) {
    $caminho = $_FILES['arquivo']['tmp_name'];
    
    // Conecta ao banco de dados
    $dsn = 'mysql:host=nome_do_host;dbname=academico';
    $usuario = 'seu_usuario';
    $senha = 'sua_senha';

    try {
        $conexao = new PDO($dsn, $usuario, $senha);
        
        // Abre o arquivo para leitura
        $arquivo = fopen($caminho, 'r');
        
        // Prepara as consultas SQL
        $consultaAlunos = $conexao->prepare('INSERT INTO alunos (nome, matricula) VALUES (:nome, :matricula)');
        $consultaProfessores = $conexao->prepare('INSERT INTO professores (nome, disciplina) VALUES (:nome, :disciplina)');
        
        $totalAlunos = 0;
        $totalProfessores = 0;
        
        // Lê o arquivo linha por linha
        while (($linha = fgets($arquivo)) !== false) {
            $dados = explode(';', $linha);
            
            // Verifica o tipo de registro (aluno ou professor)
            if ($dados[0] === '001') {
                $consultaAlunos->execute(array(
                    ':nome' => $dados[2],
                    ':matricula' => $dados[1]
                ));
                
                $totalAlunos++;
            } elseif ($dados[0] === '002') {
                $consultaProfessores->execute(array(
                    ':nome' => $dados[2],
                    ':disciplina' => $dados[1]
                ));
                
                $totalProfessores++;
            }
        }
        
        // Fecha o arquivo
        fclose($arquivo);
        
        // Exibe os resultados
        echo "Total de alunos inseridos: $totalAlunos<br>";
        echo "Total de professores inseridos: $totalProfessores<br>";
        echo '<a href="alunos.php">Lista de Alunos</a><br>';
        echo '<a href="professores.php">Lista de Professores</a>';
    } catch (PDOException $e) {
        die('Erro ao conectar ao banco de dados: ' . $e->getMessage());
    }
} else {
    // Caso nenhum arquivo tenha sido enviado
    echo "Nenhum arquivo foi enviado.";
}
?>

