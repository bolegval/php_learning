<?php

namespace Manager;

spl_autoload_register(function ($class) {

    $prefix = '\\App\\Tasks\\';
 
    $base_dir = __DIR__ . '/src/';
 
    $len = strlen($prefix);

    $relative_class = $prefix . $class;

    $file = $base_dir . str_replace('\\', '/', $relative_class) . '.php';

    if (file_exists($file)) {
        require $file;
    }
    
});
var_dump(strlen('\\App\\Tasks\\'));
$relative_class = '\\App\\Tasks\\' . 'Manager';
var_dump($relative_class);
var_dump(__DIR__ . '/src/' . str_replace('\\', '/', $relative_class) . '.php');

class Manager
{
    public function place($item)
    {
        $name = is_object($item) ? substr(get_class($item), strrpos(get_class($item), '\\') + 1) : $item;

        if ($item instanceof Papers)
        {
            echo "Положил $name на стол" . PHP_EOL;
            return;
        } 
        
        if ($item instanceof Instrument)
        {
            echo "Убрал $name внутрь стола" . PHP_EOL;
            return;
        } 

        echo "Выкинул $name в корзину" . PHP_EOL;
        return;
    }
}

abstract class Papers
{
}

abstract class Instrument 
{
}

class Book extends Papers
{
}

class Hammer extends Instrument
{
}

class Table
{
}

class Card extends Papers
{
}

class Drill extends Instrument
{
}

$manager = new Manager;

$book = new Book;
$hammer = new Hammer;
$table = new Table;
$card = new Card;
$drill = new Drill;

$manager->place($book);
$manager->place($hammer);
$manager->place($table);
$manager->place($card);
$manager->place($drill);
$manager->place("Мусор");