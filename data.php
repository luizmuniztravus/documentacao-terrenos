<?php
// Armazenamento simples em arquivo para o painel de documentacao dos terrenos.
// GET  -> devolve o JSON salvo (ou {} se ainda nao existir nada)
// POST -> substitui o conteudo salvo pelo corpo da requisicao (JSON)

header('Content-Type: application/json; charset=utf-8');

$file = __DIR__ . '/terrenos-data.json';
$method = $_SERVER['REQUEST_METHOD'];

if ($method === 'GET') {
    if (!file_exists($file)) {
        echo '{}';
        exit;
    }
    $fp = fopen($file, 'r');
    if ($fp === false) {
        http_response_code(500);
        echo json_encode(['error' => 'nao foi possivel ler o arquivo']);
        exit;
    }
    flock($fp, LOCK_SH);
    $contents = stream_get_contents($fp);
    flock($fp, LOCK_UN);
    fclose($fp);
    echo ($contents === false || trim($contents) === '') ? '{}' : $contents;
    exit;
}

if ($method === 'POST') {
    $body = file_get_contents('php://input');
    json_decode($body);
    if (json_last_error() !== JSON_ERROR_NONE) {
        http_response_code(400);
        echo json_encode(['error' => 'JSON invalido']);
        exit;
    }
    $fp = fopen($file, 'c');
    if ($fp === false) {
        http_response_code(500);
        echo json_encode(['error' => 'nao foi possivel escrever o arquivo']);
        exit;
    }
    flock($fp, LOCK_EX);
    ftruncate($fp, 0);
    fwrite($fp, $body);
    fflush($fp);
    flock($fp, LOCK_UN);
    fclose($fp);
    echo json_encode(['ok' => true]);
    exit;
}

http_response_code(405);
echo json_encode(['error' => 'metodo nao permitido']);
