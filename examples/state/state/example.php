<?php

class SwitchElement
{
    public State $state;

    /**
     * @param State $state
     */
    public function __construct()
    {
        $this->state = new OffState();
    }

    public function on(): void
    {
        $this->state->on($this);
    }

    public function off(): void
    {
        $this->state->off($this);
    }
}

abstract class State
{
    public function on(SwitchElement $switchElement): void
    {
        echo("Light is already on \n");
    }
    public function off(SwitchElement $switchElement): void
    {
        echo("Light is already off \n");
    }
}

class OnState extends State
{
    public function __construct()
    {
        echo("Light turned on \n");
    }

    public function off(SwitchElement $switchElement): void
    {
        echo("Turning light off... \n");
        $switchElement->state = new OffState();
    }

}

class OffState extends State
{
    public function __construct()
    {
        echo("Light turned off \n");
    }

    public function on(SwitchElement $switchElement): void
    {
        echo("Turning light on... \n");
        $switchElement->state = new OnState();
    }

}


class Demo
{
    public function __construct()
    {
        $ls = new SwitchElement();
        $ls->on();
        $ls->off();
        $ls->off();
    }
}
new Demo();