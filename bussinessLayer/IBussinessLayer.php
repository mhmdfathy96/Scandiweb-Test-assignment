<?php

namespace app\bussinessLayer;


interface IBussinessLayer
{
    public function fetchObjects();
    public function addObject($object);
    public function deleteObject($object);
}