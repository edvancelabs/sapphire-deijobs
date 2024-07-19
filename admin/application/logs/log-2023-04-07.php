<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2023-04-07 00:36:24 --> order req: {
    "txnid": "txn_LE0000CC00190000000000000000000001",
    "amount": 13.2,
    "customer_id": "CID_LE0000CC00190000000000000000000001",
    "customer_firstname": "nitesh",
    "customer_lastname": "nahar",
    "customer_email": "nj.248591@gmail.com",
    "customer_phone": "9867248591",
    "productinfo": "Test Txn",
    "signature": "ade47343cdfe812963b1768ebef21e4994cd62d1f2f5c52db45531f5aed5b6394633d2cc9da4d43901e530b88fd54ca911d8afc4a085f0ded39f9848b86e184c"
}
ERROR - 2023-04-07 00:36:24 --> Order res: {"code":103,"message":"Signature provided is invalid","signature":"8e27f3a8d47d48c0faf47a6703d2391d3086efc53ebd93c7908cc4dbb8028a5008d033126d1e10e2c4147987cd113e1d75fb7f23d70a465a3f896bb1733bc238"}
ERROR - 2023-04-07 00:36:45 --> order req: {
    "txnid": "txn_LE0000CC00190000000000000000000001",
    "amount": 13.2,
    "customer_id": "CID_LE0000CC00190000000000000000000001",
    "customer_firstname": "nitesh",
    "customer_lastname": "nahar",
    "customer_email": "nj.248591@gmail.com",
    "customer_phone": "9867248591",
    "productinfo": "Test Txn",
    "signature": "1aa010e828a3d3c79b71f0f86e3bbf9092666d9541a3029cb652faaa0e6501bec2f462f483ce2fc0dfc251926053a0700ff81ac88ac467b98ddde84afe6d0069"
}
ERROR - 2023-04-07 00:36:46 --> Order res: {"code":200,"txnid":"txn_LE0000CC00190000000000000000000001","status":"success","message":"Success","signature":"52f207dc69bcf7a4621a42132fd4e8877007d920e5d5d8b72be3d2125851c95f6c5b2618d8bfa6f2d791ce72043eb754bd4f53210aa8eadd77d57ebe5ddad87d"}
ERROR - 2023-04-07 00:37:11 --> payment req: {
    "txnid": "txn_LE0000CC00190000000000000000000001",
    "user_ip": "1.1.1.1",
    "user_agent": "123123",
    "signature": "affc8cd44dba00db0344279b5757884d4defdd17eeb4b637fc56b8db1b1cd86a28ae3242d5cf9ca22f87cf3a3833bebda4816f5640b8bcfc844c8166c77ffbde"
}
ERROR - 2023-04-07 00:37:11 --> PhonePE req (af23eae0d212b5f442202523a6bc3b6b3e453965abd4d61838e61bb5f56ad49b###1) /pg/v1/pay : {"request":"eyJtZXJjaGFudFRyYW5zYWN0aW9uSWQiOiIxX3R4bl9MRTAwMDBDQzAwMTkwMDAwMDAwMDAwMDAwMDAwMDAwMDAxIiwibWVyY2hhbnRVc2VySWQiOiJDSURfTEUwMDAwQ0MwMDE5MDAwMDAwMDAwMDAwMDAwMDAwMDAwMSIsImFtb3VudCI6MTMyMCwiY2FsbGJhY2tVcmwiOiJodHRwczpcL1wvZXppcGF5LmluXC93ZWJob29rXC9wZV9wYXltZW50IiwibW9iaWxlTnVtYmVyIjoiOTg2NzI0ODU5MSIsImRldmljZUNvbnRleHQiOnsiZGV2aWNlT1MiOiJBTkRST0lEIn0sInBheW1lbnRJbnN0cnVtZW50Ijp7InR5cGUiOiJVUElfSU5URU5UIiwidGFyZ2V0QXBwIjoiY29tLnBob25lcGUuYXBwIn0sIm1lcmNoYW50SWQiOiJFWklQSUtTRVJWSUNFU09OTElORSJ9"}
ERROR - 2023-04-07 00:37:12 --> PhonePE res /pg/v1/pay : {"success":false,"code":"BAD_REQUEST","message":"merchantTransactionId size must be between 1 and 38.","data":{}}
ERROR - 2023-04-07 00:37:12 --> Order res: {"code":801,"error":"merchantTransactionId size must be between 1 and 38.","message":"Invalid requests params","signature":"316518253d41e7bdb9666feb97ddb3de4b196069a89a603475f206918309d7eb876e5690e8e4709ebc66b7185828ec89cd7897965482103a63f469c0be33c5cb"}
ERROR - 2023-04-07 00:50:42 --> order req: {
    "txnid": "txn_LE0000CC001900000000000000000002",
    "amount": 13.2,
    "customer_id": "CID_LE0000CC00190000000000000000000001",
    "customer_firstname": "nitesh",
    "customer_lastname": "nahar",
    "customer_email": "nj.248591@gmail.com",
    "customer_phone": "9867248591",
    "productinfo": "Test Txn",
    "signature": "ef04e9820a6b2c7c002b1d822a423d275fde689404d6d787d887aafafcd1f042a73240d8f9772a369e94f7259ab4c93c1f6be74b81cbc36dde105925e5daee6c"
}
ERROR - 2023-04-07 00:50:42 --> Order res: {"code":200,"txnid":"txn_LE0000CC001900000000000000000002","status":"success","message":"Success","signature":"3c2da887106462c37ee4db2d51f010505ddf993bcc6edd89662ca90d1bd970372e4f3ae557f9761d40542c2473edda91ff74af03824de8cd9c4955ed49da1a0e"}
ERROR - 2023-04-07 00:50:57 --> payment req: {
    "txnid": "txn_LE0000CC001900000000000000000002",
    "user_ip": "1.1.1.1",
    "user_agent": "123123",
    "signature": "77e265f2d287f681119cc7a7c9b975936225654b9f679d5b258e67c44a820b9badc515e28c7ed6cae8d32fb71c41670a1de7d3d927be173cedd138e464501e27"
}
ERROR - 2023-04-07 00:50:58 --> PhonePE req (bfbc59a7243d1337ffa7943f2a9c900507ec92e84eaacc6668505eed9aecbfb6###1) /pg/v1/pay : {"request":"eyJtZXJjaGFudFRyYW5zYWN0aW9uSWQiOiIxX3R4bl9MRTAwMDBDQzAwMTkwMDAwMDAwMDAwMDAwMDAwMDAwMiIsIm1lcmNoYW50VXNlcklkIjoiQ0lEX0xFMDAwMENDMDAxOTAwMDAwMDAwMDAwMDAwMDAwMDAwMDEiLCJhbW91bnQiOjEzMjAsImNhbGxiYWNrVXJsIjoiaHR0cHM6XC9cL2V6aXBheS5pblwvd2ViaG9va1wvcGVfcGF5bWVudCIsIm1vYmlsZU51bWJlciI6Ijk4NjcyNDg1OTEiLCJkZXZpY2VDb250ZXh0Ijp7ImRldmljZU9TIjoiQU5EUk9JRCJ9LCJwYXltZW50SW5zdHJ1bWVudCI6eyJ0eXBlIjoiVVBJX0lOVEVOVCIsInRhcmdldEFwcCI6ImNvbS5waG9uZXBlLmFwcCJ9LCJtZXJjaGFudElkIjoiRVpJUElLU0VSVklDRVNPTkxJTkUifQ=="}
ERROR - 2023-04-07 00:50:58 --> PhonePE res /pg/v1/pay : {"success":true,"code":"PAYMENT_INITIATED","message":"Payment initiated","data":{"merchantId":"EZIPIKSERVICESONLINE","merchantTransactionId":"1_txn_LE0000CC001900000000000000000002","instrumentResponse":{"type":"UPI_INTENT","intentUrl":"upi://pay?pa=EZIPIKSERVICESONLINE@ybl&pn=Ezipik%20Services%20&am=13.20&mam=13.20&tr=1_txn_LE0000CC001900000000000000000002&tn=Payment%20for%201_txn_LE0000CC001900000000000000000002&mc=8999&mode=04&purpose=00&utm_campaign=B2B_PG&utm_medium=EZIPIKSERVICESONLINE&utm_source=1_txn_LE0000CC001900000000000000000002"}}}
ERROR - 2023-04-07 00:50:58 --> Order res: {"code":200,"txnid":"txn_LE0000CC001900000000000000000002","uri":"upi:\/\/pay?pa=EZIPIKSERVICESONLINE@ybl&pn=Ezipik%20Services%20&am=13.20&mam=13.20&tr=1_txn_LE0000CC001900000000000000000002&tn=Payment%20for%201_txn_LE0000CC001900000000000000000002&mc=8999&mode=04&purpose=00&utm_campaign=B2B_PG&utm_medium=EZIPIKSERVICESONLINE&utm_source=1_txn_LE0000CC001900000000000000000002","message":"Success","signature":"c66215335a08b4bacaa3a359dba073dbabb5e07bcdd56b7d017b2977713ecbd24b5460b38c4a9a1f76503d275475c06ba68a01bebbfefd3c09888ca16a32a382"}
ERROR - 2023-04-07 00:53:26 --> txnStatus req: {
    "txnid": "txn_LE0000CC001900000000000000000002",
    "signature": "5eb0da4fec2471116853bdb663b34a0d48f8cdd5498fd7e7097c952029682970dd0145b7e6d592e931575e7655dd55218d2acc93a4dcdd8d936d6665fd94bee4"
}
ERROR - 2023-04-07 00:53:27 --> PhonePE res /pg/v1/status/EZIPIKSERVICESONLINE/1_txn_LE0000CC001900000000000000000002 : {"success":true,"code":"PAYMENT_PENDING","message":"Your request is in pending state.","data":{"merchantId":"EZIPIKSERVICESONLINE","merchantTransactionId":"1_txn_LE0000CC001900000000000000000002","transactionId":null,"amount":1320,"state":"PENDING","responseCode":"PAYMENT_PENDING","paymentInstrument":null}}
ERROR - 2023-04-07 00:53:27 --> TxnStatus res: {"code":200,"txnid":"txn_LE0000CC001900000000000000000002","payment_status":"pending","payment_message":"Payment initiated","message":"Success","signature":"493a2ac198b60837946e59dd0a4739d2be5f26e5fd102a02d197eeeac44329349fc233745aa5c9786aee87842c7dd03bec6d329784e0b901d5399d9c61d13c43"}
ERROR - 2023-04-07 00:54:12 --> txnStatus req: {
    "txnid": "txn_LE0000CC001900000000000000000002",
    "signature": "5eb0da4fec2471116853bdb663b34a0d48f8cdd5498fd7e7097c952029682970dd0145b7e6d592e931575e7655dd55218d2acc93a4dcdd8d936d6665fd94bee4"
}
ERROR - 2023-04-07 00:54:13 --> PhonePE res /pg/v1/status/EZIPIKSERVICESONLINE/1_txn_LE0000CC001900000000000000000002 : {"success":true,"code":"PAYMENT_PENDING","message":"Your request is in pending state.","data":{"merchantId":"EZIPIKSERVICESONLINE","merchantTransactionId":"1_txn_LE0000CC001900000000000000000002","transactionId":null,"amount":1320,"state":"PENDING","responseCode":"PAYMENT_PENDING","paymentInstrument":null}}
ERROR - 2023-04-07 00:54:13 --> TxnStatus res: {"code":200,"txnid":"txn_LE0000CC001900000000000000000002","payment_status":"pending","payment_message":"Payment initiated","message":"Success","signature":"493a2ac198b60837946e59dd0a4739d2be5f26e5fd102a02d197eeeac44329349fc233745aa5c9786aee87842c7dd03bec6d329784e0b901d5399d9c61d13c43"}
ERROR - 2023-04-07 00:55:34 --> txnStatus req: {
    "txnid": "txn_LE0000CC001900000000000000000002",
    "signature": "5eb0da4fec2471116853bdb663b34a0d48f8cdd5498fd7e7097c952029682970dd0145b7e6d592e931575e7655dd55218d2acc93a4dcdd8d936d6665fd94bee4"
}
ERROR - 2023-04-07 00:55:34 --> PhonePE res /pg/v1/status/EZIPIKSERVICESONLINE/1_txn_LE0000CC001900000000000000000002 : {"success":true,"code":"PAYMENT_PENDING","message":"Your request is in pending state.","data":{"merchantId":"EZIPIKSERVICESONLINE","merchantTransactionId":"1_txn_LE0000CC001900000000000000000002","transactionId":null,"amount":1320,"state":"PENDING","responseCode":"PAYMENT_PENDING","paymentInstrument":null}}
ERROR - 2023-04-07 00:55:34 --> TxnStatus res: {"code":200,"txnid":"txn_LE0000CC001900000000000000000002","payment_status":"pending","payment_message":"Payment initiated","message":"Success","signature":"493a2ac198b60837946e59dd0a4739d2be5f26e5fd102a02d197eeeac44329349fc233745aa5c9786aee87842c7dd03bec6d329784e0b901d5399d9c61d13c43"}
ERROR - 2023-04-07 00:56:08 --> txnStatus req: {
    "txnid": "txn_LE0000CC001900000000000000000002",
    "signature": "5eb0da4fec2471116853bdb663b34a0d48f8cdd5498fd7e7097c952029682970dd0145b7e6d592e931575e7655dd55218d2acc93a4dcdd8d936d6665fd94bee4"
}
ERROR - 2023-04-07 00:56:10 --> PhonePE res /pg/v1/status/EZIPIKSERVICESONLINE/1_txn_LE0000CC001900000000000000000002 : {"success":true,"code":"PAYMENT_PENDING","message":"Your request is in pending state.","data":{"merchantId":"EZIPIKSERVICESONLINE","merchantTransactionId":"1_txn_LE0000CC001900000000000000000002","transactionId":null,"amount":1320,"state":"PENDING","responseCode":"PAYMENT_PENDING","paymentInstrument":null}}
ERROR - 2023-04-07 00:56:10 --> TxnStatus res: {"code":200,"txnid":"txn_LE0000CC001900000000000000000002","payment_status":"pending","payment_message":"Payment initiated","message":"Success","signature":"493a2ac198b60837946e59dd0a4739d2be5f26e5fd102a02d197eeeac44329349fc233745aa5c9786aee87842c7dd03bec6d329784e0b901d5399d9c61d13c43"}
ERROR - 2023-04-07 00:57:48 --> txnStatus req: {
    "txnid": "txn_LE0000CC001900000000000000000002",
    "signature": "5eb0da4fec2471116853bdb663b34a0d48f8cdd5498fd7e7097c952029682970dd0145b7e6d592e931575e7655dd55218d2acc93a4dcdd8d936d6665fd94bee4"
}
ERROR - 2023-04-07 00:57:50 --> PhonePE res /pg/v1/status/EZIPIKSERVICESONLINE/1_txn_LE0000CC001900000000000000000002 : {"success":true,"code":"PAYMENT_PENDING","message":"Your request is in pending state.","data":{"merchantId":"EZIPIKSERVICESONLINE","merchantTransactionId":"1_txn_LE0000CC001900000000000000000002","transactionId":null,"amount":1320,"state":"PENDING","responseCode":"PAYMENT_PENDING","paymentInstrument":null}}
ERROR - 2023-04-07 00:57:50 --> TxnStatus res: {"code":200,"txnid":"txn_LE0000CC001900000000000000000002","payment_status":"pending","payment_message":"Payment initiated","message":"Success","signature":"493a2ac198b60837946e59dd0a4739d2be5f26e5fd102a02d197eeeac44329349fc233745aa5c9786aee87842c7dd03bec6d329784e0b901d5399d9c61d13c43"}
ERROR - 2023-04-07 01:01:38 --> txnStatus req: {
    "txnid": "txn_LE0000CC001900000000000000000002",
    "signature": "5eb0da4fec2471116853bdb663b34a0d48f8cdd5498fd7e7097c952029682970dd0145b7e6d592e931575e7655dd55218d2acc93a4dcdd8d936d6665fd94bee4"
}
ERROR - 2023-04-07 01:01:40 --> PhonePE res /pg/v1/status/EZIPIKSERVICESONLINE/1_txn_LE0000CC001900000000000000000002 : {"success":false,"code":"PAYMENT_ERROR","message":"Payment Failed","data":{"merchantId":"EZIPIKSERVICESONLINE","merchantTransactionId":"1_txn_LE0000CC001900000000000000000002","transactionId":null,"amount":1320,"state":"FAILED","responseCode":"PAYMENT_ERROR","paymentInstrument":null}}
ERROR - 2023-04-07 01:01:40 --> TxnStatus res: {"code":801,"txnid":"txn_LE0000CC001900000000000000000002","error":"Payment Failed","message":"Invalid requests params","signature":"0cf35882efccaf972b07807a940e0651e2ffe97df1e2fc29b55bef0b2867c7e357ae29133fc3934c7f8f177a030199fe6983bd543fddd42413b69ed28a9759c5"}
ERROR - 2023-04-07 01:03:34 --> txnStatus req: {
    "txnid": "txn_LE0000CC001900000000000000000002",
    "signature": "5eb0da4fec2471116853bdb663b34a0d48f8cdd5498fd7e7097c952029682970dd0145b7e6d592e931575e7655dd55218d2acc93a4dcdd8d936d6665fd94bee4"
}
ERROR - 2023-04-07 01:03:35 --> PhonePE res /pg/v1/status/EZIPIKSERVICESONLINE/1_txn_LE0000CC001900000000000000000002 : {"success":false,"code":"PAYMENT_ERROR","message":"Payment Failed","data":{"merchantId":"EZIPIKSERVICESONLINE","merchantTransactionId":"1_txn_LE0000CC001900000000000000000002","transactionId":null,"amount":1320,"state":"FAILED","responseCode":"PAYMENT_ERROR","paymentInstrument":null}}
ERROR - 2023-04-07 01:03:35 --> TxnStatus res: {"code":801,"txnid":"txn_LE0000CC001900000000000000000002","error":"Payment Failed","message":"Invalid requests params","signature":"0cf35882efccaf972b07807a940e0651e2ffe97df1e2fc29b55bef0b2867c7e357ae29133fc3934c7f8f177a030199fe6983bd543fddd42413b69ed28a9759c5"}
ERROR - 2023-04-07 01:04:54 --> txnStatus req: {
    "txnid": "txn_LE0000CC001900000000000000000002",
    "signature": "5eb0da4fec2471116853bdb663b34a0d48f8cdd5498fd7e7097c952029682970dd0145b7e6d592e931575e7655dd55218d2acc93a4dcdd8d936d6665fd94bee4"
}
ERROR - 2023-04-07 01:04:54 --> PhonePE res /pg/v1/status/EZIPIKSERVICESONLINE/1_txn_LE0000CC001900000000000000000002 : {"success":false,"code":"PAYMENT_ERROR","message":"Payment Failed","data":{"merchantId":"EZIPIKSERVICESONLINE","merchantTransactionId":"1_txn_LE0000CC001900000000000000000002","transactionId":null,"amount":1320,"state":"FAILED","responseCode":"PAYMENT_ERROR","paymentInstrument":null}}
ERROR - 2023-04-07 01:04:55 --> TxnStatus res: {"code":200,"txnid":"txn_LE0000CC001900000000000000000002","payment_status":"failed","payment_message":"Payment Failed","message":"Success","signature":"2fbc9d5f939260b98712333589af41e86985ff564d10a852e71076117b1c511214731ad8ad694e0728af19ed8ada3556298b28514f38f95adf7f7f9ca611b950"}
ERROR - 2023-04-07 01:22:16 --> order req: {
    "txnid": "txn_LE0000CC00190000000000000000003",
    "amount": 11.2,
    "customer_id": "CID_LE0000CC00190000000000000000000001",
    "customer_firstname": "nitesh",
    "customer_lastname": "nahar",
    "customer_email": "nj.248591@gmail.com",
    "customer_phone": "9867248591",
    "productinfo": "Test Txn",
    "signature": "7647e15731fbae443af5be908c54d0e18836c8aba5883dd5a67e6d637015fa79f304059f552ca1dd783ea826e578d9da10edf6731dac3acaccfbcafcaf898d95"
}
ERROR - 2023-04-07 01:22:16 --> Order res: {"code":200,"txnid":"txn_LE0000CC00190000000000000000003","status":"success","message":"Success","signature":"87ca54b467ab80512fb49c6350727e216a6ddf061bbce364d4c031b84ee9ee61a9260906023a17a1a81ca361340d1a94b1175d1ba1ab7f9b2523c3580bff2e72"}
ERROR - 2023-04-07 01:22:34 --> payment req: {
    "txnid": "txn_LE0000CC00190000000000000000003",
    "user_ip": "1.1.1.1",
    "user_agent": "123123",
    "signature": "2ac5055c030d208f87d7d0b6b3453242ddfb5851251236b9e06ba6bbaa97c51d56610334ba9fc819d70efb57220e8be5e0fd95962afc1bede58ac871b7608def"
}
ERROR - 2023-04-07 01:22:34 --> PhonePE req (f8970dfa496471bc16fcb56f9e632eee239a4a0993609f1487a8aaec35498409###1) /pg/v1/pay : {"request":"eyJtZXJjaGFudFRyYW5zYWN0aW9uSWQiOiIxX3R4bl9MRTAwMDBDQzAwMTkwMDAwMDAwMDAwMDAwMDAwMDAzIiwibWVyY2hhbnRVc2VySWQiOiJDSURfTEUwMDAwQ0MwMDE5MDAwMDAwMDAwMDAwMDAwMDAwMDAwMSIsImFtb3VudCI6MTEyMCwiY2FsbGJhY2tVcmwiOiJodHRwczpcL1wvZXppcGF5LmluXC93ZWJob29rXC9wZV9wYXltZW50IiwibW9iaWxlTnVtYmVyIjoiOTg2NzI0ODU5MSIsImRldmljZUNvbnRleHQiOnsiZGV2aWNlT1MiOiJBTkRST0lEIn0sInBheW1lbnRJbnN0cnVtZW50Ijp7InR5cGUiOiJVUElfSU5URU5UIiwidGFyZ2V0QXBwIjoiY29tLnBob25lcGUuYXBwIn0sIm1lcmNoYW50SWQiOiJFWklQSUtTRVJWSUNFU09OTElORSJ9"}
ERROR - 2023-04-07 01:22:40 --> PhonePE res /pg/v1/pay : {"success":true,"code":"PAYMENT_INITIATED","message":"Payment initiated","data":{"merchantId":"EZIPIKSERVICESONLINE","merchantTransactionId":"1_txn_LE0000CC00190000000000000000003","instrumentResponse":{"type":"UPI_INTENT","intentUrl":"upi://pay?pa=EZIPIKSERVICESONLINE@ybl&pn=Ezipik%20Services%20&am=11.20&mam=11.20&tr=1_txn_LE0000CC00190000000000000000003&tn=Payment%20for%201_txn_LE0000CC00190000000000000000003&mc=8999&mode=04&purpose=00&utm_campaign=B2B_PG&utm_medium=EZIPIKSERVICESONLINE&utm_source=1_txn_LE0000CC00190000000000000000003"}}}
ERROR - 2023-04-07 01:22:40 --> Order res: {"code":200,"txnid":"txn_LE0000CC00190000000000000000003","uri":"upi:\/\/pay?pa=EZIPIKSERVICESONLINE@ybl&pn=Ezipik%20Services%20&am=11.20&mam=11.20&tr=1_txn_LE0000CC00190000000000000000003&tn=Payment%20for%201_txn_LE0000CC00190000000000000000003&mc=8999&mode=04&purpose=00&utm_campaign=B2B_PG&utm_medium=EZIPIKSERVICESONLINE&utm_source=1_txn_LE0000CC00190000000000000000003","message":"Success","signature":"e0940c84be97e096836a52a123fed855e25c3007b2f16c067a86eb45a0726b90e2887f02386319852a8cf137934f4a9a87097c5d9bcba0f2a6aa1ab9c93d2bf2"}
ERROR - 2023-04-07 01:26:10 --> txnStatus req: {
    "txnid": "txn_LE0000CC00190000000000000000003",
    "signature": "f987e302ea4c0afc9face7e7153c0d0e97fba76cccdde08fc25d7f7a60e56f9635775cf4b7ec4ffb54c3515e0c1c8b30309d5263f9f60adf7849bdbeb0787e78"
}
ERROR - 2023-04-07 01:26:11 --> PhonePE res /pg/v1/status/EZIPIKSERVICESONLINE/1_txn_LE0000CC00190000000000000000003 : {"success":true,"code":"PAYMENT_PENDING","message":"Your request is in pending state.","data":{"merchantId":"EZIPIKSERVICESONLINE","merchantTransactionId":"1_txn_LE0000CC00190000000000000000003","transactionId":null,"amount":1120,"state":"PENDING","responseCode":"PAYMENT_PENDING","paymentInstrument":null}}
ERROR - 2023-04-07 01:26:11 --> TxnStatus res: {"code":200,"txnid":"txn_LE0000CC00190000000000000000003","payment_status":"pending","payment_message":"Payment initiated","message":"Success","signature":"eabcfd522d3a4d8754504a056eff1762a8a131df9790c440369d5eede7df57581a13e4ee83e964a38caf44b7ec1b62025cbd652352a6a1f0fb87cb025c83ae0c"}
ERROR - 2023-04-07 02:01:52 --> 404 Page Not Found: Assets/admin
ERROR - 2023-04-07 02:03:39 --> txnStatus req: {
    "txnid": "txn_Ez000CC0000200000000000003",
    "signature": "1cbe2dcf10ac721d92623d6cebaf87abc7d4def598023028539923a52e15dc850529fa77dea550a9d7d151e2326838a52e44aa12112104542700aa0139af04b3"
}
ERROR - 2023-04-07 02:03:39 --> TxnStatus res: {"code":103,"message":"Signature provided is invalid","signature":"8e27f3a8d47d48c0faf47a6703d2391d3086efc53ebd93c7908cc4dbb8028a5008d033126d1e10e2c4147987cd113e1d75fb7f23d70a465a3f896bb1733bc238"}
ERROR - 2023-04-07 22:38:33 --> 404 Page Not Found: Assets/admin
ERROR - 2023-04-07 22:38:40 --> 404 Page Not Found: Assets/admin
