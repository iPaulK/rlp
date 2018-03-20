<?php
namespace Test;

use IPaulK\RLP\{Encoder, Utils};
use PHPUnit\Framework\TestCase as TestCase;

class EncoderTest extends TestCase
{
    /**
     * Encoder
     * 
     * @var \IPaulK\RLP\Encoder
     */
    protected $encoder;
    /**
     * SetUp
     * 
     * @return void
     */
    public function setUp()
    {
        $this->encoder = new Encoder();
    }
    /**
     * Test encode a string "dog" = [ 0x83, 'd', 'o', 'g' ]
     * ascii: "dog" = [ 131, 100, 111, 103 ]
     * hex: "dog" = [ 0xc8, 0x64, 0x6f, 0x67 ]
     * 
     * @return void
     */
    public function testEncodeString()
    {
        $output = $this->encoder->encode('dog');
        $this->assertEquals([131, 100, 111, 103], $output);
        $this->assertEquals(4, count($output));
    }
    /**
     * Test encode a list [ "cat", "dog" ] = [ 0xc8, 0x83, 'c', 'a', 't', 0x83, 'd', 'o', 'g' ]
     * ascii: [ "cat", "dog" ] = [ 200, 131, 99, 97, 116, 131, 100, 111, 103 ]
     * hex: [ "cat", "dog" ] = [ 0xc8, 0x83, 0x63, 0x61, 0x74, 0x83, 0x64, 0x6f, 0x67 ]
     * 
     * @return void
     */
    public function testEncodeList()
    {
        $output = $this->encoder->encode(["cat", "dog"]);
        $this->assertEquals([200, 131, 99, 97, 116, 131, 100, 111, 103], $output);
        $this->assertEquals(9, count($output));
    }
    /**
     * Test encode a empty string ('null') = [ 0x80 ]
     *
     * @return void
     */
    public function testEncodeEmptyString()
    {
        $output = $this->encoder->encode('');
        $this->assertEquals([0x80], $output);
        $this->assertEquals(1, count($output));
    }
    /**
     * Test encode a empty list [] = [ 0xc0 ]
     *
     * @return void
     */
    public function testEncodeEmptyList()
    {
        $output = $this->encoder->encode([]);
        $this->assertEquals([0xc0], $output);
        $this->assertEquals(1, count($output));
    }
    /**
     * Test encode a integer 0 = [ 0x80 ]
     *
     * @return void
     */
    public function testEncodeIntegerZero()
    {
        $output = $this->encoder->encode(0);
        $this->assertEquals([0x00], $output);
        $this->assertEquals(1, count($output));
    }
    /**
     * Test encode a integer 0 ('\x00') = [ 0x00 ]
     *
     * @return void
     */
    public function testEncodeEncodedIntegerZero()
    {
        $output = $this->encoder->encode('\x00');
        $this->assertEquals([0x00], $output);
        $this->assertEquals(1, count($output));
    }
    /**
     * Test encode a integer 15 ('\x0f') = [ 0x0f ]
     *
     * @return void
     */
    public function testEncodeEncodedIntegerFifteen()
    {
        $output = $this->encoder->encode('\x0f');
        $this->assertEquals([0x0f], $output);
        $this->assertEquals(1, count($output));
    }
    /**
     * Test encode a integer 1024 ('\x04\x00') = [ 0x82, 0x04, 0x00 ]
     *
     * @return void
     */
    public function testEncodeEncodedIntegerTenTwentyFour()
    {
        $output = $this->encoder->encode('\x04\x00');
        $this->assertEquals([0x82, 0x04, 0x00], $output);
        $this->assertEquals(3, count($output));
    }
}
