<?php
declare(strict_types=1);

use Demir\Config\Config;
use PHPUnit\Framework\TestCase;

final class ConfigTest extends TestCase
{
  public function setUp()
  {
    new Config([
      'app' => [
        'name' => 'Foo',
        'url' => 'https://foo.bar'
      ]
    ]);

    parent::setUp();
  }

  public function testConfigKeyExistsOnCollection(): void
  {
    $this->assertTrue(
      Config::has('app')
    );
  }

  public function testConfigGetter(): void
  {
    $this->assertEquals(
      Config::get('app')['name'], 'Foo'
    );
  }

  public function testConfigSetter(): void
  {
    Config::set('foo', 'Bar');

    $this->assertEquals(
      Config::get('foo'), 'Bar'
    );
  }

  public function testConfigDotNotation(): void
  {
    Config::set('app.db.username', 'Foo');

    $this->assertEquals(
      Config::get('app.db'), ['username' => 'Foo']
    );
  }

  public function testConfigHelpers()
  {
    config(['app.foo.bar' => 'baz']);

    $this->assertEquals(
      config('app.foo'), ['bar' => 'baz']
    );

    $this->assertNull(config('foo.bar.baz.qux'));
    $this->assertFalse(config('foo.bar.baz.qux', false));
  }

  public function testConfigGetterException()
  {
    try {
      Config::get('foo.bar.baz.qux.mux');
      $this->assertTrue(false);
    } catch (\InvalidArgumentException $e) {
      $this->assertTrue(true);
    }
  }
}