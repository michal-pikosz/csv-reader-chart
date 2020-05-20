<?php declare(strict_types=1);

use src\CsvModel;
use PHPUnit\Framework\TestCase;

final class MysqlTest extends TestCase
{
    private static $mysql;

    public static function setUpBeforeClass(): void
    {
        self::$mysql = new CsvModel();
    }

    public function testCanConnectToDb()
    {
        self::assertNotFalse(self::$mysql->getConnection());
    }

    public function testCanMakeQuery()
    {
        self::assertTrue(self::$mysql->save(['first_name' => "a",'last_name' => "a",'email' => "a",'gender' => "a",'ip_address' => "a",'country' => "a"]));
    }

    public function testResturnFalseAndExceptionOnError()
    {
        $this->expectException(PDOException::class);
        self::assertFalse(self::$mysql->save(['first_namefd' => "a",'last_name' => "a",'email' => "a",'gender' => "a",'ip_address' => "a",'country' => "a"]));
    }


}
