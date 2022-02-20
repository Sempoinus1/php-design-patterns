<?php

interface IDatabase
{
    public function getPopulation(string $name): int;
}

class SingletonDatabase implements IDatabase
{
    private static $instance = null;
    private array $capitals; // Array ['capital']['population'];
    private function __construct()
    {
        echo("Initializing");
        $lines = file("capitals.txt");
        foreach($lines as $line)
        {
            $pieces = explode(";", $line);
            $this->capitals[] = ['capital' => $pieces[0], 'population' => $pieces[1]];
        }
    }

    /**
     * @throws Exception
     */
    public function getPopulation(string $name): int
    {
        foreach($this->capitals as $capital)
        {
            if(array_search($name, $capital))
            {
                return $capital['population'];
            }
        }
        throw new Exception("Name does not exists");
    }

    public static function getInstance(): ?SingletonDatabase
    {
        if(self::$instance == null)
        {
            self::$instance = new SingletonDatabase();
        }
        return self::$instance;
    }

}

class Demo
{
    /**
     * @throws Exception
     */
    public function __construct()
    {
        $db = SingletonDatabase::getInstance();
        echo($db->getPopulation("Tokyo"));
    }
}

new Demo();