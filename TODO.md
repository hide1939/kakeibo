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
    - phpcs.xmlを定義
- larastan(静的解析ツール)の導入
- dev環境のみでデバッグツールを導入
- セッション管理に使うRedisを導入する
    - docker-composeに追加
    - Laravel側でsession driverの切り替え
- Reactのセットアップ
    - https://readouble.com/laravel/7.x/ja/frontend.html?header=React%25E3%2581%25AE%25E4%25BD%25BF%25E7%2594%25A8
    - https://liginc.co.jp/375726
    - https://reffect.co.jp/laravel/laravel6-react-router

## 開発の開始
- Reactの勉強をする(Progateを一周する)
- 裏側のロジックから作る
- auth機能をインストール
    - 認証機能は基本的にはそのまま使う
    - view等の画面表示の部分だけ独自に整える
- Reactが絡んでくるviewとかのフロント側は後回し

## デプロイする
- AWSの学習
- インフラ構成図の作成
- AWSのインフラを設定する
- デプロイ用の設定ファイルおよび環境変数のファイルを作成
    - php.ini
        - opcacheの導入
- config.ymlの作成
    - 自動テスト
    - 自動デプロイ
    - GitHub上でmainにマージしたら本番にリリースされる
- デプロイを行う

## 動作確認
- 本番環境で画面が映る
- バグ、不自然な動作が無いか確認
- 監視ツール(NewRelic)の導入