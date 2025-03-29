<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Teste do Sistema de Comentários</title>
    <style>
        .comentarios-container {
            max-width: 800px;
            margin: 30px auto;
            padding: 20px;
            background: #fff;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .comentario {
            margin: 15px 0;
            padding: 15px;
            background: #f8f9fa;
            border-left: 4px solid #9BD239;
        }
    </style>
</head>
<body>
    <div class="comentarios-container">
        <!-- Formulário -->
        <?php include 'includes/formulario.php'; ?>
        
        <!-- Lista de Comentários -->
        <?php include 'includes/exibir_comentarios.php'; ?>
    </div>
</body>
</html>