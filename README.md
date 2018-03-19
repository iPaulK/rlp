RLP
==========================================
Recursive Length Prefix implementation
The purpose of RLP (Recursive Length Prefix) is to encode arbitrarily nested arrays of binary data, and RLP is the main encoding method used to serialize objects in Ethereum. The only purpose of RLP is to encode structure; encoding specific data types (eg. strings, floats) is left up to higher-order protocols; but positive RLP integers must be represented in big endian binary form with no leading zeroes (thus making the integer value zero be equivalent to the empty byte array). Deserialised positive integers with leading zeroes must be treated as invalid. The integer representation of string length must also be encoded this way, as well as integers in the payload. Additional information can be found in the Ethereum yellow paper Appendix B.

See [RLP](https://github.com/ethereum/wiki/wiki/RLP) for details.

## Installation

Clone repository and install dependencies
```sh
$ git clone https://github.com/iPaulK/rlp path/to/install
$ cd path/to/install
$ composer update
```

## Usage

RLP encode:

```php
use IPaulK\RLP\Encoder;
use IPaulK\RLP\Utils;

/** @var array $encoded */
$encoded = Encoder::encode(["cat", "dog"]);
/** @var array $encodedHex */
$encodedHex = Utils::toHEX($encoded);

```

Examples:

The string "dog" = [ 0x83, 0x64, 0x6f, 0x67 ]

The list [ "cat", "dog" ] = [ 0xc8, 0x83, 0x63, 0x61, 0x74, 0x83, 0x64, 0x6f, 0x67 ]

The empty string ('null') = [ 0x80 ]

The empty list = [ 0xc0 ]

The integer 0 = [ 0x80 ]

The encoded integer 0 ('\x00') = [ 0x00 ]

The encoded integer 15 ('\x0f') = [ 0x0f ]

The encoded integer 1024 ('\x04\x00') = [ 0x82, 0x04, 0x00 ]


RLP decode:

```php
not implemented, maybe in the future
```

## Unit Testing

Unit testing for RLP is done using [PHPUnit](https://phpunit.de/).

To get started, run `composer install` from the command line while in the RLP root directory.

To execute tests, run `vendor/bin/phpunit` from the command line while in the RLP root directory.

## Todos

 - Add Decoder

## License

MIT