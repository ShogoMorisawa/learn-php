
    <!-- Header Section -->
    <header class="bg-dark text-white py-5">
        <div class="container">
            <h1 class="display-4">Welcome to the CMS PDO System</h1>
            <p class="lead">Sharing insights, ideas, and stories.</p>
        </div>
    </header>

    <!-- Main Content -->
    <main class="container my-5">
        <?php if ($totalPages > 1): ?>
            <nav aria-label="Page navigation">
                <ul class="pagination justify-content-center mb-4">
                    <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                        <li class="page-item <?= $i == $page ? 'active' : '' ?>">
                            <a class="page-link" href="/?page=<?= $i ?>">
                                <?= $i ?>
                            </a>
                        </li>
                    <?php endfor; ?>
                </ul>
            </nav>
        <?php endif; ?>

        <?php foreach ($articles as $article): ?>
            <div class="row mb-5 pb-4 border-bottom">
                <div class="col-md-4 mb-3 mb-md-0">
                    <?php if (!empty($article['image'])): ?>
                        <a href="/article/<?= $article['id'] ?>">
                            <img
                                src="<?= htmlspecialchars($article['image']) ?>"
                                alt="<?= htmlspecialchars($article['title']) ?>"
                                class="img-fluid rounded shadow-sm"
                                style="object-fit: cover; height: 200px; width: 100%;"
                            >
                        </a>
                    <?php else: ?>
                        <a href="/article/<?= $article['id'] ?>">
                            <img
                                src="https://via.placeholder.com/350x200"
                                class="img-fluid rounded shadow-sm"
                                alt="Blog Post Image"
                                style="object-fit: cover; height: 200px; width: 100%;"
                            >
                        </a>
                    <?php endif; ?>
                </div>
                <div class="col-md-8">
                    <h2 class="mb-2">
                        <a href="/article/<?= $article[
                            'id'
                        ] ?>" class="text-decoration-none text-dark">
                            <?= htmlspecialchars($article['title']) ?>
                        </a>
                    </h2>
                    <p class="text-muted mb-2">
                        <i class="bi bi-person"></i> <?= htmlspecialchars(
                            $article['author_name'] ?? 'Unknown',
                        ) ?>
                        <span class="mx-2">|</span>
                        <i class="bi bi-calendar"></i> <?= date(
                            'Y-m-d',
                            strtotime($article['created_at']),
                        ) ?>
                    </p>
                    <p class="mb-3"><?= htmlspecialchars(
                        mb_strimwidth($article['content'], 0, 160, '...'),
                    ) ?></p>
                    <a href="/article/<?= $article[
                        'id'
                    ] ?>" class="btn btn-outline-primary">Read More</a>
                </div>
            </div>
        <?php endforeach; ?>

        <?php if ($totalPages > 1): ?>
            <nav aria-label="Page navigation">
                <ul class="pagination justify-content-center mt-4">
                    <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                        <li class="page-item <?= $i == $page ? 'active' : '' ?>">
                            <a class="page-link" href="/?page=<?= $i ?>">
                                <?= $i ?>
                            </a>
                        </li>
                    <?php endfor; ?>
                </ul>
            </nav>
        <?php endif; ?>
    </main>
