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

  /**
   * PHPサーバーを実行しAssetの変更を監視するデモ
   *
   * このコマンドは、PHPカンファレンス関西2017のRoboデモ用で、PHPサーバーを非同期で実行しAssetファイルに変更があったらコンパイルを実行します。
   */
  function start()
  {
    $this->assetCompile();

    $this->taskServer(8000)
      ->dir('public')
      ->background()
      ->run();

    $this->taskOpenBrowser('http://localhost:8000')
      ->run();

    $this->say("終了するには Ctrl+C を押してください");

    $this->taskWatch()
      ->monitor('assets', function() { $this->assetCompile(); })
      ->run();
  }

  /**
   * Assetのコンパイルを実行するデモ
   *
   * このコマンドは、PHPカンファレンス関西2017のRoboデモ用で、assetsのscssファイルをpublicのcssへコンパイルします。
   */
  function assetCompile()
  {
    $this->taskScss(['assets/main.scss' => 'public/main.css'])
      ->run();
  }
}
