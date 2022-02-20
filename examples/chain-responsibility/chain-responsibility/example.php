<?php

class Creature
{
    public string $name;
    public int $attack;
    public int $defense;

    /**
     * @param string $name
     * @param int $attack
     * @param int $defense
     */
    public function __construct(string $name, int $attack, int $defense)
    {
        $this->name = $name;
        $this->attack = $attack;
        $this->defense = $defense;
    }

    public function __toString(): string
    {
        return "Name: $this->name, Attack: $this->attack, Defense: $this->defense \n";
    }
}

class CreatureModifier
{
    protected Creature $creature;
    protected ?CreatureModifier $next; // linked list

    /**
     * @param Creature $creature
     * @param CreatureModifier $next
     */
    public function __construct(Creature $creature)
    {
        $this->creature = $creature;
        $this->next = null;
    }

    public function add(CreatureModifier $creatureModifier): void
    {
        if ($this->next != null)
        {
            $this->next->add($creatureModifier);
        }
        else
        {
            $this->next = $creatureModifier;
        }
    }
    public function handle(): void
    {
        $this->next?->handle();
    }
}

class DoubleAttackModifier extends CreatureModifier
{
    public function handle(): void
    {
        echo("Doubling {$this->creature->name}'s attack \n");
        $this->creature->attack *= 2;
        parent::handle();
    }
}

class IncreasedDefenseModifier extends CreatureModifier
{
    public function handle(): void
    {
        echo("Increasing {$this->creature->name}'s defense \n");
        $this->creature->defense += 1;
        parent::handle();
    }

}

class NoBonusesModifier extends CreatureModifier
{
    public function handle(): void
    {
        // magic
    }

}

class Demo
{
    public function __construct()
    {
        $goblin = new Creature("Goblin", "2", "1");
        echo($goblin);;

        $root = new CreatureModifier($goblin);
        echo("Let's double goblin's attack \n");
        $root->add(new DoubleAttackModifier($goblin));
        $root->add(new DoubleAttackModifier($goblin));
        $root->add(new DoubleAttackModifier($goblin));
        $root->add(new IncreasedDefenseModifier($goblin));
        $root->add(new NoBonusesModifier($goblin));
        $root->add(new IncreasedDefenseModifier($goblin));
        $root->add(new IncreasedDefenseModifier($goblin));
        $root->add(new DoubleAttackModifier($goblin));
        $root->add(new IncreasedDefenseModifier($goblin));
        $root->handle();
        echo($goblin);
    }
}

new Demo();