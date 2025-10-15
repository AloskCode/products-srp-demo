<?php
namespace App\Contracts;

interface ProductValidator
{
    /**
     * Validate input and return array with errors (empty = valid)
     * @param array $input
     * @return array
     */
    public function validate(array $input): array;
}
