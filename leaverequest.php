<?php include('header.php');?>
<?php
  include_once('controller/connect.php');
  
  $dbs = new database();
  $db=$dbs->connection();
  $Statusl = "Pending";
  $registrationdetails = mysqli_query($db,"select * from registrationdetails where Status='$Statusl'");
  if(isset($_GET['id']))
  {
    $acceptid = $_GET['id'];
    $accept = "Accept";
    mysqli_query($db,"update registrationdetails set Status='$accept' where Detail_Id='$acceptid'");
    echo "<script>window.location='leaverequest.php';</script>";
  }
  else if(isset($_GET['msg']))
  {
    $deniedid = $_GET['msg'];
    $denied = "Denied";
    mysqli_query($db,"update registrationdetails set Status='$denied' where Detail_Id='$deniedid'");
    echo "<script>window.location='leaverequest.php';</script>";
  }

  $laccept = mysqli_query($db,"SELECT l.*,e.FirstName,e.LastName,lt.Technology_Name FROM registrationdetails l JOIN candidate e ON l.CandId=e.CandidateId JOIN type_of_registration lt on l.TechId=lt.RegistrationId WHERE Status='Accept'");
  $ldenied = mysqli_query($db,"SELECT l.*,e.FirstName,e.LastName,lt.Technology_Name FROM registrationdetails l JOIN candidate e ON l.CandId=e.CandidateId JOIN type_of_registration lt on l.TechId=lt.RegistrationId WHERE Status='Denied'");
  
?>
<ol class="breadcrumb" style="margin: 10px 0px ! important;">
    <li class="breadcrumb-item"><a href="Home.php">Home</a><i class="fa fa-angle-right"></i>Registered<i class="fa fa-angle-right"></i>Application</li>
</ol>
<form method="POST">
<div class="validation-form">
  <h2>Request Application</h2>
  <div class="row" style="color: white; margin-right: 0; margin-left: 0;">
    <div style="background: #202a29;" class="col-md-1 control-label">
            <h5>ID</h5>
        </div>
        <div style="background: #202a29;" class="col-md-2 control-label">
            <h5>Name</h5>
        </div>
        <div style="background: #202a29; text-align: center;" class="col-md-1 control-label">
            <h5>Emp ID</h5>
        </div>
        <div style="background: #202a29;" class="col-md-2 control-label">
            <h5>Technology</h5>
        </div>
        <div style="background: #202a29; " class="col-md-1 control-label">
            <h5>Reason </h5>
        </div>
        <div style="background: #202a29; text-align: center;" class="col-md-2 control-label">
            <h5>Last Working Day</h5>
        </div>
        <div style="background: #202a29; text-align: center;" class="col-md-2 control-label">
            <h5>Interview Date</h5>
        </div>
        <div style="background: #202a29; text-align: center;" class="col-md-1 control-label">
            <h5>Action</h5>
        </div>
    </div>
    
    <?php $i=1; while($row = mysqli_fetch_assoc($registrationdetails)) {
      $candid = $row['CandId'];
      $name_query = mysqli_query($db,"select * from candidate where CandidateId='$candid'");
      $empname = mysqli_fetch_assoc($name_query);
      $namem = (isset($empname['FirstName']) && isset($empname['LastName'])) ? ucfirst($empname['FirstName'])."&nbsp;".ucfirst($empname['LastName']) : '';
      $typen = $row['TechId'];
      $typeid = mysqli_query($db,"select * from type_of_registration where RegistrationId='$typen'");
      $typename = null; // Initialize $typename variable to null
      if ($typeid_query = mysqli_query($db, "select * from type_of_registration where RegistrationId='$typen'")) {
        $typename = mysqli_fetch_assoc($typeid_query);
      }


      ?>
    <div class="row" style="margin-right: 0; margin-top: 10px; margin-left: 0;">
    <div class="col-md-1"><?php echo $i; $i++;?></div>
    <div class="col-md-2"><?php echo $namem;?></div>
    <div class="col-md-1" style="text-align: center;"><?php echo isset($row['CandId']) ? $row['CandId'] : '';?></div>
    <div class="col-md-2"><?php echo isset($typename['Technology_Name']) ? ucfirst($typename['Technology_Name']) : '';?></div>
    <div class="col-md-1" ><?php echo isset($row['Reason']) ? ucfirst($row['Reason']) : '';?></div>
    <div class="col-md-2" style="text-align: center;"><?php echo isset($row['LastDay']) ? $row['LastDay'] : '';?></div>
    <div class="col-md-2" style="text-align: center;"><?php echo isset($row['InterviewDay']) ? $row['InterviewDay'] : '';?></div>
    
      
      <div class="col-md-1" style="text-align: center;"><a href="?id=<?php echo $row['Detail_Id'];?>" title="Accept"><i class="fa fa-check " aria-hidden="true"></i></a>&nbsp;&nbsp;<a href="?msg=<?php echo $row['Detail_Id'];?>" title="Denied"><i class="fa fa-times" style="color: #202a29;" aria-hidden="true"></i></a></div>
    </div><hr style="margin-bottom: 0px;margin-top: 0px;border-top: 1px solid #eee;">
      <?php }?>    
