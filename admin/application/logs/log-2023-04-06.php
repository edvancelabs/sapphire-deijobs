<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2023-04-06 20:27:32 --> order req: {
    "txnid": "txn_LE0000CC0018",
    "amount": 1.2,
    "customer_id": "123123",
    "customer_firstname": "nitesh",
    "customer_lastname": "nahar",
    "customer_email": "nj.248591@gmail.com",
    "customer_phone": "9867248591",
    "productinfo": "Test Txn",
    "signature": "aeaf7abdb04cd37dd9839b4f4cbe8f03854de09d4aedee89256437bd8168d8cca689014b883ec5455a009bf658d370398c18266e9d06c6b2a10c87e975fc8cd8"
}
ERROR - 2023-04-06 20:27:32 --> Order res: {"code":103,"message":"Signature provided is invalid","signature":"8e27f3a8d47d48c0faf47a6703d2391d3086efc53ebd93c7908cc4dbb8028a5008d033126d1e10e2c4147987cd113e1d75fb7f23d70a465a3f896bb1733bc238"}
ERROR - 2023-04-06 20:27:47 --> order req: {
    "txnid": "txn_LE0000CC0018",
    "amount": 1.2,
    "customer_id": "123123",
    "customer_firstname": "nitesh",
    "customer_lastname": "nahar",
    "customer_email": "nj.248591@gmail.com",
    "customer_phone": "9867248591",
    "productinfo": "Test Txn",
    "signature": "aeaf7abdb04cd37dd9839b4f4cbe8f03854de09d4aedee89256437bd8168d8cca689014b883ec5455a009bf658d370398c18266e9d06c6b2a10c87e975fc8cd8"
}
ERROR - 2023-04-06 20:27:47 --> Order res: {"code":103,"message":"Signature provided is invalid","signature":"8e27f3a8d47d48c0faf47a6703d2391d3086efc53ebd93c7908cc4dbb8028a5008d033126d1e10e2c4147987cd113e1d75fb7f23d70a465a3f896bb1733bc238"}
ERROR - 2023-04-06 20:27:53 --> 404 Page Not Found: Assets/admin
ERROR - 2023-04-06 20:27:56 --> 404 Page Not Found: Assets/admin
ERROR - 2023-04-06 20:28:04 --> 404 Page Not Found: Assets/admin
ERROR - 2023-04-06 20:28:07 --> 404 Page Not Found: Assets/admin
ERROR - 2023-04-06 20:28:19 --> order req: {
    "txnid": "txn_LE0000CC0018",
    "amount": 1.2,
    "customer_id": "123123",
    "customer_firstname": "nitesh",
    "customer_lastname": "nahar",
    "customer_email": "nj.248591@gmail.com",
    "customer_phone": "9867248591",
    "productinfo": "Test Txn",
    "signature": "957ec58ef05c47e6402f37965851d4eb325da69d03597db31bd5a6a8bf229f0caea16b9e37326a26c5434e60ba5f4127976557976743c81b684f42e6024e63b9"
}
ERROR - 2023-04-06 20:28:19 --> Severity: error --> Exception: Call to undefined function SHA256() /Applications/MAMP/htdocs/ezipay/application/libraries/Phonepe.php 49
ERROR - 2023-04-06 20:30:44 --> order req: {
    "txnid": "txn_LE0000CC0018",
    "amount": 1.2,
    "customer_id": "123123",
    "customer_firstname": "nitesh",
    "customer_lastname": "nahar",
    "customer_email": "nj.248591@gmail.com",
    "customer_phone": "9867248591",
    "productinfo": "Test Txn",
    "signature": "957ec58ef05c47e6402f37965851d4eb325da69d03597db31bd5a6a8bf229f0caea16b9e37326a26c5434e60ba5f4127976557976743c81b684f42e6024e63b9"
}
ERROR - 2023-04-06 20:30:44 --> PhonePE req /pg/v1/pay : {"request":"eyJtZXJjaGFudFRyYW5zYWN0aW9uSWQiOiIxX3R4bl9MRTAwMDBDQzAwMTgiLCJtZXJjaGFudFVzZXJJZCI6IjEyMzEyMyIsImFtb3VudCI6MTIwLCJjYWxsYmFja1VybCI6Imh0dHA6XC9cL3Rlc3QuZXppcGF5LmluXC93ZWJob29rXC9wZV9wYXltZW50IiwibW9iaWxlTnVtYmVyIjoiOTg2NzI0ODU5MSIsImRldmljZUNvbnRleHQiOnsiZGV2aWNlT1MiOiJBTkRST0lEIn0sInBheW1lbnRJbnN0cnVtZW50Ijp7InR5cGUiOiJVUElfSU5URU5UIiwidGFyZ2V0QXBwIjoiY29tLnBob25lcGUuYXBwIn0sIm1lcmNoYW50SWQiOiJFWklQSUtTRVJWSUNFU09OTElORSJ9"}
ERROR - 2023-04-06 20:30:47 --> PhonePE res /pg/v1/pay : {"success":false,"code":"401"}
ERROR - 2023-04-06 20:30:47 --> Order res: {"code":801,"error":null,"message":"Invalid requests params","signature":"f5d9e2c00de40ed1daa55e0cf5e88b914fa4a54c8b013b36f4a1dd7ed0fc2e61c6f1120fbd0f243a89838d81acb1fa70aef532e1a3b2095706babc342faf9196"}
ERROR - 2023-04-06 20:32:25 --> order req: {
    "txnid": "txn_LE0000CC0018",
    "amount": 1.2,
    "customer_id": "123123",
    "customer_firstname": "nitesh",
    "customer_lastname": "nahar",
    "customer_email": "nj.248591@gmail.com",
    "customer_phone": "9867248591",
    "productinfo": "Test Txn",
    "signature": "957ec58ef05c47e6402f37965851d4eb325da69d03597db31bd5a6a8bf229f0caea16b9e37326a26c5434e60ba5f4127976557976743c81b684f42e6024e63b9"
}
ERROR - 2023-04-06 20:32:25 --> Severity: Warning --> base64_encode() expects parameter 1 to be string, array given /Applications/MAMP/htdocs/ezipay/application/libraries/Phonepe.php 44
ERROR - 2023-04-06 20:32:25 --> PhonePE req /pg/v1/pay : {"request":""}
ERROR - 2023-04-06 20:32:25 --> PhonePE res /pg/v1/pay : {"success":false,"code":"400"}
ERROR - 2023-04-06 20:32:25 --> Order res: {"code":801,"error":null,"message":"Invalid requests params","signature":"f5d9e2c00de40ed1daa55e0cf5e88b914fa4a54c8b013b36f4a1dd7ed0fc2e61c6f1120fbd0f243a89838d81acb1fa70aef532e1a3b2095706babc342faf9196"}
ERROR - 2023-04-06 20:34:59 --> order req: {
    "txnid": "txn_LE0000CC0018",
    "amount": 1.2,
    "customer_id": "123123",
    "customer_firstname": "nitesh",
    "customer_lastname": "nahar",
    "customer_email": "nj.248591@gmail.com",
    "customer_phone": "9867248591",
    "productinfo": "Test Txn",
    "signature": "957ec58ef05c47e6402f37965851d4eb325da69d03597db31bd5a6a8bf229f0caea16b9e37326a26c5434e60ba5f4127976557976743c81b684f42e6024e63b9"
}
ERROR - 2023-04-06 20:34:59 --> PhonePE req (b91f236bd24eba53f919df221144b81459b72df5dc914e81dda7b6f9046b1dea###1) /pg/v1/pay : {"request":"eyJtZXJjaGFudFRyYW5zYWN0aW9uSWQiOiIxX3R4bl9MRTAwMDBDQzAwMTgiLCJtZXJjaGFudFVzZXJJZCI6IjEyMzEyMyIsImFtb3VudCI6MTIwLCJjYWxsYmFja1VybCI6Imh0dHA6XC9cL3Rlc3QuZXppcGF5LmluXC93ZWJob29rXC9wZV9wYXltZW50IiwibW9iaWxlTnVtYmVyIjoiOTg2NzI0ODU5MSIsImRldmljZUNvbnRleHQiOnsiZGV2aWNlT1MiOiJBTkRST0lEIn0sInBheW1lbnRJbnN0cnVtZW50Ijp7InR5cGUiOiJVUElfSU5URU5UIiwidGFyZ2V0QXBwIjoiY29tLnBob25lcGUuYXBwIn0sIm1lcmNoYW50SWQiOiJFWklQSUtTRVJWSUNFU09OTElORSJ9"}
ERROR - 2023-04-06 20:35:02 --> PhonePE res /pg/v1/pay : {"success":true,"code":"PAYMENT_INITIATED","message":"Payment initiated","data":{"merchantId":"EZIPIKSERVICESONLINE","merchantTransactionId":"1_txn_LE0000CC0018","instrumentResponse":{"type":"UPI_INTENT","intentUrl":"upi://pay?pa=EZIPIKSERVICESONLINE@ybl&pn=Ezipik%20Services%20&am=1.20&mam=1.20&tr=1_txn_LE0000CC0018&tn=Payment%20for%201_txn_LE0000CC0018&mc=8999&mode=04&purpose=00&utm_campaign=B2B_PG&utm_medium=EZIPIKSERVICESONLINE&utm_source=1_txn_LE0000CC0018"}}}
ERROR - 2023-04-06 20:35:02 --> Order res: {"code":801,"error":null,"message":"Invalid requests params","signature":"f5d9e2c00de40ed1daa55e0cf5e88b914fa4a54c8b013b36f4a1dd7ed0fc2e61c6f1120fbd0f243a89838d81acb1fa70aef532e1a3b2095706babc342faf9196"}
ERROR - 2023-04-06 21:27:25 --> txnStatus req: {
    "txnid": "txn_LE0000CC0018",
    "signature": "97d99a72cd573079d574b6fdef99f8d7f1df41668a0463420a83befde658f549a691faca04270a0ce7c5f7b33057f2188d26dffc6382c588b35bf88fa66c8f7d"
}
ERROR - 2023-04-06 21:27:26 --> TxnStatus res: {"code":107,"message":"Invalid Reference \/ Txn id","signature":"23449c084c47e1c59db4500a22c2eb8f8d8905d2381e77b8863e05ff92c9cf8bcbe59241ddcabbe916a8f3ae940e35d875776a28034b28b5ddc48bf99f1981d5"}


















ERROR - 2023-04-06 21:35:10 --> order req: {
    "txnid": "txn_LE0000CC0019",
    "amount": 3.2,
    "customer_id": "123123i3o4",
    "customer_firstname": "nitesh",
    "customer_lastname": "nahar",
    "customer_email": "nj.248591@gmail.com",
    "customer_phone": "9867248591",
    "productinfo": "Test Txn",
    "signature": "ade47343cdfe812963b1768ebef21e4994cd62d1f2f5c52db45531f5aed5b6394633d2cc9da4d43901e530b88fd54ca911d8afc4a085f0ded39f9848b86e184c"
}
ERROR - 2023-04-06 21:35:10 --> Order res: {"code":200,"txnid":"txn_LE0000CC0019","status":"success","message":"Success","signature":"b45340b799dd9031530efcf1c8eac8ddfbc5c2ec6e5918a9d191f5b24590004640c6873be20f86514cf6c94f682e8dfdbb587f2a4be445b9a4c9a729d222f798"}
ERROR - 2023-04-06 21:35:31 --> payment req: {
    "txnid": "txn_LE0000CC0019",
    "user_ip": "1.1.1.1",
    "user_agent": "123123",
    "signature": "3650fc4447e311ee2f721c907da586c6c25726b4884b1488fb1b6a1edbf2acbfa91e447f64fbaf9c867d5700163f8b27df8f8dd0066388f6c239714fe34a20c1"
}
ERROR - 2023-04-06 21:35:31 --> PhonePE req (7ac6f94c4521a4f4e71950232d570fdae44ee4ce872c504ac8cff5fabfc9c034###1) /pg/v1/pay : {"request":"eyJtZXJjaGFudFRyYW5zYWN0aW9uSWQiOiIxX3R4bl9MRTAwMDBDQzAwMTkiLCJtZXJjaGFudFVzZXJJZCI6IjEyMzEyM2kzbzQiLCJhbW91bnQiOjMyMCwiY2FsbGJhY2tVcmwiOiJodHRwOlwvXC90ZXN0LmV6aXBheS5pblwvd2ViaG9va1wvcGVfcGF5bWVudCIsIm1vYmlsZU51bWJlciI6Ijk4NjcyNDg1OTEiLCJkZXZpY2VDb250ZXh0Ijp7ImRldmljZU9TIjoiQU5EUk9JRCJ9LCJwYXltZW50SW5zdHJ1bWVudCI6eyJ0eXBlIjoiVVBJX0lOVEVOVCIsInRhcmdldEFwcCI6ImNvbS5waG9uZXBlLmFwcCJ9LCJtZXJjaGFudElkIjoiRVpJUElLU0VSVklDRVNPTkxJTkUifQ=="}
ERROR - 2023-04-06 21:35:34 --> PhonePE res /pg/v1/pay : {"success":true,"code":"PAYMENT_INITIATED","message":"Payment initiated","data":{"merchantId":"EZIPIKSERVICESONLINE","merchantTransactionId":"1_txn_LE0000CC0019","instrumentResponse":{"type":"UPI_INTENT","intentUrl":"upi://pay?pa=EZIPIKSERVICESONLINE@ybl&pn=Ezipik%20Services%20&am=3.20&mam=3.20&tr=1_txn_LE0000CC0019&tn=Payment%20for%201_txn_LE0000CC0019&mc=8999&mode=04&purpose=00&utm_campaign=B2B_PG&utm_medium=EZIPIKSERVICESONLINE&utm_source=1_txn_LE0000CC0019"}}}
ERROR - 2023-04-06 21:35:34 --> Order res: {"code":200,"txnid":"txn_LE0000CC0019","uri":"upi:\/\/pay?pa=EZIPIKSERVICESONLINE@ybl&pn=Ezipik%20Services%20&am=3.20&mam=3.20&tr=1_txn_LE0000CC0019&tn=Payment%20for%201_txn_LE0000CC0019&mc=8999&mode=04&purpose=00&utm_campaign=B2B_PG&utm_medium=EZIPIKSERVICESONLINE&utm_source=1_txn_LE0000CC0019","message":"Success","signature":"460015395c8b5ac3fa458de9c680a55cf05139901236156e9621e282b61308f17bc5cba37c9910794e260331fd798aaedf4b467243a5bae497ddf73ddeb59102"}
ERROR - 2023-04-06 21:35:50 --> txnStatus req: {
    "txnid": "txn_LE0000CC0019",
    "signature": "42f566528c6fa689acfa20dfd460a1cf388eaebcd5e1734b65b1f0546bbac727eececc5593d4b2a496e1190f991721a0e8ce659e76e5713c97a1e0d178449860"
}
ERROR - 2023-04-06 21:35:51 --> Severity: Notice --> Undefined property: stdClass::$reference_id /Applications/MAMP/htdocs/ezipay/application/libraries/Phonepe.php 141
ERROR - 2023-04-06 21:35:51 --> PhonePE res /pg/v1/status/EZIPIKSERVICESONLINE/ : {"message":"Bad Request - Api Mapping Not Found"}
ERROR - 2023-04-06 21:35:51 --> TxnStatus res: {"code":801,"txnid":"txn_LE0000CC0019","error":"Bad Request - Api Mapping Not Found","message":"Invalid requests params","signature":"bd2c97052d0e2c964ebb22b4fa7f777a40fd382340799d2c0fb1a04eea020fa1ae6e77211b6e8ac67cc73ed980cf5ef7ca924021b63985685fcd35155f18336f"}
ERROR - 2023-04-06 21:36:56 --> txnStatus req: {
    "txnid": "txn_LE0000CC0019",
    "signature": "42f566528c6fa689acfa20dfd460a1cf388eaebcd5e1734b65b1f0546bbac727eececc5593d4b2a496e1190f991721a0e8ce659e76e5713c97a1e0d178449860"
}
ERROR - 2023-04-06 21:36:57 --> PhonePE res /pg/v1/status/EZIPIKSERVICESONLINE/1_txn_LE0000CC0019 : {"success":true,"code":"PAYMENT_PENDING","message":"Your request is in pending state.","data":{"merchantId":"EZIPIKSERVICESONLINE","merchantTransactionId":"1_txn_LE0000CC0019","transactionId":null,"amount":320,"state":"PENDING","responseCode":"PAYMENT_PENDING","paymentInstrument":null}}
ERROR - 2023-04-06 21:36:57 --> TxnStatus res: {"code":200,"txnid":"txn_LE0000CC0019","payment_status":"pending","payment_message":"Payment initiated","message":"Success","signature":"293c93e86b4266fb2b72d302ce70a04a1a1fb262f43e3201e1ff7d1d44e3eeec6256b820c9e5c26ce67cfe6cb34763d824b9d3156b55fb05b092ffe93b42ab28"}
ERROR - 2023-04-06 21:45:38 --> txnStatus req: {
    "txnid": "txn_LE0000CC0019",
    "signature": "42f566528c6fa689acfa20dfd460a1cf388eaebcd5e1734b65b1f0546bbac727eececc5593d4b2a496e1190f991721a0e8ce659e76e5713c97a1e0d178449860"
}
ERROR - 2023-04-06 21:45:39 --> PhonePE res /pg/v1/status/EZIPIKSERVICESONLINE/1_txn_LE0000CC0019 : {"success":true,"code":"PAYMENT_SUCCESS","message":"Your payment is successful.","data":{"merchantId":"EZIPIKSERVICESONLINE","merchantTransactionId":"1_txn_LE0000CC0019","transactionId":"T2304062142402366538805","amount":320,"state":"COMPLETED","responseCode":"PAYMENT_SUCCESS","paymentInstrument":{"type":"UPI","utr":"309686578722","unmaskedAccountNumber":null,"payerVpa":null,"cardNetwork":null,"accountType":"SAVINGS"}}}
ERROR - 2023-04-06 21:45:39 --> TxnStatus res: {"code":200,"txnid":"txn_LE0000CC0019","payment_status":"success","payment_message":"Your payment is successful.","message":"Success","signature":"3927642594329e485d3b6a2794fb78a062c4b140f0273226820d6c9871dcd020dea0b541042d3e8bb27cca7611533cf834dc718cc6b7b30f221e8eaaf3390e8b"}
ERROR - 2023-04-06 21:45:47 --> txnStatus req: {
    "txnid": "txn_LE0000CC0019",
    "signature": "42f566528c6fa689acfa20dfd460a1cf388eaebcd5e1734b65b1f0546bbac727eececc5593d4b2a496e1190f991721a0e8ce659e76e5713c97a1e0d178449860"
}
ERROR - 2023-04-06 21:45:47 --> Severity: Notice --> Undefined variable: txn_pg_res_data /Applications/MAMP/htdocs/ezipay/application/libraries/Phonepe.php 170
ERROR - 2023-04-06 21:45:47 --> Severity: Notice --> Trying to get property 'message' of non-object /Applications/MAMP/htdocs/ezipay/application/libraries/Phonepe.php 170
ERROR - 2023-04-06 21:45:47 --> TxnStatus res: {"code":200,"txnid":"txn_LE0000CC0019","payment_status":"success","payment_message":null,"message":"Success","signature":"81ed5f9b2600961308589ec675b063bffbfd45d8a0dc19328d784cebc806fb2e69cb69504eb1da36af537f3bd8d560a94b7d13578551778f5801b2a768d290d5"}
ERROR - 2023-04-06 21:48:51 --> txnStatus req: {
    "txnid": "txn_LE0000CC0019",
    "signature": "42f566528c6fa689acfa20dfd460a1cf388eaebcd5e1734b65b1f0546bbac727eececc5593d4b2a496e1190f991721a0e8ce659e76e5713c97a1e0d178449860"
}
ERROR - 2023-04-06 21:48:51 --> TxnStatus res: {"code":200,"txnid":"txn_LE0000CC0019","payment_status":"success","payment_message":"Your payment is successful.","message":"Success","signature":"3927642594329e485d3b6a2794fb78a062c4b140f0273226820d6c9871dcd020dea0b541042d3e8bb27cca7611533cf834dc718cc6b7b30f221e8eaaf3390e8b"}
ERROR - 2023-04-06 22:21:46 --> refund req: {
    "txnid": "txn_LE0000CC0019",
    "refund_amount": 3.2,
    "refund_txnid": "txn_RefLE0000CC0019",
    "signature": "27173dfd610a8775999633507ccbad3f07413b99e9f1e2444822f9b14584f1a5a95721c5d37c884e426f77edcfebe1d9557ad6e9240aeb21ff9725e31754f0b1"
}
ERROR - 2023-04-06 22:21:46 --> Severity: error --> Exception: syntax error, unexpected ':', expecting ')' /Applications/MAMP/htdocs/ezipay/application/libraries/Phonepe.php 243
ERROR - 2023-04-06 22:22:30 --> refund req: {
    "txnid": "txn_LE0000CC0019",
    "refund_amount": 3.2,
    "refund_txnid": "txn_RefLE0000CC0019",
    "signature": "27173dfd610a8775999633507ccbad3f07413b99e9f1e2444822f9b14584f1a5a95721c5d37c884e426f77edcfebe1d9557ad6e9240aeb21ff9725e31754f0b1"
}
ERROR - 2023-04-06 22:22:30 --> Severity: error --> Exception: syntax error, unexpected '$res' (T_VARIABLE) /Applications/MAMP/htdocs/ezipay/application/libraries/Phonepe.php 250
ERROR - 2023-04-06 22:22:58 --> refund req: {
    "txnid": "txn_LE0000CC0019",
    "refund_amount": 3.2,
    "refund_txnid": "txn_RefLE0000CC0019",
    "signature": "27173dfd610a8775999633507ccbad3f07413b99e9f1e2444822f9b14584f1a5a95721c5d37c884e426f77edcfebe1d9557ad6e9240aeb21ff9725e31754f0b1"
}
ERROR - 2023-04-06 22:22:58 --> Query error: Unknown column 'mer_req_data' in 'field list' - Invalid query: SELECT `mer_req_data`
FROM `orders`
WHERE `id` = '32'
ERROR - 2023-04-06 22:23:45 --> refund req: {
    "txnid": "txn_LE0000CC0019",
    "refund_amount": 3.2,
    "refund_txnid": "txn_RefLE0000CC0019",
    "signature": "27173dfd610a8775999633507ccbad3f07413b99e9f1e2444822f9b14584f1a5a95721c5d37c884e426f77edcfebe1d9557ad6e9240aeb21ff9725e31754f0b1"
}
ERROR - 2023-04-06 22:23:45 --> PhonePE req (fa5de9fe92af0fda272cb222964209068bc7c4802cbd97cb68f6f927dbd30d30###1) /pg/v1/refund : {"request":"eyJtZXJjaGFudFVzZXJJZCI6IjEyMzEyM2kzbzQiLCJvcmlnaW5hbFRyYW5zYWN0aW9uSWQiOiIxX3R4bl9MRTAwMDBDQzAwMTkiLCJtZXJjaGFudFRyYW5zYWN0aW9uSWQiOiIxX3R4bl9SZWZMRTAwMDBDQzAwMTkiLCJhbW91bnQiOjMyMCwiY2FsbGJhY2tVcmwiOiJodHRwOlwvXC90ZXN0LmV6aXBheS5pblwvd2ViaG9va1wvcGVfcGF5bWVudCIsIm1lcmNoYW50SWQiOiJFWklQSUtTRVJWSUNFU09OTElORSJ9"}
ERROR - 2023-04-06 22:23:45 --> PhonePE res /pg/v1/refund : {"success":true,"code":"PAYMENT_PENDING","message":"Your request is in pending state.","data":{"merchantId":"EZIPIKSERVICESONLINE","merchantTransactionId":"1_txn_RefLE0000CC0019","transactionId":"P2304062223475910036430","amount":320,"state":"PENDING","responseCode":null}}
ERROR - 2023-04-06 22:23:45 --> Refund res: {"code":200,"refund_txnid":"txn_RefLE0000CC0019","refund_status":"pending","refund_description":"Your request is in pending state.","refund_arn":"","message":"Success","signature":"1d0c8709c35e0308a63ca5e26146b7cbabcc1dc79d60bc8605098f1ac8facd3ed798225ee27c950911b91589cb9240be8f968990e9b1b93913bdbc91b7bcffad"}
ERROR - 2023-04-06 22:33:00 --> PhonePE res /pg/v1/status/EZIPIKSERVICESONLINE/1_txn_RefLE0000CC0019 : {"success":true,"code":"PAYMENT_SUCCESS","message":"Your payment is successful.","data":{"merchantId":"EZIPIKSERVICESONLINE","merchantTransactionId":"1_txn_RefLE0000CC0019","transactionId":"P2304062223475910036430","amount":320,"state":"COMPLETED","responseCode":"PAYMENT_SUCCESS","paymentInstrument":{"type":"UPI","utr":"309644816298","unmaskedAccountNumber":null,"payerVpa":null,"cardNetwork":null,"accountType":null}}}
ERROR - 2023-04-06 22:33:00 --> Severity: Notice --> Undefined variable: txn_data /Applications/MAMP/htdocs/ezipay/application/libraries/Phonepe.php 277
ERROR - 2023-04-06 22:33:00 --> Severity: Notice --> Trying to get property 'txn_status' of non-object /Applications/MAMP/htdocs/ezipay/application/libraries/Phonepe.php 277
