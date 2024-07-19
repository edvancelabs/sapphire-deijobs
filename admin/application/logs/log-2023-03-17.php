<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2023-03-17 05:33:08 --> Severity: Notice --> Trying to get property 'merchant_secret' of non-object /Applications/MAMP/htdocs/ezipay/application/controllers/Appapi.php 482
ERROR - 2023-03-17 05:33:23 --> 404 Page Not Found: Assets/admin
ERROR - 2023-03-17 05:33:26 --> 404 Page Not Found: Assets/admin
ERROR - 2023-03-17 05:33:29 --> 404 Page Not Found: Assets/admin
ERROR - 2023-03-17 05:33:50 --> 404 Page Not Found: Assets/admin
ERROR - 2023-03-17 05:34:09 --> Cashfree res pg/orders : {"cf_order_id":1809165220,"created_at":"2023-03-17T11:04:09+05:30","customer_details":{"customer_id":"123123","customer_name":null,"customer_email":"nj.248591@gmail.com","customer_phone":"9867248591"},"entity":"order","order_amount":1.20,"order_currency":"INR","order_expiry_time":"2023-04-16T11:04:09+05:30","order_id":"1_txn_E0000CC0001","order_meta":{"return_url":null,"notify_url":null,"payment_methods":null},"order_note":null,"order_splits":[],"order_status":"ACTIVE","order_tags":null,"payment_session_id":"session_hH6RTsEb3FuiqaZ3rCe1pCEo2Zo0mxFeE7moE6DYF5bDac4PMUFIh8TrffsyvokjTFggc17OiWBgyGKLRhZVwBsduykhOAjHreh_MGKGOwJX","payments":{"url":"https://api.cashfree.com/pg/orders/1_txn_E0000CC0001/payments"},"refunds":{"url":"https://api.cashfree.com/pg/orders/1_txn_E0000CC0001/refunds"},"settlements":{"url":"https://api.cashfree.com/pg/orders/1_txn_E0000CC0001/settlements"},"terminal_data":null}

ERROR - 2023-03-17 05:34:28 --> Severity: Notice --> Trying to get property 'merchant_secret' of non-object /Applications/MAMP/htdocs/ezipay/application/controllers/Appapi.php 482
ERROR - 2023-03-17 05:34:37 --> 404 Page Not Found: Assets/admin
ERROR - 2023-03-17 05:34:43 --> Cashfree res pg/orders/sessions : {"action":"custom","cf_payment_id":1669220077,"channel":"link","data":{"url":null,"payload":{"bhim":"bhim://upi/pay?pa=cf.ezipikservicesprivatelim@icici\u0026pn=ezipik%20services%20private%20limited\u0026tr=ATC1175142757\u0026am=1.20\u0026cu=INR\u0026mode=00\u0026purpose=00\u0026mc=5411\u0026tn=1175142757","default":"upi://pay?pa=cf.ezipikservicesprivatelim@icici\u0026pn=ezipik%20services%20private%20limited\u0026tr=ATC1175142757\u0026am=1.20\u0026cu=INR\u0026mode=00\u0026purpose=00\u0026mc=5411\u0026tn=1175142757","gpay":"tez://upi/pay?pa=cf.ezipikservicesprivatelim@icici\u0026pn=ezipik%20services%20private%20limited\u0026tr=ATC1175142757\u0026am=1.20\u0026cu=INR\u0026mode=00\u0026purpose=00\u0026mc=5411\u0026tn=1175142757","paytm":"paytmmp://pay?pa=cf.ezipikservicesprivatelim@icici\u0026pn=ezipik%20services%20private%20limited\u0026tr=ATC1175142757\u0026am=1.20\u0026cu=INR\u0026mode=00\u0026purpose=00\u0026mc=5411\u0026tn=1175142757","phonepe":"phonepe://pay?pa=cf.ezipikservicesprivatelim@icici\u0026pn=ezipik%20services%20private%20limited\u0026tr=ATC1175142757\u0026am=1.20\u0026cu=INR\u0026mode=00\u0026purpose=00\u0026mc=5411\u0026tn=1175142757","web":"https://api.cashfree.com/pg/view/upi/1hnshnd.session_hH6RTsEb3FuiqaZ3rCe1pCEo2Zo0mxFeE7moE6DYF5bDac4PMUFIh8TrffsyvokjTFggc17OiWBgyGKLRhZVwBsduykhOAjHreh_MGKGOwJX.cc0c9cfad467842d1f0d35cf77b77394"},"content_type":null,"method":null},"payment_amount":1.20,"payment_method":"upi"}

