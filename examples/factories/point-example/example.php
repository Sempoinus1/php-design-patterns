<?php

enum CoordinateSystem
{
    case Cartesian;
    case Polar;
}

class Point
{
    private float $x;
    private float $y;

    /**
     * @param float $a výpočet X pro daný systém
     * @param float $b výpočet Y pro daný systém
     */
    public function __construct(float $a, float $b, CoordinateSystem $coords = CoordinateSystem::Cartesian)
    {
        switch ($coords)
        {
            case CoordinateSystem::Cartesian:
                $this->x = $a;
                $this->y = $b;
                break;
            case CoordinateSystem::Polar:
                $x = $a * cos($b);
                $y = $a * sin($b);
                break;
        }

    }


}

class Demo
{
    public function __construct()
    {
    }
}
new Demo();