<?php
include('server.php');

if (isset($_POST['submitjpg'])) {
    $jpgfile = $_FILES['jpgfile']['name'];
    $violationID = $_POST['violation_id'];
    
    $deleteViolationQuery = "DELETE FROM violations WHERE violation_id = '$violationID'";
    $db->query($deleteViolationQuery);
    
    $insertJPGQuery = "INSERT INTO responses (violation_id, jpg) VALUES ('$violationID', '$jpgfile')";
    $db->query($insertJPGQuery);
    
    echo 'success';
} 
if (isset($_POST['submittext'])) {
    $textfile = $_POST['paragraph'];
    $violationID = $_POST['violation_id'];
    
    $deleteViolationQuery = "DELETE FROM violations WHERE violation_id = '$violationID'";
    $db->query($deleteViolationQuery);
    
    $insertPARAGRAPHQuery = "INSERT INTO responses (violation_id, paragraph) VALUES ('$violationID', '$textfile')";
    $db->query($insertPARAGRAPHQuery);
    
    echo 'success here';
}
?>

<script>
    alert('Processed Successfully');
    window.location.href = 'inputviolationfinal.php';
</script>