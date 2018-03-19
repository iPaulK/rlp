<?php
namespace IPaulK\RLP\Types;

class ArrayType implements TypeInterface
{
    /**
     * Encode input
     * 
     * @param string $input
     * @param string $encoding
     * @return array
     * @throws InvalidArgumentException
     */
    public static function encode($input, string $encoding = 'utf8')
    {
        throw new InvalidArgumentException('Do not use multidimensional array.');
    }
}