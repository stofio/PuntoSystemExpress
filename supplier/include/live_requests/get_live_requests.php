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
WHERE `offers`.`offer_useridfk` = $userId AND `requests`.`request_status` IN (1,2)
ORDER BY `requests`.`created` DESC LIMIT $start_from, $limit";
$rs_result = mysqli_query($conn, $sql);  

if($rs_result->num_rows == 0) echo '<p class="mt-4">No live requests to which you have made an offer...</p>';

?>
   
<?php  
while ($row = mysqli_fetch_array($rs_result)) {  
    
?>  

        <div class="single-order">
            <div class="single-order-header">
                <div class="header-details">
                    <h2 class="order-title">ID #<?php echo $row["id"]; ?></h2>
                    <div class="order-details">
                        <p><b>From</b> <?php echo $row["from_place"]; ?>, <?php echo $row["loading_point"]; ?></p>
                        <p><b>To</b> <?php echo $row["to_place"]; ?>, <?php echo $row["discharge_point"]; ?></p>
                        <p><b>Available from</b> <?php echo substr($row["from_time"], 0, -3); ?></p>
                        <p><b>Delivered within</b> <?php echo substr($row["to_time"], 0, -3); ?></p>
                    </div>
                    <div class="mt-3">
                        <p><b>Packing list</b></p>
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
                </div>
                <div class="header-controls">
                    <span class="order-status">Processing</span>
                    <a href="mailto:<?php echo $row["email"]; ?>">
                        <button type="button">Send email</button>
                    </a>
                </div>
            </div>
            <div class="live_request single-order-body">
                <div class="single-offer">
                    <div class="offer-type">
                        <span>MY OFFER</span>
                    </div>
                    <div class="offer-collection">
                        <p><b>Good Collection</b><br><?php echo substr($row["collect_time"], 0, -3); ?></p>
                    </div>
                    <div class="offer-delivery">
                        <p><b>Good Delivery</b><br><?php echo substr($row["deliver_time"], 0, -3); ?></p>
                    </div>
                    <div class="offer-expires">
                        <p><b>Expire</b><br><?php echo substr($row["valid_until"], 0, -3); ?></p>
                    </div>
                    <div class="offer-price">
                        <h4>€ <?php echo $row["price"]; ?></h4>
                    </div>
                    <!-- <div class="offer-button">
                        <button type="button">Withdraw</button>
                    </div> -->
                </div>
            </div>
        </div>

<?php  
};  
?>  

