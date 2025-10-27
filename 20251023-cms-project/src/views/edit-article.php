<!-- Main Content -->
<main class="container my-5">
    <h2>Edit Article</h2>
    <form action="/admin/edit/<?= $article['id'] ?>" method="post">
        <?= csrfInput(); ?>
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