<?php

interface IRenderer
{
    public function  RenderCircle(float $radius): void;
}

class VectorRenderer implements IRenderer
{
    public function RenderCircle(float $radius): void
    {
        echo("drawing a circle of radius $radius");
    }
}

class RasterRenderer implements IRenderer
{
    public function RenderCircle(float $radius): void
    {
        echo("drawing pixels for circle with radius $radius");
    }
}

abstract class Shape
{
    protected IRenderer $renderer;

    /**
     * @param IRenderer $renderer
     */
    public function __construct(IRenderer $renderer)
    {
        $this->renderer = $renderer;
    }

    public abstract function Draw(): void;
    public abstract function Resize(float $factor): void;
}

class Circle extends Shape
{
    private float $radius;

    /**
     * @param float $radius
     */
    public function __construct(IRenderer $renderer, float $radius)
    {
        parent::__construct($renderer);
        $this->radius = $radius;
    }

    public function Draw(): void
    {
        $this->renderer->RenderCircle($this->radius);
    }

    public function Resize(float $factor): void
    {
        $this->radius *= $factor;
    }
}

class Demo
{
    public function __construct()
    {
        //$renderer = new RasterRenderer();
        $renderer = new VectorRenderer();
        $circle = new Circle($renderer, 5);
        $circle->Draw();
        $circle->Resize(5);
        $circle->Draw();
    }
}

new Demo();