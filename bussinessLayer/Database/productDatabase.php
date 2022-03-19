<?php

namespace app\bussinessLayer\Database;

use app\model\ProductModel;
use PDO;

class productDatabase
{
    protected $pdo;

    public function __construct()
    {
        $this->initConnection();
    }

    private function initConnection(){
        $host = 'localhost';
        $port = 3306;
        $dbName = "productdb";
        $username='root';
        $password='';
        $this->pdo = new PDO("mysql:host=$host;port=$port;dbname=$dbName", $username, $password);
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function fetchProducts()
    {
        $statement = $this->pdo->prepare("Select * from products order by date asc ");
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }
    public function isUniqueSKU($SKU): bool
    {
        $statement = $this->pdo->prepare('select * from products where SKU =:sku');
        $statement->bindValue(':sku', $SKU);
        $statement->execute();
        $product=$statement->fetch(PDO::FETCH_ASSOC);
        return !isset($product['SKU']);
    }
    public function addProduct(ProductModel $productModel)
    {
        $statement = $this->pdo->prepare("insert into products (SKU,Name,Price,Date,Size,Weight,Height,Width,Length) values (:sku,:name,:price,:date,:size,:weight,:height,:width,:length);");
        $statement->bindValue(':sku', $productModel->getSKU());
        $statement->bindValue(':name', $productModel->getName());
        $statement->bindValue(':price', $productModel->getPrice());
        $statement->bindValue(':date', $productModel->getDate());
        $statement->bindValue(':size', $productModel->getSize());
        $statement->bindValue(':weight', $productModel->getWeight());
        $statement->bindValue(':height', $productModel->getHeight());
        $statement->bindValue(':width', $productModel->getWidth());
        $statement->bindValue(':length', $productModel->getLength());
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function deleteProduct($SKU)
    {
        $statement = $this->pdo->prepare('delete from products where SKU =:sku');
        $statement->bindValue(':sku', $SKU);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }
}
