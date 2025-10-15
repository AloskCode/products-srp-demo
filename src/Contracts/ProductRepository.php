<?php
namespace App\Contracts;

interface ProductRepository
{
    /**
     * @param array $product associative array with keys id, name, price
     * @return bool
     */
    public function save(array $product): bool;

    /**
     * @return array list of products (each product is associative array)
     */
    public function findAll(): array;

    /**
     * Return last id or 0 if none.
     */
    public function getLastId(): int;
}
