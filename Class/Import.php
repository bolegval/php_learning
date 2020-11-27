<?php

namespace Import;

interface Reader
{
    public function read($data) :array;
}

interface Writer
{
    public function write(array $data);
}

interface Converter
{
    public function convert($item);
}

class Import 
{
    public $data;
    public $reader;
    public $writer;
    public $converters = [];

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function from(Reader $reader)
    {   
        $this->reader = $reader;
        return $this;
    }

    public function to(Writer $writer)
    {
        $this->writer = $writer;
        return $this;
    }

    public function with(Converter $converter)
    {
        $this->converters[] = $converter;
        return $this;
    }

    public function execute()
    {
        $data = $this->reader->read($this->data);
        $result = [];
        
        foreach ($data as $item) {
            foreach ($this->converters as $converter) {
                $item = $converter->convert($item);
            }

            $result[] = $item;
        }

        $this->data = $this->writer->write($result); 
    }
}

class ArrayReader implements Reader
{
    public function read($data) : array
    {
        return $data;
    }
}

class ArrayWriter implements Writer
{
    public function write(array $data)
    {
        return $data;
    }
}

class ArrayConverter implements Converter
{
    public function convert($item)
    {
        shuffle($item);
        return $item;
    }
}

class ShiftConverter implements Converter
{
    public function convert($item)
    {
        return array_shift($item);
    }
}

$user = [
    [
        'id' => 2135,
        'first_name' => 'John',
        'last_name' => 'Doe',
    ],
    [
        'id' => 3245,
        'first_name' => 'Sally',
        'last_name' => 'Smith',
    ],
    [
        'id' => 5342,
        'first_name' => 'Jane',
        'last_name' => 'Jones',
    ],
    [
        'id' => 5623,
        'first_name' => 'Peter',
        'last_name' => 'Doe',
    ]
];


$imp = new Import($user);
$imp->from(new ArrayReader);
$imp->to(new ArrayWriter);
$imp->with(new ArrayConverter);
$imp->with(new ShiftConverter);

$imp->execute();
