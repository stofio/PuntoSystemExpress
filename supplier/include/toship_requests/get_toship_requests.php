<link href="/vendor/bootstrap-datetimepicker-master/bootstrap-datetimepicker.min.css" rel="stylesheet">
<script src="/vendor/bootstrap-datetimepicker-master/bootstrap-datetimepicker.min.js"></script>

<?php

session_start();

include $_SERVER['DOCUMENT_ROOT'].'/functions.php';

$userId = $_SESSION['user_id'];

$limit = 5;  
if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; };  
$start_from = ($page-1) * $limit;  


//get requestidfk from offers where useridfk = $userID
$sql = "SELECT *
FROM `requests` 
INNER JOIN `offers` on `requests`.`id` = `offers`.`requestidfk` 
INNER JOIN `users` on `users`.`userid` = `requests`.`useridfk`
WHERE `offers`.`offer_useridfk` = $userId AND `requests`.`request_status` = 3
ORDER BY `requests`.`created` DESC LIMIT $start_from, $limit";
$rs_result = mysqli_query($conn, $sql);  

if($rs_result->num_rows == 0) echo '<p class="mt-4">No requests to ship...</p>';

?>
   
<?php  
while ($row = mysqli_fetch_array($rs_result)) {  
    
?>  

        <div class="single-order">
            <form class="conf_shipped" enctype="multipart/form-data" autocomplete="off">
                <input type="hidden" name="request_id" value="<?php echo $row["id"]; ?>">
                <input type="hidden" name="final_price_with_comm" value="<?php echo getClientCommissionsCalculated($row["price"], $row['userid']) ?>">
                <div class="single-order-header">
                    <div class="header-details">
                        <h2 class="order-title">ID #<?php echo $row["id"]; ?></h2>
                        <div class="order-details">
                            <p><b>From</b> <?php echo $row["from_place"]; ?></p>
                            <p><b>To</b> <?php echo $row["to_place"]; ?></p>
                            <p><b>Available from</b> <?php echo substr($row["from_time"], 0, -3); ?></p>
                            <p><b>Delivered within</b> <?php echo substr($row["to_time"], 0, -3); ?></p>
                            <p>Offer Available Until <?php echo substr($row["valid_until"], 0, -3); ?></p>
                        </div>
                    </div>
                    <div class="header-controls">
                        <span class="order-status">TO SHIP</span>
                        <a href="mailto:<?php echo $row["email"]; ?>">
                            <button type="button">Send email</button>
                        </a>
                    </div>
                </div>
                <div class="live_request single-order-body">
                    <div class="single-offer">
                        <input type="hidden" name="offer_id" value="<?php echo $row["offer_id"]; ?>">
                        <div class="offer-type">
                            <span>MY OFFER</span>
                            <p><b>Good Collection</b> <?php echo substr($row["collect_time"], 0, -3); ?></p>
                            <p><b>Good Delivery</b> <?php echo substr($row["deliver_time"], 0, -3); ?></p>
                            <h4>€ <?php echo $row["price"]; ?></h4>
                        </div>
                        <div class="offer-collection">
                            <label><b>Drive name</b><br>
                                <input type="text" name="driver_name" placeholder="Drive name" required/>
                            </label><br>
                            <label class="mt-4"><b>Vehicle reg. number</b><br>
                                <input type="text" name="vehicle_num" placeholder="Vehicle reg. number" required/>
                            </label>
                        </div>
                        <div class="offer-delivery">
                            <label><b>Loading - time of arrival</b><br>
                                <input type="text" name="final_from_time" class="from-t" placeholder="Cargo loading at" required/>
                            </label><br>
                            <label class="mt-4"><b>Unloading - estimated time</b><br>
                                <input type="text" name="final_to_time" class="to-t" placeholder="Cargo at destination at" required/>
                            </label>
                        </div>
                        <div class="offer-button confirm-shipped">
                            <button class="confirm_shipped" type="submit">Confirm Shipped</button>
                        </div>
                    </div>
                </div>
        </form>
        </div>

        <script>
            $(".from-t").datetimepicker({ format: 'dd-mm-yyyy hh:ii' });
            $(".to-t").datetimepicker({ format: 'dd-mm-yyyy hh:ii' });
        </script>

<?php  
};  
?>  

