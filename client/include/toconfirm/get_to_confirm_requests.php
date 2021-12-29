<?php

session_start();

include '../../../functions.php';

$userid = $_SESSION['user_id'];

$limit = 5;  
if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; };  
$start_from = ($page-1) * $limit;  
  
$sql = "SELECT * FROM requests WHERE `request_status` = 2 AND `useridfk` = $userid 
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
                <div class="header-details">
                    <h2 class="order-title"><?php echo $row['title']; ?></h2>
                    <div class="order-details">
                        <p><b>From</b> <?php echo $row['from_place']; ?></p>
                        <p><b>To</b> <?php echo $row['to_place']; ?></p>
                        <p><b>Available from</b> <?php echo substr($row['from_time'], 0, -3); ?></p>
                        <p><b>Delivered within</b> <?php echo substr($row['to_time'], 0, -3); ?></p>
                        <p>Offer Available Until <?php echo substr($row["valid_until"], 0, -3); ?></p>
                    </div>
                </div>
                <div class="header-controls">
                    <span class="order-status">TO CONFIRM</span>
                </div>
            </div> 
            <div class="live_request single-order-body">
                
                <?php

                //get offers of this request
                $currentRequestId = $row["id"];
                $sql2 = "SELECT * FROM offers WHERE `requestidfk` = $currentRequestId";
                $rs_result2 = mysqli_query($conn, $sql2);  

                $offersArray = mysqli_fetch_all($rs_result2, MYSQLI_ASSOC);

                /**
                 * calculate the cheapest, quickest and latest
                 */

                $latestOffer;
                $cheapestOffer;
                $quickestOffer;
                $currentLatest = 0;
                $currentPrice = 0;
                $currentQuickest  = 0;

                $keyToRemove;
                $keyToRemove2;
                $keyToRemove3;

                
                //cheapest
                foreach( $offersArray as $key => $val ) {
                    if($currentPrice == 0) {
                        $currentPrice = $val['price'];
                        $cheapestOffer = $val;
                        $keyToRemove = $key;
                    }
                    elseif($val['price'] < $currentPrice) {
                        $currentPrice = $val['price'];
                        $cheapestOffer = $val;
                        $keyToRemove = $key;
                    }
                }
                unset($offersArray[$keyToRemove]); //remove this from array to avoid dupplicate
                
                ?>

                <div class="single-offer">
                    <div class="offer-type">
                        <span>CHEAPEST</span>
                    </div>
                    <div class="offer-collection">
                        <p><b>Good Collection</b><br><?php echo substr($cheapestOffer['collect_time'], 0, -3); ?></p>
                    </div>
                    <div class="offer-delivery">
                        <p><b>Good Delivery</b><br><?php echo substr($cheapestOffer['deliver_time'], 0, -3); ?></p>
                    </div>
                    <div class="offer-price">
                        <h4>€ <?php echo $cheapestOffer['price'] ?></h4>
                    </div>
                    <div class="offer-button">
                        <input type="hidden" class="offer_id" value="<?php echo $cheapestOffer['offer_id'] ?>">
                        <button class="blockOffer" type="button">Block Offer</button>
                    </div>
                </div>
                
                <?php 

                //quickest
                foreach( $offersArray as $key => $val ) {
                    $collect = date_timestamp_get(date_create($val['collect_time']));
                    $deliver = date_timestamp_get(date_create($val['deliver_time']));
                    
                    $interval = abs($collect - $deliver);
                    if($currentQuickest == 0) {
                        $currentQuickest = $interval;
                        $quickestOffer = $val;
                        $keyToRemove2 = $key;
                    }
                    elseif($interval < $currentQuickest) {
                        $currentQuickest = $collect - $deliver;
                        $quickestOffer = $val;
                        $keyToRemove2 = $key;
                    }
                }
                unset($offersArray[$keyToRemove2]); //remove this from array to avoid dupplicate

                ?>

                <div class="single-offer">
                    <div class="offer-type">
                        <span>QUICKEST</span>
                    </div>
                    <div class="offer-collection">
                        <p><b>Good Collection</b><br><?php echo substr($quickestOffer['collect_time'], 0, -3); ?></p>
                    </div>
                    <div class="offer-delivery">
                        <p><b>Good Delivery</b><br><?php echo substr($quickestOffer['deliver_time'], 0, -3); ?></p>
                    </div>
                    <div class="offer-price">
                        <h4>€ <?php echo $quickestOffer['price'] ?></h4>
                    </div>
                    <div class="offer-button">
                        <input type="hidden" class="offer_id" value="<?php echo $quickestOffer['offer_id'] ?>">
                        <button class="blockOffer" type="button">Block Offer</button>
                    </div>
                </div>
                
                <?php
                    
                //latest
                foreach( $offersArray as $key => $val ) {
                    $d = date_create($val['offer_created']);
                    if($currentLatest == 0) {
                        //to timestamp
                        $currentLatest = date_timestamp_get($d);
                        $latestOffer = $val;
                        $keyToRemove3 = $key;
                    }
                    elseif(date_timestamp_get($d) > $currentLatest) {
                        $currentLatest = date_timestamp_get($d);
                        $latestOffer = $val;
                        $keyToRemove3 = $key;
                    }
                }
                unset($offersArray[$keyToRemove3]); //remove this from array to avoid dupplicate

                ?>

                <div class="single-offer">
                    <div class="offer-type">
                        <span>LATEST</span>
                    </div>
                    <div class="offer-collection">
                        <p><b>Good Collection</b><br><?php echo substr($latestOffer['collect_time'], 0, -3); ?></p>
                    </div>
                    <div class="offer-delivery">
                        <p><b>Good Delivery</b><br><?php echo substr($latestOffer['deliver_time'], 0, -3); ?></p>
                    </div>
                    <div class="offer-price">
                        <h4>€ <?php echo $latestOffer['price'] ?></h4>
                    </div>
                    <div class="offer-button">
                        <input type="hidden" class="offer_id" value="<?php echo $latestOffer['offer_id'] ?>">
                        <button class="blockOffer" type="button">Block Offer</button>
                    </div>
                </div>
                

                <?php
                
                // var_dump($cheapestOffer);
                
                // var_dump($quickestOffer);
                
                // var_dump($latestOffer);
                
                ?>


            </div>
        </div>

<?php  
};  
?>  

