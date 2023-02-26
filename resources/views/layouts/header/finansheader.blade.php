<header class="header">
    <div class="header-scroll-container">
        <div class="header-scroll-area">
            <section class="header-widgets-row">
                <div class="container ">
                    <div class="row hisse2014Bar">
                        <ul class="bar">
                            <li class="item up">
                                <div style="text-align: center;font-size: 11px;font-weight: 800"><?=now()->translatedFormat('d F Y H:i')?>
                                    <span style="font-weight:800;color: #f24636;"><?php echo now()->dayName; ?></span></div>
                             </li>
                            <?php foreach($currencys as $val){ ?>
                            <li class="item up">
                                <a>
                                   <span class="col1">
                                       <span class="name"><?=$val->left_icon?></span>
                                   </span>
                                    <span class="col3">
                                             <span class="value2" style="color: #000">
                                                     <span style="padding-right: 12px;" class="spansub">Alış</span><?=$val->price_buy?>
                                             </span>
                                             <span class="value3"  style="color: #2bbf69">
                                                 <span style="padding-right: 7px;color: #2bbf69" class="spansub">Satış</span><?=$val->price_sell?>
                                             </span>
                                     </span>
                                </a>
                            </li>
                            <?php } ?>

                        </ul>
                     </div>
                </div>
            </section>
        </div>
    </div>
</header>

