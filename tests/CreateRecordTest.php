<?php 
use PHPUnit\Framework\TestCase;
use App\Model\CreateRecord;

final class CreateRecordTest extends TestCase
{

    // Test create records
    public function testCreateRecords () {
        $newrec = new CreateRecord;
        // $newrec->setColumn("name,price,quantity,img");
        // $newrec->getColumn();
        // $newrec->setTable("products");
        // $newrec->getTable();
        // $newrec->setValue("	
        // 'TestCase', '7500.00', '20', 'dress-shirt-img.png'");
        // $newrec->getValue();
        // $newrec->setData([]);
        // $newrec->getData();
        $this->assertIsBool($newrec->create());
    }

}
