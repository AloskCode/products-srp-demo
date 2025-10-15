<?php
require_once __DIR__ . '/../vendor/autoload.php';

use App\Application\ProductService;
use App\Infra\FileProductRepository;
use App\Domain\SimpleProductValidator;

http_response_code(400);
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo 'Método não permitido';
    exit;
}

$input = [
    'name' => isset($_POST['name']) ? trim($_POST['name']) : '',
    'price' => isset($_POST['price']) ? $_POST['price'] : ''
];

$repo = new FileProductRepository(__DIR__ . '/../storage/products.txt');
$validator = new SimpleProductValidator();
$service = new ProductService($repo, $validator);

$result = $service->create($input);

if ($result['success']) {
    http_response_code(201);
    header('Location: products.php');
    exit;
}

// 422 Unprocessable Entity for validation errors
http_response_code(422);
echo '<h2>Erros de validação</h2>';
echo '<ul>';
foreach ($result['errors'] as $err) {
    echo '<li>' . htmlspecialchars($err) . '</li>';
}
echo '</ul>';
echo '<p><a href="index.php">Voltar</a></p>';
