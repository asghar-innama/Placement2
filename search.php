<?php

session_start();

require_once("db.php");

$limit = 4;

if(isset($_GET["page"])) {
	$page = $_GET['page'];
} else {
	$page = 1;
}

$start_from = ($page-1) * $limit;

if(isset($_GET['filter']) && $_GET['filter']=='city') {
  
  $sql = "SELECT * FROM company WHERE city=?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("s", $_GET['search']);
  $stmt->execute();
  $result = $stmt->get_result();

  if($result->num_rows > 0) {
    while($row1 = $result->fetch_assoc()) {
      $sql1 = "SELECT * FROM job_post WHERE id_company>=? LIMIT ?, ?";
      $stmt1 = $conn->prepare($sql1);
      $stmt1->bind_param("iii", $row1['id_company'], $start_from, $limit);
      $stmt1->execute();
      $result1 = $stmt1->get_result();
      if($result1->num_rows > 0) {
        while($row = $result1->fetch_assoc()) 
        {
          ?>
          <div class="attachment-block clearfix">
            <img class="attachment-img" src="uploads/logo/<?php echo $row1['logo']; ?>" alt="Attachment Image">
            <div class="attachment-pushed">
              <h4 class="attachment-heading"><a href="view-job-post.php?id=<?php echo $row['id_jobpost']; ?>"><?php echo $row['jobtitle']; ?></a> <span class="attachment-heading pull-right">$<?php echo $row['maximumsalary']; ?>/Month</span></h4>
              <div class="attachment-text">
                <div><strong><?php echo $row1['companyname']; ?> | <?php echo $row1['city']; ?> | Experience <?php echo $row['experience']; ?> Years</strong></div>
              </div>
            </div>
          </div>
          <?php
        }
      }
    }
  }
} else {
  
  if(isset($_GET['filter']) && $_GET['filter']=='searchBar') {
    $search = "%".$_GET['search']."%";
    $sql = "SELECT * FROM job_post WHERE jobtitle LIKE ? LIMIT ?, ?";
  } else if(isset($_GET['filter']) && $_GET['filter']=='experience') {
    $sql = "SELECT * FROM job_post WHERE experience>=? LIMIT ?, ?";
  }

  $stmt = $conn->prepare($sql);
  if(isset($search)) {
    $stmt->bind_param("sii", $search, $start_from, $limit);
  } else {
    $stmt->bind_param("iii", $_GET['search'], $start_from, $limit);
  }
  $stmt->execute();
  $result = $stmt->get_result();

  if($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
      $sql1 = "SELECT * FROM company WHERE id_company=?";
      $stmt1 = $conn->prepare($sql1);
      $stmt1->bind_param("i", $row['id_company']);
      $stmt1->execute();
      $result1 = $stmt1->get_result();
      if($result1->num_rows > 0) {
        while($row1 = $result1->fetch_assoc()) 
        {
          ?>
          <div class="attachment-block clearfix">
            <img class="attachment-img" src="uploads/logo/<?php echo $row1['logo']; ?>" alt="Attachment Image">
            <div class="attachment-pushed">
              <h4 class="attachment-heading"><a href="view-job-post.php?id=<?php echo $row['id_jobpost']; ?>"><?php echo $row['jobtitle']; ?></a> <span class="attachment-heading pull-right">$<?php echo $row['maximumsalary']; ?>/Month</span></h4>
              <div class="attachment-text">
                <div><strong><?php echo $row1['companyname']; ?> | <?php echo $row1['city']; ?> | Experience <?php echo $row['experience']; ?> Years</strong></div>
              </div>
            </div>
          </div>
          <?php
        }
      }
    }
  }
}

$conn->close();
?>
