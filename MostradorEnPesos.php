<?php

require_once 'Mostrador.php';

class MostradorEnPesos implements Mostrador {
  public function mostrar(Array $billetes) {
    $total = 0;
    foreach ($billetes as $billete => $cantidad) {
      $total = $total + $billete*$cantidad;
    }
    return $total;
  }
}
