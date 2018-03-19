<?php
namespace IPaulK\RLP;

class Encoder
{
    /**
     * Encode a array or a string to RLP format.
     * 
     * @param mixed $inputs
     * @return array
     */
    public function encode($inputs)
    {
        if (is_string($inputs) || is_numeric($inputs)) {
            return $this->encodeString($inputs);
        } else if (is_array($inputs)) {
            $output = [];
            foreach ($inputs as $input) {
                $output = array_merge($output, $this->encode($input));
            }
            $length = count($output);
            $encodeLength = $this->encodeLength($length, 0xc0);
            return array_merge($encodeLength, $output);
        }
    }
    /**
     * Encode a string to RLP format.
     * 
     * @param string $inputs
     * @return array
     */
    protected function encodeString($inputs)
    {
        $inputs = $this->prepareInputs($inputs);
        $length = count($inputs);

        if ($length === 1 && ord($inputs[0]) < 0x80) {
            return [$inputs[0]];
        } 
        
        return array_merge($this->encodeLength($length, 0x80), $inputs);
    }
    /**
     * Encode Length
     * 
     * @param int $length
     * @param int $offset
     * @return array
     * @throws InvalidArgumentException
     */ 
    protected function encodeLength(int $length, int $offset)
    {
        if ($length < 56) {
            $inputs[] = $length + $offset;
            $output = Inputs::encode($inputs);
        } elseif ($length < 256**8) {
            $hexValue = Utils::intToBinary($length);
            $hexLength = Utils::hexLength($hexValue);
            $firstByte = Utils::intToBinary($offset + 55 + $hexLength);
            $inputs[] = $firstByte . $hexLength;
            $output = Inputs::encode($inputs, 'hex');
        } else {
            throw new InvalidArgumentException("Input too long.");
        }
        return $output;
    }
    /**
     * @param string $inputs
     * @return array
     */
    protected function prepareInputs($inputs)
    {
        $encoding = 'utf8';
        if (is_numeric($inputs)) {
            $inputs = [$inputs];
        } elseif (is_string($inputs)) {
            // Check if string is hex
            if (strpos($inputs, '\x') === 0) {
                $inputs = str_replace('\x', '', $inputs);
                $inputs = str_split($inputs, 2);
                $encoding = 'hex';
            } else {
                $inputs = str_split($inputs, 1);
            }
        }
        $output = Inputs::encode($inputs, $encoding);
        return $output;
    }
}
