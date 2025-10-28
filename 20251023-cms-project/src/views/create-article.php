
    <!-- Main Content -->
    <main class="container my-5">
        <h2>Create New Article</h2>
        <form action="/admin/create" method="post" enctype="multipart/form-data">
            <?= csrfInput() ?>
            <div class="mb-3">
                <label for="title" class="form-label">Article Title *</label>
                <input type="text" class="form-control" id="title" name="title" placeholder="Enter article title" value="<?= $oldInput[
                    'title'
                ] ?? '' ?>" required>
            </div>
            <div class="mb-3">
                <label for="content" class="form-label">Content *</label>
                <textarea class="form-control" id="content" name="content" rows="10" placeholder="Enter article content" required><?= $oldInput[
                    'content'
                ] ?? '' ?></textarea>
            </div>
            <div class="mb-3">
                <label for="image" class="form-label">Featured Image</label>
                <input type="file" class="form-control" id="image" name="image" accept="image/*">
            </div>
            <button type="submit" class="btn btn-success">Publish Article</button>
            <a href="/admin" class="btn btn-secondary ms-2">Cancel</a>
        </form>
    </main>

