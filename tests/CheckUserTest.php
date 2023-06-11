<?php
use PHPUnit\Framework\TestCase;
use App\User\CheckUser;

final class CheckUserTest extends TestCase
{
    // Test on construct
    public function testCheckUser () {
        
        $this->assertIsBool(CheckUser::userExist('kaunapraise@gmail.co'));
        $this->assertIsArray(CheckUser::userExist('kaunapraise@gmail.com'));
    }
   
}
