<?php

class User
{
    public string $fullName;

    /**
     * @param string $fullName
     */
    public function __construct(string $fullName)
    {
        $this->fullName = $fullName;
    }

}

class User2
{
    static array $strings = [];
    private array $names = [];

    public function __construct(string $fullName)
    {
        if($this->getOrAdd($fullName) == null)
        {
            $this->names[] = explode(' ', $fullName);
        }
        return $this->getOrAdd($fullName);
    }

    private function getOrAdd(string $fullName): ?int
    {
        if(array_search($fullName,self::$strings))
        {
            return array_search($fullName, self::$strings);
        }
        self::$strings[] = $fullName;
        return null;
    }
}

class Demo
{
    public function __construct()
    {
    }
}
new Demo();