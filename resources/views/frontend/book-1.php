<?php include ("inc/header.php");?>

<section class="profile-area">
    <div class="container">
        <div class="col-md-4 col-sm-4 col-xs-12">
            <div class="profile-img">
                <img src="img/interface/avatar.png">
                <h3>Online</h3>
            </div>
            <div class="short-info">
                <h1>Jeremy Rose<br><span><i class="fa fa-map-marker"></i>New York, NY</span></h1>
                <a class="btn btn-min">$5 / Minute</a>
            </div>
        </div>
        <div class="col-md-8 col-sm-8 col-xs-12">
            <div class="row">
                <div class="field-area">
                    <div class="head-line">
                        <h3><i class="fa fa-phone"></i> Provide Call Information </h3>
                    </div>
                    <div class="input-group">
                        <span class="input-group-addon">Message to Jeremy<br><a href="#">Examples</a></span>
                        <textarea class="form-control" rows="4" id="comment" style="height:65px !important; width:100%;" placeholder="Please enter a reason for the call" spellcheck="false"></textarea>
                    </div>
                    <br>
                    <div class="input-group">
                        <span class="input-group-addon">Set Estimated Length</span>
                        <select class="minimal">
                            <option>05 minutes ($25.00)</option>
                            <option>10 minutes ($50.00)</option>
                            <option>15 minutes ($75.00)</option>
                            <option>20 minutes ($100.00)</option>
                            <option>25 minutes ($125.00)</option>
                            <option>30 minutes ($150.00)</option>
                            <option>35 minutes ($175.00)</option>
                        </select>
                    </div>
                    <p>You will be charged $125.00 for the current scheduled call length. If the call goes over the scheduled time, you 
                    will be charged the balance at a rate of $8.33/min. If the call goes less than the scheduled time, you will be 
                    refunded the balance.</p>
                    <div class="input-group">
                        <span class="input-group-addon">Full Name*</span>
                        <input type="text" class="form-control" placeholder="John Doe">
                    </div>
                    <div class="input-group">
                        <span class="input-group-addon">Email Address*</span>
                        <input type="text" class="form-control" placeholder="johndoe@gmail.com">
                    </div>
                    <a class="mem" href="#">Already a Member?</a>
                    <div class="input-group">
                        <span class="input-group-addon">Cell Phone*</span>
                        <div class="intl-phone-input">
                            <div class="intl-code-select">
                                <select class="select-menu">
                                <option value="0">Taiwan (+886)</option><option value="1">China (+86)</option><option value="2">USA (+1)</option></select>
                                <div class="select-display">+1</div>
                            </div>
                            <div class="input-wrap">
                                <input class="phone-input" type="text" placeholder="(123) 456-78910">
                                <span class="error-tip">Error occured</span>
                            </div>
                            <div class="hint-text"></div>
                        </div>
                    </div>
                    <p> Cell phone is only used for notifications. <a href="#">Learn more about how Clarity works.</a> </p>
                </div>
                <div class="field-area">
                    <div class="head-line">
                        <h3><i class="fa fa-calendar"></i> Suggest Times When You’re Free to Talk </h3>
                    </div>
                    <div class="date-time">
                        <div class="col-md-8 col-sm-12 col-xs-12 no-padding">
                            <input class="form-control left" placeholder="MM/DD/YYYY"/>
                        </div>
                        <div class="col-md-4 col-sm-12 col-xs-12 no-padding">
                            <div class="tm-box">
                                <input class="form-control tm-form right" placeholder="HH:MM AM/PM"/>
                            </div>
                        </div>
                    </div>
                    <br>
                    <p>Please note that the times you choose will be 10 hours earlier for Adrian (EDT)</p>
                    <div class="input-group">
                        <span class="input-group-addon">Your Timezone</span>
                        <select class="minimal">
                            <option>(GMT +06:00) Almaty</option>
                            <option>(GMT +02:00) Almaty</option>
                            <option>(GMT +08:00) Almaty</option>
                            <option>(EST +06:00) Almaty</option>
                            <option>(GMT +04:00) Almaty</option>
                        </select>
                    </div>
                </div>
                <p>By scheduling a call you agree with our <a href="#">Terms of Service.</a></p>
                <a class="btn btn-booking">Book Now</a>
            </div>
        </div>
    </div>
</section>

<?php include ("inc/footer.php");?>