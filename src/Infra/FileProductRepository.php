<?php
namespace App\Infra;

use App\Contracts\ProductRepository;

class FileProductRepository implements ProductRepository
{
    private string $file;

    public function __construct(string $filepath)
    {
        $this->file = $filepath;
        $dir = dirname($this->file);
        if (!is_dir($dir)) {
            mkdir($dir, 0777, true);
        }
        if (!file_exists($this->file)) {
            touch($this->file);
        }
    }

    public function save(array $product): bool
    {
        $line = json_encode($product, JSON_UNESCAPED_UNICODE) . PHP_EOL;
        return (bool)file_put_contents($this->file, $line, FILE_APPEND | LOCK_EX);
    }

    public function findAll(): array
    {
        $lines = @file($this->file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        if (!$lines) {
            return [];
        }
        $out = [];
        foreach ($lines as $ln) {
            $data = json_decode($ln, true);
            if (json_last_error() === JSON_ERROR_NONE && is_array($data)) {
                $out[] = $data;
            }
        }
        return $out;
    }

    public function getLastId(): int
    {
        $lines = @file($this->file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        if (!$lines) {
            return 0;
        }
        $last = end($lines);
        $data = json_decode($last, true);
        if (json_last_error() === JSON_ERROR_NONE && isset($data['id']) && is_numeric($data['id'])) {
            return (int)$data['id'];
        }
        return 0;
    }
}
