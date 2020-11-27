<?php

namespace Box;

class Box
{
    public function putBall(Ball $ball)
    {
        echo 'В корзину добавлен мяч' . PHP_EOL;
    }
}

class Ball
{
    private static $count = 0;

    public static function addCount()
    {
        self::$count++;
    }

    public static function getCount()
    {
        return self::$count;
    }

}

$box = new Box;
$ball = new Ball;

for ($i = 0; $i < rand(); $i++) { 
    Ball::addCount();
}

$box->putBall($ball);
echo "Всего мячей в корзине: " . Ball::getCount();

