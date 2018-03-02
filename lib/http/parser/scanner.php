<?php

namespace lib\http\parser;

use \lib\http\parser\Token as Token;
use \lib\http\parser\TokenType as TokenType;

use \lib\helper\obj as obj;
use \lib\helper\str as str;

class scanner
{
    private $tokens = [];

    private $input;
    private $cur = 0;
    private $len;

    public function __construct($input = null)
    {
        $this->input = $input;

        $this->cur = 0;
        $this->len = strlen($this->input);

        $this->scan();
    }

    // [key_condition_value]
    // [level=10], [level>=20&exp=200] ...

    private function scan()
    {
        if($this->input == null || $this->input == '') return false;

        for($this->cur; $this->cur < $this->len; $this->cur++)
        {
            if($this->cur > 0) {
                $p = $this->input[$this->cur - 1];
            }

            $c = $this->input[$this->cur];

            if($this->cur + 1 < $this->len) {
                $n = $this->input[$this->cur + 1];
            }

            if(!$this->isInGrammar($c)) break;

            switch ($c) {

                case '[':
                    $this->tokens[] = new Token(TokenTypes::START, '[');
                    break;

                case ']':
                    $this->tokens[] = new Token(TokenTypes::END, ']');
                    break;

                case '^':
                    $this->tokens[] = new Token(TokenTypes::_AND, 'and', 'conditional');
                    break;

                case '|':
                    $this->tokens[] = new Token(TokenTypes::_OR, 'or', 'conditional');
                    break;

                case '=':
                    $this->tokens[] = new Token(TokenTypes::EQUAL, '=', 'conditional');
                    break;

                case '>':

                    if($n == '=') {
                        $this->tokens[] = new Token(TokenTypes::GREATER_EQUAL, '>=', 'conditional');
                        $this->cur++;
                    } else {
                        $this->tokens[] = new Token(TokenTypes::GREATER, '>', 'conditional');
                    }

                    break;

                case '<':

                    if($n == '=') {
                        $this->tokens[] = new Token(TokenTypes::LESS_EQUAL, '<=', 'conditional');
                        $this->cur++;
                    } else {
                        $this->tokens[] = new Token(TokenTypes::LESS, '<', 'conditional');
                    }

                    break;

                default:

                    $str = '';

                    while($this->isAlphaNumeric($c)) {
                        $str .= $c;
                        $this->cur++;

                        if(!isset($this->input[$this->cur])) break;

                        $c = $this->input[$this->cur];
                    }

                    if(isset($this->input[$this->cur]))
                        $this->cur--;

                    if($str != '') {
                        $htmlInput = null;
                        if($c == '>' || $c == '>=' || $c == '<' || $c == '<=' || $c == '=') {
                            $htmlInput = $str;
                            $str = "`{$str}`";
                        } else {
                            $str = "'{$str}'";
                        }
                        $this->tokens[] = new Token(TokenTypes::ALPHANUMERIC, "{$str}", 'string', $htmlInput);
                    }

                    break;
            }
        }
    }

    private function isAlpha($c = '')
    {
        return ($c >= 'a' && $c <= 'z') ||
                ($c >= 'A' && $c <= 'Z') ||
                $c == '_' ||
                $c == '-';
    }

    private function isDigit($c)
    {
        return $c >= '0' && $c <= '9';
    }

    private function isAlphaNumeric($c)
    {
        return $this->isDigit($c) || $this->isAlpha($c);
    }

    private function isEnd($c)
    {
        return $c == ']';
    }

    private function isInGrammar($c)
    {
        return $c == '[' || $c == ']'
                || $c == '>' || $c == '<'
                || $c == '>=' ||  $c == '<='
                || $c == '^' || $c == '|'
                || $c == '='
                || $this->isAlphaNumeric($c);
    }

    private function isEndLine()
    {
        $this->cur + 1 < $this->len - 1;
    }

    public function getTokens()
    {
        return $this->tokens;
    }

    public function getTokensLength()
    {
        return count($this->tokens);
    }

}