</div>

<div class="validation-form" style="margin-bottom: 0px;margin-top: 10px;">
<h2>Accepted Application</h2>
<div class="row" style="color: white; margin-right: 0; margin-left: 0;">
  <div class="col-md-1" style="background-color: #202a29;">
    <h5>ID</h5>
  </div>
  <div class="col-md-4" style="background-color: #202a29;">
    <h5>Name</h5>
  </div>
  <div class="col-md-3" style="background-color: #202a29;">
    <h5>Technology</h5>
  </div>
  <div class="col-md-2" style="background-color: #202a29;">
    <h5>Last Working Day</h5>
  </div>
  <div class="col-md-2" style="background-color: #202a29;">
    <h5>Interview Date</h5>
  </div>
</div>

    <?php $i=1; while($row = mysqli_fetch_assoc($laccept)) { 
      $name = ucfirst($row['FirstName']." ".$row['LastName']);
      ?>
<div class="row" style="margin-right: 0; margin-left: 0;">
  <div class="col-md-1">
    <h5><?php $i=$i; echo $i; $i++;?></h5>
  </div>
  <div class="col-md-4">
    <h5><?php echo(isset($name))?$name:"";?></h5>
  </div>
  <div class="col-md-3">
    <h5><?php echo(isset($row['Technology_Name']))?$row['Technology_Name']:"";?></h5>
  </div>
  <div class="col-md-2">
    <h5><?php echo(isset($row['LastDay']))?$row['LastDay']:"";?></h5>
  </div>
  <div class="col-md-2">
    <h5><?php echo(isset($row['InterviewDay']))?$row['InterviewDay']:"";?></h5>
  </div>
</div><hr style="margin-bottom: 0px;margin-top: 0px;border-top: 1px solid #eee;">
<?php } ?>
<div class="clearfix"></div>
</div>

<div class="validation-form" style="margin-bottom: 30px;margin-top: 10px;">
<h2>Denied Application</h2>
<div class="row" style="color: white; margin-right: 0; margin-left: 0;">
  <div class="col-md-1" style="background-color: #202a29;">
    <h5>ID</h5>
  </div>
  <div class="col-md-4" style="background-color: #202a29;">
    <h5>Name</h5>
  </div>
  <div class="col-md-3" style="background-color: #202a29;">
    <h5>Technology</h5>
  </div>
  <div class="col-md-2" style="background-color: #202a29;">
    <h5>Last Working Day</h5>
  </div>
  <div class="col-md-2" style="background-color: #202a29;">
    <h5>Interview Date</h5>
  </div>
</div>

    <?php $i=1; while($row = mysqli_fetch_assoc($ldenied)) {
      $name = ucfirst($row['FirstName']." ".$row['LastName']);
      ?>
<div class="row" style="margin-right: 0; margin-left: 0;">
  <div class="col-md-1">
    <h5><?php $i=$i; echo $i; $i++;?></h5>
  </div>
  <div class="col-md-4">
    <h5><?php echo(isset($name))?$name:"";?></h5>
  </div>
  <div class="col-md-3">
    <h5><?php echo(isset($row['Technology_Name']))?$row['Technology_Name']:"";?></h5>
  </div>
  <div class="col-md-2">
    <h5><?php echo(isset($row['LastDay']))?$row['LastDay']:"";?></h5>
  </div>
  <div class="col-md-2">
    <h5><?php echo(isset($row['InterviewDay']))?$row['InterviewDay']:"";?></h5>
  </div>
</div><hr style="margin-bottom: 0px;margin-top: 0px;border-top: 1px solid #eee;">
<?php } ?>
</div>
<div class="clearfix"></div>
</form>
<?php include('footer.php'); ?>


