<?php
require_once __DIR__ . '/../vendor/autoload.php';

use App\Application\ProductService;
use App\Infra\FileProductRepository;
use App\Domain\SimpleProductValidator;

$repo = new FileProductRepository(__DIR__ . '/../storage/products.txt');
$validator = new SimpleProductValidator();
$service = new ProductService($repo, $validator);

$products = $service->list();

?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>Produtos</title>
    <style>table { border-collapse: collapse; } td, th { padding:6px 10px; border:1px solid #ccc; }</style>
</head>
<body>
    <h1>Produtos</h1>
    <p><a href="index.php">Novo produto</a></p>
    <?php if (empty($products)): ?>
        <p>Nenhum produto cadastrado.</p>
    <?php else: ?>
        <table>
            <thead><tr><th>ID</th><th>Nome</th><th>Preço</th></tr></thead>
            <tbody>
                <?php foreach ($products as $p): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($p['id']); ?></td>
                        <td><?php echo htmlspecialchars($p['name']); ?></td>
                        <td><?php echo number_format((float)$p['price'], 2, ',', '.'); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</body>
</html>
