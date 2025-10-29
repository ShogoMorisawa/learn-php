    <main class="container my-5">
        <h2 class="mb-4">Admin Dashboard</h2>
        <div class="table-responsive">
            <?php if ($totalPages > 1): ?>
                <nav aria-label="Page navigation">
                    <ul class="pagination">
                        <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                            <li class="page-item <?= $i == $page ? 'active' : '' ?>">
                                <a class="page-link" href="/admin?page=<?= $i ?>">
                                    <?= $i ?>
                                </a>
                            </li>
                        <?php endfor; ?>
                    </ul>
                </nav>
            <?php endif; ?>
            <form method="POST" action="/admin/delete-multiple">
                <?= csrfInput() ?>
                <button class="btn btn-sm btn-danger me-1" type="submit" name="delete_multiple_articles" onclick="return confirm('Are you sure you want to delete these articles?')">Delete Multiple Articles</button>
     
            <table class="table table-bordered table-hover align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>check box</th>
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
                        <td><input type="checkbox" name="article_ids[]" value="<?= $article[
                            'id'
                        ] ?>"></td>
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
                                <?= csrfInput() ?>
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
        </form>         
        </div>
    </main>
