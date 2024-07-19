<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Card Example</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD"
        crossorigin="anonymous">
    <style>
        .card {
            box-shadow: rgba(50, 50, 93, 0.25) 0px 30px 60px -12px, rgba(0, 0, 0, 0.3) 0px 18px 36px -18px;
            padding-bottom: 0px;
            border-radius: 14px;
        }
        .container{
            border-radius: 20px;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            padding: 20px;border: 1px solid #ddd;
        }
    </style>
    </head>

<body>
    <main class="container">
        <div class="row">

            <div class="col  ">
                <div class="row">
                    <h1>Demo of Card Payment</h1>
                </div>
            </div>
            <hr>

        </div>
        <div class="row">
            <div class="col col-lg-6 col-sm-12">
                <div class="row">
                    <h4>Payment Session ID</h4>
                    <div class="col">
                        <textarea name="" id="paymentSessionId" class="form-control"></textarea>
                        <span class="form-text text-muted">Don't have a paymentSessionId? Get a sample one <a href="https://test.cashfree.com/pgappsdemos/sample-psi.php" target="_blank">here</a> for sandbox mode</span>
                    </div>
                </div>
                <div class="row mt-4">
                    <h4>Return URL <span class="badge h6 bg-danger">Required</span></h4>
                    <div class="col">
                        <textarea name="" id="returnUrl" class="form-control">https://test.cashfree.com/pgappsdemos/v3success.php?myorder={order_id}</textarea>
                        <span class="form-text text-muted">Don't have a paymentSessionId? Get a sample one <a href="https://test.cashfree.com/pgappsdemos/sample-psi.php" target="_blank">here</a> for sandbox mode</span>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col ">
                        <p class="alert" id="paymentMessage">

                        </p>
                    </div>
                </div>
            </div>
            <div class="col col-lg-6 col-sm-10">

                <div class="card" style="width: 24rem;">
                    <div class="card-body pb-0">
                         
                        <div class="row">
                            <h4></h4>
                            <div class="col">
                                <div id="card-number" class="card-number form-control"></div>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col">
                                <div id="cardHolder" class="card-holder form-control"></div>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col">
                                <div id="cardExpiry" class="form-control"></div>
                            </div>
                            <div class="col">
                                <div class="col">
                                    <div id="cardCvv" class="form-control"></div>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col">
                                <button class="btn btn-primary btn-block w-100 pull-right" id="pay-card" type="button">
                                    Pay By Card
                                </button>
                            </div>
                        </div>
                        <br>
                    </div>
                </div>

            </div>
        </div>
    </main>
    <script src="https://sdk.cashfree.com/js/v3/cashfree.js"></script>
    <script>
        let paymentBtn = document.getElementById("pay-card");
        paymentBtn.disabled = true;
        let paymentMessage = document.getElementById("paymentMessage");

        let cashfree = Cashfree({mode: "sandbox"});
        let cardOptions = {
            values: {
                placeholder: "Enter Card Number"
            }
        };
        let cardComponent = cashfree.create("cardNumber", cardOptions);
        cardComponent.mount("#card-number");

        let cvvOptions = {};
        let cvvComponent = cashfree.create("cardCvv", cvvOptions);
        cvvComponent.mount("#cardCvv");

        let cardHolderOptions = {};
        let cardHolder = cashfree.create("cardHolder", cardHolderOptions);
        let cardHolderValid = false;
        cardHolder.mount("#cardHolder");

        let cardExpiryOptions = {};
        let cardExpiry = cashfree.create("cardExpiry", cardExpiryOptions);
        cardExpiry.mount("#cardExpiry");


        function toggleBtn() {

            if (cardExpiry.isComplete() && cardHolder.isComplete() && cardComponent.isComplete() && cvvComponent.isComplete()) {
                paymentBtn.disabled = false;
            } else {
                paymentBtn.disabled = true;
            }
        }

        cardExpiry.on('change', function (data) {

            toggleBtn();
        })
        cardHolder.on('change', function (data) {

            toggleBtn();
        })
        cardComponent.on('change', function (data) {

            toggleBtn();
        })
        cvvComponent.on('change', function (data) {

            toggleBtn();
        })



        paymentBtn.addEventListener('click', function () {
            paymentBtn.disabled = true;
            paymentBtn.innerText = "Please wait ...";
            paymentMessage.innerText = "";
            paymentMessage.classList.remove("alert-danger");
            paymentMessage.classList.remove("alert-success");
            cashfree.pay({
                paymentMethod: cardComponent,
                paymentSessionId: document.getElementById("paymentSessionId").value,
                returnUrl: document.getElementById("returnUrl").value,
            }).then(function (data) {
                if(data != null && data.error) {
                    paymentMessage.innerHTML = data.error.message;
                    paymentMessage.classList.add("alert-danger");
                    
                }
                paymentBtn.innerText = "Pay";
                paymentBtn.disabled = false;
                
            });
        })
    </script>
</body>

</html>