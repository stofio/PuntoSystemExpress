<?php

session_start();

include '../../../functions.php';

$limit = 2;  
if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; };  
$start_from = ($page-1) * $limit;  
  
$sql = "SELECT * FROM requests WHERE `request_status` = 1 ORDER BY created DESC LIMIT $start_from, $limit";  
$rs_result = mysqli_query($conn, $sql);  

?>
   
<?php  
while ($row = mysqli_fetch_array($rs_result)) {  
?>  

         <div class="single-order">
            <input type="hidden" id="request_id" name="request_id" value="<?php echo $row["id"]; ?>">
            <div class="single-order-header">
                <div class="header-details">
                    <h2 class="order-title"><?php echo $row["title"]; ?></h2>
                    <div class="order-details">
                        <p><b>From</b> <?php echo $row["from_place"]; ?></p>
                        <p><b>To</b> <?php echo $row["to_place"]; ?></p>
                        <p><b>Available from</b> <?php echo $row["from_time"]; ?></p>
                        <p><b>Delivered within</b> <?php echo $row["to_time"]; ?></p>
                        <!-- <p>Offer Available Untill 29/12/2021</p> -->
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
                        <button type="button">Cancel Request</button>
                    </div>
                </div>
            </div>
        </div>

<?php  
};  
?>  
























<?php
// // Very important to set the page number first.
// if (!(isset($_GET['pagenum']))) { 
//   $pagenum = 1; 
// } else {
//   $pagenum = intval($_GET['pagenum']);         
// }
// //Number of results displayed per page by default its 10.
// $page_limit =  ($_GET["show"] <> "" && is_numeric($_GET["show"]) ) ? intval($_GET["show"]) : 10;


// // Get the total number of rows in the table
// $sql = "SELECT count(*) as count FROM requests WHERE `request_status` = 1" ;
// try {
//     $stmt = $conn->prepare($sql);
//     $stmt->execute();
//     $r = $stmt->get_result();
//     $tresults = $r->fetch_assoc();
// } catch (Exception $ex) {
//     echo($ex->getMessage());
// }

// $cnt = $tresults["count"];

// //Calculate the last page based on total number of rows and rows per page. 
// $last = ceil($cnt/$page_limit); 

// $lower_limit = ($pagenum - 1) * $page_limit;


// $sql2 = " SELECT * FROM requests WHERE `request_status` = 1 limit ". ($lower_limit)." ,  ". ($page_limit). " ";
// try {
//     $stmt = $conn->prepare($sql2);
//     $stmt->execute();
//     $rr = $stmt->get_result();
//     $results = $rr->fetch_assoc();
// } catch (Exception $ex) {
//     echo($ex->getMessage());
// }

// //display pagination links
// for($i=1; $i<=$last; $i++) {
//     if ($i == $pagenum ) {
//   ?>
<!-- //     <a href="#" class="selected" ><?php// echo $i ?></a> -->
   <?php
//   } else {  
//   ?>
<!-- //     <a href="my-requests?pagenum=<?php// echo $i; ?>" class="links" onclick="displayRecords('<?php// echo $page_limit;  ?>', '<?php //echo $i; ?>');" ><?php //echo $i ?></a> -->
   <?php 
//     }
// }



?>