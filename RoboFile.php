<?php
/**
 * This is project's console commands configuration for Robo task runner.
 *
 * @see http://robo.li/
 */
class RoboFile extends \Robo\Tasks
{
  /**
   * PHPUnitのテストを実行するデモ
   *
   * このコマンドは、PHPカンファレンス関西2017のRoboデモ用で、PHPUnitを実行します。
   *
   * @param array $opts コマンド引数
   * @option $force-fail  失敗するテストを実行する場合に指定する
   */
  function test($opts = ['force-fail' => false])
  {
    $testFile = $opts['force-fail'] ? 'BadTest' : 'GoodTest';
    $this->taskPHPUnit()
      ->file('tests/'.$testFile.'.php')
      ->optionList('colors', 'always', '=')
      ->run();
  }
}