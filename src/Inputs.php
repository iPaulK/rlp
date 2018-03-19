<?php
namespace IPaulK\RLP;

class Inputs
{
    /**
     * Encode inputs
     * 
     * @param array $inputs
     * @param string $encoding
     * @return array
     */
    public static function encode(array $inputs = [], string $encoding = 'utf8')
    {
        $data = [];
        foreach ($inputs as $input) {
            $decorator = self::createInputDecorator($input);
            if (!self::isValidDecorator($decorator)) {
                throw new InvalidArgumentException('The input type didn\'t support.');
            }
            $data = array_merge($data, $decorator::encode($input, $encoding));
        }
        return $data;
    }
    /**
     * Create input decorator
     * 
     * @param string $input
     * @return string
     */
    private static function createInputDecorator($input)
    {
        return __NAMESPACE__ . '\\Types\\' . ucwords(gettype($input)) . 'Type';
    }
    /**
     * Check if decorator is valid
     * 
     * @param string $decorator
     * @return bool
     */
    private static function isValidDecorator($decorator)
    {
        return class_exists($decorator);
    }
}
