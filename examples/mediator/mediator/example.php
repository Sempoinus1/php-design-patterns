<?php

class Person
{
    public string $name;
    public ChatRoom $room;
    private array $chatLog = [];

    /**
     * @param string $name
     */
    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public function say(string $message): void
    {
        $this->room->broadcast($this->name, $message);
    }

    public function privateMessage(string $who, string $message): void
    {
        $this->room->message($this->name, $who, $message);
    }

    public function receive(string $sender, string $message): void
    {
        $s = "$sender: '$message'";
        $this->chatLog[] = $s;
        echo("[$this->name's chat session] $s \n");
    }

}

class ChatRoom
{
    private array $people = []; // array of People
    public function join(Person $p): void
    {
        $joinMsg = "{$p->name} joins the chat \n";
        $this->broadcast("room", $joinMsg);
        $p->room = $this;
        $this->people[] = $p;
    }

    public function broadcast(string $source, string $message): void
    {
        foreach ($this->people as $person)
        {
            if($person->name != $source)
            {
                $person->receive($source, $message);
            }
        }
    }

    public function message(string $source, string $dest, string $message): void
    {
        if ($key = array_search($dest, $this->people))
        {
            $this->people[$key]->receive($source, $message);
        }
    }
}

class Demo
{
    public function __construct()
    {
        $room = new ChatRoom();
        $john = new Person("John");
        $jane = new Person("Jane");
        $room->join($john);
        $room->join($jane);
        $john->say("hi");
        $jane->say("hey");

        $simon = new Person("Simon");
        $room->join($simon);
        $simon->say("hii");

        $jane->privateMessage("Simon", "glad you could join us");
    }
}
new Demo();