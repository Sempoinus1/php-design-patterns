<?php

class CEO
{
    private static string $name;
    private static int $age;

    /**
     * @return string
     */
    public function getName(): string
    {
        return self::$name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        self::$name = $name;
    }

    /**
     * @return int
     */
    public function getAge(): int
    {
        return self::$age;
    }

    /**
     * @param int $age
     */
    public function setAge(int $age): void
    {
        self::$age = $age;
    }
}

class Demo
{
    public function __construct()
    {
        $ceo = new CEO();
        $ceo->setAge(60);
        $ceo->setName("Joe");

        $ceo2 = new CEO();
        echo($ceo2->getAge() . " " . $ceo2->getName());
    }
}

new Demo();