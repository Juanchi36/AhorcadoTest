<?php

class BilleteraConMostrador
{
    private $billetes;
    private $mostrador;

    public function __construct($mostrador)
    {
        $this->billetes = array();
        $this->mostrador = $mostrador;

    }
    public function mostrar()
    {
        return $this->mostrador->mostrar($this->billetes);
    }
   
    public function sacar($denominacion, $cantidad)
    {
        if(!isset($this->billetes[$denominacion])){
            return false;
        }
        if ($this->billetes[$denominacion] != 0){
            if($this->billetes[$denominacion] >= $cantidad){
                $this->billetes[$denominacion] -= $cantidad; 
                return true;
            }
            return false;
        }
        return false;
        
    }
    public function agregar($denominacion, $cantidad)
    {
        if (isset($this->billetes[$denominacion])){
            $this->billetes[$denominacion] += $cantidad;
            return true;
        }else{
            $this->billetes[$denominacion] = $cantidad;
            return true;
        }
    }
}

