<?php

enum CoordinateSystem
{
    case Cartesian;
    case Polar;
}

class PointFactory
{
    public static function NewCartesianPoint(float $x, float $y): Point
    {
        return new Point($x, $y);
    }

    public static function NewPolarPoint(float $rho, float $theta): Point
    {
        return new Point($rho*cos($theta), $rho*sin($theta));
    }
}

class Point
{
    private float $x;
    private float $y;

    public function __construct(float $x, float $y)
    {
        $this->x = $x;
        $this->y = $y;
    }


}

class Demo
{
    public function __construct()
    {
        $point = PointFactory::NewPolarPoint(1.0, pi() / 2);
        var_dump($point);
    }
}
new Demo();