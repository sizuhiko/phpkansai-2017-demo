<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;

final class BadTest extends TestCase
{
  public function test失敗すること(): void
  {
    $this->assertTrue(false);
  }
}
