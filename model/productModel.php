<?php

namespace app\model;


class ProductModel
{
    private $SKU;
    private $Name;
    private $Price;
    private $Date;
    private $Size;
    private $Weight;
    private $Height;
    private $Width;
    private $Length;

    public function getSKU()
    {
        return $this->SKU;
    }


    public function setSKU($SKU)
    {
        $this->SKU = $SKU;
    }

    public function getName()
    {
        return $this->Name;
    }

    public function setName($Name)
    {
        $this->Name = $Name;
    }

    public function getPrice()
    {
        return $this->Price;
    }

    public function setPrice($Price)
    {
        $this->Price = $Price;
    }

    public function getDate()
    {
        return $this->Date;
    }

    public function setDate($Date)
    {
        $this->Date = $Date;
    }

    public function getSize()
    {
        return $this->Size;
    }

    public function setSize($Size)
    {
        $this->Size = $Size;
    }

    public function getWeight()
    {
        return $this->Weight;
    }

    public function setWeight($Weight)
    {
        $this->Weight = $Weight;
    }

    public function getHeight()
    {
        return $this->Height;
    }

    public function setHeight($Height)
    {
        $this->Height = $Height;
    }

    public function getWidth()
    {
        return $this->Width;
    }

    public function setWidth($Width)
    {
        $this->Width = $Width;
    }

    public function getLength()
    {
        return $this->Length;
    }

    function setLength($Length)
    {
        $this->Length = $Length;
    }

}
