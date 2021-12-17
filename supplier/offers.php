<?php $page_title = 'My Offers'; ?>
<?php require_once 'include/header.php'; ?>

 
    <section class="text-center hero-section">
        <div class="breadcrumbs">
            <span><a href="/supplier">Supplier dashboard</a></span> » 
            <span><?php echo $page_title; ?></span>
        </div>
        <div class="row align-items-center">
            <div>
                <h1><?php echo $page_title; ?></h1>
                <p>Discover your active offers</p>
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
                    <span class="order-status">TO SHIP</span>
                    <button type="button">Send email</button>
                </div>
            </div>
            <div class="live_request single-order-body">
                <div class="single-offer">
                    <div class="offer-type">
                        <span>MY OFFER</span>
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
                    <div class="offer-button confirm-shipped">
                        <button type="button">Confirm Shipped</button>
                    </div>
                </div>
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
                <div class="single-offer">
                    <div class="offer-type">
                        <span>MY OFFER</span>
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
                    <span class="order-status">ENDED</span>
                </div>
            </div>
            <div class="live_request single-order-body">
                <div class="single-offer">
                    <div class="offer-type">
                        <span>MY OFFER</span>
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
                </div>
            </div>
        </div>

    </section>



<?php require_once 'include/footer.php'; ?>