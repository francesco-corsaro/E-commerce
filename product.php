<?php
class Product {
    public $id;
    public $name;
    public $description;
    public $price;
    public $manufacturer;
    public $image;
    public $slug;
    
    
    public function __construct($id, $name, $description, $price, $manufacturer, $image, $slug) {
        $this->id = (is_null($id)) ? $this->genId() : $id;
        $this->name = $name;
        $this->description = $description;
        $this->price = $price;
        $this->manufacturer = $manufacturer;
        $this->image = $image;
        $this->slug = $slug;
    }
    
    protected function genId() {
        $prefix = 'b0';
        $output = $prefix;
        $chars = range('a','z');
        $digits = range(0, 9);
        $parts = array_merge($chars, $digits);
        for($i = 0; $i < 8; $i++) {
            $output .= $parts[mt_rand(0, count($parts) - 1)];
        }
        return $output;
    }
}

// Per aggiungere un nuovo prodotto possimao i
//$new_product = new Product(null, 'Test', 'Lorem ipsum', 10.50, 'Acme', 'image.jpg', 'test-product');