

<?php
try {
    $conn = new PDO(
        "mysql:host=localhost;dbname=tvaonl10_wp557;charset=utf8",
        "tvaonl10_wp557",
        "Bond27071989@",
        array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)
    );
    
    // Forçar UTF-8 após a conexão
    $conn->exec("SET NAMES utf8");
    
} catch(PDOException $e) {
    error_log("Erro na conexão: " . $e->getMessage());
    die("Erro na conexão com o banco de dados");
}
?>



