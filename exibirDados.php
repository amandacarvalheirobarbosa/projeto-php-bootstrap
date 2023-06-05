<?php
require_once 'config.php';

try{
    $sql = "SELECT * FROM nome_da_tabela";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $table = "<table><tr><th>ID</th><th>Nome</th><th>Email</th></tr>";
        while ($row = $result->fetch_assoc()) {
            $table .= "<tr><td>".$row["id"]."</td><td>".$row["nome"]."</td><td>".$row["email"]."</td></tr>";
        }
        $table .= "</table>";
    } else {
        $table = "Nenhum dado encontrado.";
    }
}catch(Exception $e){
    header("Refresh: 1; url=".$_SERVER['PHP_SELF']);
    exit;
}
?>

<!DOCTYPE html>

<html>
<head>
    <title>Exibição de Dados</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }

        th, td {
            border: 1px solid black;
            padding: 8px;
        }
    </style>
</head>
<body>
    <h1>Dados do Banco de Dados</h1>
    <?php echo $table; ?>
</body>
</html>
