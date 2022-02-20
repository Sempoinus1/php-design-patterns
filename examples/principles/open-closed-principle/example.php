<?php namespace DesignPattern;

enum Color
{
    case Red;
    case Blue;
    case Yellow;
    case Green;
}

enum Size
{
    case Small;
    case Medium;
    case Large;
}

class Product
{
    public string $name;
    public Color $color;
    public Size $size;

    /**
     * @param string $name
     * @param Color $color
     * @param Size $size
     */
    public function __construct(string $name, Color $color, Size $size)
    {
        $this->name = $name;
        $this->color = $color;
        $this->size = $size;
    }
}

/* není open-close principle
* u Open-close principle by mělo být možné dědit tuto třídu ale samotná třída ProductFilter by měla být uzavřená pro modifikace
*/
class ProductFilter
{
    public function FilterBySize(array $products, Size $size)
    {
        foreach($products as $p)
        {
            if($p->size == $size)
            {
                yield $p;
            }
        }
    }

    public function FilterByColor(array $products, Color $color)
    {
        foreach($products as $p)
        {
            if($p->color == $color)
            {
                yield $p;
            }
        }
    }

    public function FilterBySizeAndColor(array $products, Color $color, Size $size)
    {
        foreach($products as $p)
        {
            if($p->color == $color && $p->size == $size)
            {
                yield $p;
            }
        }
    }
}

interface ISpecification
{
    public function IsSatisfied(Product $t): bool;
}
interface IFilter
{
    public function  Filter(array $t, ISpecification $specs);
}

class ColorSpecification implements ISpecification
{
    private Color $color;

    /**
     * @param Color $color
     */
    public function __construct(Color $color)
    {
        $this->color = $color;
    }

    public function IsSatisfied(Product $t): bool
    {
        return $t->color == $this->color;
    }
}

class SizeSpecification implements ISpecification
{
    private Size $size;

    /**
     * @param Size $size
     */
    public function __construct(Size $size)
    {
        $this->size = $size;
    }

    public function IsSatisfied(Product $t): bool
    {
        return $t->size == $this->size;
    }

}

class AndSpecification implements ISpecification
{
    private ISpecification $firstSpec;
    private ISpecification $secondSpec;

    /**
     * @param ISpecification $color
     * @param ISpecification $size
     */
    public function __construct(ISpecification $color, ISpecification $size)
    {
        $this->firstSpec = $color;
        $this->secondSpec = $size;
    }

    public function IsSatisfied(Product $t): bool
    {
        return $this->firstSpec->IsSatisfied($t) && $this->secondSpec->IsSatisfied($t);
    }
}

class BetterFilter implements IFilter
{
    public function Filter(array $t, ISpecification $specs): \Generator
    {
        foreach($t as $item)
        {
            if($specs->IsSatisfied($item))
            {
                yield $item;
            }
        }
    }
}
$products[] = new Product("Pivo", Color::Green, Size::Large);
$products[] = new Product("Jogurt", Color::Yellow, Size::Large);
$products[] = new Product("Kapesníčky", Color::Red, Size::Medium);
$products[] = new Product("Voda", Color::Green, Size::Medium);
$products[] = new Product("Jahody", Color::Red, Size::Small);

$pf = new ProductFilter();
foreach($pf->FilterBySize($products, Size::Large) as $filteredProduct)
{
    var_dump($filteredProduct);
}
echo('----');
echo("\n Red products \n");
$f = new BetterFilter();
foreach($f->Filter($products, new ColorSpecification(Color::Red)) as $filteredProduct) {
    var_dump($filteredProduct);
}
echo('----');
echo("\n Large Green products \n");
foreach($f->Filter($products, new AndSpecification(new ColorSpecification(Color::Green), new SizeSpecification(Size::Large))) as $filteredProduct)
{
    var_dump($filteredProduct);
}