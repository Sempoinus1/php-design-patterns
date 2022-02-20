<?php namespace DesignPattern;

// vyšší úrovně systému by neměly přímo záviset na nižších úrovních systému

//geneology relationship
enum Relationship
{
    case Parent;
    case Child;
    case Sibling;
}

interface IRelationBrowser
{
    public function FindAllChildrenOf(string $name);
}

class Person
{
    public string $name;
    //public $dateOfBirth;
}

//low-level
//definice relationshipů
class Relationships implements IRelationBrowser
{
    private array $relations; // [person][relation][to]

    public function addParentAndChild(Person $parent, Person $child): void
    {
        $this->relations[] = ["person" => $parent, "relation" => Relationship::Parent, "to" => $child];
        $this->relations[] = ["person" => $child, "relation" => Relationship::Child, "to" => $parent];
    }

    public function listOFRelationships(): array
    {
        return $this->relations;
    }

    //low-level module který nedependuje na další low-level ale na abstrakci
    public function FindAllChildrenOf(string $name): \Generator
    {
        foreach($this->relations as $r)
        {
            if($r['person']->name == $name && in_array(Relationship::Parent, $r))
            {
                //echo("Osoba " . $r['person']->name . " je v rodičovským vztahu k " . $r['to']->name . "\n");
                yield $r['to']->name;
            }

        }
    }
}

// exposujeme private promennou do public - dependujeme na low-level systemu
class Research
{
    public function __construct(Relationships $relationships)
    {
        $relations = $relationships->listOFRelationships();
        foreach($relations as $r)
        {
            if(in_array(Relationship::Parent, $r))
            {
                echo("Osoba " . $r['person']->name . " je v rodičovským vztahu k " . $r['to']->name . "\n");
            }
        }
    }
}

class ResearchNew
{
    public function __construct(IRelationBrowser $browser)
    {
        foreach($browser->FindAllChildrenOf("John") as $child)
        {
            echo($child . " je Johnovo dítě. \n");
        }
    }
}

class Demo
{
    public function __construct()
    {
        $parent = new Person();
        $parent->name = "John";
        $child1 = new Person();
        $child1->name = "Chris";
        $child2 = new Person();
        $child2->name = "Mary";

        $relationships = new Relationships();
        $relationships->addParentAndChild($parent, $child1);
        $relationships->addParentAndChild($parent, $child2);

        new ResearchNew($relationships);
    }
}

new Demo();