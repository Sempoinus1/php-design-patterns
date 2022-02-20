<?php

interface IBird
{
    public function fly(): void;
}

interface ILizard
{
    public function crawl(): void;
}

class Bird implements IBird
{
    public int $weight;
    public function fly(): void
    {
        echo("Flying with weight $this->weight  \n");
    }
}
class Lizard implements ILizard
{
    public int $weight;
    public function crawl(): void
    {
        echo("Crawling with weight $this->weight \n");
    }
}

class Dragon implements ILizard, IBird
{
    private Bird $bird;
    private Lizard $lizard;
    private int $weight;

    /**
     * @param Bird $bird
     * @param Lizard $lizard
     */
    public function __construct()
    {
        $this->bird = new Bird();
        $this->lizard = new Lizard();
        $this->weight = $this->lizard->weight = $this->bird->weight = 5;
    }

    public function fly(): void
    {
        $this->bird->fly();
    }

    public function crawl(): void
    {
        $this->lizard->crawl();
    }

}

class Demo
{
    public function __construct()
    {
        $d = new Dragon();
        $d->fly();
        $d->crawl();
    }
}

new Demo();