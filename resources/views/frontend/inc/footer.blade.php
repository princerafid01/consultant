
<section class="footer-area no-padding">
    <div class="container w-sm-80 mx-auto">
        <div class="footer-middle-area w-full flex flex-wrap  pt-10">
             {{--<div class=" w-full sm:w-1/2 lg:w-1/4">
                <div class="content-footer ">
                    <img src="/public/frontend/img/interface/logo-2.png" >
                    <h4 class="my-2 text-4xl font-bold">Connect With Us</h4>
                    <ul>
                        <li><a target="blank" href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                        <li><a target="blank" href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                        <li><a target="blank" href="#"><i class="fa fa-youtube-play" aria-hidden="true"></i></a></li>
                        <li><a target="blank" href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
                    </ul>
                </div>
            </div>
            <div class="w-full sm:w-1/2 lg:w-1/4">
                <div class="content-footer">
                    <h4>About Geeks</h4>
                    <li><a href="privacy.php">Privacy Policy</a></li>
                    <li><a href="terms.php">Terms of Service</a></li>
                </div>
            </div>
            <div class="w-full sm:w-1/2 lg:w-1/4">
                <div class="content-footer">
                    <h4>For Clients</h4>
                    <li><a href="pricing.php">Pricing</a></li>
                    <li><a href="enterprise.php">Enterprise Services</a></li>
                    <li><a href="faq.php">Client FAQ</a></li>
                    <li><a href="support.php">Client Support</a></li>
                </div>
            </div>
            <div class="w-full sm:w-1/2 lg:w-1/4">
                <div class="content-footer">
                    <h4>For Freelancer</h4>
                    <li><a href="f-faq.php">Freelancer FAQ</a></li>
                    <li><a href="f-support.php">Freelancer Support</a></li>
                    <li><a href="f-community.php">Freelancer Community</a></li>
                    <li><a href="f-blog.php">Freelancer Community Blog</a></li>
                </div>
            </div> --}}
            <div class="w-full border-t border-gray-800 mt-10">

                <h5 style="border:none" class="flex justify-center items-center">© Expense Geeks LLC 2020-21
                    <img src="/public/frontend/img/interface/logo-2.png" style="width:50px">
                </h5>


            </div>
        </div>
    </div>
</section>
</div>


<!--------------Begin: Javascript---------------->
<script src="/public/frontend/js/jquery-2.1.1.js"></script>
<script src="/public/frontend/js/bootstrap.min.js"></script>
{{-- <script src="https://js.stripe.com/v3/"></script> --}}
<script src="https://www.paypalobjects.com/api/checkout.js"></script>
<!-- Load the required Braintree components. -->
{{-- <script src="https://js.braintreegateway.com/web/3.39.0/js/client.min.js"></script>
<script src="https://js.braintreegateway.com/web/3.39.0/js/paypal-checkout.min.js"></script> --}}

<!------For Active Menu------>
<script>


//   $(document).ready(function() {


//   var url = window.location.href;
// //   url = url.substring(0, (url.indexOf("#") == -1) ? url.length : url.indexOf("#"));
// //   url = url.substring(0, (url.indexOf("?") == -1) ? url.length : url.indexOf("?"));
//   url = url.substr(url.lastIndexOf("/") + 1);
//   if(url == ''){
//   url = 'index.php';
//   }
//   $('.navbar-area li').each(function(){
//   var href = $(this).find('a').attr('href');
//   if(url == href){
//    $(this).addClass('active');
//   }
//   });
  </script>

  <script>
  $(document).ready(function(){

  $('#myDIV .fav').click(function(){
    $(this).addClass("active");
  });
  });
</script>

