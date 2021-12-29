<?php 
include_once '../functions.php';

$userid = $_SESSION['user_id'];

$limit = 5;
$sql = "SELECT COUNT(id) FROM requests WHERE `request_status` = 3 AND `useridfk` = $userid";  
$rs_result = mysqli_query($conn, $sql);  
$row = mysqli_fetch_row($rs_result);  
$total_records = $row[0];  
$total_pages = ceil($total_records / $limit); 

if(!empty($total_pages)){
    for($i=1; $i<=$total_pages; $i++){
            if($i == 1){
                ?>
            <li class="pageitem2 active" id="tc-<?php echo $i;?>"><a href="javascript:void(0);" data-id="tc-<?php echo $i;?>" class="page-link2 page-link" ><?php echo $i;?></a></li>
                                        
            <?php 
            }
            else{
                ?>
            <li class="pageitem2" id="tc-<?php echo $i;?>"><a href="javascript:void(0);" class="page-link2 page-link" data-id="tc-<?php echo $i;?>"><?php echo $i;?></a></li>
            <?php
            }
    }
}
?>