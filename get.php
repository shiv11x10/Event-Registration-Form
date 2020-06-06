<?php
$mysqli = new mysqli("127.0.0.1", "root", "", "stackhack");
if($mysqli->connect_error) {
  exit('Could not connect');
}

$sql = "SELECT `id`, `Name`, `Email`, `phone`, `Registration type`, `No of tickets`, `ID Card`, `date`, `Present` FROM `registrations` WHERE id = ?";

$stmt = $mysqli->prepare($sql);
$stmt->bind_param("s", $_GET['q']);
$stmt->execute();
$stmt->store_result();
$stmt->bind_result($id, $name, $email, $phone, $registration, $tickets, $id_card, $date, $present);
$stmt->fetch();
$stmt->close();

echo "<img src='uploads/" . $id_card . "' width='200px'>";
echo "<table class='table table-bordered'>";
echo "<tbody>";
echo "<tr>";
echo "<th>Name</th>";
echo "<td>" . $name . "</td>";
echo "</tr>";
echo "<tr>";
echo "<th>Email</th>";
echo "<td>" . $email . "</td>";
echo "</tr>";
echo "<tr>";
echo "<th>Phone</th>";
echo "<td>" . $phone . "</td>";
echo "</tr>";
echo "<tr>";
echo "<th>Registration type</th>";
echo "<td>" . $registration . "</td>";
echo "</tr>";
echo "<tr>";
echo "<th>No of Tickets</th>";
echo "<td>" . $tickets . "</td>";
echo "</tr>";
echo "<tr>";
echo "<th>Date</th>";
echo "<td>" . $date . "</td>";
echo "</tr>";
echo "<tr>";
echo "<th>Present</th>";
echo "<td>" . $present . "</td>";
echo "</tr>";
echo "</tbody";
echo "</table>";
?>