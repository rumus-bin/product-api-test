<?php

namespace App\Repositories;

use App\Models\Product;

/**
 * @method Product|null findOneBy(string $field, $value): ?Product
 * @method Product|null findById(int $id): ?Product
 * @method Product save(Product $model): Product
 * @method Product[] findBy(string $field, $value): Product[]
 * @method Product[] all(): Product[]
 * @method Product[] getAllPaginated(int $perPage = 10, array $columns = ['*'], string $pageName = 'page', int $page = null): Product[]
 */
class ProductRepository extends AbstractRepository
{
    public function __construct()
    {
        parent::__construct(Product::class);
    }
}
