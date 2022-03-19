<?php

namespace app\controllers;

use app\bussinessLayer\ProductBussinessLayer;

class ProductController implements IController
{
    private $pbl;
    public function __construct()
    {
            $this->pbl=new ProductBussinessLayer();
    }

    public function index()
    {
        $router = Router::$router;
        $products = $this->pbl->fetchObjects();
        $router->renderView("/index", [
            'products' => $products,
        ]);
    }

    public function create()
    {
        $router = Router::$router;
        $errors = [];
        $productData = [
            'SKU' => '',
            'Name' => '',
            'Price' => '',
            'Size' => '',
            'Weight' => '',
            'Height' => '',
            'Width' => '',
            'Length' => '',
        ];
        $type='';
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $productData['SKU'] = $_POST['SKU'];
            $productData['Name'] = $_POST['Name'];
            $productData['Price'] = (float)$_POST['Price'];
            $productData['Size'] = $_POST['Size'] ?? null;
            $productData['Weight'] = $_POST['Weight'] ?? null;
            $productData['Height'] = $_POST['Height']?? null;
            $productData['Width'] = $_POST['Width']?? null;
            $productData['Length'] = $_POST['Length']?? null;
            $type=$_POST['type']??null;
            /*
            $productData['Size'] = isset($_POST['Size']) ? $_POST['Size'] : null;
            $productData['Weight'] = isset($_POST['Weight']) ? (float)$_POST['Weight'] : null;
            $productData['Height'] = isset($_POST['Height']) ? (float)$_POST['Height'] : null;
            $productData['Width'] = isset($_POST['Width']) ? (float)$_POST['Width'] : null;
            $productData['Length'] = isset($_POST['Length']) ? (float)$_POST['Length'] : null;
            */
            //////////
            $errors=$this->pbl->addObject($productData);
            if (empty($errors)) {
                header('location: /products');
                exit();
            }
        }
        $router->renderView("/create", [
            'productData' => $productData,
            'errors' => $errors,
            'type'=>$type,
        ]);
    }

    public function delete()
    {
        $products = $this->pbl->fetchObjects();
        foreach ($products as $product) {
            $checked = isset($_POST[$product->getSKU()]);
            if ($checked) $this->pbl->deleteObject($product->getSKU());
        }
        header('Location: /products');
    }
}
