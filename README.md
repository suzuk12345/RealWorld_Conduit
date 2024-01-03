# Conduit

ブログプラットフォームを作る [RealWorld](https://github.com/gothinkster/realworld/tree/main) という OSS のプロジェクトがあります。RealWorld は実世界と同じ機能を持つプラットフォームを作ることで、学習したいフレームワークの技術を習得することを目的としてたプロジェクトです。

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

### 未実装
- タグ機能
- JWT認証
- ユーザー CRU-
- 記事へのコメント CR-D
- ページネーション
- 記事お気に入り
- ユーザーフォロー
- テスト
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

