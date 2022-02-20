<?php namespace DesignPattern;

use mysql_xdevapi\Exception;

enum CarType
{
    case Sedan;
    case Crossover;
}

class Car
{
    public CarType $type;
    public int $wheelSize;
}

interface ISpecifyCarType
{
    public function ofType(CarType $type): ISpecifyWheelSize;
}

interface ISpecifyWheelSize
{
    public function withWheels(int $size): IBuildCar;
}

interface IBuildCar
{
    public function build(): Car;
}

// Tato classa by měla být private uvnitř CarBuilder
class Impl implements ISpecifyCarType, ISpecifyWheelSize, IBuildCar
{
    public function ofType(CarType $type): ISpecifyWheelSize
    {
        return $this;
    }

    public function withWheels(int $size): IBuildCar
    {
        return $this;
    }

    public function build(): Car
    {
        return new Car();
    }

}

class CarBuilder
{
    private Car $car;

    /**
     * @param Car $car
     */
    public function __construct(Car $car)
    {
        $this->car = $car;
    }

    public static function create(): ISpecifyCarType
    {
        return new Impl();
    }

    public function ofType(CarType $type): ISpecifyWheelSize
    {
        $this->car->type = $type;
        return $this;
    }

    public function withWheels(int $size): IBuildCar
    {
        switch ($this->car->type)
        {
            case CarType::Crossover:
                if($size < 17 || $size > 20)
                {
                    throw new Exception("Wrong size of wheel");
                }
                break;
            case CarType::Sedan:
                if($size < 15 || $size > 17)
                {
                    throw new Exception("Wrong size of wheel");
                }
                break;
        }
        $this->car->wheelSize = $size;
        return $this;
    }

    public function build(): Car
    {
        return $this->car;
    }

}

class Demo
{
    public function __construct()
    {
        $car = CarBuilder::create();         // ISpecifyCarType
        $car->ofType(CarType::Sedan)    // ISpecifyWheelSize
        ->withWheels(18)            // IBuildCar
        ->build();

        var_dump($car);
    }
}
new Demo();