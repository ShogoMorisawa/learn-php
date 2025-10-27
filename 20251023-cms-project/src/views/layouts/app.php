<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title><?= htmlspecialchars($title ?? 'CMS PDO System') ?></title>
    
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >
    <link rel="stylesheet" href="/assets/css/style.css">
</head>
<body>
    <?php if (isset($isAdminPage) && $isAdminPage) {
        include __DIR__ . '/../partials/admin-nav.php';
    } else {
        include __DIR__ . '/../partials/nav.php';
    } ?>

    <div id="content">
        <?php if (isset($flash['status'])): ?>
            <div class="alert alert-success" role="alert">
                <?= htmlspecialchars($flash['status']) ?>
            </div>
        <?php endif; ?>
        <?php if (isset($flash['errors']) && !empty($flash['errors'])): ?>
            <div class="alert alert-danger" role="alert">
                <ul class="mb-0">
                    <?php foreach ($flash['errors'] as $error): ?>
                        <li><?= htmlspecialchars($error) ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>
        
        <div class="container my-5">
            <?= $content ?? '' ?>
        </div>
    </div>


    <!-- Footer -->
    <?php include __DIR__ . '/../partials/footer.php'; ?>

    <!-- Bootstrap JS and dependencies -->
    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
    ></script>
</body>
</html>