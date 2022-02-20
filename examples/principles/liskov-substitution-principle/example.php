<?php namespace DesignPattern;

// idea - měly bychom být schopni nahradit základní typ za náhradní typ

use JetBrains\PhpStorm\Pure;

class Rectangle
{
    private int $width;
    private int $height;

    /**
     * @param int $width
     * @param int $height
     */
    public function __construct(int $width = 0, int $height = 0)
    {
        $this->width = $width;
        $this->height = $height;
    }

    /**
     * @return int
     */
    public function getWidth(): int
    {
        return $this->width;
    }

    /**
     * @param int $width
     */
    public function setWidth(int $width): void
    {
        $this->width = $width;
    }

    /**
     * @return int
     */
    public function getHeight(): int
    {
        return $this->height;
    }

    /**
     * @param int $height
     */
    public function setHeight(int $height): void
    {
        $this->height = $height;
    }

    public function __toString(): string
    {
        return "Width: $this->width, Height: $this->height";
    }
}

class Square extends Rectangle
{
    public function __construct(int $size = 0)
    {
        parent::__construct($size, $size);
    }
}

class Demo
{

    public static function area(Rectangle $r): int
    {
        return $r->getHeight() * $r->getWidth();
    }

    public function __construct(int $width = 0, int $height = 0)
    {
        $rect = new Rectangle(2,3);
        echo("$rect has area ". self::area($rect) . " \n");

        $sq = new Square(5);
        echo("$sq has area ". self::area($sq) . " \n");

    }
}

new Demo();