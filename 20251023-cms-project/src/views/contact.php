<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Contact Us - CMS PDO System</title>
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
    <header class="bg-secondary text-white py-5">
        <div class="container">
            <h1 class="display-4">Contact Us</h1>
            <p class="lead">
                We'd love to hear from you!
            </p>
        </div>
    </header>

    <!-- Main Content -->
    <main class="container my-5">
        <div class="row">
            <!-- Contact Form -->
            <div class="col-md-6">
                <h2>Get in Touch</h2>
                <form action="mailto:edwin@edwindiaz.com.com" method="post" enctype="text/plain">
                    <div class="mb-3">
                        <label for="name" class="form-label">Name *</label>
                        <input
                            type="text"
                            class="form-control"
                            id="name"
                            required
                        >
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email *</label>
                        <input
                            type="email"
                            class="form-control"
                            id="email"
                            required
                        >
                    </div>
                    <div class="mb-3">
                        <label for="message" class="form-label">Message *</label>
                        <textarea
                            class="form-control"
                            id="message"
                            rows="5"
                            required
                        ></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Send Message</button>
                </form>
            </div>
            <!-- Contact Information -->
            <div class="col-md-6">
                <h2>Contact Information</h2>
                <p>
                    Feel free to reach out to us through any of the following methods.
                </p>
                <ul class="list-unstyled">
                    <li>
                        <strong>Email:</strong> <a href="mailto:edwin@edwindiaz.com.com">edwin@edwindiaz.com.com</a>
                    </li>
                    <li>
                        <strong>Phone:</strong> (123) 456-7890
                    </li>
                    <li>
                        <strong>Address:</strong> 123 Blog Street, City, Country
                    </li>
                </ul>
                <h2>Follow Us</h2>
                <a href="#" class="text-decoration-none me-3">
                    <i class="fab fa-facebook fa-2x"></i>
                </a>
                <a href="#" class="text-decoration-none me-3">
                    <i class="fab fa-twitter fa-2x"></i>
                </a>
                <a href="#" class="text-decoration-none me-3">
                    <i class="fab fa-instagram fa-2x"></i>
                </a>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <?php include __DIR__ . '/partials/footer.php'; ?>

    <!-- Bootstrap JS and dependencies -->
    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
    ></script>
    <!-- Font Awesome JS -->
    <script
        src="https://kit.fontawesome.com/your-fontawesome-kit.js"
      
    ></script>
</body>
</html>
