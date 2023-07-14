<html>
<head>
    <title>payment</title>
    <link rel="icon" href="{{asset('assets/images/logo.svg')}}" type="image/x-icon"/>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
    <link href="https://getbootstrap.com/docs/3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- INCLUDE SESSION.JS JAVASCRIPT LIBRARY -->
    <script src="https://api.vapulus.com:1338/app/session/script?appId=738bdc3e-167e-4afb-aeb9-a3a535c8ac53"></script>
    <!-- APPLY CLICK-JACKING STYLING AND HIDE CONTENTS OF THE PAGE -->
    <style id="antiClickjack">
        body {
            display: none !important;
            background-color: #EFEFEF !important;
        }
    </style>

    <style>
        body {
            font-family: Arial;
            font-size: 17px;
            padding: 8px;
            overflow-x: hidden;
        }


        .row {
            display: -ms-flexbox; /* IE10 */
            display: flex;
            -ms-flex-wrap: wrap; /* IE10 */
            flex-wrap: wrap;
            margin: 0 -16px;
        }

        .col-25 {
        -ms-flex: 25%; /* IE10 */
            flex: 25%;
        }

        .col-50 {
        -ms-flex: 50%; /* IE10 */
            flex: 50%;
        }

        .col-75 {
        -ms-flex: 75%; /* IE10 */
            flex: 75%;
        }

            .col-25,
            .col-50,
            .col-75 {
                padding: 0 16px;
            }

            .container {
                background-color: #f2f2f2;
                padding: 5px 20px 15px 20px;
                border: 1px solid lightgrey;
                border-radius: 3px;
            }

            input[type=text] {
                width: 100%;
                margin-bottom: 20px;
                padding: 12px;
                border: 1px solid #ccc;
                border-radius: 3px;
            }

            label {
                margin-bottom: 10px;
                display: block;
            }

            .icon-container {
                margin-bottom: 20px;
                padding: 7px 0;
                font-size: 24px;
            }

            .btn {
                background-color: #4CAF50;
                color: white;
                padding: 12px;
                margin: 10px 0;
                border: none;
                width: 100%;
                border-radius: 3px;
                cursor: pointer;
                font-size: 17px;
            }

            .btn:hover {
                background-color: #45a049;
            }

            a {
                color: #2196F3;
            }

            hr {
                border: 1px solid lightgrey;
            }

            span.price {
                float: right;
                color: grey;
            }

            /* Responsive layout - when the screen is less than 800px wide, make the two columns stack on top of each other instead of next to each other (also change the direction - make the "cart" column go on top) */
            @media (max-width: 800px) {
                .row {
                    flex-direction: column-reverse;
                }
                .col-25 {
                    margin-bottom: 20px;
                }
            }
            body{
                margin: 0;
                padding: 0;
            }
            .landpage{
                width: 100%;
                height: 100%;
                position: absolute;
                z-index: 9999;
                background-color: rgba(0, 0, 0, .7);
            }
            .landpage img{
                position: absolute;
                left: 50%;
                top: 50%;
                transform: translate(-50% , -50%);
                width: 300px;
            }
            .d-none{
                display: none;
            }
    </style>
</head>

