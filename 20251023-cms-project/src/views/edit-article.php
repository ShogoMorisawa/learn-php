<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Article - Admin - CMS PDO System</title>
    <!-- Bootstrap CSS -->
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
        rel="stylesheet"
        crossorigin="anonymous"
    >
    <!-- Custom CSS -->
    <style>
        /* Sticky Footer Styles */
        html, body {
            height: 100%;
            margin: 0;
        }

        body {
            display: flex;
            flex-direction: column;
        }

        main {
            flex: 1;
        }
    </style>
</head>
<body>
    <!-- Navigation Bar -->
    <?php include __DIR__ . '/partials/admin-nav.php'; ?>

    <!-- Main Content -->
    <main class="container my-5">
        <h2>Edit Article</h2>
        <form action="/admin/edit/<?= $article['id'] ?>" method="post">
            <div class="mb-3">
                <label for="title" class="form-label">Article Title *</label>
                <input type="text" class="form-control" id="title" name='title' value="<?= $article[
                    'title'
                ] ?>" required>
            </div>
            <div class="mb-3">
                <label for="content" class="form-label">Content *</label>
                <textarea class="form-control" id="content" rows="10" name='content' required><?= $article[
                    'content'
                ] ?></textarea>
            </div>
            <div class="mb-3">
                <label for="image" class="form-label">Featured Image URL</label>
                <input type="url" class="form-control" id="image" name='image' value="<?= $article[
                    'image'
                ] ?>">
            </div>
            <button type="submit" class="btn btn-primary">Update Article</button>
            <a href="/admin" class="btn btn-secondary ms-2">Cancel</a>
        </form>
    </main>

    <!-- Footer -->
    <?php include __DIR__ . '/partials/footer.php'; ?>

    <!-- Bootstrap JS -->
    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        crossorigin="anonymous"
    ></script>
</body>
</html>
