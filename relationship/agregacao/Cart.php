<?php

class Cart
{

    private $itens;

    public function addItem(Product $product)
    {
        $this->itens[] = $product;
    }

    /**
     * Get the value of itens
     */ 
    public function getItens()
    {
        return $this->itens;
    }

    /**
     * Set the value of itens
     *
     * @return  self
     */ 
    public function setItens($itens)
    {
        $this->itens = $itens;
    }
}
