<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register - CMS PDO System</title>
    <!-- Bootstrap CSS -->
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >
</head>
<body>
    <!-- Navigation Bar -->
    <?php include __DIR__ . '/partials/nav.php'; ?>

    <!-- Main Content -->
    <main class="container my-5">
        <h2 class="text-center mb-4">Register</h2>
        <div class="row justify-content-center">
            <div class="col-md-6">
                <form action="/register" method="post">
                    <div class="mb-3">
                        <label for="name" class="form-label">Full Name *</label>
                        <input
                            type="text"
                            class="form-control"
                            id="name"
                            required
                        >
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email address *</label>
                        <input
                            type="email"
                            class="form-control"
                            id="email"
                            required
                        >
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password *</label>
                        <input
                            type="password"
                            class="form-control"
                            id="password"
                            required
                        >
                    </div>
                    <div class="mb-3">
                        <label for="confirm-password" class="form-label">Confirm Password *</label>
                        <input
                            type="password"
                            class="form-control"
                            id="confirm-password"
                            required
                        >
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Register</button>
                </form>
                <p class="mt-3 text-center">
                    Already have an account? <a href="/login">Login here</a>.
                </p>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <?php include __DIR__ . '/partials/footer.php'; ?>

    <!-- Bootstrap JS -->
    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
    ></script>
</body>
</html>
