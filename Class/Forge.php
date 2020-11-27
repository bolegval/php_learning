<?php

class Forge
{
    public function burn($object)
    {
        $flame = $object->burn();
        echo $flame->render((string)$object) . PHP_EOL;
    }
}

class BlueFlame extends Forge
{
    public function render($name)
    {
        return $name . " загорелся синим пламенем";
    }
}

class RedFlame
{
    public function render($name)
    {
        return $name . " начал хорошо гореть";
    }
}

class Smoke
{
    public function render($name)
    {
        return $name . " лишь задымился";
    }
}

class Notebook
{
    private $name = 'Ноутбук';

    public function burn()
    {
        return new BlueFlame;
    }

    public function __toString()
    {
        return $this->name;
    }
}

class Bike
{
    private $name = 'Велосипед';

    public function burn()
    {
        return new Smoke;
    }

    public function __toString()
    {
        return $this->name;
    }
}
class Carrot
{
    private $name = 'Морковь';

    public function burn()
    {
        return new Smoke;
    }

    public function __toString()
    {
        return $this->name;
    }
}

class Doll
{
    private $name = 'Кукла';

    public function burn()
    {
        return new Smoke;
    }

    public function __toString()
    {
        return $this->name;
    }
}

class Tree
{
    private $name = 'Дерево';

    public function burn()
    {
        return new Smoke;
    }

    public function __toString()
    {
        return $this->name;
    }
}


$forge = new Forge;
$note = new Notebook;
$bike = new Bike;
$carrot = new Carrot;
$doll = new Doll;
$tree = new Tree;


$forge->burn($note);
$forge->burn($bike);
$forge->burn($carrot);
$forge->burn($doll);
$forge->burn($tree);
