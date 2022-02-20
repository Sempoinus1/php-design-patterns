<?php

interface ICar
{
    public function drive(): void;
}
class Car implements ICar
{
    public function drive(): void
    {
       echo("Car is being driven \n");
    }
}
class CarProxy implements ICar
{
    private Car $car;

    public function __construct(Car $car)
    {
        $this->car = $car;
    }

    public function drive(): void
    {
        if($this->checkDriversAge())
        {
            $this->car->drive();
        }
    }

    private function checkDriversAge(): bool
    {
        echo("Driver can drive a car");
        return true;
    }

}