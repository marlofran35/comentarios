<?php
require_once __DIR__ . '/../config/conexao.php';

try {
    $sql = "SELECT * FROM comentarios WHERE status = 'aprovado' ORDER BY data_criacao DESC";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $comentarios = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (count($comentarios) > 0): ?>
        <div class="comentarios-lista">
            <h3>Comentários</h3>
            <?php foreach($comentarios as $comentario): ?>
                <div class="comentario">
                    <div class="comentario-header">
                        <strong><?php echo htmlspecialchars($comentario['nome']); ?></strong>
                        <span class="data">
                            <?php echo date('d/m/Y H:i', strtotime($comentario['data_criacao'])); ?>
                        </span>
                    </div>
                    <div class="comentario-texto">
                        <?php echo nl2br(htmlspecialchars($comentario['comentario'])); ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <p class="sem-comentarios">Nenhum comentário ainda. Seja o primeiro a comentar!</p>
    <?php endif;

} catch(Exception $e) {
    error_log("Erro ao listar comentários: " . $e->getMessage());
    echo "<p class='erro'>Erro ao carregar comentários. Tente novamente mais tarde.</p>";
}
?>