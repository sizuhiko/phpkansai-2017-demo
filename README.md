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

# 開発中の作業を楽にするタスク

WebページのAssetファイルを編集したとき、都度ビルドするのはとても面倒です。
ファイルが変更されたら、自動的にコンパイルするようなタスクを作ってみましょう。

roboの標準タスクを使うとき、外部コンポーネントが必要になる場合があります。
これらはインストールしていない状態で実行すると、親切なエラーが出るので、そのタイミングでインストールしても良いのですが、
ドキュメントにも明示されているので、あらかじめ `composer require --dev` しておきましょう。

- SCSSコンパイラ: "leafo/scssphp"
- ファイル監視: "henrikbjorn/lurker"

`composer.json` に start スクリプトを追加して、 `composer start` で起動できるようにします。
コマンドを実行すると、PHPサーバーが起動し、ブラウザで表示します。
エディタで `assets/main.scss` を修正すると、自動的にcssを生成します。
ブラウザのリロードボタンをクリックしてみましょう。

