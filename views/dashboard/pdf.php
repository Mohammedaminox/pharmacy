<?php

require_once __DIR__."/../../dompdf/dompdf/autoload.inc.php";
use Dompdf\Dompdf;

$document = new Dompdf();

$db = new PDO("mysql:host=localhost:3307;dbname=pharmacy", "username", "password");
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Add your SQL query here to fetch data from the database
$query = "SELECT * FROM medicament";
$stmt = $db->query($query);
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

$output = '
<style>
table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

td, th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
}

tr:nth-child(even) {
  background-color: #dddddd;
}
</style>
<table>
  <tr>
    <th>id</th>
    <th>name</th>
    <th>description</th>
    <th>quantity</th>
    <th>prix</th>
    <th>date creation</th>
  </tr>
';

foreach ($result as $row) {
    $output .= '
    <tr>
      <td>' . $row["id"] . '</td>
      <td>' . $row["nom"] . '</td>
      <td>' . $row["description"] . '</td>
      <td>' . $row["quantite_stock"] . '</td>
      <td>' . $row["prix"] . '</td>
      <td>' . $row["date_creation"] . '</td>
    </tr>
    ';
}

$output .= '</table>';
$document->loadHtml($output);

$document->setPaper("A4", "landscape");
$document->render();
$document->stream("Store.pdf", ["Attachment" => true]);
header("location:?route=store")

?>
