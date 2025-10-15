<?php
namespace App\Application;

use App\Contracts\ProductRepository;
use App\Contracts\ProductValidator;

class ProductService
{
    private ProductRepository $repo;
    private ProductValidator $validator;

    public function __construct(ProductRepository $repo, ProductValidator $validator)
    {
        $this->repo = $repo;
        $this->validator = $validator;
    }

    public function create(array $input): array
    {
        $errors = $this->validator->validate($input);
        if (!empty($errors)) {
            return ['success' => false, 'errors' => $errors];
        }

        $lastId = $this->repo->getLastId();
        $nextId = $lastId + 1;

        // normalize price to float
        $price = is_numeric($input['price']) ? (float)$input['price'] : 0.0;

        $product = [
            'id' => $nextId,
            'name' => $input['name'],
            'price' => $price
        ];

        $saved = $this->repo->save($product);

        if (!$saved) {
            return ['success' => false, 'errors' => ['Erro ao salvar produto.']];
        }

        return ['success' => true, 'product' => $product];
    }

    public function list(): array
    {
        return $this->repo->findAll();
    }
}
