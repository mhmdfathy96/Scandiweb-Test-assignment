<?php

namespace app\bussinessLayer;

use app\bussinessLayer\Database\productDatabase;
use app\model\ProductModel;

class ProductBussinessLayer implements IBussinessLayer
{

    private $db;

    public function __construct()
    {
        $this->db = new productDatabase();
    }

    public function fetchObjects(): array
    {
        $productModels = [];
        $products = $this->db->fetchProducts();
        foreach ($products as $product) {
            $productModel = $this->fromJson($product);
            $productModels[] = $productModel;
        }
        return $productModels;
    }

    public function addObject($object)
    {
        $productModel = $this->fromJson($object);
        $errors = $this->productValidation($productModel);
        if (!empty($errors)) {
            return $errors;
        }
        $isUniqueSKU = $this->db->isUniqueSKU($productModel->getSKU());
        if ($isUniqueSKU) {
            $this->db->addProduct($productModel);
        } else {
            return ["SKU_ALREADY_EXIST"];
        }
    }

    private function fromJson($productJson): ProductModel
    {
        $productModel = new ProductModel();
        $productModel->setSKU($productJson['SKU']);
        $productModel->setName($productJson['Name']);
        $productModel->setPrice($productJson['Price']);
        $productModel->setDate($productJson['Date'] ?? date("Y-m-d H:i:s"));
        $productModel->setSize($productJson['Size']);
        $productModel->setWeight($productJson['Weight']);
        $productModel->setHeight($productJson['Height']);
        $productModel->setWidth($productJson['Width']);
        $productModel->setLength($productJson['Length']);
        return $productModel;
    }

    private function productValidation(ProductModel $product): array
    {
        $errors = [];
        if (!$product->getSKU()) {
            $errors[] = "SKU is REQUIRED!";
        }elseif(strlen($product->getSKU())>25){
            $errors[] = "SKU must not exceed 25 char!";
        }

        if (!$product->getName()) {
            $errors[] = "Name is REQUIRED!";
        }elseif(strlen($product->getName())>25){
            $errors[] = "Name must not exceed 25 char!";
        }
        if (!$product->getPrice()) {
            $errors[] = "Price is REQUIRED!";
        }elseif((float)($product->getPrice())>99999999.99){
            $errors[] = "Price must be less than 100 Million !";
        }
        if (!isset($_POST['type'])) {
            $errors[] = "Type is REQUIRED!";
        } elseif ($_POST['type'] === "") {
            $errors[] = "Type is REQUIRED!";
        } elseif ($_POST['type'] === 'DVD-disc' && empty($_POST['Size'])) {
            $errors[] = "DVD-disc Size is REQUIRED!";
        }elseif ($_POST['type'] === 'DVD-disc' && strlen($_POST['Size'])>9) {
            $errors[] = "DVD-disc Size must not exceed 9 chars!";
        } elseif ($_POST['type'] === 'Book' && empty($_POST['Weight'])) {
            $errors[] = "Book Weight is REQUIRED!";
        }elseif ($_POST['type'] === 'Book' && (float)($_POST['Weight'])>99.99) {
            $errors[] = "Book Weight must be less than 100 KG!";
        } elseif ($_POST['type'] === 'Furniture' &&(empty($_POST['Height']) || empty($_POST['Width']) || empty($_POST['Length']))) {
            $errors[] = "Furniture All Dimension is REQUIRED!";
        }elseif ($_POST['type'] === 'Furniture' &&((float)($_POST['Height'])>99.99 || (float)($_POST['Width'])>99.99 || (float)($_POST['Length'])>99.99)) {
            $errors[] = "Dimensions must be less than 100 meter!";
        }
        return $errors;
    }

    public function deleteObject($object)
    {
        return $this->db->deleteProduct($object);
    }
}