<?php include BASE_PATH . '/app/views/partials/header.php'; ?>

<div class="row justify-content-center">
    <div class="col-md-8 col-lg-6">
        <div class="card shadow">
            <div class="card-body p-4">
                <div class="text-center mb-4">
                    <i class="bi bi-person-plus-fill display-4 text-success"></i>
                    <h2 class="card-title mt-2">Create Account</h2>
                    <p class="text-muted">Join our medical prescription system</p>
                </div>

                <?php if (isset($_SESSION['flash'])): ?>
                    <div class="alert alert-info alert-dismissible fade show" role="alert">
                        <i class="bi bi-info-circle me-2"></i>
                        <?= htmlspecialchars($_SESSION['flash']) ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                    <?php unset($_SESSION['flash']); ?>
                <?php endif; ?>

                <form method="post" action="?action=register-post">
                    <?php csrf_field(); ?>
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="name" class="form-label">
                                <i class="bi bi-person me-1"></i>Full Name *
                            </label>
                            <input type="text" class="form-control" id="name" name="name" required 
                                   placeholder="Enter your full name">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="email" class="form-label">
                                <i class="bi bi-envelope me-1"></i>Email Address *
                            </label>
                            <input type="email" class="form-control" id="email" name="email" required 
                                   placeholder="Enter your email">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="address" class="form-label">
                            <i class="bi bi-geo-alt me-1"></i>Address
                        </label>
                        <input type="text" class="form-control" id="address" name="address" 
                               placeholder="Enter your address">
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="contact_no" class="form-label">
                                <i class="bi bi-phone me-1"></i>Contact Number
                            </label>
                            <input type="text" class="form-control" id="contact_no" name="contact_no" 
                                   placeholder="Enter your phone number">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="dob" class="form-label">
                                <i class="bi bi-calendar me-1"></i>Date of Birth
                            </label>
                            <input type="date" class="form-control" id="dob" name="dob">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">
                            <i class="bi bi-lock me-1"></i>Password *
                        </label>
                        <input type="password" class="form-control" id="password" name="password" required 
                               placeholder="Choose a secure password">
                    </div>

                    <div class="d-grid mb-3">
                        <button type="submit" class="btn btn-success">
                            <i class="bi bi-person-plus me-2"></i>Create Account
                        </button>
                    </div>
                </form>

                <div class="text-center">
                    <p class="text-muted">Already have an account?</p>
                    <a href="?action=login" class="btn btn-outline-primary">
                        <i class="bi bi-box-arrow-in-right me-2"></i>Login
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include BASE_PATH . '/app/views/partials/footer.php'; ?>
