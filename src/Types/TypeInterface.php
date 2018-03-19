<?php
namespace IPaulK\RLP\Types;

interface TypeInterface
{
    public static function encode($input, string $encoding = 'utf8');
}
