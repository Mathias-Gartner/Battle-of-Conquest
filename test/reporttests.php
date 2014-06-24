<?php
include_once 'basetest.php';

class reporttests extends BaseTest
{
    /*public function testbattle1()
    {
        $attack = new \Classes\Attack();
        $ph = new \Classes\Report($attack);        
        
        $attack->setBattleState(0);
        
        $this->assertFalse($ph->battle());
    }*/
    
    public function testattackerWon()
    {        
        $attack = new \Classes\Attack();
        $ph = new \Classes\Report($attack);        
        
        $attack->setBattleState(0);
        
        $this->assertFalse($ph->attackerWon());
    }
    
    /*
    public function testgetModifiedAttackUnitCount()
    {        
        $attack = new \Classes\Attack();
        $ph = new \Classes\Report($attack);        
        
        $attack->setBattleState(0);
        
        $this->assertFalse($ph->getModifiedAttackUnitCount());
    }
    
    public function testgetModifiedDefendUnitCount()
    {        
        $attack = new \Classes\Attack();
        $ph = new \Classes\Report($attack);        
        
        $attack->setBattleState(0);
        
        $this->assertFalse($ph->getModifiedDefendUnitCount());
    }
    */
}
