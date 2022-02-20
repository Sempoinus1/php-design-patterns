<?php

class GraphicObject
{
    public string $color;
    public string $name = "Group";
    public array $children; // array of GraphicObject

    private function print(int $depth)
    {
        $string = str_repeat("*", $depth);
        $string .= $this->color == null ? $this->color : "";
        $string .= $this->name;
        foreach($this->children as $child)
        {
            $child->print($depth + 1);
        }
    }

    public function __toString(): string
    {
        $this->print(0);
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getChildren(): array
    {
        return $this->children;
    }

    public function addChildern(GraphicObject $graphicObject): void
    {
        $this->children[] = $graphicObject;
    }

}

class Circle extends GraphicObject
{
    public function __construct()
    {
        parent::setName("Circle");
    }
}

class Square extends GraphicObject
{
    public function __construct()
    {
        parent::setName("Square");
    }
}

class Demo
{
    public function __construct()
    {
        $drawing = new GraphicObject();
        $drawing->name = "Drawing";
        $sq = new Square();
        $sq->color = "Red";
        $cq = new Circle();
        $cq->color = "Yellow";
        $drawing->addChildern($sq);
        $drawing->addChildern($cq);

        $group = new GraphicObject();
        $cq = new Circle();
        $cq->color = "Blue";
        $sq = new Square();
        $sq->color = "Blue";
        $group->addChildern($cq);
        $group->addChildern($sq);
        $drawing->addChildern($group);
        echo($drawing);
    }
}

new Demo();