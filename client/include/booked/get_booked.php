<?php

session_start();

include $_SERVER['DOCUMENT_ROOT'].'/functions.php';

$userid = $_SESSION['user_id'];


$limit = 5;  
if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; };  
$start_from = ($page-1) * $limit;  
  
$sql = "SELECT * FROM requests WHERE `request_status` in (2,3) AND `useridfk` = $userid 
ORDER BY created DESC LIMIT $start_from, $limit";  
$rs_result = mysqli_query($conn, $sql);  


if($rs_result->num_rows == 0) echo '<p class="mt-4">No requests to confirm...</p>';

?>
   
<?php  
while ($row = mysqli_fetch_array($rs_result)) {  
?>  


        <div class="single-order">
        <input type="hidden" class="request_id" name="request_id" value="<?php echo $row["id"]; ?>">
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
                            <p><b>Shipment Ref.</b> <?php echo $row["shipment_ref"]; ?></p>
                            <p><b>Commodity</b> <?php echo $row["commodity"]; ?></p>
                            <p><b>ADR</b> <?php echo $row["adr"] == 0 ? '✗' : '✓'; ?></p>
                            <p><b>Temp. Control</b> <?php echo $row["temp_cont"] == 0 ? '✗' : '✓'; ?></p>
                        </div>
                    </div>
                </div>
                <div class="header-controls">
                    <span class="order-status">BOOKED 
                        <?php if($row['request_status'] == 2) : //if is BOOKED ?>
                            <span class="order-notice">(waiting admin approval)</span>
                        <?php elseif($row['request_status'] == 3) : //if is APPROVED ?>
                            <span class="order-notice">(waiting supplier info)</span>
                        <?php endif; ?>
                    </span>
                    <div class="offer-button view-button mt-3">
                        <a class="view-request viewRequest" type="button"><b>View request</b></a>
                    </div>
                </div>
            </div>  
            <div class="live_request single-order-body">
                
                <?php

                //get offers of this request
                $currentRequestId = $row["id"];
                $sql2 = "SELECT * FROM offers WHERE `requestidfk` = $currentRequestId AND `offer_status` = 2";
                $rs_result2 = mysqli_query($conn, $sql2);  

                $offer = mysqli_fetch_assoc($rs_result2);

                ?>


                <div class="single-offer">
                    <div class="offer-type">
                        <span>BOOKED OFFER</span>
                    </div>
                    <div class="offer-collection">
                        <p><b>Good Collection</b><br><?php echo substr($offer['collect_time'], 0, -3); ?></p>
                    </div>
                    <div class="offer-delivery">
                        <p><b>Good Delivery</b><br><?php echo substr($offer['deliver_time'], 0, -3); ?></p>
                    </div>
                    <div class="offer-price">
                    <h4>€ <?php echo getClientCommissionsCalculated($offer['price'], $_SESSION['user_id']) ?></h4>
                    </div>
                </div>
                

            </div>
        </div>

<?php  
};  
?>  

