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
                            <div class="row">
                                <div class="col-md-6">
                                    <p><b>From</b> <?php echo $row["from_place"]; ?></p>
                                    <p><b>To</b> <?php echo $row["to_place"]; ?></p>
                                    <p><b>Available from</b> <?php echo substr($row["from_time"], 0, -3); ?></p>
                                    <p><b>Delivered within</b> <?php echo substr($row["to_time"], 0, -3); ?></p>
                                </div>
                                <div class="col-md-6">
                                    <p><b>Commodity</b> <?php echo $row["commodity"]; ?></p>
                                    <p><b>ADR</b> <?php echo $row["adr"] == 0 ? '✗' : '✓'; ?></p>
                                    <p><b>Temp. Control</b> <?php echo $row["temp_cont"] == 0 ? '✗' : '✓'; ?></p>
                                    <p><b>Shipment Ref.</b> <?php echo $row["shipment_ref"]; ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="header-controls">
                        <span class="order-status">TO SHIP</span>
                        <a href="mailto:<?php echo $row["email"]; ?>">
                            <button type="button">Send email</button>
                        </a>
                    </div>
                </div>
                <div class="arrow-toggle"><span>❯</span></div>
            <div class="live_request single-order-body panel-collapse intransit">
                <div class="row" style="padding: 50px 25px;">
                    <div class="col-md-6 ml-5">
                        <h4>Request attachments</h4>
                    </div>
                    <?php if($row["request_status"] !== '0' ) : ?>
                    <div class="col-md-6">
                        <h4>Offer attachments</h4>
                    </div>
                    <?php endif; ?>
                </div>
                <div class="mt-3" style="padding: 50px;">
                    <h4>Packing list</h4>
                    <?php 
                        $jsonColli = $row["colli"];

                        $colli = unserialize($jsonColli);
                        //var_dump($colli['colli']);
                        foreach ($colli['colli'] as $c) {
                            $n = $c['name'];
                            $we = $c['weight'];
                            $le = $c['lenght'];
                            $wi = $c['width'];
                            $hi = $c['height'];
                            $st = $c['stack'] == 1 ? '✓' : '✗';
                            echo "<p><b>$n</b> - [ Weight: $we Kg ], [ Lenght: $le m ], [ Width: $wi m ], [ Height: $hi m ], [ Stackable: $st ]</p>";
                            }
                        
                        ?>
                </div>
                <div class="single-offer">
                    <input type="hidden" class="offer_id" value="<?php echo $row["offer_id"]; ?>">
                    <div class="offer-type">
                        <span>MY OFFER</span> 
                    </div>
                    <div class="offer-collection">
                        <p><b>Good Collection</b><br><?php echo substr($row["from_time"], 0, -3); ?></p>
                    </div>
                    <div class="offer-delivery">
                        <p><b>Good Delivery</b><br><?php echo substr($row["to_time"], 0, -3); ?></p>
                    </div>
                    <div class="offer-price">
                        <h4>€ <?php echo $row["price"]; ?></h4>
                    </div>
                </div>
            </div>
                <div class="live_request single-order-body">
                    <div class="single-offer">
                        <input type="hidden" name="offer_id" value="<?php echo $row["offer_id"]; ?>">
                        <div class="offer-type">
                            <span>VEHICLE INFORMATION</span>
                        </div>
                        <div class="offer-collection">
                            <label><b>Driver name</b><br>
                                <input type="text" name="driver_name" placeholder="Drive name" required/>
                            </label><br>
                            <label class="mt-4"><b>Vehicle reg. number</b><br>
                                <input type="text" name="vehicle_num" placeholder="Vehicle reg. number" required/>
                            </label>
                        </div>
                        <div class="offer-delivery">
                            <label><b>Time of arrival for loading</b><br>
                                <input type="text" name="final_from_time" class="from-t" placeholder="Cargo loading at" required/>
                            </label><br>
                            <label class="mt-4"><b>Estimated time unloading</b><br>
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

