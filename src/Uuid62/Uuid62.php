<?php
namespace ZiffDavis\Uuid62;

use Ramsey\Uuid\Exception\InvalidArgumentException;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;
use Tuupola\Base62;

class Uuid62
{
    public static function fromUuid(UuidInterface $uuid, $pad = true): string
    {
        $encoder = new Base62(["characters" => Base62::INVERTED]);
        $encoded = $encoder->encode($uuid->getBytes());
        if ($pad) {
            $encoded = str_pad($encoded, 23, "0", STR_PAD_LEFT);
        }
        return $encoded;
    }

    public static function toUuid(string $base62UuidString): UuidInterface
    {
        $encoder = new Base62(["characters" => Base62::INVERTED]);
        do {
            $decoded = $encoder->decode($base62UuidString);
            try {
                return Uuid::fromBytes($decoded);
            } catch (InvalidArgumentException $e) {
                $base62UuidString = substr($base62UuidString, 1);
            }
        } while (strlen($decoded) > 0);
        throw new \InvalidArgumentException("Could not successfully decode 16 byes from base62 string");
    }

    public static function new($pad = true): string
    {
        return self::fromUuid(Uuid::uuid4(), $pad);
    }

    public static function valid(string $uuid62)
    {
        try {
            if (strlen($uuid62) == 23) {
                $uuid = self::toUuid($uuid62);
                return Uuid::isValid($uuid->toString());
            }
        } catch (\Exception $e) {
        }
        return false;
    }
}