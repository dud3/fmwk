<?php

namespace lib\http\parser;

abstract class tokenTypes
{
    const START = 'start';
    const END = 'end';
    const _AND = 'and';
    const _OR = 'or';
    const EQUAL = 'equal';
    const GREATER = 'greater'; const GREATER_EQUAL = 'greater_equal';
    const LESS = 'less'; const LESS_EQUAL = 'less_equal';
    const ALPHANUMERIC = 'alphanumeric';
}
