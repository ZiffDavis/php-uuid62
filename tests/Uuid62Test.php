<?php
use ZiffDavis\Uuid62\Uuid62;
class Uuid62Test extends \PHPUnit\Framework\TestCase
{
    public function testNew()
    {
        $uuid62 = Uuid62::new();
        $this->assertTrue(is_string($uuid62));
        $this->assertEquals(23, strlen($uuid62));
    }

    public function testFromUuid()
    {
        $testUuid = "3078350b-bfd0-41ff-8cc2-3a3a7969ceba";
        $testUuidEncoded = "01tsz7Nk9Grmziqc5gFI0pY";
        $uuid = \Ramsey\Uuid\Uuid::fromString($testUuid);
        $this->assertEquals($testUuidEncoded, Uuid62::fromUuid($uuid));
    }

    public function testToUuid()
    {
        $testUuid = "3078350b-bfd0-41ff-8cc2-3a3a7969ceba";
        $testUuidEncoded = "01tsz7Nk9Grmziqc5gFI0pY";
        $uuid = Uuid62::toUuid($testUuidEncoded);
        $this->assertEquals($testUuid, $uuid->toString());
    }

    public function testValid()
    {
        $testUuidEncoded = "01tsz7Nk9Grmziqc5gFI0pY";
        $this->assertTrue(Uuid62::valid($testUuidEncoded));
        $this->assertFalse(Uuid62::valid(""));
        $this->assertFalse(Uuid62::valid(123456789));
        $this->expectError();
        $this->assertFalse(Uuid62::valid(null));
    }
}