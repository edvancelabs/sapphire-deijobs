<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2023-04-01 00:35:15 --> order req: {
    "txnid": "txn_LE0000CC0012",
    "amount": 2.2,
    "customer_id": "123123",
    "customer_firstname": "nitesh",
    "customer_lastname": "nahar",
    "customer_email": "nj.248591@gmail.com",
    "customer_phone": "9867248591",
    "productinfo": "Test Txn",
    "signature": "fa82788a0555390092203440cff0044bc57d83c91a11f8112797d1b89c725b789a1410c8c08cafdc1edf43ef778774d69076fd83114a8b3aa7b38294f4466647"
}
ERROR - 2023-04-01 00:35:15 --> Severity: error --> Exception: syntax error, unexpected ':', expecting ')' /Applications/MAMP/htdocs/ezipay/application/libraries/Nimbbl.php 44
ERROR - 2023-04-01 00:35:35 --> order req: {
    "txnid": "txn_LE0000CC0012",
    "amount": 2.2,
    "customer_id": "123123",
    "customer_firstname": "nitesh",
    "customer_lastname": "nahar",
    "customer_email": "nj.248591@gmail.com",
    "customer_phone": "9867248591",
    "productinfo": "Test Txn",
    "signature": "fa82788a0555390092203440cff0044bc57d83c91a11f8112797d1b89c725b789a1410c8c08cafdc1edf43ef778774d69076fd83114a8b3aa7b38294f4466647"
}
ERROR - 2023-04-01 00:35:36 --> Nimbbl res create-order : {"message": "Order Created Successfully", "order": {"sub_merchant_id": 18855, "order_date": "2023-03-31 19:05:36.456064", "order_id": "o_lmL2gw9ew9exZmYw", "amount_before_tax": 2.2, "tax": 0, "total_amount": 2.2, "referrer_platform": null, "referrer_platform_version": null, "invoice_id": "1_txn_LE0000CC0012", "merchant_shopfront_domain": "server_to_server", "user_id": "user_NYP0EYpJyRdMn0GD", "attempts": 0, "device_user_agent": null, "status": "new", "order_from_ip": null, "partner_id": null, "currency": "INR", "description": null, "callback_url": "", "callback_mode": "callback_url_noredirect", "cancellation_reason": null, "orignal_user_id": 145153, "max_retries": 15, "browser_name": null, "device_name": null, "os_name": null, "fingerprint": null, "additional_charges": 0, "order_transac_type": null, "offer_discount": 0, "grand_total_amount": 2.2, "payment_link_id": null, "user": {"id": 145153, "email": "nj248591@gmail.com", "first_name": "Nitesh", "last_name": "", "country_code": "+91", "mobile_number": "9867248591", "user_id": "user_NYP0EYpJyRdMn0GD", "token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ1c2VyX2lkIjoxNDUxNTMsImV4cCI6MTY4MDI5MDczNiwidG9rZW5fdHlwZSI6InVzZXIifQ.HXUHybCZGB3BY6khjaPEwsdRE5OhPQZOn_sh7-lzEwU", "token_expiration": "2023-03-31T19:25:36.585083"}, "sub_merchant": {"sub_merchant_id": "381197", "sandbox": "Y", "description": "EziPik(Sandbox)"}}, "order_id": "o_lmL2gw9ew9exZmYw", "sub_merchant_id": 18855, "order_date": "2023-03-31 19:05:36.456064", "amount_before_tax": 2.2, "tax": 0, "total_amount": 2.2, "referrer_platform": null, "referrer_platform_version": null, "invoice_id": "1_txn_LE0000CC0012", "merchant_shopfront_domain": "server_to_server", "user_id": "user_NYP0EYpJyRdMn0GD", "attempts": 0, "device_user_agent": null, "status": "new", "order_from_ip": null, "partner_id": null, "currency": "INR", "description": null, "callback_url": "", "callback_mode": "callback_url_noredirect", "cancellation_reason": null, "orignal_user_id": 145153, "max_retries": 15, "browser_name": null, "device_name": null, "os_name": null, "fingerprint": null, "additional_charges": 0, "order_transac_type": null, "offer_discount": 0, "grand_total_amount": 2.2, "payment_link_id": null, "user": {"id": 145153, "email": "nj248591@gmail.com", "first_name": "Nitesh", "last_name": "", "country_code": "+91", "mobile_number": "9867248591", "user_id": "user_NYP0EYpJyRdMn0GD", "token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ1c2VyX2lkIjoxNDUxNTMsImV4cCI6MTY4MDI5MDczNiwidG9rZW5fdHlwZSI6InVzZXIifQ.HXUHybCZGB3BY6khjaPEwsdRE5OhPQZOn_sh7-lzEwU", "token_expiration": "2023-03-31T19:25:36.585083"}, "sub_merchant": {"sub_merchant_id": "381197", "sandbox": "Y", "description": "EziPik(Sandbox)"}}
ERROR - 2023-04-01 00:35:36 --> Order res: {"code":200,"txnid":"txn_LE0000CC0012","status":"success","message":"Success","signature":"0f49a474fb99fd3d283b1ae5f825171dca844831f02911ebd6d16ac13f3fc547b76758aab352d2ffb4382d5c2b66f4ca3d245644a9fdd7aefa6a5ecbec842c68"}
ERROR - 2023-04-01 00:36:25 --> payment req: {
    "txnid": "txn_LE0000CC0012",
    "user_ip": "1.1.1.1",
    "user_agent": "123123",
    "signature": "90a468c2da571807cdc5e858d6c41f3837e8619406a8ed9ce7d8d2507838d7cbf92349bbfa5106f8da10ed8ee3ff6486974db7273b875bb93769a0404fd15386"
}
ERROR - 2023-04-01 00:36:28 --> Nimbbl res payment : {"status_code": 200, "status": "success", "order_id": "o_lmL2gw9ew9exZmYw", "transaction_id": "o_lmL2gw9ew9exZmYw-230331190626", "message": "Payment Initiated", "completion_time": 1, "extra_info": {"attempts": 1, "data": {"redirectUrl": "upi://pay?pa=upi@razopay&pn=BIGITALTECHNOLOGIESPRIVATELIMITED&tr=WzBQKZQI9QRhJUZ&tn=razorpay&am=2.2&cu=INR&mc=5411"}}, "info": {"url": "/api/v2/transaction-enquiry", "request_args": {"transaction_id": "o_lmL2gw9ew9exZmYw-230331190626", "order_id": "o_lmL2gw9ew9exZmYw", "payment_mode": "UPI"}}}
ERROR - 2023-04-01 00:36:28 --> Order res: {"code":200,"txnid":"txn_LE0000CC0012","uri":"upi:\/\/pay?pa=upi@razopay&pn=BIGITALTECHNOLOGIESPRIVATELIMITED&tr=WzBQKZQI9QRhJUZ&tn=razorpay&am=2.2&cu=INR&mc=5411","message":"Success","signature":"8a46fd45c5792babf6060a6c1fb2196b341d840647ddf26f3cf4ab943a34d442fa24733ccc28d0c814ded6bc579c04724a3b9e921f4165327bc912aa30eb6401"}
ERROR - 2023-04-01 00:37:05 --> txnStatus req: {
    "txnid": "txn_LE0000CC0012",
    "signature": "b73879bee9f7140ac185a12dd95fc4b95156637b4f75d6bebc69d70490baa5153d9ebdf8f19172a08841fab4c17e3f21b274fe4928cfb82a414537d1c44f8787"
}
ERROR - 2023-04-01 00:37:07 --> Nimbbl res transaction-enquiry : {"status": "success", "orignal_status": "captured", "message": "Payment Successful", "nimbbl_order_id": "o_lmL2gw9ew9exZmYw", "nimbbl_transaction_id": "o_lmL2gw9ew9exZmYw-230331190626", "nimbbl_signature": "4da793c7aa4b0d21a0135d3121636d6331c4668f4cbca01d7e389da232fa6946", "completion_time": 40, "raw": {"id": "pay_LYEzg5BshXwb5J", "entity": "payment", "amount": 220, "currency": "INR", "status": "captured", "order_id": "order_LYEzfcw49dqbIw", "invoice_id": null, "international": false, "method": "upi", "amount_refunded": 0, "refund_status": null, "captured": true, "description": null, "card_id": null, "card": null, "bank": null, "wallet": null, "vpa": "success@razorpay", "email": "nj248591@gmail.com", "contact": "+919867248591", "notes": [], "fee": 5, "tax": 0, "error_code": null, "error_description": null, "error_source": null, "error_step": null, "error_reason": null, "acquirer_data": {"rrn": "227380716860", "upi_transaction_id": "BDD85EC98B404E0638D4F3D793B6E8C1"}, "created_at": 1680289587}}
ERROR - 2023-04-01 00:37:07 --> TxnStatus res: {"code":200,"txnid":"txn_LE0000CC0012","payment_status":"success","payment_message":"Payment Successful","message":"Success","signature":"880981427051f992075abc33e1dfac537aac7dfe26c0c33845838a9044c01afd6c5cf4435df9daef64d05a30c8e73c6a250cad495bc272a6b7570c933d4f5f2c"}
ERROR - 2023-04-01 00:47:31 --> refund req: {
    "txnid": "txn_LE0000CC0012",
    "refund_amount": 1,
    "refund_txnid": "rfndLocal10011",
    "signature": "dc3f81bc4c42e094709321f4647196a6fcfeafb22c8b8a5a813661488f4b39a83a63901105384d1fdab9e0ec16e5c1b1617709a7f12a008e11017981610a15e5"
}
ERROR - 2023-04-01 00:47:33 --> Nimbbl res refund : {"id": "rfnd_LYFBOKXnxaPTmW", "entity": "refund", "amount": 100, "currency": "INR", "payment_id": "pay_LYEzg5BshXwb5J", "notes": [], "receipt": null, "acquirer_data": {"rrn": null}, "created_at": 1680290252, "batch_id": "", "status": "processed", "speed_processed": "normal", "speed_requested": "normal"}
ERROR - 2023-04-01 00:47:33 --> Severity: Warning --> Attempt to assign property 'txn_order_id' of non-object /Applications/MAMP/htdocs/ezipay/application/libraries/Nimbbl.php 195
ERROR - 2023-04-01 00:47:33 --> Severity: Notice --> Undefined property: stdClass::$extra_info /Applications/MAMP/htdocs/ezipay/application/libraries/Nimbbl.php 196
ERROR - 2023-04-01 00:47:33 --> Severity: Notice --> Trying to get property 'data' of non-object /Applications/MAMP/htdocs/ezipay/application/libraries/Nimbbl.php 196
ERROR - 2023-04-01 00:47:33 --> Severity: Notice --> Trying to get property 'status' of non-object /Applications/MAMP/htdocs/ezipay/application/libraries/Nimbbl.php 196
ERROR - 2023-04-01 00:47:33 --> Severity: Notice --> Undefined index:  /Applications/MAMP/htdocs/ezipay/application/libraries/Nimbbl.php 176
ERROR - 2023-04-01 00:47:33 --> Severity: Notice --> Undefined property: stdClass::$extra_info /Applications/MAMP/htdocs/ezipay/application/libraries/Nimbbl.php 196
ERROR - 2023-04-01 00:47:33 --> Severity: Notice --> Trying to get property 'data' of non-object /Applications/MAMP/htdocs/ezipay/application/libraries/Nimbbl.php 196
ERROR - 2023-04-01 00:47:33 --> Severity: Notice --> Trying to get property 'respMessage' of non-object /Applications/MAMP/htdocs/ezipay/application/libraries/Nimbbl.php 196
ERROR - 2023-04-01 00:47:33 --> Severity: Notice --> Undefined property: stdClass::$extra_info /Applications/MAMP/htdocs/ezipay/application/libraries/Nimbbl.php 196
ERROR - 2023-04-01 00:47:33 --> Severity: Notice --> Trying to get property 'data' of non-object /Applications/MAMP/htdocs/ezipay/application/libraries/Nimbbl.php 196
ERROR - 2023-04-01 00:47:33 --> Severity: Notice --> Trying to get property 'lpTxnId' of non-object /Applications/MAMP/htdocs/ezipay/application/libraries/Nimbbl.php 196
ERROR - 2023-04-01 00:47:33 --> Refund res: {"code":200,"refund_txnid":"rfndLocal10011","refund_status":null,"refund_description":null,"refund_arn":null,"message":"Success","signature":"b042c658fd0499fe20936daa549c1755923d38a7698c69a9e7335fc08d133ed0c12f2907cdbdb4e9e2fe97169707325f3dd4bd3082f8c187fa5bf90286d01c7c"}
ERROR - 2023-04-01 00:47:33 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at /Applications/MAMP/htdocs/ezipay/system/core/Exceptions.php:271) /Applications/MAMP/htdocs/ezipay/system/core/Common.php 570
ERROR - 2023-04-01 00:49:59 --> refund req: {
    "txnid": "txn_LE0000CC0012",
    "refund_amount": 1,
    "refund_txnid": "rfndLocal10011",
    "signature": "dc3f81bc4c42e094709321f4647196a6fcfeafb22c8b8a5a813661488f4b39a83a63901105384d1fdab9e0ec16e5c1b1617709a7f12a008e11017981610a15e5"
}
ERROR - 2023-04-01 00:49:59 --> Refund res: {"code":110,"message":"Refund Txn already present","signature":"6f4abc39acee5461385a3a5a103a6a2753acb1524cf31e0e0ade8705deb23548ef24b1e816f0f8a83406ac5bd86a0472b5e52c895c687ba28cbab478d1446c6c"}
ERROR - 2023-04-01 00:51:44 --> Severity: Notice --> Undefined property: stdClass::$refunds /Applications/MAMP/htdocs/ezipay/application/libraries/Nimbbl.php 224
ERROR - 2023-04-01 00:51:44 --> Severity: Notice --> Trying to get property 'nimbbl_consumer_message' of non-object /Applications/MAMP/htdocs/ezipay/application/libraries/Nimbbl.php 224
ERROR - 2023-04-01 00:51:44 --> Severity: Notice --> Undefined property: stdClass::$refunds /Applications/MAMP/htdocs/ezipay/application/libraries/Nimbbl.php 224
ERROR - 2023-04-01 00:51:44 --> Severity: Notice --> Trying to get property 'refund_arn' of non-object /Applications/MAMP/htdocs/ezipay/application/libraries/Nimbbl.php 224
ERROR - 2023-04-01 00:53:22 --> Severity: Notice --> Undefined property: stdClass::$txn_order_id /Applications/MAMP/htdocs/ezipay/application/libraries/Nimbbl.php 210
ERROR - 2023-04-01 00:53:23 --> Nimbbl res order/fetch-refunds/ : {"error": {"code": 400, "message": "Unable to resolve order using specified order_id"}}
ERROR - 2023-04-01 00:53:23 --> Severity: Notice --> Undefined property: stdClass::$message /Applications/MAMP/htdocs/ezipay/application/libraries/Nimbbl.php 217
ERROR - 2023-04-01 00:54:27 --> refund req: {
    "txnid": "txn_LE0000CC0012",
    "refund_amount": 1,
    "refund_txnid": "rfndLocal10011",
    "signature": "dc3f81bc4c42e094709321f4647196a6fcfeafb22c8b8a5a813661488f4b39a83a63901105384d1fdab9e0ec16e5c1b1617709a7f12a008e11017981610a15e5"
}
ERROR - 2023-04-01 00:54:27 --> Refund res: {"code":110,"message":"Refund Txn already present","signature":"6f4abc39acee5461385a3a5a103a6a2753acb1524cf31e0e0ade8705deb23548ef24b1e816f0f8a83406ac5bd86a0472b5e52c895c687ba28cbab478d1446c6c"}
ERROR - 2023-04-01 00:54:42 --> refund req: {
    "txnid": "txn_LE0000CC0012",
    "refund_amount": 1,
    "refund_txnid": "rfndLocal10011",
    "signature": "dc3f81bc4c42e094709321f4647196a6fcfeafb22c8b8a5a813661488f4b39a83a63901105384d1fdab9e0ec16e5c1b1617709a7f12a008e11017981610a15e5"
}
ERROR - 2023-04-01 00:54:43 --> Nimbbl res refund : {"id": "rfnd_LYFIyuCVU6c9wt", "entity": "refund", "amount": 100, "currency": "INR", "payment_id": "pay_LYEzg5BshXwb5J", "notes": [], "receipt": null, "acquirer_data": {"rrn": null}, "created_at": 1680290683, "batch_id": "", "status": "processed", "speed_processed": "normal", "speed_requested": "normal"}
ERROR - 2023-04-01 00:54:43 --> Severity: Notice --> Undefined property: stdClass::$extra_info /Applications/MAMP/htdocs/ezipay/application/libraries/Nimbbl.php 196
ERROR - 2023-04-01 00:54:43 --> Severity: Notice --> Trying to get property 'data' of non-object /Applications/MAMP/htdocs/ezipay/application/libraries/Nimbbl.php 196
ERROR - 2023-04-01 00:54:43 --> Severity: Notice --> Trying to get property 'status' of non-object /Applications/MAMP/htdocs/ezipay/application/libraries/Nimbbl.php 196
ERROR - 2023-04-01 00:54:43 --> Severity: Notice --> Undefined index:  /Applications/MAMP/htdocs/ezipay/application/libraries/Nimbbl.php 176
ERROR - 2023-04-01 00:54:43 --> Severity: Notice --> Undefined property: stdClass::$extra_info /Applications/MAMP/htdocs/ezipay/application/libraries/Nimbbl.php 196
ERROR - 2023-04-01 00:54:43 --> Severity: Notice --> Trying to get property 'data' of non-object /Applications/MAMP/htdocs/ezipay/application/libraries/Nimbbl.php 196
ERROR - 2023-04-01 00:54:43 --> Severity: Notice --> Trying to get property 'respMessage' of non-object /Applications/MAMP/htdocs/ezipay/application/libraries/Nimbbl.php 196
ERROR - 2023-04-01 00:54:43 --> Severity: Notice --> Undefined property: stdClass::$extra_info /Applications/MAMP/htdocs/ezipay/application/libraries/Nimbbl.php 196
ERROR - 2023-04-01 00:54:43 --> Severity: Notice --> Trying to get property 'data' of non-object /Applications/MAMP/htdocs/ezipay/application/libraries/Nimbbl.php 196
ERROR - 2023-04-01 00:54:43 --> Severity: Notice --> Trying to get property 'lpTxnId' of non-object /Applications/MAMP/htdocs/ezipay/application/libraries/Nimbbl.php 196
ERROR - 2023-04-01 00:54:43 --> Refund res: {"code":200,"refund_txnid":"rfndLocal10011","refund_status":null,"refund_description":null,"refund_arn":null,"message":"Success","signature":"b042c658fd0499fe20936daa549c1755923d38a7698c69a9e7335fc08d133ed0c12f2907cdbdb4e9e2fe97169707325f3dd4bd3082f8c187fa5bf90286d01c7c"}
ERROR - 2023-04-01 00:54:43 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at /Applications/MAMP/htdocs/ezipay/system/core/Exceptions.php:271) /Applications/MAMP/htdocs/ezipay/system/core/Common.php 570
ERROR - 2023-04-01 17:35:46 --> 404 Page Not Found: Assets/admin
ERROR - 2023-04-01 17:35:56 --> 404 Page Not Found: Assets/admin
ERROR - 2023-04-01 17:36:10 --> 404 Page Not Found: Assets/admin
ERROR - 2023-04-01 17:36:32 --> order req: {
    "txnid": "txn_LE0000CC0013",
    "amount": 12.2,
    "customer_id": "123123",
    "customer_firstname": "nitesh",
    "customer_lastname": "nahar",
    "customer_email": "nj.248591@gmail.com",
    "customer_phone": "9867248591",
    "productinfo": "Test Txn",
    "signature": "25d6d3e0d047d22d92a7b8637a4f276ac1c4ee9412298edbbc78f84d34e59aa399b8f8ee3ebe5a8378a4e27130a25f7807f5d2c2ea2cfaa32a2208b85e84a2b1"
}
ERROR - 2023-04-01 17:36:32 --> Nimbbl res create-order : {"message": "Order Created Successfully", "order": {"sub_merchant_id": 18855, "order_date": "2023-04-01 12:06:32.740449", "order_id": "o_lqgKXA9dLdjGAdk9", "amount_before_tax": 12.2, "tax": 0, "total_amount": 12.2, "referrer_platform": null, "referrer_platform_version": null, "invoice_id": "1_txn_LE0000CC0013", "merchant_shopfront_domain": "server_to_server", "user_id": "user_NYP0EYpJyRdMn0GD", "attempts": 0, "device_user_agent": null, "status": "new", "order_from_ip": null, "partner_id": null, "currency": "INR", "description": null, "callback_url": "", "callback_mode": "callback_url_noredirect", "cancellation_reason": null, "orignal_user_id": 145153, "max_retries": 15, "browser_name": null, "device_name": null, "os_name": null, "fingerprint": null, "additional_charges": 0, "order_transac_type": null, "offer_discount": 0, "grand_total_amount": 12.2, "payment_link_id": null, "user": {"id": 145153, "email": "nj248591@gmail.com", "first_name": "Nitesh", "last_name": "", "country_code": "+91", "mobile_number": "9867248591", "user_id": "user_NYP0EYpJyRdMn0GD", "token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ1c2VyX2lkIjoxNDUxNTMsImV4cCI6MTY4MDM1MTk5MiwidG9rZW5fdHlwZSI6InVzZXIifQ.i5zJBK5OcH4VUEVHrzL2q9dyOU940qKkHhYmqUHo53E", "token_expiration": "2023-04-01T12:26:32.855996"}, "sub_merchant": {"sub_merchant_id": "381197", "sandbox": "Y", "description": "EziPik(Sandbox)"}}, "order_id": "o_lqgKXA9dLdjGAdk9", "sub_merchant_id": 18855, "order_date": "2023-04-01 12:06:32.740449", "amount_before_tax": 12.2, "tax": 0, "total_amount": 12.2, "referrer_platform": null, "referrer_platform_version": null, "invoice_id": "1_txn_LE0000CC0013", "merchant_shopfront_domain": "server_to_server", "user_id": "user_NYP0EYpJyRdMn0GD", "attempts": 0, "device_user_agent": null, "status": "new", "order_from_ip": null, "partner_id": null, "currency": "INR", "description": null, "callback_url": "", "callback_mode": "callback_url_noredirect", "cancellation_reason": null, "orignal_user_id": 145153, "max_retries": 15, "browser_name": null, "device_name": null, "os_name": null, "fingerprint": null, "additional_charges": 0, "order_transac_type": null, "offer_discount": 0, "grand_total_amount": 12.2, "payment_link_id": null, "user": {"id": 145153, "email": "nj248591@gmail.com", "first_name": "Nitesh", "last_name": "", "country_code": "+91", "mobile_number": "9867248591", "user_id": "user_NYP0EYpJyRdMn0GD", "token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ1c2VyX2lkIjoxNDUxNTMsImV4cCI6MTY4MDM1MTk5MiwidG9rZW5fdHlwZSI6InVzZXIifQ.i5zJBK5OcH4VUEVHrzL2q9dyOU940qKkHhYmqUHo53E", "token_expiration": "2023-04-01T12:26:32.855996"}, "sub_merchant": {"sub_merchant_id": "381197", "sandbox": "Y", "description": "EziPik(Sandbox)"}}
ERROR - 2023-04-01 17:36:32 --> Order res: {"code":200,"txnid":"txn_LE0000CC0013","status":"success","message":"Success","signature":"07a7d3170e9a0a4531dbcfd59828e6354039fbb48dba884e057dd6bb728a654abd0c188ea3e27ede798e54c8c16380e87dc5d2df78a0e37fa70e7fa74546249e"}
ERROR - 2023-04-01 17:36:51 --> payment req: {
    "txnid": "txn_LE0000CC0013",
    "user_ip": "1.1.1.1",
    "user_agent": "123123",
    "signature": "5e74869d24f5b550ee32728d98b75cdd55cc62bca8e32bd232bbff0373cf8d38a5221d914e306231753dfd059f54c7920ddb81ca8c696977d1265ca5b4268494"
}
ERROR - 2023-04-01 17:36:54 --> Nimbbl res payment : {"status_code": 200, "status": "success", "order_id": "o_lqgKXA9dLdjGAdk9", "transaction_id": "o_lqgKXA9dLdjGAdk9-230401120652", "message": "Payment Initiated", "completion_time": 1, "extra_info": {"attempts": 1, "data": {"redirectUrl": "upi://pay?pa=upi@razopay&pn=BIGITALTECHNOLOGIESPRIVATELIMITED&tr=Q6dEHBeZVkN4pcO&tn=razorpay&am=12.2&cu=INR&mc=5411"}}, "info": {"url": "/api/v2/transaction-enquiry", "request_args": {"transaction_id": "o_lqgKXA9dLdjGAdk9-230401120652", "order_id": "o_lqgKXA9dLdjGAdk9", "payment_mode": "UPI"}}}
ERROR - 2023-04-01 17:36:54 --> Order res: {"code":200,"txnid":"txn_LE0000CC0013","uri":"upi:\/\/pay?pa=upi@razopay&pn=BIGITALTECHNOLOGIESPRIVATELIMITED&tr=Q6dEHBeZVkN4pcO&tn=razorpay&am=12.2&cu=INR&mc=5411","message":"Success","signature":"db1113767e8bbe605552dd3db28c11d873bd33e6bb70d447f7e89948ffcea256f481997d43506db8315d64a8cf61c7336a378b428f46c254fad0884dc370ba89"}
ERROR - 2023-04-01 18:52:56 --> order req: {
    "txnid": "txn_LE0000CC0014",
    "amount": 12.2,
    "customer_id": "123123",
    "customer_firstname": "nitesh",
    "customer_lastname": "nahar",
    "customer_email": "nj.248591@gmail.com",
    "customer_phone": "9867248591",
    "productinfo": "Test Txn",
    "signature": "726973e9200a3d147639b0c74f633264906cc9a3c016b68785e5cf009836ae7d83cc49f996a9626da2fa9da3ac98d88b49487ece6912f3652344dead4b4ddec8"
}
ERROR - 2023-04-01 18:52:57 --> EaseBuzz res payment/initiateLink : {"status": 1, "data": "7c8e96ef6e86d96e6d17e90fa4e2513d0f29816defdca06ac1815851a7a65190"}
ERROR - 2023-04-01 18:52:57 --> Order res: {"code":200,"txnid":"txn_LE0000CC0014","status":"success","message":"Success","signature":"8996fc9dfc5b1f81cff80cbc675ec20f8e719157ba9327b0953f6a247ab710a796a8ec58a3af33fded7ca87249684c2611a2a9909b7795213f461385f591febf"}
ERROR - 2023-04-01 18:53:53 --> payment req: {
    "txnid": "txn_LE0000CC0014",
    "user_ip": "1.1.1.1",
    "user_agent": "123123",
    "signature": "71bc5bccf63f8bb1591617216ed468d7d86a03ec67e727cba591720777caf7f95efe1ba3cfd6f91757e0cceac1a274fd5eb1f7c007066471530fbe5f8d223cd6"
}
ERROR - 2023-04-01 18:53:55 --> EaseBuzz res initiate_seamless_payment/ : 
ERROR - 2023-04-01 18:53:55 --> Order res: {"code":801,"error":"something went wrong. try again","message":"Invalid requests params","signature":"70acb18f22a03b6f5dd2d58bfbeb5e0c0b42327a63f8ffcb414508cf61f48553a5a494a2cf7af7e192de207bf8438391e0a961b35cd2e2e485d507a52747d7f9"}
ERROR - 2023-04-01 18:55:42 --> payment req: {
    "txnid": "txn_LE0000CC0014",
    "user_ip": "1.1.1.1",
    "user_agent": "123123",
    "signature": "71bc5bccf63f8bb1591617216ed468d7d86a03ec67e727cba591720777caf7f95efe1ba3cfd6f91757e0cceac1a274fd5eb1f7c007066471530fbe5f8d223cd6"
}
ERROR - 2023-04-01 18:55:42 --> EaseBuzz res initiate_seamless_payment/ : 
ERROR - 2023-04-01 18:55:42 --> Order res: {"code":801,"error":"something went wrong. try again","message":"Invalid requests params","signature":"70acb18f22a03b6f5dd2d58bfbeb5e0c0b42327a63f8ffcb414508cf61f48553a5a494a2cf7af7e192de207bf8438391e0a961b35cd2e2e485d507a52747d7f9"}




















