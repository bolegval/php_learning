<?php

namespace Shop;

require($_SERVER['DOCUMENT_ROOT'] . '/Notification.php');


class Order
{   
    public $basket;

    public function __construct($basket)
    {
        $this->basket = $basket;
    }

    public function getBasket()
    {
        return $this->basket;
    }

    public function getPrice()
    {
        return $this->basket->getPrice();
    }
}

class Basket
{
    public $products = [];

    public function addProduct(Product $product, $quantity)
    {
        $product->quantity = $quantity;
        $this->products[] = $product;
    }

    public function getPrice()
    {
        $sum = 0;
        foreach ($this->products as $product) 
        {
            $sum += $product->price * $product->quantity;
        }

        return $sum;
    }

    public function describe()
    {
        foreach ($this->products as $product) 
        {
            echo "{$product->getName()} - {$product->getPrice()} руб. - {$product->quantity} шт. </br>"; 
        }
    }
}

class Product
{
    public $name;
    public $price;


    public function __construct($name, $price)
    {
        $this->name = $name;
        $this->price = $price;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getPrice()
    {
        return $this->price;
    }
}

$basket = new Basket;

$ball = new Product('ball', 100);
$car = new Product('car', 1500);
$doll = new Product('doll', 50);

$basket->addProduct($ball, 5);
$basket->addProduct($car, 1);
$basket->addProduct($doll, 3);

$order = new Order($basket);
$order->getBasket()->describe();

echo "Общая стоимсоть заказа - {$order->getPrice()} </br>";

$customer = new \Notification\User('Николай Николаич', 'nic-nic@mail.com');

$customer->notify("для вас создан заказ, на сумму: {$order->getPrice()} </br> Состав: </br> {$order->getBasket()->describe()}");