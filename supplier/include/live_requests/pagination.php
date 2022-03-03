<?php 
include '../functions.php';


$userId = $_SESSION['user_id'];


$limit = 5;
$sql = "SELECT COUNT(id)
FROM `requests` INNER JOIN `offers` on `requests`.`id` = `offers`.`requestidfk` 
WHERE `offers`.`offer_useridfk` = $userId AND `requests`.`request_status` IN (1,2)";  
$rs_result = mysqli_query($conn, $sql);  
$row = mysqli_fetch_row($rs_result);  
$total_records = $row[0];  
$total_pages = ceil($total_records / $limit); 

if(!empty($total_pages)){
    for($i=1; $i<=$total_pages; $i++){
            if($i == 1){
                ?>
            <li class="pageitem active" id="<?php echo $i;?>"><a href="javascript:void(0);" data-id="<?php echo $i;?>" class="page-link" ><?php echo $i;?></a></li>
                                        
            <?php 
            }
            else{
                ?>
            <li class="pageitem" id="<?php echo $i;?>"><a href="javascript:void(0);" class="page-link" data-id="<?php echo $i;?>"><?php echo $i;?></a></li>
            <?php
            }
    }
}
?>