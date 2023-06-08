<?php
use PHPUnit\Framework\TestCase;
use App\Model\ConnectDB;

final class ConnectDBTest extends TestCase
{
    // Test on construct
    public function testConstruct () {
        $connectdb = new ConnectDB();
        $this->assertIsObject($connectdb->__construct());
    }
   
}