ERROR - 2023-04-01 18:56:22 --> payment req: {
    "txnid": "txn_LE0000CC0014",
    "user_ip": "1.1.1.1",
    "user_agent": "123123",
    "signature": "71bc5bccf63f8bb1591617216ed468d7d86a03ec67e727cba591720777caf7f95efe1ba3cfd6f91757e0cceac1a274fd5eb1f7c007066471530fbe5f8d223cd6"
}
ERROR - 2023-04-01 18:56:23 --> EaseBuzz res initiate_seamless_payment/ : 
ERROR - 2023-04-01 18:56:23 --> Order res: {"code":801,"error":"something went wrong. try again","message":"Invalid requests params","signature":"70acb18f22a03b6f5dd2d58bfbeb5e0c0b42327a63f8ffcb414508cf61f48553a5a494a2cf7af7e192de207bf8438391e0a961b35cd2e2e485d507a52747d7f9"}
ERROR - 2023-04-01 18:57:11 --> payment req: {
    "txnid": "txn_LE0000CC0014",
    "user_ip": "1.1.1.1",
    "user_agent": "123123",
    "signature": "71bc5bccf63f8bb1591617216ed468d7d86a03ec67e727cba591720777caf7f95efe1ba3cfd6f91757e0cceac1a274fd5eb1f7c007066471530fbe5f8d223cd6"
}
ERROR - 2023-04-01 18:57:11 --> EaseBuzz Req initiate_seamless_payment/ : {"access_key":"7c8e96ef6e86d96e6d17e90fa4e2513d0f29816defdca06ac1815851a7a65190","amount":"12.20","payment_mode":"UPI","upi_qr":true,"request_mode":"SUVA"}
ERROR - 2023-04-01 18:57:12 --> EaseBuzz res initiate_seamless_payment/ : 
ERROR - 2023-04-01 18:57:12 --> Order res: {"code":801,"error":"something went wrong. try again","message":"Invalid requests params","signature":"70acb18f22a03b6f5dd2d58bfbeb5e0c0b42327a63f8ffcb414508cf61f48553a5a494a2cf7af7e192de207bf8438391e0a961b35cd2e2e485d507a52747d7f9"}































