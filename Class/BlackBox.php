<?php

class BlackBox
{
    private $data = [];

    public function addLog($message)
    {
        $this->data[] = $message;
    }

    public function getDataForEngineer(Engineer $engineer)
    {
        return $this->data;
    }
}

class Plane
{
    private $blackBox;

    public function __construct()
    {
        $this->blackBox = new BlackBox;
    }

    public function flyAndCrush()
    {
        $this->flyProcess();
        $this->crushProcess();
    }

    public function flyProcess()
    {
        return $this->addLog('Полет нормальный');
    }

    public function crushProcess()
    {
        return $this->addLog('Полный крах');
    }

    protected function addLog($message)
    {
       $this->blackBox->addLog($message);
    }

    public function getBoxForEngineer(Engineer $engineer)
    {
        return $engineer->setBox($this->blackBox);
    }
}

class Engineer
{
    public function setBox(BlackBox $blackBox)
    {
        return $blackBox->getDataForEngineer($this);
    }

    public function takeBox(Plane $plane)
    {
       return $plane->getBoxForEngineer($this);
    }

    public function decodeBox(Plane $plane)
    {

        foreach ($this->takeBox($plane) as $message) {
            echo $message . PHP_EOL;
        }
    }
}

$plane = new Plane;
$plane->flyAndCrush();

$engineer = new Engineer;

$engineer->decodeBox($plane);

class AnotherPlane extends Plane
{
}

$newPlane = new AnotherPlane;
$newPlane->flyAndCrush();

$engineer->decodeBox($newPlane);
