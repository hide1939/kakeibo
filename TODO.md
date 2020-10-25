# TODOリスト(アプリの実装手順)

## 開発前のセットアップ
- [x]composerをインストールする
- Laravelをインストールする
    - [x]コンテナ内のアプリのディレクトリ構成を調整(volumesのところ)
    - [x]Laravelの画面が表示できる
    - [x]現在のPRをマージ+新たなブランチを切る
- phpunitの導入
    - [x]簡単なテストが動く
    - [x]テスト用dbの導入
    - [x]テスト用dbのマイグレーションを行う
    - [x]簡単なデータベースを用いたテストが動く
    - [x]テストを動かすのに最低限必要な設定以外は削除
    - [x]テストのカバレッジについて勉強してphpunitに導入する(xdebug)
        - [x]コマンド(vendor/bin/phpunit --coverage-html reports/)
    - [x]phpunit.xmlの中身を理解
- [x]phpcsの導入(phpcbf)
    - [x]phpcs.xmlを定義
- [x]larastan(静的解析ツール)の導入
- [x]dev環境のみでデバッグツールを導入
- [x]セッション管理に使うRedisを導入する
    - [x]docker-composeに追加
    - [x]Laravel側でsession driverの切り替え
    - 資料(ライブラリ(predis)・ツール(medis))(https://qiita.com/minato-naka/items/8b31d28823cabaa9487a#redis%E3%82%B3%E3%83%B3%E3%83%86%E3%83%8A%E4%BD%9C%E6%88%90)

## 開発の開始
- [x]Ajaxの基礎を勉強する
- [x]Laravel x Ajaxを実装する方法を調べる
    - 【Laravel】ajaxを使った検索機能の実装(https://qiita.com/hot-and-cool/items/c2e9e651f0e53dd14303)
- [x]React x Ajaxを実装する方法を調べる
- [x]Laravel x React x Ajaxで機能を実装する方法を調べる
- JavaScriptを学ぶ
    - 分かりすぎて怖いJavaScript入門(https://www.youtube.com/watch?v=EXxIVEC72mU&list=PLX8Rsrpnn3IVvcPCZTixO7Pf5lAGoyNOA)
    - JavaScript講座(https://www.youtube.com/watch?v=pnsieVYy72M&list=PLwM1-TnN_NN7-zdRV8YsGUB82VVhfYiWW)
    - モダンJavaScript講座(https://www.youtube.com/watch?v=De9PH3EAz7c&list=PLwM1-TnN_NN4SV6DEs4OtfA51Up6XzTfB)
- Reactの勉強をする
    - 日本一わかりやすいReact入門【基礎編】(https://www.youtube.com/watch?v=Otrc2zAlJyM&list=PLX8Rsrpnn3IWKz6H5ZEPWBY8AKWwb9qq7)
    - 日本一わかりやすいReact入門【実践編】(https://www.youtube.com/watch?v=MzJkWO73S70&list=PLX8Rsrpnn3IVOk48awq_nKW0aFP0MGpnn)
    - Progate(https://prog-8.com/languages/react)
- Reactのセットアップ
    - Laravelの本
    - https://readouble.com/laravel/7.x/ja/frontend.html?header=React%25E3%2581%25AE%25E4%25BD%25BF%25E7%2594%25A8
    - https://liginc.co.jp/375726
    - https://reffect.co.jp/laravel/laravel6-react-router
- auth機能をインストール
    - 認証機能は基本的にはそのまま使う
    - view等の画面表示の部分だけ独自に整える
- データベース構造を考える
    - 必要なテーブル、カラム
    - データ型
    - リレーション
- 必要な機能と開発手順の洗い出し
    - なるべく細かく
    - 実装はTDD(テスト駆動開発)で行う
        - テストを書く→実装する
- 定期支出登録画面を作る
    - 

## デプロイする
- AWSの学習
    - Udemy
- インフラ構成図の作成
- AWSのインフラを設定する
- デプロイ用の設定ファイルおよび環境変数のファイルを作成
    - deployディレクトリを作成
        - deployディレクトリ内に以下のファイル群を配置
    - Dockerfile
        - アプリのファイルをCOPY
    - php.ini
        - production用の設定
        - opcacheの導入
            - アプリの高速化
    - その他必要な設定ファイル(apache等)
- .circleci/config.ymlの作成
    - 自動テスト
    - 自動デプロイ
    - GitHub上でmainにマージしたら本番に自動リリースされる
- 本番デプロイを行う

## 動作確認
- 本番環境で画面が映る
- バグ、不自然な動作が無いか確認
    - デバッグツールが画面に表示されてないか
    - その他不要な情報が画面に表示されていないか
- 監視ツール(NewRelic)の導入

## 宣伝