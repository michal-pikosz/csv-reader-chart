<?php declare(strict_types=1);

use src\CsvReader;
use PHPUnit\Framework\TestCase;
use function PHPUnit\Framework\assertIsResource;

final class CsvReaderTest extends TestCase
{
    private static $csvReader;

    public static function setUpBeforeClass(): void
    {
        self::$csvReader = new CsvReader();
    }

    public function testCanOpenFile()
    {
        assertIsResource(self::$csvReader->openFile());
    }

    public function testCloseFile()
    {
        self::assertTrue(self::$csvReader->closeFile());
    }

    public function testReadingLines()
    {
        self::assertIsArray(self::$csvReader->readFile());
        self::assertNotEmpty(self::$csvReader->readFile());
        self::assertContains([
            'id',
            'first_name',
            'last_name',
            'email',
            'gender',
            'ip_address',
            'country',
        ], self::$csvReader->getCsvContents());
    }
}
