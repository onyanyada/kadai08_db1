# ①課題番号-プロダクト名

アンケート管理アプリ

## ②課題内容（どんな作品か）

ユーザーから集めたアンケートを3つの権限に分けて更新削除できるアンケート管理アプリ

## ③DEMO

[なし](https://studiohub.sakura.ne.jp/kadai2/)

## ④作ったアプリケーション用のIDまたはPasswordがある場合


## ⑤工夫した点・こだわった点
- 管理者権限、一般権限、誰でもできることを分けたこと
- アンケート更新、削除
- ユーザー登録、更新、ログイン、ログアウト処理
- テーブルを3つに分け、外部キー設定、1フィールドに複数データが入らないようにした
- 出力時、外部キーをもとにテーブルを結合して表示
- 親テーブルが削除されたら、子テーブルの内容も自動で削除される
- ログイン時のエラーメッセージを分けた
- 閲覧権限のない人がURLにアクセスしたときのエラー表示
- ファイル共通化
- 前回から対応（SSL設定、XSS対策、確認画面、完了画面）


## ⑥難しかった点・次回トライしたいこと(又は機能)

- 

## ⑦質問・疑問・感想、シェアしたいこと等なんでも

- 