<body>
    <div class="landpage d-none">
        <img src="{{asset('assets/images/loader.gif')}}" />
    </div>
    <div class="row" style="padding-top: 30px">
        <div class="col-75">
            <div class="container">
                @if($errors->any())
                    <div class="alert alert-danger" style="margin-right: 15px;margin-left: 15px" role="alert">
                        @foreach($errors->all() as $error)
                            <p>{{$error}}</p>
                        @endforeach
                    </div>
                @endif
                <div class="alert alert-danger alert-errors" style="margin-right: 15px;margin-left: 15px ; display: none" role="alert">
                    <p class="mb-0 alert-errors"></p>
                </div>
                <form id="payForm" method="post" action="{{route('vapulusPayment.company.pay')}}">
                    @csrf
                    <input type="hidden" name="package_id" id="package_id" value="{{$packageId}}" readonly/>
                    <input type="hidden" name="user_id" id="user_id" value="{{$userId}}" />
                    <input type="hidden" name="type" id="type" value="company" readonly/>
                    <input type="hidden" name="package_type" id="package_type" value="{{ $package_type }}" readonly/>
                    <input type="hidden" name="no_of_cvs" id="no_of_cvs" value="{{ $no_of_cvs }}" readonly/>
                    <input type="hidden" name="sessionId" id="sessionId" readonly/>
                    
                    <h3>Payment</h3>
                    <label for="fname">Total Price : {{$amount }}</label>


                    <div class="icon-container">
                        <i class="fa fa-cc-visa" style="color:navy;"></i>
                        <i class="fa fa-cc-amex" style="color:blue;"></i>
                        <i class="fa fa-cc-mastercard" style="color:red;"></i>
                        <i class="fa fa-cc-discover" style="color:orange;"></i>
                    </div>
                    <div class="row">

                        <div class="col-md-6">
                            <label for="cardNumber">Credit card number</label>
                            <input type="text" id="cardNumber" readonly>

                            <label for="cardMonth">Exp Month</label>
                            <input type="text" id="cardMonth">
                        </div>

                        <div class="col-md-6">
                            <label for="cardCVC">Security code:</label>
                            <input type="text" id="cardCVC" readonly/>

                            <label for="cardYear">Exp Year</label>
                            <input type="text" id="cardYear">
                        </div>

                    </div>
                </form>
                <button class="btn btn-primary pull-right" id="payButton" style="margin-right: 15px"
                        onclick="pay();">Pay
                </button>
            </div>
        </div>
    </div>

<!-- JAVASCRIPT FRAME-BREAKER CODE TO PROVIDE PROTECTION AGAINST IFRAME CLICK-JACKING -->
<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    if (window.PaymentSession) {
        PaymentSession.configure({
            fields: {
                // ATTACH HOSTED FIELDS IDS TO YOUR PAYMENT PAGE FOR A CREDIT CARD
                card: {
                    cardNumber: "cardNumber",
                    securityCode: "cardCVC",
                    expiryMonth: "cardMonth",
                    expiryYear: "cardYear"
                }
            },
            callbacks: {
                initialized: function (err, response) {
                    console.log("init....");
                    console.log(err, response);
                    console.log("/init.....");
                    // HANDLE INITIALIZATION RESPONSE
                },
                formSessionUpdate: function (err, response) {
                    console.log("update callback.....");
                    console.log(err, response);
                    $('.landpage').addClass('d-none');
                    $('.alert-errors').fadeIn(400);
                    $('.alert-errors').empty();
                    $('.alert-errors').append(`<p class="mb-0">` + response.message + `</p>`);
                    console.log(`<p class="mb-0">` + response.message + `</p>`);
                    console.log("/update callback....");
                    // HANDLE RESPONSE FOR UPDATE SESSION
                    if (response.statusCode) {
                        if (200 == response.statusCode) {
                            document.getElementById("sessionId").value = response.data.sessionId; //set value on myInputID
                            $('#payForm').submit();
                        } else if (201 == response.statusCode) {
                            console.log("Session update failed with field errors.");
                            if (response.message) {
                                var field = response.message.indexOf('valid')
                                field = response.message.slice(field + 5, response.message.length);
                                console.log(field + " is invalid or missing.");
                            }
                        } else {
                            console.log("Session update failed: " + response);
                        }
                    }
                }
            }
        });
    } else {
        alert('Fail to get app/session/script !\n\nPlease check if your appId added in session script tag in head section?')
    }

    function pay() {
        // UPDATE THE SESSION WITH THE INPUT FROM HOSTED FIELDS
        $('.landpage').removeClass('d-none');
        PaymentSession.updateSessionFromForm();
    }
</script>


</body>

</html>
