<?php 
use PHPUnit\Framework\TestCase;
use App\Model\ReadRecord;

final class ReadRecordTest extends TestCase
{
     // Test read records
     public function testReadRecords () {
        $readrec = new ReadRecord;
        $readrec->setColumn("*");
        // $readrec->getColumn();
        $readrec->setTable("products");
        // $readrec->getTable();
        $readrec->setWhere("1");
        // $readrec->getWhere();
        $readrec->setData([]);
        // $readrec->getData();
        $this->assertIsArray($readrec->readRecord());
    }

     // Test read records
     public function testReadOneRecord () {
        $readrec = new ReadRecord;
        $readrec->setColumn("*");
        // $readrec->getColumn();
        $readrec->setTable("products");
        // $readrec->getTable();
        $readrec->setWhere("1");
        // $readrec->getWhere();
        $readrec->setData([]);
        // $readrec->getData();
        $this->assertIsArray($readrec->readOneRecord());
    }

}