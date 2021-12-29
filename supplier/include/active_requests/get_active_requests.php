<?php

session_start();

include '../../../functions.php';

$userId = $_SESSION['user_id'];

$limit = 5;  
if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; };  
$start_from = ($page-1) * $limit;  
  
//get all LIVE requests
$sql = "SELECT * FROM requests WHERE `request_status` = 1 ORDER BY created DESC LIMIT $start_from, $limit";  
$rs_result = mysqli_query($conn, $sql);  

//get offers of current user
$sql2 = "SELECT `requestidfk` FROM offers WHERE `offer_useridfk` = $userId";  
$offers_result = mysqli_query($conn, $sql2);  
$offers_result_array = mysqli_fetch_all($offers_result);


$offers_array = array_column($offers_result_array, 0);


if($rs_result->num_rows == 0) echo '<p class="mt-4">No currently active requests...</p>';

?>
   
<?php  
while ($row = mysqli_fetch_array($rs_result)) {  

    // skip if there is an offer already
    if(in_array($row["id"], $offers_array)) continue;
    
?>  

        <div class="single-order">
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
                <form class="offer_form" enctype="multipart/form-data" autocomplete="off">
                    <input type="hidden" class="request_id" name="request_id" value="<?php echo $row["id"]; ?>">
                    <div class="single-offer">
                        <div class="offer-type">
                            <span>MAKE YOUR OFFER</span>
                        </div>
                        
                        <div class="offer-delivery">
                            <p class="mb-3">
                                <b>Good Delivery Time</b><br>
                                <input size="16" type="text" placeholder="dd-mm-yyyy hh:ii" class="good_delivery" name="good_delivery" required>
                            </p>
                            <p class="mb-3">
                                <b>Good Collection Time</b><br>
                                <input size="16" type="text" placeholder="dd-mm-yyyy hh:ii" class="good_collection" name="good_collection" required>
                            </p>
                            <p>
                                <b>Offer valid until</b><br>
                                <input size="16" type="text" placeholder="dd-mm-yyyy hh:ii" class="offer_active_until" name="offer_active_until" required>
                            </p>
                        </div>
                        <div class="offer-price">
                            <p class="mb-3">
                                <b>Note (optional)</b><br>
                                <textarea placeholder="Note" name="note" class="note_area"></textarea>
                            </p>
                            <p>
                                <b>Attachments (optional)</b><br>
                                <input type="file" name="files[]" id="files" multiple />
                            </p>
                        </div>
                        <div class="offer-button send-offer">
                            <p><b>Price</b></p>
                            <h4>€ 
                                <input type="text" class="offer_price" name="offer_price" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" required>
                            </h4><br>
                            <button type="submit" style="float:right">Send Offer</button>
                        </div>
                    </div>
                    <div class="note_attachm row">
                        
                    </div>
                </form>
            </div>
        </div>

<?php  
};  
?>  

