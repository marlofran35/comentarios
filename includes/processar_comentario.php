<?php
header('Content-Type: application/json');
header('X-Content-Type-Options: nosniff');
header('X-Frame-Options: DENY');

require_once __DIR__ . '/../config/conexao.php';

try {
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        throw new Exception('Método inválido');
    }

    $nome = trim(htmlspecialchars($_POST['nome'] ?? '', ENT_QUOTES, 'UTF-8'));
    $comentario = trim(htmlspecialchars($_POST['comentario'] ?? '', ENT_QUOTES, 'UTF-8'));
    
    if (empty($nome) || empty($comentario)) {
        throw new Exception('Preencha todos os campos');
    }

    $sql = "INSERT INTO comentarios (nome, comentario, data_criacao, status) 
            VALUES (:nome, :comentario, NOW(), 'aprovado')";
    
    $stmt = $conn->prepare($sql);
    $result = $stmt->execute([
        ':nome' => $nome,
        ':comentario' => $comentario
    ]);
    
    if ($result) {
        echo json_encode(['sucesso' => true]);
    } else {
        throw new Exception('Erro ao salvar comentário');
    }

} catch (Exception $e) {
    error_log('Erro: ' . $e->getMessage());
    echo json_encode([
        'sucesso' => false,
        'mensagem' => $e->getMessage()
    ]);
}
?>