ERROR - 2023-04-01 18:57:56 --> payment req: {
    "txnid": "txn_LE0000CC0014",
    "user_ip": "1.1.1.1",
    "user_agent": "123123",
    "signature": "71bc5bccf63f8bb1591617216ed468d7d86a03ec67e727cba591720777caf7f95efe1ba3cfd6f91757e0cceac1a274fd5eb1f7c007066471530fbe5f8d223cd6"
}
ERROR - 2023-04-01 18:57:56 --> EaseBuzz Req initiate_seamless_payment/ : {"access_key":"7c8e96ef6e86d96e6d17e90fa4e2513d0f29816defdca06ac1815851a7a65190","amount":"12.20","payment_mode":"UPI","upi_qr":true,"request_mode":"SUVA"}
ERROR - 2023-04-01 18:57:56 --> EaseBuzz res initiate_seamless_payment/ : 
ERROR - 2023-04-01 18:57:56 --> Order res: {"code":801,"error":"something went wrong. try again","message":"Invalid requests params","signature":"70acb18f22a03b6f5dd2d58bfbeb5e0c0b42327a63f8ffcb414508cf61f48553a5a494a2cf7af7e192de207bf8438391e0a961b35cd2e2e485d507a52747d7f9"}
ERROR - 2023-04-01 19:20:31 --> payment req: {
    "txnid": "txn_LE0000CC0014",
    "user_ip": "1.1.1.1",
    "user_agent": "123123",
    "signature": "71bc5bccf63f8bb1591617216ed468d7d86a03ec67e727cba591720777caf7f95efe1ba3cfd6f91757e0cceac1a274fd5eb1f7c007066471530fbe5f8d223cd6"
}
ERROR - 2023-04-01 19:20:31 --> EaseBuzz Req initiate_seamless_payment/ : {"access_key":"7c8e96ef6e86d96e6d17e90fa4e2513d0f29816defdca06ac1815851a7a65190","payment_mode":"UPI","upi_qr":true}
ERROR - 2023-04-01 19:20:32 --> EaseBuzz res initiate_seamless_payment/ : 
ERROR - 2023-04-01 19:20:32 --> Order res: {"code":801,"error":"something went wrong. try again","message":"Invalid requests params","signature":"70acb18f22a03b6f5dd2d58bfbeb5e0c0b42327a63f8ffcb414508cf61f48553a5a494a2cf7af7e192de207bf8438391e0a961b35cd2e2e485d507a52747d7f9"}
ERROR - 2023-04-01 19:21:23 --> payment req: {
    "txnid": "txn_LE0000CC0014",
    "user_ip": "1.1.1.1",
    "user_agent": "123123",
    "signature": "71bc5bccf63f8bb1591617216ed468d7d86a03ec67e727cba591720777caf7f95efe1ba3cfd6f91757e0cceac1a274fd5eb1f7c007066471530fbe5f8d223cd6"
}
ERROR - 2023-04-01 19:21:23 --> EaseBuzz Req initiate_seamless_payment/ : {"access_key":"7c8e96ef6e86d96e6d17e90fa4e2513d0f29816defdca06ac1815851a7a65190","payment_mode":"UPI","upi_qr":true}
ERROR - 2023-04-01 19:21:23 --> EaseBuzz res initiate_seamless_payment/ : 
ERROR - 2023-04-01 19:21:23 --> Order res: {"code":801,"error":"something went wrong. try again","message":"Invalid requests params","signature":"70acb18f22a03b6f5dd2d58bfbeb5e0c0b42327a63f8ffcb414508cf61f48553a5a494a2cf7af7e192de207bf8438391e0a961b35cd2e2e485d507a52747d7f9"}










