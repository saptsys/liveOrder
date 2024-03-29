<div id="header">
        <h1>
            <i class="fas fa-glass-cheers"></i><b> Live Orders</b>
            <span class='fas fa-info-circle' id="iBtn"></span>

            <?php
                if(!(isset($_SESSION['user']) && isset($_SESSION['pass']) && isset($_SESSION['role'])))
                {
                    echo "<button onclick='login()' class='login-btn btn'>Login";
                }
                else
                {?>
                    <span id="header_user">
                        <img src="../../assets/uploads/<?php echo $_SESSION['role']."/".$_SESSION['user'] .".jpg"?>" alt="vaitul" id="header_user_img" onerror="this.onerror=null;this.src='../../assets/images/avatar.png'">
                        <div id="header_user_div">
                            <p><?php echo ucwords(@$_SESSION['fullName']); ?> 
                                <i style="font-size:10pt; ">(<?php echo ucwords(@$_SESSION['role']); ?>)</i> <br> 
                                <i style="font-size:11pt;">Logout <a style="cursor:pointer;" onclick='logout()'>@<?php echo @$_SESSION['user']; ?></a></i>
                            </p>
                        </div>
                    </span>
                <?php 
                    // echo "<button onclick='logout()' class='logout-btn btn'>Logout <br>".ucwords(@$_SESSION['fullName']);
                }
            ?>

            </button>
        </h1>


    <div id="info-page">
        <hr/>
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <h3><b>Concept</b></h3>
                    <h4>Perpose to make "Digitalize Working of Restaurants" by smart phones or tablets so workers of restaurant can do things in less efforts and less time.</h4>
            </div>
        </div>

        <!-- <br/>
        <br/>
        
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <blockquote>
                    <h3><b>Hackathon 2019</b></h3>
                    <h4>This website developed by Vaitul & Keval for Hackathon organized by <b>Saurashtra University Rajkot, Gujarat.</b></h4>
                    <h4>Fork Repository <a href="https://github.com/liveOrder">https://github.com/liveOrder</a></h4>
                </blockquote>
            </div>
        </div> -->

        <br/>
        <br/>

        <blockquote>
            <h3><b>Creators</b></h3>
        </blockquote>

        <div class="row" id="dev-row">
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <center>
                    <img src="../../assets/images/vaitul.jpg" alt="">
                    <h4><b>VAITUL B BHAYANI</b></h4>
                    <h6>Mobile : 9904021519</h6>
                    <h6>E-Mail : personal.vaitul@gmail.com</h6>
                </center>
                <br>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <center>
                    <img src="../../assets/images/keval.jpg" alt="">
                    <h4><b>KEVAL H DHOLAKIYA</b></h4>
                    <h6>Mobile : 7096823708</h6>
                    <h6>E-Mail : kevald47@gmail.com</h6>
                </center>
            </div>
        </div>

        <br/>
        <br/>
        <br/>   

    </div>
</div>


<script src="../../assets/js/script.js"></script>