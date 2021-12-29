<?php

session_start();

include '../../../functions.php';

$userid = $_SESSION['user_id'];

$limit = 5;  
if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; };  
$start_from = ($page-1) * $limit;  
  
$sql = "SELECT * FROM requests WHERE `request_status` = 1 AND `useridfk` = $userid 
ORDER BY created DESC LIMIT $start_from, $limit";  
$rs_result = mysqli_query($conn, $sql);  


if($rs_result->num_rows == 0) echo '<p class="mt-4">No live requests...</p>';

?>
   
<?php  
while ($row = mysqli_fetch_array($rs_result)) {  
?>  

         <div class="single-order">
            <input type="hidden" class="request_id" name="request_id" value="<?php echo $row["id"]; ?>">
            <div class="single-order-header">
                <div class="header-details">
                    <h2 class="order-title"><?php echo $row["title"]; ?></h2>
                    <div class="order-details">
                        <p><b>From</b> <?php echo $row["from_place"]; ?></p>
                        <p><b>To</b> <?php echo $row["to_place"]; ?></p>
                        <p><b>Available from</b> <?php echo substr($row["from_time"], 0, -3); ?></p>
                        <p><b>Delivered within</b> <?php echo substr($row["to_time"], 0, -3); ?></p>
                        <p>Offer Available Until <?php echo substr($row["valid_until"], 0, -3); ?></p>
                    </div>
                </div>
                <div class="header-controls">
                    <span class="order-status">LIVE</span>
                </div>
            </div>
            <div class="live_request single-order-body">
                <div class="single-offer">
                    <div class="offer-type">
                        <span>WAITING FOR OFFERS</span>
                    </div>
                    <div class="offer-button">
                        <button id="cancelLiveOffer" type="button">Cancel Request</button>
                    </div>
                </div>
            </div>
        </div>

<?php  
};  
?>  

