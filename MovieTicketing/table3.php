<?php
session_start();

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$database = "movie_book";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Function to update seat status to occupied
function bookSeats($seatNumbers, $conn) {
    foreach ($seatNumbers as $seatNumber) {
        $sql = "UPDATE table3 SET status = 'occupied' WHERE seat_number = '$seatNumber'";
        $conn->query($sql);
    }
}

// Handle booking request
// Handle booking request
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["selected_seats"])) {
        $selectedSeats = json_decode($_POST["selected_seats"]);
        bookSeats($selectedSeats, $conn);
        echo "Seats booked successfully.";
        exit;
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Movie Ticket Booking - Godzilla x Kong: The New Empire
</title>
    <!-- Link to your CSS file -->
    <link rel="stylesheet" href="table3.css">
    <style>
        /* Add CSS for occupied seats */
        .seat.occupied {
            background-color: #FF5733; /* Change color for occupied seats */
        }
    </style>
</head>
<body>
    <header>
        <h1>Godzilla x Kong: The New Empire
 - Seat Selection</h1>
    </header>

    <div class="container">
        <h2>Select Your Seats</h2>
        <div class="screen">Screen</div>
        <form id="booking-form" method="post">
            <div class="seats-container">
                <?php
                // Retrieve seat data from the database and display seats
                $sql = "SELECT * FROM table3";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $seatNumber = $row["seat_number"];
                        $status = $row["status"];
                        $seatClass = "seat";
                        if ($status === "occupied") {
                            $seatClass .= " occupied";
                        }
                        echo "<div class='$seatClass' data-seat='$seatNumber'>$seatNumber</div>";
                    }
                }
                ?>
            </div>
            <div class="booking-info">
                <h3>Booking Information</h3>
                <div class="legend">
                    <div class="seat available"></div><span>Available</span>
                    <div class="seat selected"></div><span>Selected</span>
                    <div class="seat occupied"></div><span>Occupied</span>
                </div>
                <button type="button" id="book-btn">Book Selected Seats</button>
                <button type="button" id="back-to-previous" onclick="goBack()">Back to Previous Page</button>
            </div>
        </form>
    </div>

    <script>
        const seats = document.querySelectorAll('.seat');

        seats.forEach(seat => {
            seat.addEventListener('click', () => {
                if (!seat.classList.contains('occupied')) {
                    seat.classList.toggle('selected');
                }
            });
        });

        document.getElementById('book-btn').addEventListener('click', () => {
    const selectedSeats = document.querySelectorAll('.selected');
    const seatNumbers = Array.from(selectedSeats).map(seat => seat.dataset.seat);
    
    if (seatNumbers.length === 0) {
        alert('Please select at least one seat.');
        return;
    }

    // Update seat status in the database via AJAX
    const xhr = new XMLHttpRequest();
    xhr.open('POST', 'table3.php', true);
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xhr.onload = function() {
        if (xhr.status === 200) {
            alert(xhr.responseText);
            // Reload the page after booking
            location.reload();
        } else {
            alert('Error booking seats.');
        }
    };
    xhr.send('selected_seats=' + JSON.stringify(seatNumbers));
});


        // Function to go back to the previous page
        function goBack() {
            window.history.back();
        }
    </script>
</body>
</html>
