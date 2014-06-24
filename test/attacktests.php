<?php
include_once 'basetest.php';
class attacktests extends BaseTest
{
    public function testgetReturnTime()
    {
        $time = new \DateTime();
        $Time = new \Classes\Attack();
        $time->setTime(0, 0, 30);
        $Time->setStartTime($time);
        $time->setTime(0, 1, 15);
        $Time->setBattleTime($time);
        $time->setTime(0, 2, 0);        
        
        $this->assertEquals($time, $Time->getReturnTime());
    }

    public function testisReturning1()
    {
        $ph = new \Classes\Attack();
        $battleTime = new \DateTime();
        $time = new \DateTime();        
        $time->setTime(0, 1, 0);
        $ph->handle();        
        
        $battleTime->add($time);
        $ph->setBattleTime($battleTime);
        
        $this->assertFalse($ph->isReturning());
    }
    
    public function testisReturning2()
    {
        $ph = new \Classes\Attack();
  	$startTime = new \DateTime();
        $battleTime = new \DateTime();
        $time = new \DateTime();
        $ph->handle();
        
        $time->setTime(0, 5, 0);
        $battleTime->sub($time);
        $ph->setBattleTime($battleTime);
        
        $time->setTime(0, 10, 0);
  	$startTime->sub($time);
        $ph->setStartTime($startTime);
        
        $this->assertFalse($ph->isReturning());
    }
    
    public function testisReturning3()
    {
        $ph = new \Classes\Attack();
        $time = new \DateTime();
  	$startTime = new \DateTime();
        $battleTime = new \DateTime();
        $ph->handle();
                
        $time->setTime(0, 20, 0);
        $battleTime->sub($time);
        $ph->setBattleTime($battleTime);
        
        $time->setTime(0, 30, 0);
  	$startTime->sub($time);
        $ph->setStartTime($startTime);
        
        $this->assertTrue($ph->isReturning());
    }
}
