<?php

class Person
{
    // address
    public string $address;
    public string $postcode;
    public string $city;

    // employment
    public string $companyName;
    public string $position;
    public int $annualIncome;
}

class PersonBuilder // facade
{
    // reference
    protected Person $person;

    public function __construct()
    {
        $this->person = new Person();
    }

    public function works(): PersonJobBuilder
    {
        return new PersonJobBuilder($this->person);
    }

    public function lives(): PersonAdressBuilder
    {
        return new PersonAdressBuilder($this->person);
    }
}

class PersonJobBuilder extends PersonBuilder
{
    public function __construct(Person $person)
    {
        $this->person = $person;
    }

    public function at(string $companyName): self
    {
        $this->person->companyName = $companyName;
        return $this;
    }

    public function asA(string $position): self
    {
        $this->person->position = $position;
        return $this;
    }

    public function earning(int $earning): self
    {
        $this->person->annualIncome = $earning;
        return $this;
    }
}

class PersonAdressBuilder extends PersonBuilder
{
    public function __construct(Person $person)
    {
        $this->person = $person;
    }

    public function at(string $streetAdress): self
    {
        $this->person->address = $streetAdress;
        return $this;
    }

    public function withPostcode(string $postcode): self
    {
        $this->person->postcode = $postcode;
        return $this;
    }

    public function in(string $city): self
    {
        $this->person->city = $city;
        return $this;
    }
}

class Demo
{
    public function __construct()
    {
        $pb = new PersonBuilder();
        $person = $pb->works()
            ->at("Logio")
            ->asA("developer")
            ->earning(10000000)
            ->lives()
            ->at("Nová 594")
            ->in("Praha")
            ->withPostcode(16100);
        var_dump($person);
    }
}
new Demo();
