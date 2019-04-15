<?php

require_once 'ApiDolar.php';

class MostradorEnDolares implements Mostrador {

    public function mostrar(Array $billetes) {
        $total = 0;
        foreach ($billetes as $billete => $cantidad) {
        $total = ($total + $billete*$cantidad) / ApiDolar::dameDolar();
        }
        return $total;
    }
}
