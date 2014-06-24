<?php

include_once 'basetest.php';

class startattackpagehandlertests extends BaseTest
{
    public function testgetDistanceSeconds()
    {
        $ph = new \PageHandlers\StartAttackPageHandler();
        $d1 = new \Classes\District();
        $d2 = new \Classes\District();
        $d1->setPosition(1, 1);
        $d2->setPosition(4, 5);        
        $ph->handle();
        
        $this->assertEquals(1500, $ph->getDistanceSeconds($d1, $d2)); //Ergebnis soll sein: 300*(sqrt((1-4)^2+(1-5)^2))=300*5=1500
    }
    
    public function testgetBattleTime()
    {
        $ph = new \PageHandlers\StartAttackPageHandler();
        $d1 = new \Classes\District();
        $d2 = new \Classes\District();
        $units = array();        
        
        $d1->setPosition(1, 1);
        $d2->setPosition(4, 5);        
                
        $ergebnis = 1500 / 5;       //Distanzdauer = 1500
        $ph->handle();
        
  	array_push($units, array('id'=>1, 'count'=>10)); //speed...5
        array_push($units, array('id'=>2, 'count'=>20)); //speed...20
        
        $this->assertEquals($ergebnis, $ph->getBattleTime($d1, $d2, $units));
    }    
}
