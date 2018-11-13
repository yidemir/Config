<?php

if (!function_exists('config')) {
  /**
   * @param string|array $key
   * @param mixed $default
   */
  function config($key, $default = null)
  {
    if (is_array($key)) {
      foreach ($key as $k => $v) {
        \Demir\Config\Config::set($k, $v);
      }

      return true;
    } elseif (is_string($key)) {
      try {
        return \Demir\Config\Config::get($key);
      } catch (\InvalidArgumentException $e) {
        return $default;
      }
    }

    throw new \InvalidArgumentException('Geçersiz işlev argümanı');
  }
}
