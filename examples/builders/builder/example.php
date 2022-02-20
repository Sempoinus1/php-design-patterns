<?php namespace DesignPattern;

class HtmlElement
{
    public string $name;
    public string $text;
    public array $elements;
    private const identSize = 4;

    /**
     * @param string $name
     * @param string $text
     */
    public function __construct(string $name = "", string $text = "")
    {
        $this->name = $name;
        $this->text = $text;
        $this->elements = [];
    }

    private function ToStringImpl(int $indent): string
    {
        $string = "";
        $i = str_repeat(' ', $indent * self::identSize);
        $string .= "$i<$this->name> \n";

        if($this->text != null || $this->text != "")
        {
            $string .= str_repeat(' ', ($indent + 1) * self::identSize);
            $string .= "$this->text \n";
        }

        foreach($this->elements as $element)
        {
            $string .= $element->ToStringImpl($indent + 1);
        }

        $string .= "$i</$this->name> \n";
        return $string;
    }

    public function __toString(): string
    {
       return $this->ToStringImpl(0);
    }
}

class HtmlBuilder
{
    private readonly string $rootName;
    public HtmlElement $root;

    public function __construct(string $rootName)
    {
        $this->rootName = $rootName;
        $this->root = new HtmlElement();
        $this->root->name = $rootName;
    }

    public function AddChild(string $childName, string $childText): void
    {
        $e = new HtmlElement($childName, $childText);
        $this->root->elements[] = $e;
    }

    public function __toString(): string
    {
        return $this->root->__toString();
    }

    public function clear(): void
    {
        $root = new HtmlElement();
    }
}

class Demo
{
    public function __construct()
    {
        $builder = new HtmlBuilder("ul");
        $builder->AddChild("li", "hello");
        $builder->AddChild("li", "world");
        echo($builder->__toString());
    }
}

new Demo();