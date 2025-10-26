<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard - CMS PDO System</title>
    <!-- Bootstrap CSS -->
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
        rel="stylesheet"

    >

    <style>
            /* Make sure the html and body take up the full height */
    html, body {
        height: 100%;
        margin: 0;
    }

    body {
        display: flex;
        flex-direction: column;
    }

    /* Main content will expand to fill the available space */
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
        <h2 class="mb-4">Admin Dashboard</h2>

        <!-- Articles Table -->
        <div class="table-responsive">
            <table class="table table-bordered table-hover align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Author</th>
                        <th>Published Date</th>
                        <th>Excerpt</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($articles)): ?>
                     <?php foreach ($articles as $article): ?>
                    <tr>
                        <td><?= $article['id'] ?></td>
                        <td><?= $article['title'] ?></td>
                        <td>shogomorisawa</td>
                        <td><?= $article['updated_at'] ?></td>
                        <td><?= $article['content'] ?></td>
                        <td>
                            <a href="/admin/edit/<?= $article[
                                'id'
                            ] ?>" class="btn btn-sm btn-primary me-1">Edit</a>
                            <form method="POST" style="display:inline-block;" action="/admin/delete/<?= $article[
                                'id'
                            ] ?>">
                                <button class="btn btn-sm btn-danger me-1" type="submit" name="delete_article" onclick="return confirm('Are you sure you want to delete this article?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                    <?php else: ?>
                    <tr>
                        <td colspan="5">No articles found.</td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-dark text-white py-3 mt-auto">
        <div class="container text-center">
            <p class="mb-0">&copy; 2045 CMS PDO System. All rights reserved by Edwin Diaz from EdwinDiaz.com</p>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"

    ></script>

    <!-- Custom JS -->
    <script>
        function confirmDelete(articleId) {
            if (confirm('Are you sure you want to delete this article?')) {
                // Implement deletion logic here
                // For example, make an AJAX request to delete the article
                alert('Article ' + articleId + ' deleted.');
            }
        }
    </script>
</body>
</html>
