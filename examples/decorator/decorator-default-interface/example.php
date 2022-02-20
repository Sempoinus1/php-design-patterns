<?php

interface ICreature
{

}

interface IBird extends ICreature
{
    public function fly(): void
    {

    }
}

class Demo
{
    public function __construct()
    {
    }
}
new Demo();