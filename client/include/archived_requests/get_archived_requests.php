<?php

session_start();  

include $_SERVER['DOCUMENT_ROOT'].'/functions.php';

$userId = $_SESSION['user_id'];


$limit = 20;  
if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; };  
$start_from = ($page-1) * $limit;  


//get requestidfk from offers where useridfk = $userID
$sql = "SELECT *
FROM `requests` 
WHERE `requests`.`useridfk` = $userId 
AND `requests`.`request_status` = 9 
ORDER BY `requests`.`created` DESC LIMIT $start_from, $limit";


$rs_result = mysqli_query($conn, $sql);  

 
if($rs_result->num_rows == 0) echo '<p class="mt-4">No archived requests yet...</p>';

?>
   
<?php  
while ($row = mysqli_fetch_array($rs_result)) {  

    //check for discount
    $discountInfo = getDiscountinfo($userId, $row["id"]);
    
?>  

        <div class="single-order">
            <input type="hidden" class="request_id" value="<?php echo $row["id"]; ?>">
            <div class="single-order-header">
                <div class="header-details" style="width:80%">
                <h2 class="order-title">ID #<?php echo $row["id"]; ?></h2>
                    <div class="order-details row">
                        <div class="col-md-6">
                            <p><b>From</b> <?php echo $row["from_place"]; ?>, <?php echo $row["loading_point"]; ?></p>
                            <p><b>To</b> <?php echo $row["to_place"]; ?>, <?php echo $row["discharge_point"]; ?></p>
                            <p><b>Available</b> <?php echo substr($row["from_time"], 0, -3); ?></p>
                            <p><b>Delivered</b> <?php echo substr($row["to_time"], 0, -3); ?></p>
                        </div>
                        <div class="col-md-6">
                            <p><b>Commodity</b> <?php echo $row["commodity"]; ?></p>
                            <p><b>ADR</b> <?php echo $row["adr"] == 0 ? '✗' : '✓'; ?></p>
                            <p><b>Temp. Control</b> <?php echo $row["temp_cont"] == 0 ? '✗' : '✓'; ?></p>
                            <p><b>Shipment Ref.</b> <?php echo $row["shipment_ref"]; ?></p>
                            <p><b>PuntoSystem Ref.</b> {<?php echo $row["beone_ref"]; ?>}</p>
                        </div>
                    </div>
                </div>
                <div class="header-controls">
                    <span class="order-status"><?php echo $row["is_manual"] ? 'MANUAL' : 'PROCESSED'; ?>
                        <sm class="order-notice">(archived)</sm>
                    </span>
                    <div class="offer-button view-button mt-3">
                        <a class="view-request viewRequest" type="button"><b>View request</b></a>
                    </div>
                </div>
            </div>
            <div class="live_request single-order-body">
                <?php if(!$row["is_manual"]) : ?>
                    <?php

                      $reqId = $row["id"];
                      
                      //GET OFFER
                      $sql2 = "SELECT *
                        FROM `offers` 
                        WHERE `offers`.`requestidfk` = $reqId
                        AND `offers`.`offer_status` = 3";


                        $result2 = mysqli_query($conn, $sql2);  
                        $offer = mysqli_fetch_assoc($result2);
                      
                    ?>
                    <div class="single-offer"> 
                        <input type="hidden" class="offer_id" value="<?php echo $offer["offer_id"]; ?>">
                        <div class="offer-type">
                            <span>Supplier offer</span>
                        </div>
                        <div class="offer-collection">
                            <p><b>Goods Collection</b><br><?php echo substr($offer["collect_time"], 0, -3); ?></p>
                        </div>
                        <div class="offer-delivery">
                            <p><b>Goods Delivery</b><br><?php echo substr($offer["deliver_time"], 0, -3); ?></p>
                        </div>
                        <div class="offer-price">
                            <?php if($discountInfo == null): ?>
                                <h4>€ <?php echo $row["final_price_with_comm"] ?></h4>
                            <?php else: ?>
                                <h4>€ <?php echo calculateDiscount($row["final_price_with_comm"], $discountInfo['disc_percent'] == null ? 0 : $discountInfo['disc_percent']) ?></h4> <p class="disc-under-price">-<?php echo $discountInfo["disc_percent"]; ?>% calculated</p>
                            <?php endif; ?>
                        </div>
                    </div>
                    <?php endif; ?> 
            </div>
        </div>


<?php  
};  
?>  

