<?php
// Ativa exibição de erros
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Configurações do banco
$dbHost = 'localhost';
$dbName = 'tvaonl10_wp557';
$dbUser = 'tvaonl10_wp557';
$dbPass = 'Bond27071989@'; // Substitua pela senha real do banco

// Criar arquivo de log personalizado
$logFile = __DIR__ . '/debug.log';
file_put_contents($logFile, date('[Y-m-d H:i:s] ') . "Iniciando teste\n", FILE_APPEND);

try {
    // Tenta conectar com o banco
    $conn = new PDO(
        "mysql:host={$dbHost};dbname={$dbName};charset=utf8",
        $dbUser,
        $dbPass,
        array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)
    );
    
    // Força UTF-8
    $conn->exec("SET NAMES utf8");
    
    // Testa a conexão
    $sql = "SELECT COUNT(*) FROM comentarios";
    $count = $conn->query($sql)->fetchColumn();
    
    // Log de sucesso
    file_put_contents($logFile, date('[Y-m-d H:i:s] ') . "Conexão OK - {$count} comentários\n", FILE_APPEND);
    
    echo "<pre>";
    echo "✅ Conexão: OK\n";
    echo "✅ Total de comentários: " . $count . "\n";
    echo "</pre>";
    
} catch(Exception $e) {
    // Log de erro
    file_put_contents($logFile, date('[Y-m-d H:i:s] ') . "ERRO: " . $e->getMessage() . "\n", FILE_APPEND);
    
    echo "<pre>";
    echo "❌ ERRO: " . $e->getMessage() . "\n";
    echo "</pre>";
}
?>