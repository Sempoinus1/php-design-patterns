<?php

class BankAccount
{
    private int $balance = 0;
    private int $overdraftLimit = -500;

    public function deposit(int $amount): void
    {
        $this->balance += $amount;
        echo("Deposited {$amount} CZK, balance is now {$this->balance} CZK \n");
    }

    public function withdraw (int $amount): bool
    {
        if($this->balance >= $this->overdraftLimit)
        {
            $this->balance -= $amount;
            echo("Withdrew $amount CZK, balance is now $this->balance \n");
            return true;
        }
        return false;
    }

    public function __toString(): string
    {
        return "Balance: $this->balance, overdraftLimit: $this->overdraftLimit \n";
    }


}

interface ICommand
{
    public function call(): void;
    public function undo(): void;
}
enum Action
{
    case Deposit;
    case Withdraw;
}

class BankAccountCommand implements ICommand
{
    private BankAccount $account;
    private Action $action;
    private int $amount;
    private bool $succeded;
    /**
     * @param BankAccount $account
     * @param Action $action
     * @param int $amount
     */
    public function __construct(BankAccount $account, Action $action, int $amount)
    {
        $this->account = $account;
        $this->action = $action;
        $this->amount = $amount;
    }

    /**
     * @throws Exception
     */
    public function call(): void
    {
        switch ($this->action)
        {
            case Action::Deposit:
                $this->account->deposit($this->amount);
                $this->succeded = true;
                break;
            case Action::Withdraw:
                $this->succeded = $this->account->withdraw($this->amount);
                break;
            default:
                throw new Exception("Action not defined");
        }
    }

    /**
     * @throws Exception
     */
    public function undo(): void
    {
        if (!$this->succeded)
        {
           return;
        }
        switch ($this->action)
        {
            case Action::Deposit:
                $this->account->withdraw($this->amount);
                break;
            case Action::Withdraw:
                $this->account->deposit($this->amount);
                break;
            default:
                throw new Exception("Action not defined");
        }
    }

}

class Demo
{
    public function __construct()
    {
        $ba = new BankAccount();
        $commands =
            [
                new BankAccountCommand($ba, Action::Deposit, 50000),
                new BankAccountCommand($ba, Action::Withdraw, 1000),
            ];
        foreach ($commands as $command)
        {
            $command->call();
        }
        echo($ba);

        foreach (array_reverse($commands) as $command)
        {
            $command->undo();
        }
        echo($ba);

    }
}
new Demo();