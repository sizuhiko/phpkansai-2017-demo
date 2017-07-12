# PHPカンファレンス関西2017 発表デモ

シナリオ

- PHPユニットを実行する（成功/失敗)
- Assetファイルに変更があったら自動的にコンパイルする、Webサーバー
- カスタムタスクで呼び出しシーケンスの確認。ロールバック

# はじめに

必要なパッケージを `composer require --dev` でインストールします。
このデモでは以下のとおり。

- phpunit
- robo

`composer` でインストールしたパッケージの実行ファイルをパスなしで実行できるように、`composer.json` の scripts に定義します。
このデモでは、`composer robo` を実行できるように追加しました。

```json
"scripts": {
  "robo": "robo"
}
```

`composer robo -- init` で `RoboFile.php` が生成されます。

コマンドの一覧は `composer robo -- list` で確認します。

# はじめてのタスク

Roboの標準タスクに入っている `PHPUnit` を実行できるようにしてみましょう。

`tests` ディレクトリの下に成功と失敗のテストコードを準備しておき、`test` タスクを作成する。
composer script に test を追加して、`composer test` で実行できるようにする。

- 成功テストの実行方法: `composer test`
- 失敗テストの実行方法: `composer test -- --force-fail`
- testコマンドのヘルプ: `composer robo -- help -- test`
