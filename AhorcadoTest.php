<?php
require_once('./vendor/autoload.php');
require('./Ahorcado.php');

use PHPUnit\Framework\TestCase;

final class AhorcadoTest extends TestCase
{
  public function testExisteAhorcado() {
    $this->assertTrue(class_exists("Ahorcado"));
  }

  /* public function testPalabraEnConstructor() {
    $ahorcado = new Ahorcado("chachara", 5);
  } */

  public function testTieneLaPalabraQueYoDigo() {
    $palabra = "chachara".rand(0, 1000);
    $ahorcado = new Ahorcado($palabra, 5);
    $this->assertEquals(
      $palabra,
      $ahorcado->damePalabra());
  }

  public function testTieneIntentos() {
    $intentos = rand(0, 500);
    $ahorcado = new Ahorcado("aeou", $intentos);
    $this->assertEquals($intentos, $ahorcado->dameIntentos());
  }

  public function testEstaLaLetra() {
    $ahorcado = new Ahorcado("chachara", 5);
    $esta = $ahorcado->pasarLetra('h');
    $this->assertEquals(true, $esta, "Esta la h");
  }

  public function testNoEstaLetra() {
    $ahorcado = new Ahorcado("chachara", 5);
    $esta = $ahorcado->pasarLetra('e');
    $this->assertEquals(false, $esta, "No esta");
  }

  public function testRestaIntentos() {
    $ahorcado = new Ahorcado("chachara", 5);
    $this->assertEquals(
      5,$ahorcado->dameIntentosRestantes());
    
    $ahorcado->pasarLetra('z');
    $this->assertEquals(
      4,$ahorcado->dameIntentosRestantes());

    $ahorcado->pasarLetra('h');
    $this->assertEquals(
      4,$ahorcado->dameIntentosRestantes());
  }

  public function testSiEsBoludoResta() {
    $ahorcado = new Ahorcado("chachara", 5);
    $this->assertEquals(
      5,$ahorcado->dameIntentosRestantes());
    
    $ahorcado->pasarLetra('h');
    $this->assertEquals(
      5,$ahorcado->dameIntentosRestantes(), 'caca');

    $ahorcado->pasarLetra('h');
    $this->assertEquals(
      4,$ahorcado->dameIntentosRestantes(), 'pis');
  }

  function testMostrarTodoOculto() {
    $ahorcado = new Ahorcado("cha", 5);
    $this->assertEquals(
      '_ _ _',
      $ahorcado->mostrar()
    );
  }

  function testMostrarCasiTodoOculto() {
    $ahorcado = new Ahorcado("cha", 5);
    $ahorcado->pasarLetra("h");
    $this->assertEquals(
      '_ h _',
      $ahorcado->mostrar()
    );
    $this->assertFalse($ahorcado->gano());

    $ahorcado->pasarLetra("a");
    $this->assertEquals(
      '_ h a',
      $ahorcado->mostrar()
    );
    $this->assertFalse($ahorcado->gano());

    $ahorcado->pasarLetra("c");
    $this->assertEquals(
      'c h a',
      $ahorcado->mostrar()
    );
    $this->assertTrue($ahorcado->gano(), 'vomito');
  }

  function testGano() {
    $ahorcado = new Ahorcado("ab", 5);
    $ahorcado->pasarLetra("a");
    $this->assertFalse($ahorcado->perdio());
    $this->assertFalse($ahorcado->gano());

    $ahorcado->pasarLetra("b");
    $this->assertFalse($ahorcado->perdio());
    $this->assertTrue($ahorcado->gano());
  }

  function testPerdio() {
    $ahorcado = new Ahorcado("a", 1);
    $ahorcado->pasarLetra("z");
    $this->assertTrue($ahorcado->perdio());
    $this->assertFalse($ahorcado->gano());
    $this->assertEquals(0, $ahorcado->dameIntentosRestantes());
  }

}   