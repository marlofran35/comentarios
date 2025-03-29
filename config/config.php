<?php
session_start();

// Configurações do Site
define('SITE_URL', 'https://seusite.com');
define('SISTEMA_PATH', '/comentarios');

// Configurações de Email (opcional)
define('EMAIL_ADMIN', 'seu@email.com');

// Configurações de Upload (opcional)
define('UPLOAD_MAX_SIZE', 5242880); // 5MB
define('UPLOAD_ALLOWED_TYPES', ['image/jpeg', 'image/png']);

// Configurações de Segurança
define('CSRF_TOKEN_TIME', 3600); // 1 hora
?>