ERROR - 2023-03-17 05:35:55 --> Cashfree res pg/orders/sessions : {"action":"custom","cf_payment_id":1669224015,"channel":"link","data":{"url":null,"payload":{"bhim":"bhim://upi/pay?pa=cf.ezipikservicesprivatelim@icici\u0026pn=ezipik%20services%20private%20limited\u0026tr=ATC1175145712\u0026am=1.20\u0026cu=INR\u0026mode=00\u0026purpose=00\u0026mc=5411\u0026tn=1175145712","default":"upi://pay?pa=cf.ezipikservicesprivatelim@icici\u0026pn=ezipik%20services%20private%20limited\u0026tr=ATC1175145712\u0026am=1.20\u0026cu=INR\u0026mode=00\u0026purpose=00\u0026mc=5411\u0026tn=1175145712","gpay":"tez://upi/pay?pa=cf.ezipikservicesprivatelim@icici\u0026pn=ezipik%20services%20private%20limited\u0026tr=ATC1175145712\u0026am=1.20\u0026cu=INR\u0026mode=00\u0026purpose=00\u0026mc=5411\u0026tn=1175145712","paytm":"paytmmp://pay?pa=cf.ezipikservicesprivatelim@icici\u0026pn=ezipik%20services%20private%20limited\u0026tr=ATC1175145712\u0026am=1.20\u0026cu=INR\u0026mode=00\u0026purpose=00\u0026mc=5411\u0026tn=1175145712","phonepe":"phonepe://pay?pa=cf.ezipikservicesprivatelim@icici\u0026pn=ezipik%20services%20private%20limited\u0026tr=ATC1175145712\u0026am=1.20\u0026cu=INR\u0026mode=00\u0026purpose=00\u0026mc=5411\u0026tn=1175145712","web":"https://api.cashfree.com/pg/view/upi/1hnslif.session_hH6RTsEb3FuiqaZ3rCe1pCEo2Zo0mxFeE7moE6DYF5bDac4PMUFIh8TrffsyvokjTFggc17OiWBgyGKLRhZVwBsduykhOAjHreh_MGKGOwJX.c524b939c470ef3ee5f8942ce1772863"},"content_type":null,"method":null},"payment_amount":1.20,"payment_method":"upi"}

