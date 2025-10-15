<?php
namespace App\Domain;

use App\Contracts\ProductValidator;

class SimpleProductValidator implements ProductValidator
{
    public function validate(array $input): array
    {
        $errors = [];

        $name = isset($input['name']) ? trim($input['name']) : '';
        if ($name === '') {
            $errors[] = 'O campo nome é obrigatório.';
        } elseif (mb_strlen($name) < 2) {
            $errors[] = 'O nome deve ter pelo menos 2 caracteres.';
        } elseif (mb_strlen($name) > 100) {
            $errors[] = 'O nome deve ter no máximo 100 caracteres.';
        }

        if (!isset($input['price']) || $input['price'] === '') {
            $errors[] = 'O campo preço é obrigatório.';
        } elseif (!is_numeric($input['price'])) {
            $errors[] = 'O preço deve ser numérico.';
        } elseif ((float)$input['price'] < 0) {
            $errors[] = 'O preço não pode ser negativo.';
        }

        return $errors;
    }
}
