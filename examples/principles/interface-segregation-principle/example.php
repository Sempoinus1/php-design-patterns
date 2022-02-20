<?php namespace DesignPattern;

// idea - oddělování interfaců tak aby každý kdo chce implementovat můj interface nemusel používat všechny třídy které ve skutečnosti nepotřebuje
// místo jednoho interfacu je lepší mít spoustu malých interfaců
interface IMachine
{
    public function print(Document $document): void;
    public function scan(Document $document): void;
    public function fax(Document $document): void;
}

interface IPrinter
{
    public function print(Document $doc): void;
}

interface IScanner
{
    public function scan(Document $doc): void;
}

// i toto je správná implementace jelikož interface může dědit od ostatních
interface IMultiFunctionDevice extends IPrinter, IScanner
{

}

class Document implements IMachine
{
    public function print(Document $document): void
    {
        // TODO: Implement print() method.
    }

    public function scan(Document $document): void
    {
        // TODO: Implement scan() method.
    }

    public function fax(Document $document): void
    {
        // TODO: Implement fax() method.
    }
}


// klasická tiskárna, neumí skenovat, neumí faxovat, pouze tiskount - náš interface který se stará o vše je k ničemu jelikož tolik funkcí nepotřebujeme
class Printer implements IMachine
{
    public function print(Document $document): void
    {
        // tenhle stačí jelikož tiskárna neumí nic jiného
    }

    public function scan(Document $document): void
    {
        // useless
    }

    public function fax(Document $document): void
    {
        // useless
    }
}

// správná implementace - využíváme opravdu jen to co potřebujeme
class PhotoCopier implements IPrinter, IScanner
{
    public function print(Document $doc): void
    {
        // TODO: Implement print() method.
    }

    public function scan(Document $doc): void
    {
        // TODO: Implement scan() method.
    }
}

class MultiFunctionMachine implements IMultiFunctionDevice
{
    private IPrinter $printer;
    private IScanner $scanner;

    /**
     * @param IPrinter $printer
     * @param IScanner $scanner
     */
    public function __construct(IPrinter $printer, IScanner $scanner)
    {
        $this->printer = $printer;
        $this->scanner = $scanner;
    }

    //Decorator pattern
    public function print(Document $doc): void
    {
        $this->printer->print($doc);
    }

    public function scan(Document $doc): void
    {
        $this->scanner->scan($doc);
    }
}

class Demo
{

}