<!------For Tab Menu------>
<script>
  function openCity(evt, cityName) {
  var i, tabcontent, tablinks;
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
  tabcontent[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablinks");
  for (i = 0; i < tablinks.length; i++) {
  tablinks[i].className = tablinks[i].className.replace(" active", "");
  }
  document.getElementById(cityName).style.display = "block";
  evt.currentTarget.className += " active";
  }
</script>

<script>
  const tabs = document.querySelector(".tabs");
  const tabButtons = tabs.querySelectorAll('[role="tab"]');
  const tabPanels = Array.from(tabs.querySelectorAll('[role="tabpanel"]'));

  function handleTabClick(event) {
  tabPanels.forEach((panel) => (panel.hidden = true));
  tabButtons.forEach((tab) => tab.setAttribute("aria-selected", false));
  event.currentTarget.setAttribute("aria-selected", true);
  const { id } = event.currentTarget;
  const tabPanel = tabPanels.find(
  (panel) => panel.getAttribute("aria-labelledby") === id
  );
  tabPanel.hidden = false;
  }
  tabButtons.forEach((button) =>
  button.addEventListener("click", handleTabClick)
  );
</script>

<!------For Phone Input------>
<script>
  /** Helpers **/
const removeClass = (elem, className) => {
    if (elem.classList) {
        return elem.classList.remove(className);
    }

    const pattern = new RegExp(`\\s*${className}\\s*`);
    elem.className = elem.className.replace(pattern, "");
};

const addClass = (elem, className) => {
    if (elem.classList) {
        return elem.classList.add(className);
    }

    const prefix = elem.className ? " " : "";

    elem.className = elem.className + prefix + className;
};

/** Controllers **/
class IntlCodeSelect {
    static menuDisplayFn(item) {
        return item;
    }

    static displayFn(item) {
        return item;
    }

    static isDefault(item, i) {
        return i == 0;
    }

    constructor(elem, codeList) {
        this.inputElem = elem;
        this.menuElem = elem.querySelector(".select-menu");
        this.displayElem = elem.querySelector(".select-display");

        this.codeList = codeList || [];

        this.__initListeners();
        if (codeList && codeList.length) {
            this.initMenu(codeList);
        }
    }

    get curSelectedIndex() {
        const { menuElem } = this;
        return menuElem.value;
    }

    __initListeners() {
        const { menuElem } = this;
        menuElem.addEventListener("change", () => {
            this.updateDisplayByIndex(menuElem.value);
        });
    }

    initMenu(codeList = []) {
        const { menuElem } = this;

        this.codeList = codeList;

        codeList.forEach((item, i) => {
            let isDefault = IntlCodeSelect.isDefault(item, i);
            let opt = new Option(
                IntlCodeSelect.menuDisplayFn(item),
                i,
                false,
                isDefault
            );
            menuElem.add(opt);

            if (isDefault) {
                this.updateDisplayByIndex(i);
            }
        });
    }

    updateDisplayByIndex(i) {
        const { codeList, displayElem } = this;
        const item = codeList[i];
        let text = "";
        if (item != null) {
            text = IntlCodeSelect.displayFn(item);
        }

        displayElem.textContent = text;
    }

    onChange(fn) {
        const { menuElem } = this;
        menuElem.addEventListener("change", () => fn(menuElem.value));
    }
}

class IntlPhoneInput {
    static hintDisplayFn(item) {
        return "";
    }

    constructor(elem, codeList) {
        this.selectElem = elem.querySelector(".intl-code-select");
        this.hintElem = elem.querySelector(".hint-text");
        this.inputElem = elem.querySelector(".phone-input");

        this.selectCtrl = new IntlCodeSelect(this.selectElem, codeList);
        this.codeList = codeList;

        this.__initListeners();
        this.updateHintBySelect(this.selectCtrl.curSelectedIndex);
        this.error = false;
    }

    set error(hasError) {
        this.__error = hasError;
        if (hasError) {
            this.__hideHint();
            this.__showError();
        } else {
            this.__hideError();
        }
    }

    get error() {
        return this.__error;
    }

    __initListeners() {
        const { selectCtrl, inputElem } = this;
        selectCtrl.onChange((selIndex) => {
            this.updateHintBySelect(selIndex);
        });
        inputElem.addEventListener("focus", () => {
            this.__showHint();
        });
        inputElem.addEventListener("blur", () => {
            this.__hideHint();
        });
    }

    updateHintBySelect(i) {
        const { codeList, hintElem } = this;
        const item = codeList[i];
        let text = "";
        if (item != null) {
            text = IntlPhoneInput.hintDisplayFn(item);
        }

        hintElem.textContent = text;
    }

    __showError() {
        const { inputElem } = this;
        const wrap = inputElem.parentElement;
        addClass(wrap, "invalid");
    }

    __hideError() {
        const { inputElem } = this;
        const wrap = inputElem.parentElement;
        removeClass(wrap, "invalid");
    }

    __hideHint() {
        const { hintElem } = this;
        removeClass(hintElem, "show");
    }

    __showHint() {
        const { hintElem } = this;
        if (!this.error) {
            addClass(hintElem, "show");
        }
    }

    getValues() {
        const { codeList, inputElem, selectCtrl } = this;

        let code = codeList[selectCtrl.curSelectedIndex];

        return {
            code,
            number: inputElem.value
        };
    }
}

/** Setup demo **/
let areaCodeList = [
    {
        id: 1,
        show: "+886",
        area: "Taiwan"
    },
    {
        id: 2,
        show: "+86",
        area: "China"
    },
    {
        id: 3,
        show: "+1",
        area: "USA",
        defaultSelected: true
    }
];

IntlPhoneInput.hintDisplayFn = (item) => {
    return item.showCase;
};
IntlCodeSelect.menuDisplayFn = (item) => {
    return `${item.area} (${item.show})`;
};
IntlCodeSelect.displayFn = (item) => {
    return item.show;
};
IntlCodeSelect.isDefault = (item) => {
    return item.defaultSelected || false;
};

const phoneInputElem = document.querySelector(".intl-phone-input");
const phoneCtrl = new IntlPhoneInput(phoneInputElem, areaCodeList);

</script>
<script src="/public/js/app.js"></script>
<script src="/public/js/jquery.smartmenus.js" type="text/javascript"></script>

<script>
    // $('body').load(function () {
        // $(".loader").hide();
    // });
</script>

@yield('scripts')


<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-172407673-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-172407673-1');
</script>

</body>
</html>