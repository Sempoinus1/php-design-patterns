<?php namespace DesignPattern;

class Person
{
    public string $name;
    public string $position;
}

final class PersonBuilder
{
    private readonly array $actions; // ['person']['person']
    /*private function AddAction()
    {
        $this->actions[] =
    }*/

    public function Do(): PersonBuilder
    {

    }

    /**
     * @param array $actions
     */
    public function __construct(array $actions)
    {
        $this->actions = [];
    }

}


class Demo
{
    public function __construct()
    {
    }
}
new Demo();
