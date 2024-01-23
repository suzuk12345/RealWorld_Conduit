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

-   PHP 8.2.14
-   Laravel 10.38.2
-   MySQL 8.0.32
-   HTML/CSS/Bootstrap (RealWorld のテンプレートを使用)

# 機能

### 実装済み

-   JWT 認証
-   ユーザー CRU-
-   記事 CRUD
-   タグ機能

### 未実装

-   記事へのコメント CR-D
-   記事一覧ページネーション
-   記事お気に入り
-   記事マークダウン反映
-   ユーザーフォロー
-   テスト
-   バリデーション
-   ダミー生成

# セットアップ

PHP と Composer がコンピュータにグローバルにインストールされていることを確認してください。

リポジトリのクローンを作成し、プロジェクトフォルダーに移動

```bash
git clone https://github.com/suzuk12345/RealWorld_Conduit.git
cd RealWorld_Conduit
```

composer install/.env 作成

```bash
composer install
cp .env.example .env
```

コンテナ起動/キー生成

```bash
./vendor/bin/sail up -d
./vendor/bin/sail artisan key:generate
```

任意) sail コマンドの Bash エイリアスを構成

```bash
alias sail='[ -f sail ] && bash sail || bash vendor/bin/sail'
```

セットアップ完了 API や phpMyAdmin にアクセスできます。

-   phpMyAdmin
    http://localhost:8080/

# 主要ディレクトリ/ファイル

-   Model
    -   [app/Models/User.php](https://github.com/suzuk12345/RealWorld_Conduit/blob/API/app/Models/User.php)
    -   [app/Models/Article.php](https://github.com/suzuk12345/RealWorld_Conduit/blob/API/app/Models/Article.php)
-   Migration
    -   [migrations/create_users_table.php](https://github.com/suzuk12345/RealWorld_Conduit/blob/API/database/migrations/2014_10_12_000000_create_users_table.php)
    -   [migrations/create_conduit_articles_table.php](https://github.com/suzuk12345/RealWorld_Conduit/blob/master/database/migrations/2023_12_23_113214_create_conduit_articles_table.php)
-   Controller
    -   [app/Http/Controllers/AuthController.php](https://github.com/suzuk12345/RealWorld_Conduit/blob/API/app/Http/Controllers/AuthController.php)
    -   [app/Http/Controllers/UserController.php](https://github.com/suzuk12345/RealWorld_Conduit/blob/API/app/Http/Controllers/UserController.php)
    -   [app/Http/Controllers/ArticleController.php](https://github.com/suzuk12345/RealWorld_Conduit/blob/API/app/Http/Controllers/ArticleController.php)
-   Route
    -   [routes/api.php](https://github.com/suzuk12345/RealWorld_Conduit/blob/API/routes/api.php)
-   Postman ([オリジナル](https://github.com/gothinkster/realworld/blob/main/api/Conduit.postman_collection.json)を参考に実装済みの部分のみに修正)
    -   [Conduit.postman_collection.json](https://github.com/suzuk12345/RealWorld_Conduit/blob/API/Conduit.postman_collection.json)
