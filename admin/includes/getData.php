<?php
include 'config.php';



$columns = array('id', 'username', 'password', 'email', 'role');

$requestData = $_REQUEST;

$start = $requestData['start'];
$length = $requestData['length'];
$draw = $requestData['draw'];

$sql = "SELECT id, username, Password, email, role, start_date FROM users";
$query = $conn->query($sql);
$totalData = $query->num_rows;

$sql .= " LIMIT $start, $length ";
$query = $conn->query($sql);
$totalFiltered = $query->num_rows;

$data = array();

while ($row = $query->fetch_assoc()) {
    $nestedData = array();
    $nestedData[] = $row["id"];
    $nestedData[] = $row["username"];
    $nestedData[] = $row["password"];
    $nestedData[] = $row["email"];
    $nestedData[] = $row["role"];
    $data[] = $nestedData;
}

$json_data = array(
    "draw" => intval($draw),
    "recordsTotal" => intval($totalData),
    "recordsFiltered" => intval($totalFiltered),
    "data" => $data
);

echo json_encode($json_data);

$conn->close();
?>







