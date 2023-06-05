<?php
require_once 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_FILES['database'])) {
        $file = $_FILES['database'];

        // Verifica se ocorreu algum erro no upload
        if ($file['error'] === UPLOAD_ERR_OK) {
            // Lê o conteúdo do arquivo enviado
            $data = file_get_contents($file['tmp_name']);

            // Executa o conteúdo como uma consulta SQL
            $result = $conn->multi_query($data);

            if ($result === true) {
                header("Location: exibirDados.php");
                exit();
            } else {
                $error = "Erro ao executar a consulta SQL: " . $conn->error;
            }
        } else {
            $error = "Erro no upload do arquivo.";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Upload de Banco de Dados</title>
</head>
<body>
    <?php if (isset($error)): ?>
        <p><?php echo $error; ?></p>
    <?php endif; ?>

    <form method="POST" enctype="multipart/form-data">
        <input type="file" name="database">
        <input type="submit" value="Enviar">
    </form>
</body>
</html>
