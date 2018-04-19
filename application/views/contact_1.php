<?php $this->load->view('master'); ?>
<?php $this->load->view('elements/header'); ?>
<?php $this->load->view('elements/reservation'); ?>

<script src='https://www.google.com/recaptcha/api.js'></script>
<!-- Start Container -->
<div id="container">

    <!-- Content -->
    <div class="content clearfix">

        <div class="container-top"></div>

        <section class="page-head">
            <h1>
                <span><?= lang('contact') ?></span>
            </h1>
        </section>

        <!-- Main -->
        <div>
            <div class="map-container clearfix">
                <div id="map_canvas"></div>
                <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?sensor=false&key=AIzaSyCSVLqra6i7EhDOJUAok0flbH870jKOpho"></script>
                <script type="text/javascript">
                    // Google Map
                    function initialize()
                    {
                        var geocoder = new google.maps.Geocoder();
                        var map;
                        var latlng = new google.maps.LatLng(41.0230376, 29.0934362);
                        var infowindow = new google.maps.InfoWindow();
                        var myOptions = {
                            zoom: 17,
                            mapTypeId: google.maps.MapTypeId.ROADMAP
                        };

                        map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);

                        geocoder.geocode({'location': latlng},
                                function (results, status) {
                                    if (status == google.maps.GeocoderStatus.OK)
                                    {
                                        map.setCenter(results[0].geometry.location);
                                        var marker = new google.maps.Marker({
                                            map: map,
                                            position: results[0].geometry.location
                                        });
                                        //alert(results[0].formatted_address);
                                        //infowindow.setContent(results[0].formatted_address);
                                        //infowindow.open(map, marker);
                                    } else
                                    {
                                        alert("Geocode was not successful for the following reason: " + status);
                                    }
                                });

                    }

                    initialize();
                </script>
            </div>

            <!-- separator -->
            <hr class="separator">

            <section>

                <h2 class="form-heading"><?= lang('contact_form') ?></h2>

                <p>Bize bir mesaj göndermek için aşağıdaki formu doldurun; en kısa sürede size geri döneceğiz.</p>

                <form class="contact-form clearfix" action="<?= base_url('Requests/sentMessage')?>" method="post" novalidate>
                    <input type="hidden" name="<?= $csrf['name']; ?>" value="<?= $csrf['hash']; ?>" />

                    <p class="adjust">
                        <label for="name">Ad Soyad <span>*</span> </label>
                    <input type="text" name="firstname" id="name" class="required" required value="" title="* Lütfen adınızı giriniz" />
                    </p>

                    <p>
                        <label for="pn"><?= lang('phone') ?> </label>
                    <input type="text" name="phone" id="pn" value="" />
                    </p>

                    <p class="adjust">
                        <label for="email"><?= lang('email') ?>  <span>*</span></label>
                    <input type="text" name="email" id="email" class="email required" required value="" title="* lütfen e-posta adresinizi giriniz" />
                    </p>

                    <p>
                        <label for="reason">Konu  </label>
                    <input type="text" name="subject" id="reason" required value="" />
                    </p>

                    <div class="clearfix"></div>
                    <label for="message"><?= lang('message') ?> <span>*</span> </label>
                    <textarea name="message" id="message" class="required" required title="* lütfen mesajınızı girin"></textarea>


                    <input type="submit" name="submit" value="Gönder" class="submit" />

                </form>

                <div class="error-container"></div>
                <p id="message-sent">&nbsp;</p>

            </section>

        </div><!-- End Main -->


        <!-- Start of Sidebar -->


        <div class="container-bottom"></div>

    </div> <!-- End Content-->

</div><!-- End Container -->

<?php $this->load->view('elements/footer'); ?>
<?php $this->load->view('masterdown'); ?>
</body>
</html>
