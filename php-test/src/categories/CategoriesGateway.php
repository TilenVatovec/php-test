<?php

class CategoriesGateway
{
    private PDO $connection;

    public function __construct(Database $database)
    {
        $this->connection = $database->getConnection();
    }

    public function getAll(): array
    {
        // First, get all categories
        $categoriesSql = "SELECT * FROM categories";
        $categoriesStmt = $this->connection->query($categoriesSql);
        $categoriesRawData = [];
        while ($row = $categoriesStmt->fetch(PDO::FETCH_ASSOC)) {
            $categoriesRawData[] = $row;
        }

        // Then, get product counts for each category
        $productCountsSql = "
            SELECT c.id AS category_id, COUNT(cp.product_id) AS product_count
            FROM categories c
            LEFT JOIN category_product cp ON c.id = cp.category_id
            GROUP BY c.id
        ";
        $productCountsStmt = $this->connection->query($productCountsSql);
        $productCounts = [];
        while ($row = $productCountsStmt->fetch(PDO::FETCH_ASSOC)) {
            $productCounts[$row['category_id']] = $row['product_count'];
        }

        // Merge product counts with category data
        foreach ($categoriesRawData as &$category) {
            $category['product_count'] = $productCounts[$category['id']] ?? 0;
        }

        return $this->buildTree($categoriesRawData);
    }

    private function buildTree($items)
    {
        $map = [];
        foreach ($items as &$item) {
            $map[$item['id']] = [
                'id' => $item['id'],
                'name' => $item['name'],
                'children' => [],
                'product_count' => $item['product_count']
            ];
        }

        $rootNodes = [];
        foreach ($items as &$item) {
            if ($item['parent_id'] !== null && isset($map[$item['parent_id']])) {
                $map[$item['parent_id']]['children'][] = &$map[$item['id']];
            } else {
                $rootNodes[] = &$map[$item['id']];
            }
        }

        return $rootNodes;
    }
}
