<?php $page_title = 'My Requests'; ?>
<?php require_once 'include/header.php'; ?>

<!-- ADD TABS -->
 
    <section class="text-center hero-section">
        <div class="breadcrumbs">
            <span><a href="/client">Client dashboard</a></span> » 
            <span><?php echo $page_title; ?></span>
        </div>
        <div class="row align-items-center">
            <div>
                <h1><?php echo $page_title; ?></h1>
                <p>Discover your currently active requests</p>
            </div>
        </div>
    </section>

    <div class="tab">
        <button id="liveTabBtn" class="tablinks active" onclick="openTab(event, 'liveReq')">LIVE</button><!--
        --><button class="tablinks" onclick="openTab(event, 'toConfReq')">TO CONFIRM</button><!--
        --><button class="tablinks" onclick="openTab(event, 'toShipReq')">TO SHIP</button>
    </div>

    <section id="liveReq" class="tabcontent" style="display: block;">

        <div id="target-content">loading...</div>

        <div class="clearfix">
            <ul class="pagination"> <?php include 'include/live/pagination.php' ?> </ul>
       </div>


<!-- 
        <div class="single-order">
            <div class="single-order-header">
                <div class="header-details">
                    <h2 class="order-title">Spedizione Express #01135</h2>
                    <div class="order-details">
                        <p><b>From</b> Antwerp, BE</p>
                        <p><b>To</b> Turin, IT</p>
                        <p><b>Available from</b> 31/12/2021 18:00</p>
                        <p><b>Delivered within</b> 01/01/2022 09:00</p>
                        <p>Offer Available Untill 29/12/2021</p>
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
        </div> -->

    </section>

    <section id="toConfReq" class="tabcontent">

        <div class="single-order">
            <div class="single-order-header">
                <div class="header-details">
                    <h2 class="order-title">Spedizione Express #01135</h2>
                    <div class="order-details">
                        <p><b>From</b> Antwerp, BE</p>
                        <p><b>To</b> Turin, IT</p>
                        <p><b>Available from</b> 31/12/2021 18:00</p>
                        <p><b>Delivered within</b> 01/01/2022 09:00</p>
                        <p>Offer Available Untill 29/12/2021</p>
                    </div>
                </div>
                <div class="header-controls">
                    <span class="order-status">TO CONFIRM</span>
                </div>
            </div>
            <div class="live_request single-order-body">
                <div class="single-offer">
                    <div class="offer-type">
                        <span>BEST VALUE</span>
                    </div>
                    <div class="offer-collection">
                        <p><b>Good Collection</b><br>31/12/2021 18:30</p>
                    </div>
                    <div class="offer-delivery">
                        <p><b>Good Delivery</b><br>31/12/2021 18:30</p>
                    </div>
                    <div class="offer-price">
                        <h4>€ 781,90</h4>
                    </div>
                    <div class="offer-button">
                        <button type="button">Block Offer</button>
                    </div>
                </div>

                <div class="single-offer">
                    <div class="offer-type">
                        <span>CHEAPEST</span>
                    </div>
                    <div class="offer-collection">
                        <p><b>Good Collection</b><br>31/12/2021 18:30</p>
                    </div>
                    <div class="offer-delivery">
                        <p><b>Good Delivery</b><br>31/12/2021 18:30</p>
                    </div>
                    <div class="offer-price">
                        <h4>€ 781,90</h4>
                    </div>
                    <div class="offer-button">
                        <button type="button">Block Offer</button>
                    </div>
                </div>

                <div class="single-offer">
                    <div class="offer-type">
                        <span>QUICKEST</span>
                    </div>
                    <div class="offer-collection">
                        <p><b>Good Collection</b><br>31/12/2021 18:30</p>
                    </div>
                    <div class="offer-delivery">
                        <p><b>Good Delivery</b><br>31/12/2021 18:30</p>
                    </div>
                    <div class="offer-price">
                        <h4>€ 781,90</h4>
                    </div>
                    <div class="offer-button">
                        <button type="button">Block Offer</button>
                    </div>
                </div>
            </div>
        </div>

    </section>

    <section id="toShipReq" class="tabcontent">

        <div class="single-order">
            <div class="single-order-header">
                <div class="header-details">
                    <h2 class="order-title">Spedizione Express #01135</h2>
                    <div class="order-details">
                        <p><b>From</b> Antwerp, BE</p>
                        <p><b>To</b> Turin, IT</p>
                        <p><b>Available from</b> 31/12/2021 18:00</p>
                        <p><b>Delivered within</b> 01/01/2022 09:00</p>
                        <p>Offer Available Untill 29/12/2021</p>
                    </div>
                </div>
                <div class="header-controls">
                    <span class="order-status">TO SHIP</span>
                    <button type="button">Send email</button>
                </div>
            </div>
            <div class="live_request single-order-body">
                <div class="single-offer">
                    <div class="offer-type">
                        <span>BEST VALUE</span>
                    </div>
                    <div class="offer-collection">
                        <p><b>Good Collection</b><br>31/12/2021 18:30</p>
                    </div>
                    <div class="offer-delivery">
                        <p><b>Good Delivery</b><br>31/12/2021 18:30</p>
                    </div>
                    <div class="offer-price">
                        <h4>€ 781,90</h4>
                    </div>
                    <div class="offer-button">
                        <button type="button">Withdraw</button>
                    </div>
                </div>

                <div class="single-offer">
                    <div class="offer-type">
                        <span>CHEAPEST</span>
                    </div>
                    <div class="offer-collection">
                        <p><b>Good Collection</b><br>31/12/2021 18:30</p>
                    </div>
                    <div class="offer-delivery">
                        <p><b>Good Delivery</b><br>31/12/2021 18:30</p>
                    </div>
                    <div class="offer-price">
                        <h4>€ 781,90</h4>
                    </div>
                    <div class="offer-button">
                        <button type="button" class="button-expired">Expired</button>
                    </div>
                </div>

                <div class="single-offer">
                    <div class="offer-type">
                        <span>QUICKEST</span>
                    </div>
                    <div class="offer-collection">
                        <p><b>Good Collection</b><br>31/12/2021 18:30</p>
                    </div>
                    <div class="offer-delivery">
                        <p><b>Good Delivery</b><br>31/12/2021 18:30</p>
                    </div>
                    <div class="offer-price">
                        <h4>€ 781,90</h4>
                    </div>
                    <div class="offer-button">
                        <button type="button" class="button-expired">Expired</button>
                    </div>
                </div>
            </div>
        </div>

    </section>



    <script src="/client/js/my-requests.js"></script>

<?php require_once 'include/footer.php'; ?>