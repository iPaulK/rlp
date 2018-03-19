<?php
namespace IPaulK\RLP\Types;

class IntegerType implements TypeInterface
{
    /**
     * Encode input
     * 
     * @param string $input
     * @param string $encoding
     * @return array
     */
    public static function encode($input, string $encoding = 'utf8')
    {
        $output = (int) $input;
        return [$output];
    }
}
