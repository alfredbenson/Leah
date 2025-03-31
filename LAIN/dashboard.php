
<!DOCTYPE html> 
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        body { background: #f4f4f4; padding: 20px; }
        .bill-container, .bill-form { background: white; padding: 20px; border-radius: 10px; box-shadow: 0 0 10px rgba(211, 205, 205, 0.16); margin-top: 20px; }
    </style>
    <style>
        /* Light Mode (Default) */
body {
    background: #f4f4f4;
    color: #333;
    transition: background 0.3s, color 0.3s;
    padding: 0;
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
            <li class="nav-item">
    <button id="darkModeToggle" class="btn ">
        🌙 
    </button>
</li>
                <li class="nav-item"> <a class="nav-link" href="landingpage.php">Home</a></li>
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



<script>
document.addEventListener("DOMContentLoaded", function () {
    const toggleButton = document.getElementById("darkModeToggle");
    const body = document.body;

    // Function to update button text and icon
    function updateButton() {
        if (body.classList.contains("dark-mode")) {
            toggleButton.innerHTML = "☀️ ";
        } else {
            toggleButton.innerHTML = "🌙 ";
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
 


</body>
</html>
