<?php

namespace Demir\Config;

class Config
{
  /**
   * Konfigürasyon öğelerini tutar
   * 
   * @static array
   */
  public static $collection = [];

  /**
   * Sınıf kurucu
   * Koleksiyona yeni öğeler ekler
   * 
   * @param array $collection
   */
  public function __construct(array $collection)
  {
    static::$collection = array_merge(static::$collection, $collection);
  }

  /**
   * Koleksiyonda veri mevcut mu kontrol eder
   */
  public static function has(string $key): bool
  {
    return array_key_exists($key, static::$collection);
  }

  /**
   * Koleksiyona yeni veri ekler
   * 
   * @param mixed $value
   */
  public static function set(string $key, $value): void
  {
    $replace = array_reduce(
      array_reverse(explode('.', $key)),
      function ($value, $key) {
        return [$key => $value];
      },
      $value
    );

    static::$collection = array_replace_recursive(static::$collection, $replace);
  }

  /**
   * Koleksiyondaki veriyi döndürür
   * 
   * @throws \InvalidArgumentException
   * @return mixed
   */
  public static function get(string $key)
  {
    if (static::has($key, static::$collection)) {
        return static::$collection[$key];
    }

    return array_reduce(
      explode('.', $key),
      function ($config, $key) {
        if (isset($config[$key])) return $config[$key];
        throw new \InvalidArgumentException(
          "Konfigürasyon koleksiyonunda bu isimde veri yok: '{$key}'"
        );
      },
      static::$collection
    );
  }
}
