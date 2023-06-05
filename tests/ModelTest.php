<?php 
require "../DP/src/Model/Model.php";
use PHPUnit\Framework\TestCase;

final class ModelTest extends TestCase
{
    // Test on construct
    public function testConstruct () {
        $model = new Model();
        $this->assertIsObject($model->__construct());
    }
    // Test read records
    public function testRead () {
        $model = new Model();
        $this->assertIsArray($model->read("products","*","1",[]));
    }
    // Test on read records
    public function testReadOne () {
        $model = new Model();
        $this->assertIsArray($model->read("products","*","1",[]));
    }

    // public function testUserConstructor()
    // {
    //     $user = new User("Daniel", null);
    //     $this->assertSame("Daniel", $user->name);
    // }

    // public function test_array()
    // {
    //     $user = new User("Toyib", null);
    //     $this->assertArrayHasKey('email', $user->arrayVal());
    //     $this->assertArrayHasKey('name', $user->arrayVal());
    //     $this->assertIsArray($user->arrayVal());
    // }
}
