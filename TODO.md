# TODOリスト(アプリの実装手順)

## 開発前のセットアップ
- [x]composerをインストールする
- Laravelをインストールする
    - コンテナ内のアプリのディレクトリ構成を調整(volumesのところ)
    - Laravelの画面が表示できる
    - 現在のPRをマージ+新たなブランチを切る
- phpunitで簡単なテストが動かせる
- phpcsの導入(phpcbf)
- larastan(静的解析ツール)の導入
- dev環境のみでデバッグツールを導入
- Reactのセットアップ
    - https://readouble.com/laravel/7.x/ja/frontend.html?header=React%25E3%2581%25AE%25E4%25BD%25BF%25E7%2594%25A8
    - https://liginc.co.jp/375726
    - https://reffect.co.jp/laravel/laravel6-react-router

## 開発の開始
- 裏側のロジックから作る
- auth機能をインストール
    - 認証機能は基本的にはそのまま使う
    - view等の画面表示の部分だけ独自に整える
- Reactが絡んでくるviewとかのフロント側は後回し

## デプロイする
- config.ymlの作成