<?php
use PHPUnit\Framework\TestCase;
use App\User\ProcessLogin;

final class ProcessLoginTest extends TestCase
{
    // Test on construct
    public function testProcessUser () {
        
        $this->assertIsArray(ProcessLogin::processUser('kaunapraise@gmail.com','00000000'));

        $this->assertIsBool(ProcessLogin::processUser('','00000000'));
    }
   
}
