
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


<!-- Main Content -->
<div class="container mt-5">
    <div class="bill-container">
        <h2>View List Bills</h2>
        <div class="d-flex justify-content-end">
            <button class="btn btn-primary" id="addBill">➕ Add Bill</button>
        </div>
        <ul id="billList" class="list-group mt-3"></ul>
    </div>
    
    <div class="bill-form" id="billForm" style="display:none;">
        <h2>Create a Bill</h2>
        <form id="billCreationForm">
            <div class="mb-3">
                <label for="billCode" class="form-label">Generated Code</label>
                <input type="text" class="form-control" id="billCode" readonly>
            </div>
            <div class="mb-3">
                <label for="billName" class="form-label">Bill Name</label>
                <input type="text" class="form-control" id="billName" required>
            </div>
            <div class="mb-3">
                <label for="billAmount" class="form-label">Total Amount</label>
                <input type="number" class="form-control" id="billAmount" required>
            </div>
            <div class="mb-3">
                <label for="participants" class="form-label">Add Participants</label>
                <textarea class="form-control" id="participants" placeholder="Enter names separated by commas" required></textarea>
            </div>
            <button type="submit" class="btn btn-success">Save Bill</button>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
 $(document).ready(function() {
    function generateBillCode() {
        return 'BILL-' + Math.random().toString(36).substr(2, 8).toUpperCase();
    }

    let billList = JSON.parse(localStorage.getItem("billList")) || [];

    function renderBillList() {
        $("#billList").empty();
        billList.forEach(bill => {
            $("#billList").append(
                `<li class='list-group-item bill-item d-flex justify-content-between align-items-center'>
                    <div>
                        <strong>${bill.name} (${bill.code})</strong><br>
                        Total: $${bill.amount}<br>${bill.details}
                    </div>
                    <button class='btn btn-danger btn-sm delete-bill' data-code='${bill.code}'>Delete</button>
                </li>`
            );
        });
    }

    renderBillList(); // Load stored bills on page load

    $("#addBill").click(function() {
        $("#billForm").toggle();
        $("#billCode").val(generateBillCode());
    });

    $("#billCreationForm").submit(function(event) {
        event.preventDefault();
        let billName = $("#billName").val().trim();
        let billAmount = parseFloat($("#billAmount").val());
        let participants = $("#participants").val().trim().split(',').map(p => p.trim());
        let billCode = $("#billCode").val();

        if (billName === "" || isNaN(billAmount) || participants.length === 0) {
            alert("Please enter valid bill details.");
            return;
        }

        let perPersonInput = "";
        participants.forEach(participant => {
            perPersonInput += `<div class='mb-3'>
                                <label>${participant} covers for:</label>
                                <input type='number' class='form-control personShare' data-name='${participant}' min='1' value='1'>
                               </div>`;
        });

        let splitForm = `<div class='bill-form' id='splitForm'>
                            <h2>Customize Split</h2>
                            ${perPersonInput}
                            <button class='btn btn-primary' id='calculateSplit'>Calculate</button>
                        </div>`;

        $("#billForm").after(splitForm);

        $("#calculateSplit").click(function() {
            let totalShares = 0;
            let contributions = {};

            $(".personShare").each(function() {
                let name = $(this).data("name");
                let shares = parseInt($(this).val());
                contributions[name] = shares;
                totalShares += shares;
            });

            let billDetails = "";
            for (let person in contributions) {
                let shareAmount = (billAmount * (contributions[person] / totalShares)).toFixed(2);
                billDetails += `${person} pays: $${shareAmount}<br>`;
            }

            let bill = { name: billName, code: billCode, amount: billAmount, details: billDetails };
            billList.push(bill);
            localStorage.setItem("billList", JSON.stringify(billList)); // Store in localStorage

            renderBillList(); // Update the displayed list

            $("#splitForm").remove();
            $("#billForm").hide();
            $("#billCreationForm")[0].reset();
        });
    });

    // Handle delete with persistence
    $("#billList").on("click", ".delete-bill", function() {
        let billCode = $(this).data("code");

        if (confirm(`Are you sure you want to delete this bill?`)) {
            billList = billList.filter(bill => bill.code !== billCode);
            localStorage.setItem("billList", JSON.stringify(billList));
            renderBillList();
        }
    });
});

</script>


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
