<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2023-03-22 00:34:33 --> 404 Page Not Found: Assets/admin
ERROR - 2023-03-22 00:40:45 --> refund req: {
    "txnid": "txn_LE0000CC0005",
    "refund_amount": 12,
    "refund_txnid": "rfndLocal10010",
    "signature": "8779fe18f22f0cbafcfd442a1c2f23f38f4cbd9eb1335967a7b915ed3e617857b224d0d08e428cda62451fd331557c8ceb5def136f6bbfcf000eefe8eb43c641"
}
ERROR - 2023-03-22 00:40:45 --> Severity: error --> Exception: syntax error, unexpected ':', expecting ')' /Applications/MAMP/htdocs/ezipay/application/libraries/Paytm.php 274
ERROR - 2023-03-22 00:40:59 --> refund req: {
    "txnid": "txn_LE0000CC0005",
    "refund_amount": 12,
    "refund_txnid": "rfndLocal10010",
    "signature": "8779fe18f22f0cbafcfd442a1c2f23f38f4cbd9eb1335967a7b915ed3e617857b224d0d08e428cda62451fd331557c8ceb5def136f6bbfcf000eefe8eb43c641"
}
ERROR - 2023-03-22 00:40:59 --> Paytm req https://securegw.paytm.in/refund/apply : "{\"body\":{\"mid\":\"PfQyrM62428488276569\",\"txnType\":\"REFUND\",\"orderId\":\"1_txn_LE0000CC0005\",\"txnId\":\"20230321010340000844951948183999623\",\"refId\":\"1_rfndLocal10010\",\"refundAmount\":12},\"head\":{\"signature\":\"cDQPkI6Cr6mYGJb\/T6+RdbKvx92CMQmBNgCdJ1lgbyX6HPS86V8gwnT2fxNju8eZr2Yd6wQ6Y9NkhBM+K635Dz9lBcXNp9Q+aVbIa68N9V4=\",\"clientId\":\"C11\"}}"
ERROR - 2023-03-22 00:41:00 --> Paytm res https://securegw.paytm.in/refund/apply : {"head":{"clientId":"C11","responseTimestamp":"1679425860500","signature":"cCI4aB\/Soq9QLYnEytymXNXOqkCOB1vv+wfmUyC\/xj44q5G8bVMHHQu90O7uQ9CnCgjWYPj70eKiE86tTcWty6VCG6qD\/t6QGzYNFJ\/bIso=","version":"v1"},"body":{"txnTimestamp":"2023-03-21 14:57:22.0","orderId":"1_txn_LE0000CC0005","mid":"PfQyrM62428488276569","refId":"1_rfndLocal10010","resultInfo":{"resultStatus":"PENDING","resultCode":"601","resultMsg":"Refund request was raised for this transaction. But it is pending state"},"refundId":"20230322020368450988222659584019623","txnId":"20230321010340000844951948183999623","refundAmount":"12"}}
ERROR - 2023-03-22 00:41:00 --> Refund res: {"code":200,"refund_txnid":"rfndLocal10010","refund_status":"pending","refund_description":"Refund request was raised for this transaction. But it is pending state","refund_arn":"","message":"Success","signature":"f686fe896a54705dece5a4eedaab72e968243d8e68114e2c954a072ee33b4948caca4d1e26aff361f91aaa1fc8289fde1581cafdaf23c232a71e67a1b9c79db6"}
ERROR - 2023-03-22 00:43:33 --> Paytm req https://securegw.paytm.in/v2/refund/status : "{\"body\":{\"mid\":\"PfQyrM62428488276569\",\"orderId\":\"1_txn_LE0000CC0005\",\"refId\":\"1_rfndLocal10010\"},\"head\":{\"signature\":\"E8JmnHvrnWMhHirVDX04R\/LG8jq3pZZO7oHa6c7f9iNCgjW6kUeku1Ud7XPQIhPMLoBmafYtpsjgMFu9jVoBVtcxGVCOA0XZ1GxpQHWUKzc=\",\"clientId\":\"C11\"}}"
ERROR - 2023-03-22 00:43:33 --> Paytm res https://securegw.paytm.in/v2/refund/status : {"head":{"clientId":"C11","responseTimestamp":"1679426013653","signature":"nQhEuZgUMxHnrrAAkMeLZ1W3tq7jOoeeK0U9THQ2TJ3j0k9GeueqG1G6dEUGupRrRz8ULAmObXTu4AAxX\/HQlHjN9WV6PzSjtgjKwXlx+zg=","version":"v1"},"body":{"agentInfo":{"name":"","employeeId":"","phoneNo":"","email":""},"orderId":"1_txn_LE0000CC0005","userCreditInitiateStatus":"SUCCESS","mid":"PfQyrM62428488276569","merchantRefundRequestTimestamp":"2023-03-22 00:41:00.0","source":"MERCHANT","resultInfo":{"resultStatus":"TXN_SUCCESS","resultCode":"10","resultMsg":"Refund Successfull"},"txnTimestamp":"2023-03-21 14:57:22.0","acceptRefundTimestamp":"2023-03-22 00:41:00.0","acceptRefundStatus":"SUCCESS","refundDetailInfoList":[{"refundType":"TO_SOURCE","payMethod":"UPI","userCreditExpectedDate":"2023-03-22 01:41:03.0","maskedVpa":"******8591@paytm","rrn":"308105343037","refundAmount":"12.00"}],"userCreditInitiateTimestamp":"2023-03-22 00:41:03.0","totalRefundAmount":"12.00","refId":"1_rfndLocal10010","txnAmount":"12.20","refundId":"20230322020368450988222659584019623","txnId":"20230321010340000844951948183999623","refundAmount":"12.00"}}
ERROR - 2023-03-22 01:10:47 --> 404 Page Not Found: Merchant/average_transactions
