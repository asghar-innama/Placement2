<?php
session_start();
require_once("db.php");
$limit = 4;
if (isset($_GET["page"])) {
  $page = $_GET['page'];
} else {
  $page = 1;
}

$start_from = ($page - 1) * $limit;

$sql = "SELECT * FROM job_post LIMIT $start_from, $limit";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
?>
  <div class="attachment-block clearfix">
    <!-- You can include any other formatting or styling here -->
    <h4 class="attachment-heading"><a href="view-job-post.php?id=<?php echo $row['id_jobpost']; ?>"><?php echo $row['jobtitle']; ?></a> <span class="attachment-heading pull-right">₹<?php echo $row['minimumsalary']; ?>/Year</span></h4>
    <div class="attachment-text">
      <div><strong>Role: <?php echo $row['role']; ?></strong></div>
      <div>Company: <?php echo $row['companyurl']; ?></div>
      <!-- Add more details as needed -->
    </div>
  </div>
<?php
  }
}
$conn->close();
?>
