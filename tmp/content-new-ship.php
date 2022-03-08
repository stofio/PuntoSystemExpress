    <section class="text-center hero-section">
        <div class="container">
            <div class="align-items-center">
                <div class="breadcrumbs">
                    
                    <span><a href="<?php echo isset($homeLink) ? $homeLink : '/'; ?>"><?php echo isset($breadcrumbs) ? $breadcrumbs : 'Home'; ?></a></span> » 
                    <span><?php echo isset($page_title) ? $page_title : 'New Shipment'; ?></span>
                </div>
                <div class="row align-items-center">
                    <div>
                        <h1>New Request</h1>
                        <p>Request a new quote</p>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <section id="new_request">
        <form id="new_request_form" enctype="multipart/form-data" autocomplete="off"> 
            <div class="new-request-container">

                <div class="row">
                    <div class="col-md-4">
                        <label>Name<br>
                            <input type="text" name="name" placeholder="Name" required/>
                        </label>
                    </div>
                    <div class="col-md-4">
                        <label>Phone number<br>
                            <input type="text" name="phone" placeholder="Phone number" required/>
                        </label>
                    </div>
                    <div class="col-md-4">
                        <label>Email address<br>
                            <input type="text" name="email" placeholder="Email address" required/>
                        </label>
                    </div>
                </div>


                <div class="row">
                    <div class="col-md-4">
                        <label>Shipment Ref.<br>
                            <input type="text" name="shipment_ref" placeholder="Shipment Ref." required/>
                        </label>
                    </div>
                    <div class="col-md-4">
                        <label>Commodity<br>
                            <input type="text" name="commodity" placeholder="Commodity" required/>
                        </label>
                    </div>
                    <div class="col-md-4">
                        <label>Transport Requirements<br>
                            <div class="trans-req">
                                <div>
                                    <input type="checkbox" name="adr" id="adr">
                                    <label for="adr">ADR</label>
                                </div>
                                <div>
                                    <input type="checkbox" name="temp_cont" id="temp_cont">
                                    <label for="temp_cont">Temperature Controlled</label>
                                </div>
                            </div>
                        </label>
                    </div>
                </div>


                <div class="row">
                    <div class="col-md-4">
                        <label>Country of Origin<br>
                            <select name="from_place" class="request_from" required>
                            <option value=""></option>
                                <optgroup label="EU" class="request_from_eu_group"></optgroup>
                            </select>
                        </label>
                    </div>
                    <div class="col-md-4">
                        <label>Loading place<br>
                            <input type="text" name="loading_point" placeholder="Loading place" required/>
                        </label>
                    </div>
                    <div class="col-md-4">
                        <label>Cargo available from<br>
                            <input type="text" name="from_time" class="request_available_from" placeholder="Cargo available from" required/>
                        </label>
                    </div>
                </div>



                <div class="row">
                    <div class="col-md-4">
                        <label>To<br>
                            <select name="to_place" class="request_to" required="true">
                                <option value=""></option>
                                <optgroup label="EU" class="request_to_eu_group"></optgroup>
                                <optgroup label="extra-EU" class="request_to_non_eu_group"></optgroup>
                            </select>
                        </label>
                    </div>
                    <div class="col-md-4">
                        <label>Delivery place<br>
                            <input type="text" name="discharge_point" placeholder="Delivery place" required/>
                        </label>
                    </div>
                    <div class="col-md-4">
                        <label>Requested delivery within<br>
                            <input type="text" name="to_time" class="request_delivered_within" placeholder="Available within" required/>
                        </label>
                    </div>
                </div>

                
                <div class="col-md-12">
                    <label>Packing list
                        <div class="colli-container">
                            <div class="collo-single">
                                <span class="coll-nu">1</span>
                                <div>
                                    <label>Packaging Type</label>
                                    <select class="collo-name" placeholder="Packaging Type" required>
                                        <option value="Carton">Carton</option>
                                        <option value="Pallet">Pallet</option>
                                        <option value="Piece">Piece</option>
                                        <option value="Case">Case</option>
                                        <option value="Cage">Cage</option>
                                        <option value="Bundle">Bundle</option>
                                        <option value="Reel">Reel</option>
                                    </select>
                                </div>
                                <div>
                                    <label>Lenght (cm)</label><input type="text" class="collo-l" placeholder="E.g. 55" required>
                                </div>
                                <div>
                                    <label>Width (cm)</label><input type="text" class="collo-w" placeholder="E.g. 10.5" required>
                                </div>
                                <div>
                                    <label>Height (cm)</label><input type="text" class="collo-h" placeholder="E.g. 30" required>
                                </div>
                                <div>
                                    <label>Weight (kg)</label><input type="text" class="collo-kg" placeholder="E.g. 350" required>
                                </div>
                                <div>
                                    <label>Stackable</label>
                                    <input type="checkbox" class="collo-stack">
                                </div>
                            </div>
                            <span id="new-collo">+ Add new</span>
                        </div>
                    </label>
                </div>

                <div class="col-md-12">
                    <label>Note<br>
                        <textarea placeholder="Note" name="note"></textarea>
                    </label>
                </div>
                <div class="col-md-12">
                    <label>Attachments (files larger then 50MB will not be uploaded)<br>
                        <input type="file" name="files[]" id="files" multiple />
                    </label>
                </div>
                <div class="col-md-12">
                    <div class="error-container"></div>
                    <button name="send_request" type="submit">Send request</button>
                </div>

               
            </div>
        </form>
    </section>


    <!-- login popup (on form submit) -->
    <div class="modal fade login-modal" id="loginModalForm" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header border-bottom-0">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
            
                <div class="modal-body">
                    <div class="form-title text-center">
                        <h4>Login and send</h4>
                    </div>
                    <div class="d-flex flex-column text-center">
                        <form method="post">
                            <div class="form-group">
                                <input type="email" name="usernameCheck" placeholder="Your email address..." required>
                            </div>
                            <div class="form-group">
                                <input type="password" name="passwordCheck" placeholder="Your password..." required>
                            </div>
                            <div class="error-container-login-req mt-3"></div>
                            <button name="loginCheck" type="submit">Login</button>
                        </form>
                    </div>            
                </div>
                <div class="modal-footer d-flex justify-content-center">
                    <div class="signup-section">Not registered yet? 
                        <a href="mailto:info@puntosystemgroup.com"> Request an account</a>.
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="/defaults.js"></script>