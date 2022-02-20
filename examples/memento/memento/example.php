<?php

class Memento
{
    private int $balance;

    /**
     * @param int $balance
     */
    public function __construct(int $balance)
    {
        $this->balance = $balance;
    }

    /**
     * @return int
     */
    public function getBalance(): int
    {
        return $this->balance;
    }
}

class BankAccount
{
    private int $balance;

    /**
     * @param int $balance
     */
    public function __construct(int $balance)
    {
        $this->balance = $balance;
    }

    public function deposit(int $amount): Memento
    {
        $this->balance += $amount;
        return new Memento($this->balance);
    }

    public function restore(Memento $m): void
    {
        $this->balance = $m->getBalance();
    }

    public function __toString(): string
    {
        return "Balance: $this->balance \n";
    }

}

class Demo
{
    public function __construct()
    {
        $ba = new BankAccount(1000);
        $m1 = $ba->deposit(200); // 800
        $m2 = $ba->deposit(500); // 300
        echo($ba);

        $ba->restore($m1);
        echo($ba);

        $ba->restore($m2);
        echo($ba);
    }
}
new Demo();