ERROR - 2023-04-01 19:21:46 --> payment req: {
    "txnid": "txn_LE0000CC0014",
    "user_ip": "1.1.1.1",
    "user_agent": "123123",
    "signature": "71bc5bccf63f8bb1591617216ed468d7d86a03ec67e727cba591720777caf7f95efe1ba3cfd6f91757e0cceac1a274fd5eb1f7c007066471530fbe5f8d223cd6"
}
ERROR - 2023-04-01 19:21:46 --> EaseBuzz Req initiate_seamless_payment/ : {"access_key":"7c8e96ef6e86d96e6d17e90fa4e2513d0f29816defdca06ac1815851a7a65190","payment_mode":"UPI","upi_qr":true}
ERROR - 2023-04-01 19:21:46 --> EaseBuzz res initiate_seamless_payment/ : 
ERROR - 2023-04-01 19:21:46 --> Order res: {"code":801,"error":"something went wrong. try again","message":"Invalid requests params","signature":"70acb18f22a03b6f5dd2d58bfbeb5e0c0b42327a63f8ffcb414508cf61f48553a5a494a2cf7af7e192de207bf8438391e0a961b35cd2e2e485d507a52747d7f9"}
ERROR - 2023-04-01 19:22:04 --> payment req: {
    "txnid": "txn_LE0000CC0014",
    "user_ip": "1.1.1.1",
    "user_agent": "123123",
    "signature": "71bc5bccf63f8bb1591617216ed468d7d86a03ec67e727cba591720777caf7f95efe1ba3cfd6f91757e0cceac1a274fd5eb1f7c007066471530fbe5f8d223cd6"
}
ERROR - 2023-04-01 19:22:04 --> EaseBuzz Req initiate_seamless_payment/ : {"access_key":"7c8e96ef6e86d96e6d17e90fa4e2513d0f29816defdca06ac1815851a7a65190","payment_mode":"UPI","upi_qr":true}
ERROR - 2023-04-01 19:22:06 --> EaseBuzz res initiate_seamless_payment/ : 
ERROR - 2023-04-01 19:22:06 --> Order res: {"code":801,"error":"something went wrong. try again","message":"Invalid requests params","signature":"70acb18f22a03b6f5dd2d58bfbeb5e0c0b42327a63f8ffcb414508cf61f48553a5a494a2cf7af7e192de207bf8438391e0a961b35cd2e2e485d507a52747d7f9"}








