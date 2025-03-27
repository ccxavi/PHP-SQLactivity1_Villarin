<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "web1sample";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

function handleSubmit($conn, $productName, $price, $quantity)
{
  $text = "";
  $alert = "";

  $total = $price * $quantity;

  if (empty($productName) && empty($price) && empty($quantity)) {
    $text =  "Empty Input";
  }

  $sql = "INSERT INTO productData (productName, price, quantity, total) VALUES ('$productName','$price','$quantity', '$total')";

  if (mysqli_query($conn, $sql)) {
    error_reporting(0);
    ini_set('display_errors', 0);
  }

  return array("success", "Product Data successfully submitted.");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>PHP-SQLactivity1 | Villarin</title>
    <link rel="stylesheet" href="./styles/global.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" />
</head>
<body>
    <main class="container-fluid d-flex justify-content-center align-items-center vh-100">
        <div class="card w-100 p-4 card-color shadow-lg" style="max-width: 1000px">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-center gap-3">
                        <div class="pic"></div>
                        <div>
                            <h3 class="mb-1">Czachary Xavier Villarin</h3>
                            <p class="mb-0 text-muted">CIS 1202 - <i>Web Development I</i> | BSCS 1</p>
                        </div>
                    </div>
                    <h3 class="mb-0">PHP-SQLactivity1</h3>
                </div>
                <hr class="mt-3 mb-0" />
            </div>
                <div class="card card-color p-4 shadow-sm flex-fill">
                    <h4><i class="bi bi-tags"></i> | Product Price Calculator</h4>
                    <hr class="mt-2" />
                    <form method="POST">
                        <div class="mb-3">
                            <label for="productName" class="form-label">Product Name:</label>
                            <input type="text" name="productName" id="productName" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="price" class="form-label">Price:</label>
                            <input type="number" name="price" id="price" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="quantity" class="form-label">Quantity:</label>
                            <input type="number" name="quantity" id="quantity" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Calculate</button>
                    </form>
                </div>
                <div class="mt-4">
                <?php
                    if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    $name =  mysqli_real_escape_string($conn, $_POST ["productName"]);
                    $price =  mysqli_real_escape_string($conn, $_POST ["price"]);
                    $quantity =  mysqli_real_escape_string($conn, $_POST ["quantity"]);

                    $response = handleSubmit($conn, $name, $price, $quantity);
                    echo "<p class='alert alert-" . $response[0] . " w-100 text-center' role='alert'>" . $response[1] . "</p>";
                }
                ?>
                </div>
            <div class="card-footer text-center">
                <hr class="m-0"/>
                <p class="text-muted mt-3">© 2025, Czach Villarin. All Rights Reserved.</p>
            </div>
                </div>
        </div>
    </main>
</body>
</html>
