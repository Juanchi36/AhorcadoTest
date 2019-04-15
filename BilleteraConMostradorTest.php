<?php

require_once('./vendor/autoload.php');
require('./BilleteraConMostrador.php');
require('./MostradorEnPesos.php');
require('./MostradorEnDolares.php');
require_once('./ApiDolar.php');

use PHPUnit\Framework\TestCase;

final class BilleteraConMostradorTest extends TestCase
{
  /**
   * @return Billetera
   */
  public function crearBilletera() {
    $mostrar = new MostradorEnPesos();
    $billetera = new BilleteraConMostrador($mostrar);
    return $billetera;
  }

  public function testAgregar() {
    $billetera = $this->crearBilletera();
    $this->assertTrue($billetera->agregar(10, 10));
    $this->assertTrue($billetera->agregar(50, 10));
    $this->assertTrue($billetera->agregar(100, 10));
  }

  public function testSacar() {
    $billetera = $this->crearBilletera();
    $billetera->agregar(10, 10);
    $billetera->agregar(50, 10);
    $billetera->agregar(100, 10);

    $this->assertTrue($billetera->sacar(10, 10));
    $this->assertTrue($billetera->sacar(50, 10));
    $this->assertTrue($billetera->sacar(100, 10));
  }

  public function testSacarBilleteQueNoExiste() {
    $billetera = $this->crearBilletera();
    $billetera->agregar(10, 10);
    $billetera->agregar(50, 10);
    $billetera->agregar(100, 10);

    $this->assertFalse($billetera->sacar(20, 1));
  }

  public function testMostrarCuandoEstaVacia() {
    $billetera = $this->crearBilletera();
    $this->assertEquals(0, $billetera->mostrar());
  }

  public function testMostrarDespuesDeAgregarBilletes() {
    $billetera = $this->crearBilletera();
    $billetera->agregar(10, 10);
    $billetera->agregar(500, 2);
    $billetera->agregar(1000, 1);
    $this->assertEquals(2100, $billetera->mostrar());
  }

  public function testMostrarDespuesDeAgregarYSacar() {
    $billetera = $this->crearBilletera();
    $billetera->agregar(10, 10);
    $billetera->agregar(500, 2);
    $billetera->agregar(1000, 1);
    $billetera->sacar(500, 1);
    $this->assertEquals(1600, $billetera->mostrar());
  }

  public function testMostrarDespuesDeAgregarYSacarHastaQuedarVacia() {
    $billetera = $this->crearBilletera();
    $billetera->agregar(10, 10);
    $billetera->agregar(500, 2);
    $billetera->agregar(1000, 1);
    $billetera->sacar(10, 10);
    $billetera->sacar(500, 2);
    $billetera->sacar(1000, 1);
    $this->assertEquals(0, $billetera->mostrar());
  }

  public function testEnDolares()
  {
    $mostradorEnDolares = new MostradorEnDolares();
    $billetera = new BilleteraConMostrador($mostradorEnDolares);
    $billetera->agregar(1000, 20);
    $this->assertEquals(20000/ApiDolar::dameDolar(), $billetera->mostrar());

  }

}