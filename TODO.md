# TODOリスト(アプリの実装手順)(終わったら消していく)

## 機能の開発
- []Reactのセットアップ
    - Laravelの本

- 認証機能を作る
    - []remember me機能を作る

- 画像アップロード機能を作成する
    - []FormRequestクラスを作る(バリデーション)
    - []画面選択した際にプレビューが表示できる
    - []cropperで画像のトリミングが可能(後からでいい)
    - 画像が削除できる
        - []削除ボタンを実装
        - []ストレージから削除
        - []DBから画像パスを削除(nullにする)
        - []画面から画像が消えてデフォルトの画像に変わる
        - []新しい画像を登録するタイミングで以前の画像はストレージから削除する

- メイン画面を作る
    - []その月の収支を登録できる
        - MainControllerから呼ぶ
            - MainController作る(storeメソッド)
            - 引数にuser_id、e or iのパラメータ、item、amountを渡す
    - []収支を削除できる
        - regularのときに作ったCommandExpenseServiceとCommandIncomeServiceをMainControllerから呼ぶ
        - regularと同じ実装でOK
            - 共通して使えるようにServiceで作ったので
    - []メイン画面を表示できる
        - 表示させるもの
            - その月の収支合計を表示
                - 今月の収入合計、支出合計を表示するかもしれないので、regularみたいにServiceからそれぞれ読んでControllerで計算する形にする
                - また、「今月単体の収支」と、「その収支に定期収支を足し合わせた数」を表示する可能性があるので、Controllerで計算する形にする
                - QueryExpenseServiceのgetMonthTotalAmount
                    - user_idとmonthを渡す
                        - monthにはデフォルト値で今月をCarbonで取得して渡す
                    - whereでmonthとis_regularが0で絞る
                    - sumでamountの合計値を計算する
                - QueryIncomeServiceのgetMonthTotalAmount
                    - user_idとmonthを渡す
                        - monthにはデフォルト値で今月をCarbonで取得して渡す
                    - whereでmonthと、is_regularが0で絞る
                    - sumでamountの合計値を計算する
                - MainControllerから二つのServiceを呼ぶ
                    - 引数にAuth::id()とクエリパラメータから取得したmonthを渡す
                        - monthは取得できなかったらService側でデフォルトの今月が指定されるはず
            - その月の収支の項目と金額を表示
                - QueryのExpenseServiceとIncomeServiceに新たにメソッドを作る
                    - getByMonthとかで良い気がする
                    - user_id,is_regularが0,monthで絞る
                    - MainControllerで作ったServiceを呼んでModelを取得する
            - ログインしている人の名前
                - Auth::userで取得できるのでそれをviewに渡す
            - 今月を表示(2020年10月など)
                - viewでCarbon使うか、ControllerでCarbon使ってviewに月を渡すか
            - メイン画面を表示する
                - ルーティングを設定

- home->login/register->regularの流れをざっくりと試す
    - プロフィール画像が表示されるか

- sass/scss等でデザインを整える <- デプロイ後でOK

## デプロイする
- 途中でもいいのである程度のところでデプロイする
    - Done is better than perfect
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

- アジャイル的に機能追加

- インフラのコード化

## 動作確認
- 本番環境で画面が映る
- バグ、不自然な動作が無いか確認
    - デバッグツールが画面に表示されてないか
    - その他不要な情報が画面に表示されていないか
- 監視ツール(NewRelic)の導入