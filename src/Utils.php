<?php
namespace IPaulK\RLP;

class Utils
{
    /**
     * @param array $data
     * @return array
     */
    public static function toUTF8(array $data)
    {
        $output = [];
        foreach ($data as $ascii)  {
            $output[] = chr($ascii);
        }
        return $output;
    }
    /**
     * @param array $data
     * @return array
     */
    public static function toHEX(array $data)
    {
        $output = [];
        foreach ($data as $number)  {
            $output[] = '0x' . self::intToBinary($number) . ',';
        }
        return $output;
    }
    /**
     * @param int $value
     * @return string
     * @throws InvalidArgumentException
     */
    public static function intToBinary($value)
    {
        if (!is_int($value)) {
            throw new InvalidArgumentException("Value must be int.");
        }
        $hex = dechex($value);
        $hex = self::padToEven($hex);
        return $hex;
    }
    /**
     * @param string $value
     * @return int
     */
    public static function hexLength(string $value)
    {
        return strlen(str_replace('0x', '', $value));
    }
    /**
     * @param string $value
     * @return string
     */
    protected static function padToEven(string $value)
    {
        if ((strlen($value) % 2) !== 0 ) {
            $value = '0' . $value;
        }
        return $value;
    }
    /**
     * @param array $data
     * @return string
     */
    // public static function presentation(array $data)
    // {
    //     $result = [];
    //     foreach ($data as $ascii)  {
    //         if ($ascii < 0x80) {
    //             $result[] = chr($ascii);
    //         } else {
    //             $result[] = '0x' . self::intToBinary($ascii);
    //         }
    //     }
    //     return $result;
    // }
}
