# 目次
- [目次](#目次)
- [Conduit](#conduit)
- [使用技術](#使用技術)
- [機能](#機能)
    - [実装済み](#実装済み)
    - [未実装](#未実装)
- [セットアップ](#セットアップ)
- [主要ディレクトリ/ファイル](#主要ディレクトリファイル)

# Conduit

ブログプラットフォームを作る [RealWorld](https://github.com/gothinkster/realworld/tree/main) という OSS のプロジェクトがあります。RealWorld は実世界と同じ機能を持つプラットフォームを作ることで、学習したいフレームワークの技術を習得することを目的としたプロジェクトです。

Conduit は [RealWolrd](https://demo.realworld.io/#/) で作成する Medium.com のクローンサイトです。
詳細な仕様については [Specs/Backend Specs](https://realworld-docs.netlify.app/docs/specs/backend-specs/introduction), [Specs/Frontend Specs](https://realworld-docs.netlify.app/docs/specs/frontend-specs/templates)で確認できます。

今回は Counduit と同じ見た目・機能のサイトを `Laravel` で実装しています。

# 使用技術

- PHP 8.2.14
- Laravel 10.38.2
- MySQL 8.0.32
- HTML/CSS/Bootstrap (RealWorldのテンプレートを使用)

# 機能

### 実装済み
- 記事 CRUD
- JWT認証
- ユーザー CRU-

### 未実装

- タグ機能
- 記事へのコメント CR-D
- 記事一覧ページネーション
- 記事お気に入り
- 記事マークダウン反映
- ユーザーフォロー
- テスト
- バリデーション
- ダミー生成

# セットアップ
PHP と Composer がコンピュータにグローバルにインストールされていることを確認してください。

リポジトリのクローンを作成し、プロジェクトフォルダーに移動
```bash
git clone https://github.com/suzuk12345/RealWorld_Conduit.git
cd RealWorld_Conduit
```

composer install/.env作成
```bash
composer install
cp .env.example .env
```

コンテナ起動/キー生成
```bash
./vendor/bin/sail up -d
./vendor/bin/sail artisan key:generate
```

任意) sailコマンドのBashエイリアスを構成
```bash
alias sail='[ -f sail ] && bash sail || bash vendor/bin/sail'
```

セットアップ完了 ホームページやphpMyAdminにアクセスできます。
- ホームページ
http://localhost/conduit/
- phpMyAdmin
http://localhost:8080/

# 主要ディレクトリ/ファイル
- Model
    - [app/Models/ConduitArticle.php](https://github.com/suzuk12345/RealWorld_Conduit/blob/master/app/Models/ConduitArticle.php)
    - [migrations/create_conduit_articles_table.php](https://github.com/suzuk12345/RealWorld_Conduit/blob/master/database/migrations/2023_12_23_113214_create_conduit_articles_table.php)
- View
    - [resources/views/conduit](https://github.com/suzuk12345/RealWorld_Conduit/tree/master/resources/views/conduit)
- Controller
    - [app/Http/Controllers/ConduitArticleController.php](https://github.com/suzuk12345/RealWorld_Conduit/blob/master/app/Http/Controllers/ConduitArticleController.php)
- Route
    - [routes/web.php](https://github.com/suzuk12345/RealWorld_Conduit/blob/master/routes/web.php)
