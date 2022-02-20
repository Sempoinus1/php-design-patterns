<?php namespace DesignPattern;

interface IHotDrink
{
    public function Consume();
}

class Tea implements IHotDrink
{
    public function Consume()
    {
        echo("Tea consumed");
    }
}
class Coffee implements IHotDrink
{
    public function Consume()
    {
       echo("Coffee consumed");
    }
}

interface IHotDrinkFactory
{
    public function Prepare(int $amount): IHotDrink;
}

class TeaFactory implements IHotDrinkFactory
{
    public function Prepare(int $amount): IHotDrink
    {
        echo("You are making $amount ml of a tea");
        return new Tea();
    }
}

enum AvaiableDrink: string
{
    case Coffee = "Coffee";
    case Tea = "Tea";
}
class CoffeeFactory implements IHotDrinkFactory
{
    public function Prepare(int $amount): IHotDrink
    {
        echo("You are making $amount ml of a coffee");
        return new Coffee();
    }
}

class HotDrinkMachine
{
    private array $factories;

    /**
     * @param array $factories
     */
    public function __construct(array $factories)
    {
        $this->factories = [];
        foreach(AvaiableDrink::cases() as $drink)
        {
            $this->factories = new DesignPattern\$drink();
        }
    }

}

class Demo
{

}

new Demo();