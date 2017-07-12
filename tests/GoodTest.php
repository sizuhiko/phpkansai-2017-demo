<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;

final class GoodTest extends TestCase
{
  public function test成功すること(): void
  {
    $this->assertTrue(true);
  }
}
