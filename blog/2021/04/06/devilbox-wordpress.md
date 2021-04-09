---
title: Devilboxを使ってローカルのWordPressサイトの最初のセットアップしよ
layout: blogpost
date: 2021-04-06
---
まずはDevilbox（デビルボックス）っていうソフトを紹介したいです。デビルボックスはすごく便利なソフトで、PHPのサイトを作成してるときや開発してるときすごくおすすめです。簡単に説明すると、機能満載のLAMPスタックみたいなソフトです、Dockerを使って作られたんですけど。

デビルボックスのHPはこちら： http://devilbox.org/

とその説明書はこちら： https://devilbox.readthedocs.io/en/latest/

じゃあさっそく使ってみましょう。

この記事はほぼ[デビルボックスのインストールの説明書](https://devilbox.readthedocs.io/en/latest/getting-started/install-the-devilbox.html)と同じ内容になりますけど、日本語訳としてやくにたつと思います。

## デビルボックスをインストール

これは[デビルボックスのインストールの説明書](https://devilbox.readthedocs.io/en/latest/getting-started/start-the-devilbox.html)とほぼ同じ内容なんですけど、日本語訳としてやくにたつと思います。

まずは最初に必要となるのはDockerなので、まだインストールしていない場合そこから初めてください、インストールをやり終わったらこの記事に戻ってください。

デビルボックスのインストールは結構簡単です。初めにデビルボックスのrepoをpullします。

```
(自分はホームから以下のコマンドを実行してる、~/devilboxになるため)
git clone https://github.com/cytopia/devilbox
cd devilbox
```

ここからは最低限の設定を入力していきます。

```
cp env-example .env
id -u (これはUIDと覚えておいてください、user IDの略です)
id -g (これはGIDと覚えておいてください、group IDの略です)
```

で、自分の好みのエディターを使って`.env`を編集してください。`NEW_UID`をそのUIDに設定して、`NEW_GID`をそのGIDに設定する形で。例えばこんな風に：

```
NEW_UID=1001
NEW_GID=1002
```

### Macを使ってる方は

追加にこの設定をする必要があります、パーフォーマンスのために。

```
MOUNT_OPTIONS=,cached
```

これでインストールは完了です。

## デビルボックスの起動の仕方

これは[デビルボックスの起動の仕方の説明書](https://devilbox.readthedocs.io/en/latest/getting-started/start-the-devilbox.html)とほぼ同じ内容なんですけど、日本語訳としてやくにたつと思います。

### 起動

```
cd devilbox
docker-compose up
```

特定のイメージを始めたければ、`docker-compose up`にさらにそのイメージの名前を使ってください。例えば：

```
docker-compose up httpd php mysql
```

実際WordPressの場合はその3つしか必要ないです。

### 停止

```
docker-compose down
docker-compose rm -f (これも重要です、デビルボックスの説明書によると)
```

### 再起動

```
docker-compose down
docker-compose rm -f
docker-compose up httpd php mysql
```

## デビルボックスの使い方

### WordPressをインストール

ここからは説明なしでなにをやったほうがいいか伝えたいと思います、今までもあんまりせつめいしてませんけどね（笑）。

1. `/etc/hosts`を編集する、あとで`http://hello.loc`を使えるようになります。

    ```
    127.0.0.1 hello.loc
    ```

2. フォルダーを創る。

    ```
    mkdir -p data/www/hello
    ```

3. [WordPressのダウンロードして](https://ja.wordpress.org/download/)、`data/www/hello/htdocs`のフォルダーに入れてください。http://hello.loc を開けたら、WordPressの最初の画面見れれば成功しました。

### WordPressの設定

WordPressのデーターベースを作る必要があります。

```
cd devilbox
./setup.sh
(デビルボックスの中から)
mysql -u root -h 127.0.0.1 -p -e 'CREATE DATABASE hello;'
(パスワードはないです、エンターキーを押してください)
```

次はWordPressの設定。

1. http://hello.loc を開いてください。
2. 普通にセットアップ進んでください。
3. データーベースの設定のところまでにたどり着ければ：
    - データーベースの名前はさっき創ったです、`hello`
    - ユーザーネームは`root`
    - パスワードはないです
    - データーベースホストは`127.0.0.1`で

おめでとうございます、上手く行った場合あなたはローカルWordPressサイトのセットアップが無事に完了しました。

ここからは普通のアドミンユーザーのセットアップに入ります。

## 英語読める方は

ぜひできれば英語で読んでください、僕は本当にこの記事で基本的な翻訳しかやってないんで。

- https://devilbox.readthedocs.io/en/latest/getting-started/install-the-devilbox.html
- https://devilbox.readthedocs.io/en/latest/getting-started/start-the-devilbox.html
- https://devilbox.readthedocs.io/en/latest/getting-started/devilbox-intranet.html （あらゆる機能の基本的な説明書）
- https://devilbox.readthedocs.io/en/latest/getting-started/directory-overview.html
- https://devilbox.readthedocs.io/en/latest/getting-started/create-your-first-project.html

