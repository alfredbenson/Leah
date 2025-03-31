<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Split-Bill</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background: url('images/money.jpg') no-repeat center center fixed;
            background-size: cover;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            position: relative;
            overflow: hidden;
        }
        
        .hero-section {
            background: rgba(0, 0, 0, 0.6);
            color: white;
            padding: 120px 20px;
            text-align: center;
            position: relative;
            border-radius: 10px;
            margin: 50px auto;
            width: 80%;
        }
        .hero-section h1 { font-size: 2.5rem; }
        .hero-section p { font-size: 1.2rem; }
        .features-section {
            padding: 60px 20px;
        }
        .feature-box {
            background: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            text-align: center;
            transition: transform 0.3s ease-in-out;
        }
        .feature-box:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
        }
        .feature-box i { color: #007bff; margin-bottom: 15px; }
        .footer {
            background: #212529;
            color: white;
            text-align: center;
            padding: 20px;
            width: 100%;
        }
    </style>
     <style>
        /* Light Mode (Default) */
body {
    background: #f4f4f4;
    color: #333;
    transition: background 0.3s, color 0.3s;
}

.bill-container, .bill-form {
    background: white;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

/* Dark Mode */
.dark-mode {
    background: #121212;
    color: #f1f1f1;
}

.dark-mode .bill-container,
.dark-mode .bill-form {
    background: #1e1e1e;
    box-shadow: 0 0 10px rgba(255, 255, 255, 0.1);
}

.dark-mode .navbar {
    background: #000 !important;
}

.dark-mode .btn-primary {
    background: #007bff;
    border: none;
}

.dark-mode .btn-outline-light {
    border-color: #fff;
}
.dark-mode .feature-box {
    background: #333;
    color: #f1f1f1;
    box-shadow: 0 4px 15px rgba(255, 255, 255, 0.1);
}
.dark-mode .feature-box i {
    color: #f1f1f1;
}


    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="#">
            <img src="images/logo.png" alt="Bill Management Logo" height="40">
        </a>

        <!-- Search Bar on the Left -->
        <form class="d-flex me-auto ms-3" role="search" action="search.php" method="GET">
            <input class="form-control me-2" type="search" name="query" placeholder="Search..." aria-label="Search">
            <button class="btn btn-outline-light" type="submit">
                <i class="fas fa-search"></i>
            </button>
        </form>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        
        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav">
            <button id="darkModeToggle" class="btn ">
                🌙 
            </button>
                <li class="nav-item"> <a class="nav-link" href="dashboard.php">Dashboard</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Features</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Contact</a></li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="profileDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-user-circle fa-lg"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="profileDropdown">
                        <li><a class="dropdown-item" href="profile.php">Profile</a></li>
                        <li><a class="dropdown-item" href="settings.php">Settings</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="login.php">Logout</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>


    <div class="hero-section">
        <h1>Welcome to Split-Bill</h1>
        <p>Efficiently track, split, and manage your bills with ease.</p>
        <a href="dashboard.php" class="btn btn-primary btn-lg mt-3">Go to Dashboard</a>
    </div>

    <div class="container features-section">
        <div class="row g-4">
            <div class="col-md-4">
                <div class="feature-box">
                    <i class="fas fa-file-invoice-dollar fa-3x"></i>
                    <h3>Bill Tracking</h3>
                    <p>Keep a record of all your bills and payments in one place.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="feature-box">
                    <i class="fas fa-users fa-3x"></i>
                    <h3>Bill Splitting</h3>
                    <p>Split expenses with friends, roommates, or colleagues easily.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="feature-box">
                    <i class="fas fa-chart-line fa-3x"></i>
                    <h3>Reports & Insights</h3>
                    <p>Generate reports and gain insights on your spending habits.</p>
                </div>
            </div>
        </div>
    </div>

    <div class="footer">
        <p>&copy; 2025 Split-Bill  AlCed Company Corp. All rights reserved.</p>
    </div>
    <script>
document.addEventListener("DOMContentLoaded", function () {
    const toggleButton = document.getElementById("darkModeToggle");
    const body = document.body;

    // Function to update button text/icon
    function updateButton() {
        if (body.classList.contains("dark-mode")) {
            toggleButton.textContent = "☀️"; // Change to day mode text
        } else {
            toggleButton.textContent = "🌙"; // Change to dark mode text
        }
    }

    // Check local storage for theme preference
    if (localStorage.getItem("darkMode") === "enabled") {
        body.classList.add("dark-mode");
        updateButton();
    }

    toggleButton.addEventListener("click", function () {
        body.classList.toggle("dark-mode");

        // Save preference in localStorage
        if (body.classList.contains("dark-mode")) {
            localStorage.setItem("darkMode", "enabled");
        } else {
            localStorage.removeItem("darkMode");
        }

        updateButton();
    });
});
</script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
