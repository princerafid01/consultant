
<?php include ("inc/header.php");?>

<div class="book-area-full">
    <div class="col-md-7 col-sm-5 col-xs-12">
        <div class="artwork">
            <h1>Book <br>& Call</h1>
            <img src="img/banner/artwork.png">
        </div>
    </div>
    <div class="col-md-5 col-sm-7 col-xs-12">
        <div class="book-form">
            <div class="top-intro">
                <div class="intro-img">
                    <img src="img/interface/intro.png">
                </div>
                <h2>Adrian Salamunovic</h2>
                <h3>Los Angeles and Ottawa, Canada</h3>
                <h4>$1/minute</h4>
            </div>
            <div class="intro-mid">
                <h1><span>1</span>Provide Call Information</h1>
                <h4>Message to Adrian</h4>
                <textarea class="form-control" rows="4" id="comment" style="height:65px !important; width:100%;" placeholder="Please enter a reason for the call"></textarea>
                <h4>Set Estimated Length</h4>
                <select class="minimal">
                    <option>05 minutes ($25.00)</option>
                    <option>10 minutes ($50.00)</option>
                    <option>15 minutes ($75.00)</option>
                    <option>20 minutes ($100.00)</option>
                    <option>25 minutes ($125.00)</option>
                    <option>30 minutes ($150.00)</option>
                    <option>35 minutes ($175.00)</option>
                </select>
                <p>You will be charged $125.00 for the current scheduled call length. If the call goes over the scheduled time, you will be charged the balance at a rate of $8.33/min. If the call goes less than the scheduled time, you will be refunded the balance.</p>
                <div class="row">
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <label>Full Name</label>
                        <input class="form-control" placeholder="John Doe" type="Name">
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <label>Email Address</label>
                        <input class="form-control" placeholder="johndoe@gmail.com" type="Name">
                    </div>
                </div>
                <div class="ex"><a href="#">Already a member?</a></div>
                <div class="col-md-12 col-sm-12 col-xs-12 no-padding">
                    <label>Cell Phone</label>
                    <div class="intl-phone-input">
                        <div class="intl-code-select">
                            <select class="select-menu">
                            </select>
                            <div class="select-display">
                                &nbsp;
                            </div>
                        </div>
                        <div class="input-wrap">
                            <input class="phone-input" type="text" placeholder="Phone Number"></input>
                            <span class="error-tip">Error occured</span>
                        </div>
                        <div class="hint-text">123</div>
                    </div>
                </div>
                <p>Cell phone is only used for notifications. <a href="#">Learn more about how Clarity works.</a><br><br><br></p>
                <h1><span>2</span>Suggest Times When You're Free to Talk</h1>
                <div class="date-time">
                    <div class="col-md-8 col-sm-8 col-xs-12 no-padding">
                        <input class="form-control" placeholder="MM/DD/YYYY"/>
                    </div>
                    <div class="col-md-4 col-sm-8 col-xs-12 no-padding">
                        <div class="tm-box">
                            <input class="form-control tm-form" placeholder="HH:MM AM/PM"/>
                        </div>
                    </div>
                </div>
                <h1><span>3</span>Book Now</h1>
                <a href="#" class="btn btn-book">Book Now</a>
            </div>
        </div>
    </div>
</div>

<?php include ("inc/footer.php");?>