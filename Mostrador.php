<?php

interface Mostrador {
  /**
   * @param Array array[billete] => cantidad
   */
  public function mostrar(Array $billetes);

}