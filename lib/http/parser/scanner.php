<?php

namespace lib\http\parser;

use \lib\http\parser\Token as Token;
use \lib\http\parser\TokenType as TokenType;

use \lib\helper\obj as obj;
use \lib\helper\str as str;

class scanner
{
    private $tokens = [];

    private $source;
    private $start = 0;
    private $cur = 0;
    private $len;

    private $error;

    public function __construct($source = null)
    {
        $this->source = $source;

        $this->len = strlen($this->source);

        $this->error = new obj(['error' => false, 'msg' => new str('')]);

        $this->scan();
    }

    private function scanTokens()
    {
        while(!$this->isAtEnd()) {
            $this->start = $this->cur;

            $this->scan();
        }

        return $this->tokens;
    }

    // [key_condition_value]
    // [level=10], [level>=20&exp=200] ...

    private function scan()
    {
        if($this->source == null || $this->source == '') return false;

        $c = $this->advance();

        switch ($c) {

            case '[':
                $this->tokens[] = new Token(TokenTypes::START, '[');
                break;

            case ']':
                $this->tokens[] = new Token(TokenTypes::END, ']');
                break;

            case '/':
                $this->tokens[] = new Token(TokenTypes::SLASH, '/');
                break;

            case ' ':
            case '\r':
            case '\t':
                // Ignore.
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

                if($this->peek() == '=') {
                    $this->tokens[] = new Token(TokenTypes::GREATER_EQUAL, '>=', 'conditional');
                    $this->cur++;
                } else {
                    $this->tokens[] = new Token(TokenTypes::GREATER, '>', 'conditional');
                }

                break;

            case '<':

                if($this->peek() == '=') {
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

                    if(!isset($this->source[$this->cur])) break;

                    $c = $this->source[$this->cur];
                }

                if(isset($this->source[$this->cur]))
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

    private function advance()
    {
        $this->cur++;
        return $this->source[$this->cur - 1];
    }

    private function match(string $expected)
    {
        if($this->isAtEnd()) return false;
        if($this->source[$this->cur] != $expected) return false;

        $this->cur++;
        return true;
    }

    private function peek()
    {
        if($this->isEndLine()) return '\0';
        return $this->source[$this->cur]; // lookahead: one further than actual current
    }

    private function peekNext()
    {
        if ($this->cur + 1 >= $this->len) return '\0';
        return $this->source[$this->cur + 1];
    }

    private function isAlpha(string $c = '')
    {
        return ($c >= 'a' && $c <= 'z') ||
                ($c >= 'A' && $c <= 'Z') ||
                $c == '_' ||
                $c == '-';
    }

    private function isDigit(string $c)
    {
        return $c >= '0' && $c <= '9';
    }

    private function isAlphaNumeric(string $c)
    {
        return $this->isDigit($c) || $this->isAlpha($c);
    }

    private function isInGrammar(string $c)
    {
        return $c == '[' || $c == ']'
                || $c == '>' || $c == '<'
                || $c == '>=' ||  $c == '<='
                || $c == '^' || $c == '|'
                || $c == '='
                || $this->isAlphaNumeric($c);
    }

    private function isAtEnd()
    {
        $this->cur < $this->len - 1;
    }

    public function getTokens()
    {
        return $this->tokens;
    }

    public function getTokensLength()
    {
        return count($this->tokens);
    }

    private static function error(string $where, string $msg)
    {
        $this->error->get()->msg->set("Error at {$where}, {$msg}");

        return $this->error;
    }

}
