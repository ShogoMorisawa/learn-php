
    <!-- Header Section -->
    <header class="bg-dark text-white py-5">
        <div class="container">
            <h1 class="display-4">Welcome to the CMS PDO System</h1>
            <p class="lead">Sharing insights, ideas, and stories.</p>
        </div>
    </header>

    <!-- Main Content -->
    <main class="container my-5">
        <div class="row">
            <?php foreach ($articles as $article): ?>
            <div class="row mb-4">
                <div class="col-md-4">
                    <img
                        src="https://via.placeholder.com/350x200"
                        class="img-fluid"
                        alt="Blog Post Image"
                    >
                </div>
                <div class="col-md-8">
                    <h2><?= $article['title'] ?></h2>
                    <p>
                        <?= $article['content'] ?>
                    </p>
                    <a href="/article/<?= $article['id'] ?>" class="btn btn-primary">Read More</a>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </main>