ERROR - 2023-03-17 06:46:38 --> 404 Page Not Found: Assets/admin
ERROR - 2023-03-17 06:51:32 --> 404 Page Not Found: Assets/admin
ERROR - 2023-03-17 06:52:46 --> 404 Page Not Found: Assets/admin
ERROR - 2023-03-17 06:59:16 --> 404 Page Not Found: Assets/admin
ERROR - 2023-03-17 07:01:49 --> 404 Page Not Found: Assets/admin
ERROR - 2023-03-17 07:04:43 --> Severity: error --> Exception: syntax error, unexpected '<' /Applications/MAMP/htdocs/ezipay/application/views/admin/dev_api_doc.php 50
ERROR - 2023-03-17 07:04:53 --> Severity: Warning --> include_once(): http:// wrapper is disabled in the server configuration by allow_url_include=0 /Applications/MAMP/htdocs/ezipay/application/views/admin/dev_api_doc.php 50
ERROR - 2023-03-17 07:04:53 --> Severity: Warning --> include_once(http://localhost:8888/ezipay/assets/PayInApi.html): failed to open stream: no suitable wrapper could be found /Applications/MAMP/htdocs/ezipay/application/views/admin/dev_api_doc.php 50
ERROR - 2023-03-17 07:04:53 --> Severity: Warning --> include_once(): Failed opening 'http://localhost:8888/ezipay/assets/PayInApi.html' for inclusion (include_path='.:/Applications/MAMP/bin/php/php7.3.8/lib/php') /Applications/MAMP/htdocs/ezipay/application/views/admin/dev_api_doc.php 50
ERROR - 2023-03-17 07:04:54 --> 404 Page Not Found: Assets/admin
ERROR - 2023-03-17 07:05:26 --> 404 Page Not Found: Assets/admin
ERROR - 2023-03-17 08:06:06 --> Severity: Notice --> Undefined index: status /Applications/MAMP/htdocs/ezipay/assets/grocery_crud/themes/tablestrap/views/list.php 431
ERROR - 2023-03-17 08:06:07 --> 404 Page Not Found: Assets/admin
ERROR - 2023-03-17 19:19:24 --> cf_payment success res: {
	"data": {
		"order": {
			"order_id": "1_txn_E0000CC0001",
			"order_amount": 2.20,
			"order_currency": "INR",
			"order_tags": null
		},
		"payment": {
			"cf_payment_id": 1490959091,
			"payment_status": "SUCCESS",
			"payment_amount": 2.20,
			"payment_currency": "INR",
			"payment_message": "Transaction Successful",
			"payment_time": "2023-03-17T18:28:44+05:30",
			"bank_reference": null,
			"auth_id": null,
			"payment_method": {
				"upi": {
					"channel": null,
					"upi_id": null
				}
			},
			"payment_group": "upi"
		},
		"customer_details": {
			"customer_name": null,
			"customer_id": "1290",
			"customer_email": "nj@gmail.com",
			"customer_phone": "9867248591"
		},
		"payment_gateway_details": null,
		"payment_offers": null
	},
	"event_time": "2023-03-17T18:29:42+05:30",
	"type": "PAYMENT_SUCCESS_WEBHOOK"
}


ERROR - 2023-03-17 19:19:24 --> Severity: error --> Exception: syntax error, unexpected ';', expecting ')' /Applications/MAMP/htdocs/ezipay/application/libraries/Cashfree.php 128
ERROR - 2023-03-17 19:19:37 --> cf_payment success res: {
	"data": {
		"order": {
			"order_id": "1_txn_E0000CC0001",
			"order_amount": 2.20,
			"order_currency": "INR",
			"order_tags": null
		},
		"payment": {
			"cf_payment_id": 1490959091,
			"payment_status": "SUCCESS",
			"payment_amount": 2.20,
			"payment_currency": "INR",
			"payment_message": "Transaction Successful",
			"payment_time": "2023-03-17T18:28:44+05:30",
			"bank_reference": null,
			"auth_id": null,
			"payment_method": {
				"upi": {
					"channel": null,
					"upi_id": null
				}
			},
			"payment_group": "upi"
		},
		"customer_details": {
			"customer_name": null,
			"customer_id": "1290",
			"customer_email": "nj@gmail.com",
			"customer_phone": "9867248591"
		},
		"payment_gateway_details": null,
		"payment_offers": null
	},
	"event_time": "2023-03-17T18:29:42+05:30",
	"type": "PAYMENT_SUCCESS_WEBHOOK"
}


ERROR - 2023-03-17 19:19:37 --> Severity: error --> Exception: syntax error, unexpected ',' /Applications/MAMP/htdocs/ezipay/application/libraries/Cashfree.php 155
ERROR - 2023-03-17 19:19:52 --> cf_payment success res: {
	"data": {
		"order": {
			"order_id": "1_txn_E0000CC0001",
			"order_amount": 2.20,
			"order_currency": "INR",
			"order_tags": null
		},
		"payment": {
			"cf_payment_id": 1490959091,
			"payment_status": "SUCCESS",
			"payment_amount": 2.20,
			"payment_currency": "INR",
			"payment_message": "Transaction Successful",
			"payment_time": "2023-03-17T18:28:44+05:30",
			"bank_reference": null,
			"auth_id": null,
			"payment_method": {
				"upi": {
					"channel": null,
					"upi_id": null
				}
			},
			"payment_group": "upi"
		},
		"customer_details": {
			"customer_name": null,
			"customer_id": "1290",
			"customer_email": "nj@gmail.com",
			"customer_phone": "9867248591"
		},
		"payment_gateway_details": null,
		"payment_offers": null
	},
	"event_time": "2023-03-17T18:29:42+05:30",
	"type": "PAYMENT_SUCCESS_WEBHOOK"
}


ERROR - 2023-03-17 19:19:52 --> Severity: Notice --> Array to string conversion /Applications/MAMP/htdocs/ezipay/system/database/DB_driver.php 1519
ERROR - 2023-03-17 19:19:52 --> Query error: Unknown column 'Array' in 'field list' - Invalid query: UPDATE `payin_txn` SET `txn_status` = 'success', `pg_res_data` = Array
WHERE `reference_id` = '1_txn_E0000CC0001'
ERROR - 2023-03-17 19:20:24 --> cf_payment success res: {
	"data": {
		"order": {
			"order_id": "1_txn_E0000CC0001",
			"order_amount": 2.20,
			"order_currency": "INR",
			"order_tags": null
		},
		"payment": {
			"cf_payment_id": 1490959091,
			"payment_status": "SUCCESS",
			"payment_amount": 2.20,
			"payment_currency": "INR",
			"payment_message": "Transaction Successful",
			"payment_time": "2023-03-17T18:28:44+05:30",
			"bank_reference": null,
			"auth_id": null,
			"payment_method": {
				"upi": {
					"channel": null,
					"upi_id": null
				}
			},
			"payment_group": "upi"
		},
		"customer_details": {
			"customer_name": null,
			"customer_id": "1290",
			"customer_email": "nj@gmail.com",
			"customer_phone": "9867248591"
		},
		"payment_gateway_details": null,
		"payment_offers": null
	},
	"event_time": "2023-03-17T18:29:42+05:30",
	"type": "PAYMENT_SUCCESS_WEBHOOK"
}


ERROR - 2023-03-17 19:20:24 --> webhook post to merchant: http://localhost:8888/ezipay/webhook/test==={"txn_status":"success","txn_message":"Transaction Successful","bank_refrence":null,"event_time":"2023-03-17T18:29:42+05:30","txnid":"txn_E0000CC0001","signature":"7c41eaeabd8f9e4411f5719d2a087b64b5559428c7f111806a5aea013925ccff2275f771d909563ead5d280cf4b64e7de67024dc722e1e3f2751731e123e1b4f"}
ERROR - 2023-03-17 19:20:24 --> webhook request at merchant{"txn_status":"success","txn_message":"Transaction Successful","bank_refrence":null,"event_time":"2023-03-17T18:29:42+05:30","txnid":"txn_E0000CC0001","signature":"7c41eaeabd8f9e4411f5719d2a087b64b5559428c7f111806a5aea013925ccff2275f771d909563ead5d280cf4b64e7de67024dc722e1e3f2751731e123e1b4f"}
