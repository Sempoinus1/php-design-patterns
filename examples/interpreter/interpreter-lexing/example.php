<?php

enum Type
{
    case Integer;
    case Plus;
    case Minus;
    case Lparen;
    case Rparen;
}
class Token
{
    public Type $type;
    public string $text;

    /**
     * @param Type $type
     * @param string $text
     */
    public function __construct(Type $type, string $text)
    {
        $this->type = $type;
        $this->text = $text;
    }

    public function __toString(): string
    {
        return "`$this->text`";
    }
}

class Demo
{
    public static function lex(string $input): array
    {
        $result = [];
        for ($i = 0; $i < strlen($input); $i++)
        {
            switch ($input[$i])
            {
                case '+':
                    $result[] = new Token(Type::Plus, "+");
                    break;
                case '-':
                    $result[] = new Token(Type::Minus, "-");
                    break;
                case '(':
                    $result[] = new Token(Type::Lparen, "(");
                    break;
                case ')':
                    $result[] = new Token(Type::Rparen, ")");
                    break;
                default:
                    $string = $input[$i];
                    for ($j = $i + 1; $j < strlen($input); ++$j)
                    {
                        if(is_int($input[$j]))
                        {
                            $string .= $input[$j];
                            ++$i;
                        }
                        else
                        {
                            $result[] = $string;
                            break;
                        }
                    }
            }
        }
    }

    public function __construct()
    {
        // potrebujeme rozdelit tento string do ruznych tokenu (, 13, 4, ) ...
        $input = "(13+4)-(12+1)";
        $tokens = self::lex($input);
        var_dump($tokens);
    }
}
new Demo();