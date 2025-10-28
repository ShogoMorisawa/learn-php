
    <!-- Article Header -->
    <header class="bg-dark text-white py-5">
        <div class="container">
            <h1 class="display-4"><?= htmlspecialchars($article['title']) ?></h1>
            <p class="lead">
                <?= htmlspecialchars($article['content']) ?>
            </p>
            <p>
                <small>
                    By <a href="#" class="text-white text-decoration-underline"><?= htmlspecialchars(
                        $article['author_name'] ?? 'Unknown',
                    ) ?></a>
                    |
                    <span><?= $article['updated_at'] ?></span>
                </small>
            </p>
        </div>
    </header>


    <!-- Main Content -->
    <main class="container my-5">
        <!-- Featured Image -->
        <?php if (!empty($article['image'])): ?>
            <div class="mb-4 text-center">
                <img
                    src="<?= htmlspecialchars($article['image']) ?>"
                    alt="<?= htmlspecialchars($article['title']) ?>"
                    class="img-fluid w-100"
                >
            </div>
        <?php endif; ?>
        <!-- Article Content -->
        <article>
            <p>
                <?= nl2br(htmlspecialchars($article['content'])) ?>
            </p>
        </article>

        <!-- Comments Section Placeholder -->
        <section class="mt-5">
            <h3>Comments</h3>
            <p>
                <!-- Placeholder for comments -->
                Comments functionality will be implemented here.
            </p>
        </section>

        <!-- Back to Home Button -->
        <div class="mt-4">
            <a href="/" class="btn btn-secondary">← Back to Home</a>
        </div>
    </main>

