<?php $page_title = 'Today Requests'; ?>
<?php require_once 'include/header.php'; ?>

<link href="/vendor/bootstrap-datetimepicker-master/bootstrap-datetimepicker.min.css" rel="stylesheet">


    <section class="text-center hero-section">
        <div class="breadcrumbs">
            <span><a href="/supplier">Supplier dashboard</a></span> » 
            <span><?php echo $page_title; ?></span>
        </div>
        <div class="row align-items-center">
            <div>
                <h1><?php echo $page_title; ?></h1>
                <p>Discover currently active requests of shipment</p>
            </div>
        </div>
    </section>

    <section id="supp_offers_list">

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
                    <button type="button">Send email</button>
                </div>
            </div>
            <div class="live_request single-order-body">
                <form class="offer_form">
                    <div class="single-offer">
                        <div class="offer-type">
                            <span>MAKE YOUR OFFER</span>
                        </div>
                        <div class="offer-collection">
                            <p>
                                <b>Good Collection Time</b><br>
                                <input size="16" type="text" placeholder="dd-mm-yyyy hh:ii" class="good_collection" required>
                            </p>
                        </div>
                        <div class="offer-delivery">
                            <p>
                                <b>Good Delivery Time</b><br>
                                <input size="16" type="text" placeholder="dd-mm-yyyy hh:ii" class="good_delivery" required>
                            </p>
                        </div>
                        <div class="offer-price">
                            <p><b>Price</b></p>
                            <h4>€ 
                                <input type="text" class="offer_price" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" required>
                            </h4>
                        </div>
                        <div class="offer-button send-offer">
                            <button type="submit">Send Offer</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

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
                    <button type="button">Send email</button>
                </div>
            </div>
            <div class="live_request single-order-body">
                <form class="offer_form">
                    <div class="single-offer">
                        <div class="offer-type">
                            <span>MAKE YOUR OFFER</span>
                        </div>
                        <div class="offer-collection">
                            <p>
                                <b>Good Collection Time</b><br>
                                <input size="16" type="text" placeholder="dd-mm-yyyy hh:ii" class="good_collection" required>
                            </p>
                        </div>
                        <div class="offer-delivery">
                            <p>
                                <b>Good Delivery Time</b><br>
                                <input size="16" type="text" placeholder="dd-mm-yyyy hh:ii" class="good_delivery" required>
                            </p>
                        </div>
                        <div class="offer-price">
                            <p><b>Price</b></p>
                            <h4>€ 
                                <input type="text" class="offer_price" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" required>
                            </h4>
                        </div>
                        <div class="offer-button send-offer">
                            <button type="submit">Send Offer</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>


        

    </section>

    

    <div style="height:500px"></div>


    <script src="/vendor/bootstrap-datetimepicker-master/bootstrap-datetimepicker.min.js"></script>
    <script src="/supplier/js/today.js"></script>
    <?php require_once 'include/footer.php'; ?>