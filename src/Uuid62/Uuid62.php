<?php
namespace ZiffDavis\Uuid62;

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
        if (substr($base62UuidString, 0, 1) == "0") {
            $base62UuidString = substr($base62UuidString, 1);
        }
        $encoder = new Base62(["characters" => Base62::INVERTED]);
        return Uuid::fromBytes($encoder->decode($base62UuidString));
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