<?php

class Product{
    private $id;
    private $name;
    private $description;
    private $price;
    private $stock;
    private $category;
    private $image;

    public function __construct($id, $name, $description, $category, $price, $stock, $image) {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->category = $category;
        $this->price = $price;
        $this->stock = $stock;
        $this->image = $image;
    }

    public function getImage() {
        return $this->image;
    }

    public function getId() {
        return $this->id;
    }

    public function getName() {
        return $this->name;
    }

    public function getDescription() {
        return $this->description;
    }

    public function getCategory() {
        return $this->category;
    }

    public function getPrice() {
        return $this->price;
    }

    public function getStock() {
        return $this->stock;
    }
}
?>