ERROR - 2023-04-01 19:34:22 --> order req: {
    "txnid": "txn_LE0000CC0015",
    "amount": 12.2,
    "customer_id": "123123",
    "customer_firstname": "nitesh",
    "customer_lastname": "nahar",
    "customer_email": "nj.248591@gmail.com",
    "customer_phone": "9867248591",
    "productinfo": "Test Txn",
    "signature": "fd11692cb34314f65677009ddc328310c37fc2f1124d3e064a0a2ab380d5cda20c1955192926c18c203328a8e95bccc0f47464a64e727701b416514f39078797"
}
ERROR - 2023-04-01 19:34:22 --> EaseBuzz res payment/initiateLink : 
ERROR - 2023-04-01 19:34:22 --> Order res: {"code":801,"error":"something went wrong. try again","message":"Invalid requests params","signature":"70acb18f22a03b6f5dd2d58bfbeb5e0c0b42327a63f8ffcb414508cf61f48553a5a494a2cf7af7e192de207bf8438391e0a961b35cd2e2e485d507a52747d7f9"}
ERROR - 2023-04-01 19:34:52 --> order req: {
    "txnid": "txn_LE0000CC0015",
    "amount": 12.2,
    "customer_id": "123123",
    "customer_firstname": "nitesh",
    "customer_lastname": "nahar",
    "customer_email": "nj.248591@gmail.com",
    "customer_phone": "9867248591",
    "productinfo": "Test Txn",
    "signature": "fd11692cb34314f65677009ddc328310c37fc2f1124d3e064a0a2ab380d5cda20c1955192926c18c203328a8e95bccc0f47464a64e727701b416514f39078797"
}
ERROR - 2023-04-01 19:34:55 --> EaseBuzz res payment/initiateLink : {"status": 1, "data": "0a0e2ff95346a877f6c5f04ca6d7e1bd7b0fb0c0222561cd05e6130b61d05d42"}
ERROR - 2023-04-01 19:34:55 --> Order res: {"code":200,"txnid":"txn_LE0000CC0015","status":"success","message":"Success","signature":"7d6997b6d557a6a00bb0ecc61995aaa46a262fe740a7ad62500eaeb2a5339954543e77d4872b1e861c613a928e39e1219f5da997e780defbfb4c4b231562a8fc"}
ERROR - 2023-04-01 20:13:37 --> order req: {
    "txnid": "txn_LE0000CC0016",
    "amount": 1.2,
    "customer_id": "123123",
    "customer_firstname": "nitesh",
    "customer_lastname": "nahar",
    "customer_email": "nj.248591@gmail.com",
    "customer_phone": "9867248591",
    "productinfo": "Test Txn",
    "signature": "24de1892f35730fcdf4fab777497cfa1addb41de248dc28892c49bfef85be6f171cde8461da6fe2087360aaf34c8020c4a3b0a7873177939c047483c67e42821"
}
ERROR - 2023-04-01 20:13:39 --> EaseBuzz res payment/initiateLink : {"status": 1, "data": "9df6488f8b445812e75e06deb9157806fee90c6292579539a1e302abf6ba1db2"}
ERROR - 2023-04-01 20:13:39 --> Order res: {"code":200,"txnid":"txn_LE0000CC0016","status":"success","message":"Success","signature":"72b5474d852172c6ccbea15e6c40d63ae8016f649f1c22a0aadba82a80483807b9255e5458d6458272ff79c3bb6b771113547b5c83549cf52c7c587e0a00fe7a"}
ERROR - 2023-04-01 20:14:03 --> payment req: {
    "txnid": "txn_LE0000CC0016",
    "user_ip": "1.1.1.1",
    "user_agent": "123123",
    "signature": "78b05fdc7678fe362ef84430911dac1306a6fee8a7fc6b3fb02e35c404825a36aca0fcba12b35ca32c1efe56b8ad95ad00fb1ad6a032f77f533190e07b3d648c"
}
ERROR - 2023-04-01 20:14:04 --> EaseBuzz res initiate_seamless_payment/ : 
<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="content-type" content="text/html; charset=utf-8">
  <meta name="robots" content="NONE,NOARCHIVE">
  <title>403 Forbidden</title>
  <style type="text/css">
    html * { padding:0; margin:0; }
    body * { padding:10px 20px; }
    body * * { padding:0; }
    body { font:small sans-serif; background:#eee; }
    body>div { border-bottom:1px solid #ddd; }
    h1 { font-weight:normal; margin-bottom:.4em; }
    h1 span { font-size:60%; color:#666; font-weight:normal; }
    #info { background:#f6f6f6; }
    #info ul { margin: 0.5em 4em; }
    #info p, #summary p { padding-top:10px; }
    #summary { background: #ffc; }
    #explanation { background:#eee; border-bottom: 0px none; }
  </style>
</head>
<body>
<div id="summary">
  <h1>Forbidden <span>(403)</span></h1>
  <p>CSRF verification failed. Request aborted.</p>

  <p>You are seeing this message because this HTTPS site requires a &#39;Referer header&#39; to be sent by your Web browser, but none was sent. This header is required for security reasons, to ensure that your browser is not being hijacked by third parties.</p>
  <p>If you have configured your browser to disable &#39;Referer&#39; headers, please re-enable them, at least for this site, or for HTTPS connections, or for &#39;same-origin&#39; requests.</p>


</div>

<div id="explanation">
  <p><small>More information is available with DEBUG=True.</small></p>
</div>

</body>
</html>

ERROR - 2023-04-01 20:14:04 --> Severity: Notice --> Trying to get property 'msg_desc' of non-object /Applications/MAMP/htdocs/ezipay/application/libraries/Easebuzz.php 161
ERROR - 2023-04-01 20:14:04 --> Order res: {"code":801,"error":null,"message":"Invalid requests params","signature":"f5d9e2c00de40ed1daa55e0cf5e88b914fa4a54c8b013b36f4a1dd7ed0fc2e61c6f1120fbd0f243a89838d81acb1fa70aef532e1a3b2095706babc342faf9196"}
ERROR - 2023-04-01 20:22:04 --> payment req: {
    "txnid": "txn_LE0000CC0016",
    "user_ip": "1.1.1.1",
    "user_agent": "123123",
    "signature": "78b05fdc7678fe362ef84430911dac1306a6fee8a7fc6b3fb02e35c404825a36aca0fcba12b35ca32c1efe56b8ad95ad00fb1ad6a032f77f533190e07b3d648c"
}
ERROR - 2023-04-01 20:22:06 --> EaseBuzz res initiate_seamless_payment/ : 
<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="content-type" content="text/html; charset=utf-8">
  <meta name="robots" content="NONE,NOARCHIVE">
  <title>403 Forbidden</title>
  <style type="text/css">
    html * { padding:0; margin:0; }
    body * { padding:10px 20px; }
    body * * { padding:0; }
    body { font:small sans-serif; background:#eee; }
    body>div { border-bottom:1px solid #ddd; }
    h1 { font-weight:normal; margin-bottom:.4em; }
    h1 span { font-size:60%; color:#666; font-weight:normal; }
    #info { background:#f6f6f6; }
    #info ul { margin: 0.5em 4em; }
    #info p, #summary p { padding-top:10px; }
    #summary { background: #ffc; }
    #explanation { background:#eee; border-bottom: 0px none; }
  </style>
</head>
<body>
<div id="summary">
  <h1>Forbidden <span>(403)</span></h1>
  <p>CSRF verification failed. Request aborted.</p>


</div>

<div id="explanation">
  <p><small>More information is available with DEBUG=True.</small></p>
</div>

</body>
</html>

ERROR - 2023-04-01 20:22:06 --> Severity: Notice --> Trying to get property 'msg_desc' of non-object /Applications/MAMP/htdocs/ezipay/application/libraries/Easebuzz.php 162
ERROR - 2023-04-01 20:22:06 --> Order res: {"code":801,"error":null,"message":"Invalid requests params","signature":"f5d9e2c00de40ed1daa55e0cf5e88b914fa4a54c8b013b36f4a1dd7ed0fc2e61c6f1120fbd0f243a89838d81acb1fa70aef532e1a3b2095706babc342faf9196"}
ERROR - 2023-04-01 20:23:13 --> payment req: {
    "txnid": "txn_LE0000CC0016",
    "user_ip": "1.1.1.1",
    "user_agent": "123123",
    "signature": "78b05fdc7678fe362ef84430911dac1306a6fee8a7fc6b3fb02e35c404825a36aca0fcba12b35ca32c1efe56b8ad95ad00fb1ad6a032f77f533190e07b3d648c"
}
ERROR - 2023-04-01 20:23:15 --> EaseBuzz res initiate_seamless_payment/ : 
<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="content-type" content="text/html; charset=utf-8">
  <meta name="robots" content="NONE,NOARCHIVE">
  <title>403 Forbidden</title>
  <style type="text/css">
    html * { padding:0; margin:0; }
    body * { padding:10px 20px; }
    body * * { padding:0; }
    body { font:small sans-serif; background:#eee; }
    body>div { border-bottom:1px solid #ddd; }
    h1 { font-weight:normal; margin-bottom:.4em; }
    h1 span { font-size:60%; color:#666; font-weight:normal; }
    #info { background:#f6f6f6; }
    #info ul { margin: 0.5em 4em; }
    #info p, #summary p { padding-top:10px; }
    #summary { background: #ffc; }
    #explanation { background:#eee; border-bottom: 0px none; }
  </style>
</head>
<body>
<div id="summary">
  <h1>Forbidden <span>(403)</span></h1>
  <p>CSRF verification failed. Request aborted.</p>


</div>

<div id="explanation">
  <p><small>More information is available with DEBUG=True.</small></p>
</div>

</body>
</html>

ERROR - 2023-04-01 20:23:15 --> Severity: Notice --> Trying to get property 'msg_desc' of non-object /Applications/MAMP/htdocs/ezipay/application/libraries/Easebuzz.php 162
ERROR - 2023-04-01 20:23:15 --> Order res: {"code":801,"error":null,"message":"Invalid requests params","signature":"f5d9e2c00de40ed1daa55e0cf5e88b914fa4a54c8b013b36f4a1dd7ed0fc2e61c6f1120fbd0f243a89838d81acb1fa70aef532e1a3b2095706babc342faf9196"}
ERROR - 2023-04-01 20:24:01 --> payment req: {
    "txnid": "txn_LE0000CC0016",
    "user_ip": "1.1.1.1",
    "user_agent": "123123",
    "signature": "78b05fdc7678fe362ef84430911dac1306a6fee8a7fc6b3fb02e35c404825a36aca0fcba12b35ca32c1efe56b8ad95ad00fb1ad6a032f77f533190e07b3d648c"
}
ERROR - 2023-04-01 20:24:03 --> EaseBuzz res initiate_seamless_payment/ : 
<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="content-type" content="text/html; charset=utf-8">
  <meta name="robots" content="NONE,NOARCHIVE">
  <title>403 Forbidden</title>
  <style type="text/css">
    html * { padding:0; margin:0; }
    body * { padding:10px 20px; }
    body * * { padding:0; }
    body { font:small sans-serif; background:#eee; }
    body>div { border-bottom:1px solid #ddd; }
    h1 { font-weight:normal; margin-bottom:.4em; }
    h1 span { font-size:60%; color:#666; font-weight:normal; }
    #info { background:#f6f6f6; }
    #info ul { margin: 0.5em 4em; }
    #info p, #summary p { padding-top:10px; }
    #summary { background: #ffc; }
    #explanation { background:#eee; border-bottom: 0px none; }
  </style>
</head>
<body>
<div id="summary">
  <h1>Forbidden <span>(403)</span></h1>
  <p>CSRF verification failed. Request aborted.</p>


</div>

<div id="explanation">
  <p><small>More information is available with DEBUG=True.</small></p>
</div>

</body>
</html>

ERROR - 2023-04-01 20:24:03 --> Severity: Notice --> Trying to get property 'msg_desc' of non-object /Applications/MAMP/htdocs/ezipay/application/libraries/Easebuzz.php 162
ERROR - 2023-04-01 20:24:03 --> Order res: {"code":801,"error":null,"message":"Invalid requests params","signature":"f5d9e2c00de40ed1daa55e0cf5e88b914fa4a54c8b013b36f4a1dd7ed0fc2e61c6f1120fbd0f243a89838d81acb1fa70aef532e1a3b2095706babc342faf9196"}
ERROR - 2023-04-01 20:25:35 --> payment req: {
    "txnid": "txn_LE0000CC0016",
    "user_ip": "1.1.1.1",
    "user_agent": "123123",
    "signature": "78b05fdc7678fe362ef84430911dac1306a6fee8a7fc6b3fb02e35c404825a36aca0fcba12b35ca32c1efe56b8ad95ad00fb1ad6a032f77f533190e07b3d648c"
}
ERROR - 2023-04-01 20:25:36 --> EaseBuzz res initiate_seamless_payment/ : 1
ERROR - 2023-04-01 20:25:36 --> Severity: Notice --> Trying to get property 'msg_desc' of non-object /Applications/MAMP/htdocs/ezipay/application/libraries/Easebuzz.php 162
ERROR - 2023-04-01 20:25:36 --> Order res: {"code":801,"error":null,"message":"Invalid requests params","signature":"f5d9e2c00de40ed1daa55e0cf5e88b914fa4a54c8b013b36f4a1dd7ed0fc2e61c6f1120fbd0f243a89838d81acb1fa70aef532e1a3b2095706babc342faf9196"}
ERROR - 2023-04-01 20:29:29 --> payment req: {
    "txnid": "txn_LE0000CC0016",
    "user_ip": "1.1.1.1",
    "user_agent": "123123",
    "signature": "78b05fdc7678fe362ef84430911dac1306a6fee8a7fc6b3fb02e35c404825a36aca0fcba12b35ca32c1efe56b8ad95ad00fb1ad6a032f77f533190e07b3d648c"
}
ERROR - 2023-04-01 20:29:31 --> EaseBuzz res initiate_seamless_payment/ : 
<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="content-type" content="text/html; charset=utf-8">
  <meta name="robots" content="NONE,NOARCHIVE">
  <title>403 Forbidden</title>
  <style type="text/css">
    html * { padding:0; margin:0; }
    body * { padding:10px 20px; }
    body * * { padding:0; }
    body { font:small sans-serif; background:#eee; }
    body>div { border-bottom:1px solid #ddd; }
    h1 { font-weight:normal; margin-bottom:.4em; }
    h1 span { font-size:60%; color:#666; font-weight:normal; }
    #info { background:#f6f6f6; }
    #info ul { margin: 0.5em 4em; }
    #info p, #summary p { padding-top:10px; }
    #summary { background: #ffc; }
    #explanation { background:#eee; border-bottom: 0px none; }
  </style>
</head>
<body>
<div id="summary">
  <h1>Forbidden <span>(403)</span></h1>
  <p>CSRF verification failed. Request aborted.</p>


</div>

<div id="explanation">
  <p><small>More information is available with DEBUG=True.</small></p>
</div>

</body>
</html>

ERROR - 2023-04-01 20:29:31 --> Severity: Notice --> Trying to get property 'msg_desc' of non-object /Applications/MAMP/htdocs/ezipay/application/libraries/Easebuzz.php 162
ERROR - 2023-04-01 20:29:31 --> Order res: {"code":801,"error":null,"message":"Invalid requests params","signature":"f5d9e2c00de40ed1daa55e0cf5e88b914fa4a54c8b013b36f4a1dd7ed0fc2e61c6f1120fbd0f243a89838d81acb1fa70aef532e1a3b2095706babc342faf9196"}
ERROR - 2023-04-01 20:34:12 --> payment req: {
    "txnid": "txn_LE0000CC0016",
    "user_ip": "1.1.1.1",
    "user_agent": "123123",
    "signature": "78b05fdc7678fe362ef84430911dac1306a6fee8a7fc6b3fb02e35c404825a36aca0fcba12b35ca32c1efe56b8ad95ad00fb1ad6a032f77f533190e07b3d648c"
}
ERROR - 2023-04-01 20:34:13 --> EaseBuzz res initiate_seamless_payment/ : 
ERROR - 2023-04-01 20:34:13 --> Order res: {"code":801,"error":"something went wrong. try again","message":"Invalid requests params","signature":"70acb18f22a03b6f5dd2d58bfbeb5e0c0b42327a63f8ffcb414508cf61f48553a5a494a2cf7af7e192de207bf8438391e0a961b35cd2e2e485d507a52747d7f9"}
ERROR - 2023-04-01 20:35:36 --> payment req: {
    "txnid": "txn_LE0000CC0016",
    "user_ip": "1.1.1.1",
    "user_agent": "123123",
    "signature": "78b05fdc7678fe362ef84430911dac1306a6fee8a7fc6b3fb02e35c404825a36aca0fcba12b35ca32c1efe56b8ad95ad00fb1ad6a032f77f533190e07b3d648c"
}
ERROR - 2023-04-01 20:35:38 --> EaseBuzz res initiate_seamless_payment/ : 
<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="content-type" content="text/html; charset=utf-8">
  <meta name="robots" content="NONE,NOARCHIVE">
  <title>403 Forbidden</title>
  <style type="text/css">
    html * { padding:0; margin:0; }
    body * { padding:10px 20px; }
    body * * { padding:0; }
    body { font:small sans-serif; background:#eee; }
    body>div { border-bottom:1px solid #ddd; }
    h1 { font-weight:normal; margin-bottom:.4em; }
    h1 span { font-size:60%; color:#666; font-weight:normal; }
    #info { background:#f6f6f6; }
    #info ul { margin: 0.5em 4em; }
    #info p, #summary p { padding-top:10px; }
    #summary { background: #ffc; }
    #explanation { background:#eee; border-bottom: 0px none; }
  </style>
</head>
<body>
<div id="summary">
  <h1>Forbidden <span>(403)</span></h1>
  <p>CSRF verification failed. Request aborted.</p>

  <p>You are seeing this message because this HTTPS site requires a &#39;Referer header&#39; to be sent by your Web browser, but none was sent. This header is required for security reasons, to ensure that your browser is not being hijacked by third parties.</p>
  <p>If you have configured your browser to disable &#39;Referer&#39; headers, please re-enable them, at least for this site, or for HTTPS connections, or for &#39;same-origin&#39; requests.</p>


</div>

<div id="explanation">
  <p><small>More information is available with DEBUG=True.</small></p>
</div>

</body>
</html>

ERROR - 2023-04-01 20:35:38 --> Severity: Notice --> Trying to get property 'msg_desc' of non-object /Applications/MAMP/htdocs/ezipay/application/libraries/Easebuzz.php 163
ERROR - 2023-04-01 20:35:38 --> Order res: {"code":801,"error":null,"message":"Invalid requests params","signature":"f5d9e2c00de40ed1daa55e0cf5e88b914fa4a54c8b013b36f4a1dd7ed0fc2e61c6f1120fbd0f243a89838d81acb1fa70aef532e1a3b2095706babc342faf9196"}
