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
        // 'Lays Snacks', '180.00', '300', 'snacks.png'");
        // $newrec->getValue();
        // $newrec->setData([]);
        // $newrec->getData();
        $this->assertIsBool($newrec->create());
    }

}