<style>
    .weather-bar {
        order: 2;
        color: #fff;
        display: flex;
        margin-left: auto;
        padding-left: 10px;
        align-items: center;
        position: relative;
        justify-content: space-between;
        background-image: linear-gradient(90deg, #039a3d 0, rgba(3, 154, 61, .89) 53%, rgba(3, 154, 61, 0));
    }

    .css-slider-slides {
        width: 100%;
        display: flex;
    }
    .js-dropdown-item {
        font-size: 13px;
        font-weight: 700;
        text-transform: uppercase;
    }
    .js-dropdown-list {
        display: none;
    }
    .js-dropdown-ico:before {
        font-family: font-icon;
        font-style: normal;
        font-weight: 400;
        content: "";
    }
    .js-dropdown-btn, .js-dropdown-ico {
        display: flex;
        align-items: center;
        height: 100%;
    }
    .js-dropdown-btn {
        cursor: pointer;
    }
    .header {
        width: 100%;
        width: 100vw;
        z-index: 9998;
        position: relative;
    }

    .weather-bar .js-dropdown {
        overflow: hidden;
    }

    .js-dropdown {
        height: 100%;
        display: flex;
        flex-grow: 1;
    }

    .weather-bar .loading {
        width: 20px;
        height: 20px;
        opacity: 0;
    }

    .weather-bar .loading .spinner {
        border-color: #fff #00b18f #00b18f;
    }

    .weather-bar .loading .spinner {
        border-color: #00b18f;
        border-top-color: #fff;
    }

    .loading .spinner {
        -webkit-animation: spin 1s ease-in-out infinite;
        animation: spin 1s ease-in-out infinite;
        border-radius: 50%;
        border: 2px solid #e20404;
        border-top-color: #fff;
        display: block;
        height: 100%;
        width: 100%;
    }

    .header-scroll-container {
        width: 100vw;
        position: relative;
        z-index: 2;
    }

    .js-header-fixed .header-scroll-area {
        position: fixed;
        top: 0;
    }

    .header-scroll-area {
        width: 100vw;
    }

    .header-widgets-row {
        width: 100vw;
        background-image: linear-gradient(270deg, #e8e8e8, #e8e8e8);
    }




    .header-widgets-row .weather-bar {
        width: 50%;
        height: 43px;
    }


    .weather-bar {
        order: 2;
        color: #fff;
        display: flex;
        margin-left: auto;
        padding-left: 10px;
        align-items: center;
        position: relative;
        justify-content: space-between;
        background-image: linear-gradient(to right, #039a3d 0, rgba(3, 154, 61, .89) 53%, rgba(3, 154, 61, 0) 100%)
    }

    @media (min-width:768px) {
        .weather-bar {
            padding-left: 15px
        }
        .weather-bar+.finance-bar:after {
            content: "";
            width: 17px;
            height: 0px;
            display: inline-block;
            position: absolute;
            right: 0;
            background-image: linear-gradient(to left, rgba(0, 0, 0, .3) 0, rgba(0, 0, 0, 0) 100%)
        }
    }

    .weather-bar .loading {
        width: 20px;
        height: 20px;
        opacity: 0
    }

    .weather-bar .loading .spinner {
        border-color: #00b18f;
        border-top-color: #fff
    }

    .weather-bar-sponsored {
        display: none
    }

    .weather-bar.with-sponsored .weather-bar-sponsored {
        display: block;
        flex-shrink: 0;
        padding-right: 7px;
        width: 57px
    }

    .weather-bar.with-sponsored .weather-bar-sponsored a,
    .weather-bar.with-sponsored .weather-bar-sponsored picture {
        display: block
    }

    .weather-bar.with-sponsored .weather-bar-sponsored img {
        max-width: 50px
    }

    .weather-bar .js-dropdown {
        overflow: hidden
    }

    .weather-bar .js-dropdown-btn {
        position: relative
    }

    .weather-bar .js-dropdown-btn i {
        font-size: 20px;
        margin-right: 6px;
        flex-shrink: 0
    }

    .with-sponsored.weather-bar .js-dropdown-btn i {
        margin-right: 4px
    }

    @media (min-width:768px) {
        .weather-bar.with-sponsored .weather-bar-sponsored {
            padding-right: 8px;
            width: 98px
        }
        .weather-bar.with-sponsored .weather-bar-sponsored img {
            max-width: 90px
        }
        .weather-bar .js-dropdown-btn i {
            margin-right: 11px;
            font-size: 23px
        }
        .with-sponsored.weather-bar .js-dropdown-btn i {
            margin-right: 7px;
            margin-left: 0
        }
    }

    @media (min-width:992px) {
        .weather-bar.with-sponsored .weather-bar-sponsored {
            padding-right: 15px;
            width: 105px
        }
        .weather-bar .js-dropdown-btn i {
            font-size: 25px;
            margin-right: 10px
        }
        .with-sponsored.weather-bar .js-dropdown-btn i {
            margin-right: 6px
        }
    }

    .weather-bar .js-dropdown-btn .city {
        flex-grow: 1;
        font-size: 11px;
        font-weight: 700;
        padding-right: 2px;
        text-transform: uppercase;
        max-width: 87px;
        overflow: hidden
    }

    @media (max-width:375px) {
        .weather-bar .js-dropdown-btn .city {
            max-width: 55px
        }
    }

    @media (min-width:992px) {
        .weather-bar .js-dropdown-btn .city {
            max-width: 95px
        }
    }

    .with-sponsored.weather-bar .js-dropdown-btn .city {
        max-width: 32px
    }

    @media (min-width:768px) {
        .weather-bar .js-dropdown-btn .city {
            font-size: 13px
        }
        .with-sponsored.weather-bar .js-dropdown-btn .city {
            max-width: 36px
        }
    }

    .weather-bar .js-dropdown-btn .city span {
        margin-top: 2px;
        position: relative
    }

    .weather-bar .js-dropdown-btn .city span:first-child {
        display: block;
        white-space: nowrap;
        text-overflow: ellipsis;
        overflow: hidden
    }

    .with-sponsored.weather-bar .js-dropdown-btn .city span:first-child {
        display: none
    }

    .weather-bar .js-dropdown-btn .city span:last-child {
        display: none
    }

    .with-sponsored.weather-bar .js-dropdown-btn .city span:last-child {
        display: inline-block;
        padding-right: 4px
    }

    .with-sponsored.weather-bar .js-dropdown-btn .city span:last-child:after {
        content: ".";
        right: 0;
        bottom: 0;
        position: absolute
    }

    .weather-bar .js-dropdown-btn .js-dropdown-ico {
        font-size: 8px
    }

    .weather-bar .js-dropdown-ico {
        padding-left: 10px
    }

    @media (min-width:768px) {
        .weather-bar .js-dropdown-btn .js-dropdown-ico {
            font-size: 7px
        }
        .weather-bar .js-dropdown-ico {
            padding-left: 16px
        }
    }

    @media (min-width:992px) {
        .weather-bar .js-dropdown-btn .js-dropdown-ico {
            font-size: 6px
        }
        .weather-bar .js-dropdown-ico {
            padding-left: 10px
        }
    }

    .weather-bar .js-dropdown-label .degree {
        display: flex;
        flex-shrink: 0;
        font-size: 14px;
        font-weight: 700;
        line-height: 22px;
        margin-left: 40px;
        justify-content: flex-end
    }

    .weather-bar .js-dropdown-label .degree span+span {
        margin-left: 7px;

    }

    .weather-bar .js-dropdown-label .degree span {
        position: relative;
        padding-right: 9px;
        font-size:18px;
        margin-top: 12px;
    }

    .weather-bar .js-dropdown-label .degree span.low-temp {
        display: block;
        opacity: .5
    }

    .with-sponsored.weather-bar .js-dropdown-label .degree span.low-temp {
        display: block
    }

    .weather-bar .js-dropdown-label .degree span:after {
        font-family: font-icon;
        content: "";
        top: 2px;
        right: 1px;
        font-size: 7px;
        width: 7px;
        height: 7px;
        line-height: 7px;
        position: absolute
    }

    .weather-bar .js-dropdown-list {
        left: 0;
        width: 100%;
        max-height: 314px
    }

    .weather-bar .js-dropdown-item {
        line-height: 43px;
        padding-left: 14px
    }

    .weather-bar .js-dropdown-item.active {
        pointer-events: none
    }

    .weather-bar .js-dropdown-item.active {
        color: #fff;
        background-image: linear-gradient(to right, #00f2c3 0, #00b18f 100%)
    }

    .weather-bar.weather-bar-loading .loading {
        opacity: .5
    }

    .weather-bar.weather-bar-loading .js-dropdown-label {
        opacity: .5
    }
    .js-dropdown-label a {
        flex-grow: inherit;
        display: inherit;
        align-items: inherit;
        -webkit-user-select: inherit;
        -moz-user-select: inherit;
        -ms-user-select: inherit;
        user-select: inherit;
    }

    .js-dropdown-label a {
        flex-grow: inherit;
        display: inherit;
        align-items: inherit;
    }

    .finance-bar {
        color: #fff;
        flex-grow: 1;
        position: relative;
        align-items: center;
        width: 80%;
        float: left;
    }

    .finance-bar-items {
        flex-grow: 1;
        display: flex;
        overflow: hidden;
        align-items: center;
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
        justify-content: space-between;
    }

    .css-slider {
        display: flex;
        align-items: flex-start;
        flex-grow: 1;
        height: 43px;
        overflow: hidden;
    }

    .css-slider-inner {
        display: flex;
        flex-direction: column;
        flex-shrink: 0;
        width: 100%;
        overflow: hidden;
        -webkit-animation: 33s cubic-bezier(.22, .61, .36, 1) infinite;
        animation: 33s cubic-bezier(.22, .61, .36, 1) infinite;
        -webkit-animation-name: itemSlideVer;
        animation-name: itemSlideVer;
        -webkit-animation-play-state: paused;
        animation-play-state: paused;
    }

    .css-slider-run {
        -webkit-animation-play-state: running;
        animation-play-state: running;
    }

    .css-slider-slide {
        width: 20%;
        height: 43px;
        display: flex;
        align-items: center;
    }

    .finance-bar-items .fb-item-link:not(.dummy).show {
        opacity: 1;
    }

    .finance-bar-items .fb-item-link:not(.dummy) {
        opacity: 0;
        transition: opacity .3s ease-out;
        will-change: opacity;
        color: #fff;
    }

    .finance-bar-items .fb-item-name {
        display: block;
        font-size: 13px;
        font-weight: 500;
        text-transform: uppercase;
        font-style: normal;
        letter-spacing: normal;
        line-height: normal;
    }

    .finance-bar-items .fb-item-value {
        font-size: 13px;
        font-weight: 700;
        line-height: 22px;
    }

    .finance-bar-items .fb-item-change {
        font-size: 11px;
        font-weight: 500;
    }

    .finance-bar-items .fb-item-change.up:after {
        content: "";
        color: #03c43e;
    }

    .finance-bar-items .fb-item-change.down:after, .finance-bar-items .fb-item-change.up:after {
        font-size: 8px;
        font-family: font-icon;
        margin-left: 2px;
    }
    .js-dropdown-list ul{
        width: 326px;
        margin-top: 37px;
        margin-left: -25px;
    }
    .js-dropdown-list ul li:hover{
       background:#cccace;
        cursor: pointer
    }
</style>

<script>

    app.controller("mainController", ['$scope', '$http', '$httpParamSerializerJQLike', '$filter', function ($scope, $http, $httpParamSerializerJQLike, $window, $filter) {


        $scope.finans = function () {
            $http({
                method: 'GET',
                url: 'admin/api/finance',
                headers: {
                    'Content-Type': 'application/json' ,

                }
            }).then(function successCallback(response) {
                console.log(response);
                $scope.finance = response.data;
            }, function (response) {
                swal("Hoops!",'bukunamadı', 'warning');
            });
        }

        $scope.changeWeater = function (name) {
            var  formData = "name="+name+"";
            $http({
                method: 'POST',
                url: 'admin/api/weather',
                data:formData,
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                }
            }).then(function successCallback(response) {
                $scope.weather = response.data;
            }, function (response) {
                swal("Hoops!",'bukunamadı', 'warning');
            });
        }

        $scope.getCustomers = function () {
            $("#theCustomerUl").show();
            $("#theCustomerUl").css('display', 'block');
            var searchText_len = $scope.getCustomer.trim().length;
            // Check search text length
            if (searchText_len > 0) {
                $scope.data = [];
                $http({
                    method: "POST", // method bu sefer post
                    url: "/get_customer", // urlmiz
                    data: $httpParamSerializerJQLike({
                        searchText: $scope.getCustomer,
                    }),
                    headers: {
                        "Content-Type": "application/x-www-form-urlencoded"
                    }
                }).then(function (response) {
                    $scope.customerResult = response.data;
                });
            } else {
                $scope.searchResult = {};
            }
        }

        $scope.addCustomerInput = function (id, firstname, lastname, item) {
            $("#theSearch").attr("data-customer_id", id);
            $("#theSearch").val(firstname + " " + lastname);
            $("#theSearchHidden").val(id);
            $("ul#theSearchUl").css('display', 'none');
            $scope.searchResult = "";

            $scope.customer_id = item.id;
            $scope.customer_country = item.nationality;
            $scope.customer_fullname = item.firstname + " " + item.lastname;
            $scope.email = item.email;
            $scope.phone = item.phone;
            $scope.birthday = item.birthday;
            $scope.gender = item.gender;
            $scope.point = item.point;
            $scope.remaining_points = item.remaining_points;
            $scope.cancel_reservation = item.cancel_reservation;
            $scope.waiting_reservation = item.waiting_reservation;
            $scope.comfirm_reservation = item.comfirm_reservation;
            $http({
                method: "GET", // method bu sefer post
                url: "/get_customer_blacklist?id=" + id + "",
                headers: {
                    "Content-Type": "application/x-www-form-urlencoded"
                }
            }).then(function (response) {
                $scope.blacklist = response.data;
            });
            if (item.notes != null) {
                $("#customerNoteModal").modal("show");
                $scope.customernotelist = item.notes;
            }

        }

    }]);



    $(".js-dropdown").find('.city').click(function(){
           $(".js-dropdown-list").find('ul').show();
           $(".js-dropdown-list").show();
    });
    $(".js-dropdown").on("click",".js-dropdown-item",function(){
        var name = $(this).text();
        $(".city span").text(name);
        $(".js-dropdown-list").hide();
    });
</script>
