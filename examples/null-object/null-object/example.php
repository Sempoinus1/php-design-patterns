<?php
interface ILog
{
    public function info(string $msg);
    public function warn(string $msg);
}

class ConsoleLog implements ILog
{
    public function info(string $msg)
    {
        echo($msg);
    }

    public function warn(string $msg)
    {
        echo("[WARN]: $msg");
    }
}

class BankAccount
{
    private ILog $log;
    private int $balance = 0;

    /**
     * @param ILog|null $log
     */
    public function __construct(ILog $log)
    {
        $this->log = $log;
    }

    public function deposit(int $amount)
    {
        $this->balance += $amount;
        $this->log->info("Deposited $amount, balance is now $this->balance \n");
    }

}

// null object
class NullLog implements ILog
{
    public function info(string $msg)
    {
    }

    public function warn(string $msg)
    {
    }

}

class Demo
{
    public function __construct()
    {
        $ba = new BankAccount(new NullLog());
        $ba->deposit(100);
    }
}
new Demo();