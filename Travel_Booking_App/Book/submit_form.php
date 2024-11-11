<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "form_travelbooking";


$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$firstName = $_POST['firstName'];
$lastName = $_POST['lastName'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$address = $_POST['address'];
$destination = $_POST['destination'];
$departureDate = $_POST['departureDate'];
$returnDate = $_POST['returnDate'];
$adults = $_POST['adults'];
$children = $_POST['children'];
$accommodationType = $_POST['accommodationType'];
$roomType = $_POST['roomType'];
$specialRequests = $_POST['specialRequests'];
$transportationType = $_POST['transportationType'];
$pickupLocation = $_POST['pickupLocation'];
$dropoffLocation = $_POST['dropoffLocation'];
$vehiclePreference = $_POST['vehiclePreference'];

// Insert data into form_personal table
$sql_form_personal = "INSERT INTO form_personal (fname, lname, email, phone, address)
VALUES ('$firstName', '$lastName', '$email', '$phone', '$address')";

if ($conn->query($sql_form_personal) === TRUE) {
    $user_id = $conn->insert_id;  

    // Insert data into form_booking table
    $sql_form_booking = "INSERT INTO form_booking (user_id, destination, departureDate, returnDate, adults, children)
    VALUES ('$user_id', '$destination', '$departureDate', '$returnDate', '$adults', '$children')";

    if ($conn->query($sql_form_booking) === TRUE) {
        $booking_id = $conn->insert_id;  

        // Insert data into form_accommodation table
        $sql_form_accommodation = "INSERT INTO form_accommodation (booking_id, accommodationType, roomType, specialRequests)
        VALUES ('$booking_id', '$accommodationType', '$roomType', '$specialRequests')";
        
        if ($conn->query($sql_form_accommodation) === TRUE) {
            // Insert data into form_transportation table
            $sql_form_transportation = "INSERT INTO form_transportation (booking_id, transportationType, pickupLocation, dropoffLocation, vehiclePreference)
            VALUES ('$booking_id', '$transportationType', '$pickupLocation', '$dropoffLocation', '$vehiclePreference')";

            if ($conn->query($sql_form_transportation) === TRUE) {
                echo "All records created successfully!";
            } else {
                echo "Error: " . $sql_form_transportation . "<br>" . $conn->error;
            }
        } else {
            echo "Error: " . $sql_form_accommodation . "<br>" . $conn->error;
        }
    } else {
        echo "Error: " . $sql_form_booking . "<br>" . $conn->error;
    }
} else {
    echo "Error: " . $sql_form_personal . "<br>" . $conn->error;
}

$conn->close();
?>
