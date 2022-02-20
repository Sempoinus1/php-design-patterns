<?php namespace DesignPattern;


/*
 * Tenhle kurz učí, jedna třída by se neměla starat o všechny možné případy využití
 * měly by se využívat nové třídy, zde například k právě ukládání/načítání ze souboru
 * hlavním třídám stačí, co umí - přidávání, odebírání, čtení
 */

class Entities
{
    private $entries = [];

    public function add(string $text): void
    {
        $this->entries[] = $text;
    }

    public function remove(string $index): void
    {
        unset($this->entries[$index]);
    }

    /**
     * Vypíše jeden záznam jako string
     * @param int $index
     * @return string
     */
    public function get(int $index): string
    {
        return $this->entries[$index];
    }

    /**
     * Vypíše všechny záznamy jako array
     * @return array
     */
    public function getAll(): array
    {
        return $this->entries;
    }
}

class Journal
{
    protected readonly Entities $entries;

    private static int $count = 0;

    /**
     * Přidá záznam do listu
     * @param string $text
     * @return int
     */
    public function addEntry(string $text): int
    {
        self::$count++;
        $this->entries->add(self::$count . " " . $text);
        return self::$count;
    }

    /**
     * Vymaže záznam z listu
     * @param int $index
     * @return void
     */
    public function removeEntry(int $index): void
    {
        $this->entries->remove($index);
    }

    public function __construct()
    {
        $this->entries = new Entities();
    }

    public function __toString(): string
    {
        $returnString = "";
        foreach($this->entries->getAll() as $entry)
        {
            $returnString .= $entry . "\n";
        }
        return $returnString;
    }

    public function save(string $filename, string $path)
    {
        //už moc záznamů pro single responsibility
    }

    public function load()
    {
        //už moc záznamů pro single responsibility
    }
}

// pouzijeme metodu Persistence ktera se bude starat o dalsi vymozenosti
class Persistance
{
    public function saveToFile(Journal $journal, string $filename, string $path, bool $overwrite = false)
    {
        if($overwrite || !file_exists($path . $filename))
        {
            $file = fopen($path . $filename, "w+");
            fwrite($file, $journal);
            fclose($file);
        }
    }

    public function loadFromFile(string $filename, string $path): Journal
    {
        //TODO
    }
}


$journal = new Journal();
$journal->AddEntry("Ahoj");
$journal->AddEntry("Ahoj2");
echo($journal);
$persistence = new Persistance();
$persistence->saveToFile($journal, "journal", "/home/lausman/designpatterns", true);