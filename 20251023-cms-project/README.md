# CMS PDO Learning Project

手作りの MVC 構成で CMS を構築しながら、PHP での認証／CRUD／画像アップロード／検索・ページネーション／CSRF 対策／ユニットテストなどを一通り学習するためのリポジトリです。

> ラーニング用に作成したアプリのため、商用利用に足る堅牢性・機能性は想定していませんが、学習教材としては十分な規模になっています。

## 主な機能

- **記事の CRUD**
  - 管理画面から新規作成・編集・削除（一覧には自分の記事のみ表示）
  - チェックボックス＋一括削除フォームによる複数削除
- **画像アップロード**
  - 許可拡張子／サイズチェックと `public/uploads` への保存
  - 記事を削除した際は画像ファイルも削除
- **認証**
  - ログイン／ログアウト／ユーザー登録
  - 所有者チェック（他人の記事は編集・削除不可）
- **CSRF 対策**
  - すべての POST フォームにトークンを埋め込み、サーバ側で検証
- **検索 & ページネーション**
  - 管理画面：タイトル検索 + ページネーション
  - 公開側ホーム：ページネーション、著者名・投稿日の表示
- **共通レイアウト**
  - ナビゲーション／フッター／フラッシュメッセージをまとめたテンプレート
- **ユニットテスト**
  - SQLite オンメモリを使ったモデルテスト
  - ヘルパ関数（セッション操作、CSRF ユーティリティ）のテスト

## 技術スタック

- **PHP** 8.4
- **Composer**（`vlucas/phpdotenv`, `phpunit/phpunit` など）
- **PDO**（MySQL / SQLite）
- **Bootstrap 5**（ビューのスタイル向け）
- **PHPUnit 12**（ユニットテスト）

## セットアップ

```bash
git clone https://github.com/your-name/20251023-cms-project.git
cd 20251023-cms-project

composer install
```

### 1. `.env` の作成
プロジェクト直下に `.env` を作成し、DB 接続情報を記入してください。

```
DB_HOST=127.0.0.1
DB_DATABASE=cms_pdo
DB_USERNAME=root
DB_PASSWORD=
```

> `.env` は `.gitignore` に含めてリポジトリにコミットしないようにしてください。

### 2. データベースの準備

Udemy 講座で使用されたサンプルに基づき、MySQL 等で以下のテーブルを作成します。

```sql
CREATE TABLE users (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE articles (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    content TEXT NOT NULL,
    user_id INT UNSIGNED NOT NULL,
    image VARCHAR(255) DEFAULT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);
```

### 3. 画像アップロード先の準備

```bash
mkdir -p public/uploads
```

`public/uploads` ディレクトリに書き込み権限があるか確認してください。

## 開発サーバの起動

```bash
php -S localhost:8000 -t public
```

ブラウザで `http://localhost:8000` を開くとホーム画面が表示されます。管理画面は `http://localhost:8000/admin`（ログインが必要）です。

## テストの実行

```bash
./vendor/bin/phpunit
```

- `phpunit.xml` と `tests/bootstrap.php` でテスト用の SQLite オンメモリ DB をセットアップしています。
- `tests/Unit` にモデルやヘルパ関数のユニットテストを配置しています。

## ディレクトリ構成（抜粋）

```
.
├── config
│   └── database.php        # Dotenv で環境変数を読み込み、PDO を生成
├── public
│   ├── index.php           # フロントコントローラ
│   ├── uploads/            # 画像アップロード先
│   └── assets/             # CSS / JS
├── src
│   ├── Controllers/        # MVC のコントローラ
│   ├── Models/             # Article 等のモデル
│   ├── views/              # PHP テンプレート（partials, layouts を含む）
│   └── helpers.php         # CSRF やフラッシュメッセージなどのユーティリティ
├── tests
│   ├── Unit/               # ユニットテスト（Article, Helpers 等）
│   └── bootstrap.php       # テスト用のセットアップ
├── phpunit.xml
└── composer.{json,lock}
```

## 今後のアイデア

- Feature テストの追加（HTTP レベルでの挙動検証）
- 記事本文の Markdown 対応
- フロント側コメントや関連記事など UI の強化
- CI（GitHub Actions 等）での自動テスト・静的解析

## ライセンス

学習目的で作成したため、特にライセンスは定めていません。ご自身の学習用途で自由にご利用ください。必要であれば MIT などのライセンスを付与してください。

---

何か不具合や改善案があれば、Issues や Pull Request（あるいはメモ）で共有いただけると嬉しいです。Enjoy coding!
