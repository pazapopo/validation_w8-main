<?php

class Archer extends Character
{
    public $arrowCritic = false ;
    
    public function __construct($name) {
        Character::__construct($name);
        $this->damage = 20;
        $this->arrow = 10;
    }

    public function turn($target) {
        $rand = rand(1, 10);
        if ($this->arrow == 0) {
            $status = $this->attackRogue($target);
        } else if ($rand > 3 ) {
            $status = $this->attack($target);
        }else if ($rand <= 3 ) {
            $status = $this->arrowCritic();
        }
        return $status;
    }

    public function arrowCritic() {
        $this->arrowCritic= true;
        $status = "$this->name vise le point faible de son adversaire  !";
        return $status;
    }

    public function attack($target) {
        if ($this->arrowCritic) {
            $this->arrowCritic = false;
            $rand = rand(15, 30)/10;
            $critic = $this->damage * $rand;
            $target->setHealthPoints($critic);
            $this->arrow -= 1;
            $status = "$this->name tire une fleches puissante sur $target->name ! Il reste $target->healthPoints points de vie à $target->name !";
        } else{
            $target->setHealthPoints($this->damage);
            $this->arrow -= 1;
            $status = "$this->name tire une fleche sur $target->name ! Il reste $target->healthPoints points de vie à $target->name !";
        }
        return $status;
    }

    public function attackRogue($target) {
        $target->setHealthPoints($this->damage/2);
        $status = "$this->name donne un coup de dague à $target->name ! Il reste $target->healthPoints points de vie à $target->name !";
        return $status;
    }
}
