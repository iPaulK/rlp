<?php
namespace IPaulK\RLP\Types;

class StringType implements TypeInterface
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
        $output = [];
        switch ($encoding) {
            case 'hex':
                $output = self::fromHex($input);
                break;
            case 'ascii':
                $output = self::fromAscii($input);
                break;
            case 'utf8':
                $output = self::formUtf8($input);
                break;
            default:
                throw new InvalidArgumentException("The encoding didn\'t support.");
                break;
        }
        return $output;
    }
    /**
     * Returns the decimal equivalent of the hexadecimal number
     *
     * @param string $input
     * @return array
     */
    protected static function fromHex($input)
    {
        return array_map('hexdec', str_split($input, 2));
    }
    /**
     * Returns the ASCII for each character of string.
     *
     * @param string $input
     * @return array
     */
    protected static function fromAscii($input)
    {
        return array_map('ord', str_split($input, 1));
    }
    /**
     * Unpacks from a binary string into an array
     *
     * @param string $input
     * @return string
     */
    protected static function formUtf8($input)
    {
        return unpack('C*', $input);
    }
}
