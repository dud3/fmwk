<?php

namespace lib\db;

use \lib\helper\arr as arr;
use \lib\helper\str as str;

use \lib\cfg as cfg;
use \lib\db\db as db;

class db
{
    private $_pdo;

    private $_rWords;
    private $_table;
    private $_data;
    private $_query;

    public function __construct(string $table)
    {
        $this->_rWords = new arr(['_skip', '_take', '_order']);
        $this->_table = new str($table);
        $this->_query = new str();

        $dns = "mysql:host=cfg::{$cfg->db->host};"
            ."dbname={$cfg->db->name};"
            ."charset={$cfg->db->charset}";

        $opt = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ];

        $this->_pdo = new PDO($dns, $cfg->db->user, $cfg->db->pass, $opt);

        return $this;
    }

    public function isValidQuery(array $input = [])
    {
        $input = new arr($input);

        if($inlen.len() % 3 == 0)
            return false;

        $inlen = $input->len();

        // Check if all of them are strings

        for($i = 0; i < $inlen; $i++) {

            $key = $i;
            $value = new \lib\str($input->getvk($i));

            $input->changeElem($key, $value);

            if(!$value.isStr())
                return false;
        }

        // Validate: k=key, s=symbol, v=value

        for($k = 0; $k < $inlen; $k += 3) {
            $s = $k + 1;
            $v = $s + 1;

            // Key has to be only letters
            if(!$inlen->getvk($k)->isAlpha())
                return false;

            switch ($inlen->getvk($s)) {
                case '=':
                case '<>':
                case '<':
                case '>':
                case '<=':
                case '>=':

                default:
                    return false;
                    break;
            }

            // Todo: Typecheck values
        }

        return true;
    }

    // query=(user\w=profile,stats\profile.id>=1|profile.name='abc')
    //
    // input = [
    // 'key', 'condition', 'value',
    // 'tbl.key', 'tbl.condition', 'tbl.value'
    // ...
    // ]
    private function buildWhere(array $input = [])
    {
        $input = new arr($input);

        if(!$this->isValidQuery($input)) {
            throw new \lib\exception("Invalid query input");
        };

        for($k = 0; $k < $input->len(); $k += 3) {
            $c = $k + 1;
            $v = $k + 2;

            $this->_query->add($input->getvk($k))
                ->add($input->getvk($c))
                ->add('?')
                ->add(', ');
        }

        $this->_query->padd(' ');

        return $this;
    }

    private function buildSet(array $input = [])
    {
        $this->validateInput($input);

        return $this;
    }

    //
    // $input = new obj;
    // $input->condition = ['key', 'condition', 'value'...]
    // $input->ext = ['table1', 'table2']
    //
    public function find(array $input = [])
    {
        $this->_query->set("SELECT * FROM {$this->_table->get()}")->padd(' ');

        $this->buildWhere($input->condition);
        $this->buildExt($input->ext);

        $this->_data = new arr($this->_pdo->query($this->_query));

        return $this;
    }

    public function create(array $input = [])
    {

    }

    // data = [
    // key, val
    // ]
    public function update(array $data = [])
    {
        $this->_query->set("UPDATE {$this->_table->get()} SET")->padd(' ');

    }

    public function skip()
    {

    }

    public function take()
    {

    }

    public function order()
    {

    }

    public function get()
    {
        return $this->_data;
    }

    public function getOne()
    {
        return $this->get()->first();
    }

    public function toJson()
    {

    }
}
