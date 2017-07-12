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

# カスタムタスクを使った呼び出しシーケンスの確認

Roboでは独自にカスタムタスクを作れるようになっています。
公式ドキュメントによると `composer.json` の type を `robo-tasks` にすることが推奨されていますが、
`robo-phpcs` のように type が `library` のものも存在します。
Packagist からユーザータスクを探すときは `robo` をキーワードにした方が良いでしょう。

カスタムタスクは以下の条件を必要としています。

- psr-4 の名前空間に対応したファイル配置（`composer.json` に書いておくと幸せになれる）
- タスクのクラスと、それをロードするための trait

具体的なテンプレート例は[公式ドキュメント](http://robo.li/extending/#creating-a-robo-extension)に掲載されています。

`tasks` ディレクトリの下にタスクフォルダを作って、その下に trait のファイル名でタスクジェネレータを作るようにします。
RoboFileからは、この trait を use して、taskXxx のようなメソッドを利用可能にします。

複数のタスクをチェインして書く場合は `CollectionBuilder` を利用します。
利用方法は `$collection = $this->collectionBuilder();` のように記述するだけです。
あとは、普通のタスクを列挙するように `$collection` からチェインしていきます。
シンプルな書き方と比べて異なるのは `run()` を呼び出さずに、`$collection` を戻り値に設定することです。

このデモでは `custom` という composer script を追加したので、
`composer custom` またANSIの色付け表示したい場合は `composer custom -- --ansi` のように実行します。
