<?php 
require_once $_SERVER['DOCUMENT_ROOT'].'/functions.php';

$userId = $_SESSION['user_id'];

$limit = 5;
$sql = "SELECT COUNT(id) 
FROM `requests` 
INNER JOIN `offers` on `requests`.`id` = `offers`.`requestidfk` 
INNER JOIN `users` on `users`.`userid` = `requests`.`useridfk`
WHERE `offers`.`offer_useridfk` = $userId AND `requests`.`request_status` = 6";

$rs_result = mysqli_query($conn, $sql);  
$row = mysqli_fetch_row($rs_result);  
$total_records = $row[0];  
$total_pages = ceil($total_records / $limit); 

if(!empty($total_pages)){
    for($i=1; $i<=$total_pages; $i++){
            if($i == 1){
                ?>
            <li class="pageitem4 active" id="tg-<?php echo $i;?>"><a href="javascript:void(0);" data-id="tg-<?php echo $i;?>" class="page-link4 page-link" ><?php echo $i;?></a></li>
                                        
            <?php 
            }
            else{
                ?>
            <li class="pageitem4" id="tg-<?php echo $i;?>"><a href="javascript:void(0);" class="page-link4 page-link" data-id="tg-<?php echo $i;?>"><?php echo $i;?></a></li>
            <?php
            }
    }
}

?>
