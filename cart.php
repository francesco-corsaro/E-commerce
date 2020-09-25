<?php
class Cart {
    private $items;
    private $total;
    public function __construct() {
        $this->items = [];
        $this->total = 0.00;
    }
    
// La sincorinizzazione con la sessione avviene con questi due metodi
    public function setItems($items) {
        $this->items = $items;
    }
    public function setTotal($value) {
        $this->total = $value;
    }

//con questi due metodi recuoeriamo il valore
    public function getItems() {
        return $this->items;
    }
    public function getTotal() {
        return $this->total;
    }
    
//verifichiamo che nel carrello ci sisano dei prodotti
    private function hasItems() {
        return ( count( $this->items ) > 0 );
    }
    
//questo metodo impedisce di aggiungere prodotti quando l'utente ricarica la pagina
    private function isInCart(Product $product) {
        if( $this->hasItems()) {
            foreach( $this->items as $item ) {
                if($item['id'] == $product->id) {
                    return true;
                }
            }
            return false;
        } else {
            return false;
        }
    }
    
//metodo per calcolare il totale del carrello
    private function calculateTotal() {
        $this->total = 0.00;
        if($this->hasItems()) {
            $tot = 0.00;
            foreach($this->items as $item) {
                $tot += $item['subtotal'];
            }
            $this->total = $tot;
        }
    }
    
//metodo per aggiungere un un prodotto nel carrello. prendiamo un oggetto dalla classe Product
    public function addToCart(Product $product, $quantity) {
        if($quantity < 1) {
            return;
        }
        $item = [
            'id' => $product->id,
            'name' => $product->name,
            'description' => $product->description,
            'price' => $product->price,
            'manufacturer' => $product->manufacturer,
            'image' => $product->image,
            'quantity' => $quantity,
            'subtotal' => ($product->price * $quantity)
        ];
        $this->items[] = $item;
        $this->calculateTotal();
    }
    
//rimuovere il prodotto
    public function removeFromCart(Product $product) {
        if($this->hasItems()) {
            $i = -1;
            foreach($this->items as $item) {
                $i++;
                if($product->id == $item['id']) {
                    unset($this->items[$i]);
                    $this->calculateTotal();
                }
            }
        }
    }
    
//metodo per aggiornare il carrello
    public function updateCart(Product $product, $quantity) {
        if($this->hasItems()) {
            foreach($this->items as &$item)  {
                if($product->id == $item['id']) {
                    $item['quantity'] = $quantity;
                    $item['subtotal'] = ($product->price * $quantity);
                    $this->calculateTotal();
                }
            }
        }
    }


}