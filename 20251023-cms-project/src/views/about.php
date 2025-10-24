<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>About Us - CMS PDO System</title>
    <!-- Bootstrap CSS -->
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >
</head>
<body>
    <!-- Navigation Bar -->
    <?php include __DIR__ . '/partials/nav.php'; ?>

    <!-- Header Section -->
    <header class="bg-primary text-white py-5">
        <div class="container">
            <h1 class="display-4">About Us</h1>
            <p class="lead">
                Learn more about our mission and values.
            </p>
        </div>
    </header>

    <!-- Main Content -->
    <main class="container my-5">
        <h2>Our Story</h2>
        <p>
            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce auctor arcu quis nibh dapibus, id mollis leo dignissim. 
            Donec euismod, nisl eget consectetur sagittis, nisl nunc ultricies nisi, in semper nisl nunc eget lacus.
        </p>
        <p>
            Aliquam erat volutpat. Praesent at lacus in sem accumsan suscipit. Integer a odio at nisi aliquam vulputate.
        </p>
        <h2>Our Team</h2>
        <p>
            Meet the passionate individuals behind our blog.
        </p>
        <!-- Team Members -->
        <div class="row">
            <!-- Team Member 1 -->
            <div class="col-md-4 text-center">
                <img
                    src="https://via.placeholder.com/150"
                    class="rounded-circle mb-3"
                    alt="Team Member"
                >
                <h5>Edwin Diaz</h5>
                <p class="text-muted">Founder & Editor</p>
            </div>
            <!-- Team Member 2 -->
            <div class="col-md-4 text-center">
                <img
                    src="https://via.placeholder.com/150"
                    class="rounded-circle mb-3"
                    alt="Team Member"
                >
                <h5>Jose Diaz</h5>
                <p class="text-muted">Content Writer</p>
            </div>
            <!-- Team Member 3 -->
            <div class="col-md-4 text-center">
                <img
                    src="https://via.placeholder.com/150"
                    class="rounded-circle mb-3"
                    alt="Team Member"
                >
                <h5>Maria Gonzalez</h5>
                <p class="text-muted">Graphic Designer</p>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <?php include __DIR__ . '/partials/footer.php'; ?>

    <!-- Bootstrap JS and dependencies -->
    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
    ></script>
</body>
</html>
