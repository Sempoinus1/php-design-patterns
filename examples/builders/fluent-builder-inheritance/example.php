<?php namespace DesignPattern;

class Person
{
    public string $name;
    public string $position;
    public int $salary;

    /**
     * @param string $name
     * @param string $position
     */
    public function __construct(string $name = "", string $position = "", int $salary = 0)
    {
        $this->name = $name;
        $this->position = $position;
        $this->salary = $salary;
    }
}

abstract class PersonBuilder
{
    protected Person $person;

    public function __construct()
    {
        $this->person = new Person();
    }

    public function build(): Person
    {
        return $this->person;
    }
}

class PersonInfoBuilder extends PersonBuilder
{
    protected Person $person;

    /**
     * @param Person $person
     */
    public function __construct(Person $person = new Person())
    {
        parent::__construct();
        $this->person = $person;
    }

    public function called(string $name): self
    {
        $this->person->name = $name;
        return $this;
    }
}

class PersonJobBuilder extends PersonInfoBuilder
{
    public function worksAsA(string $position): self
    {
        $this->person->position = $position;
        return $this;
    }
}

class PersonSalaryBuilder extends PersonJobBuilder
{
    public function startsAt(int $salary): self
    {
        $this->person->salary = $salary;
        return $this;
    }
}

class Demo
{
    public function __construct()
    {
        $builder = new PersonSalaryBuilder();
        $builder->called("John")->worksAsA("dev")->startsAt(10000)->build();
        var_dump($builder);
    }
}

new Demo();