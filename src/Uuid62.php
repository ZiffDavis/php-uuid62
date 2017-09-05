<?php
namespace ZiffDavis;

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
        return Uuid::fromBytes($encoder->decode($base62UuidString));
    }

    public static function new($pad = true): string
    {
        return self::fromUuid(Uuid::uuid4(), $pad);
    }
}