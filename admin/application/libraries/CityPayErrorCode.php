<?php
/**
 * CityPay uses checksum signature to ensure that API requests and responses shared between your 
 * application and CityPay over network have not been tampered with. We use SHA256 hashing and 
 * AES128 encryption algorithm to ensure the safety of transaction data.
 *
 */

class CityPayErrorCode{

	static public function getErrorMessage($code) {
		//700 series for razor pay
		//800 series for payu
		$error_message = array(
							000 => "Unkonown Error",
							200 => "Success",
							101 => "Invalid merchant key in query parameters",
							102 => "Missing mandatory element",
							103 => "Signature provided is invalid",
							104 => "Duplicate Reference id",
							105 => "Invalid customer id",
							106 => "Invalid fund account id",
							107 => "Invalid Reference / Txn id",
							108 => "Invalid Order id",
							109 => "Invalid Payment Txn id or Txn is not sucessful",
							110 => "Refund Txn already present",
							111 => "Invalid Refund Amount",
							801 => "Invalid requests params",
							901 => "Check Error Message"
						);

		return $error_message[$code];


	}

	static public function payoutTxnStatus() {
		return array('pending','processing','processed','rejected','queued','cancelled','reversed');
	}


	static public function getStatusMessage($status) {
		$error_message = array(
							"pending" => "This transaction will be processed in next batch",
							"processing" => "This transaction is initiated and is under process",
							"processed" => "This transaction is completed successfully",
							"rejected" => "This transaction is rejected",
							"queued" => "This transaction is queued for processing",
							"cancelled" => "This transaction is cancelled",
							"reversed" => "This transaction is reversed"
						);

		return $error_message[$status];


	}

	static public function payInTxnStatus(){
		return array('pending','success','failed');
	}

	static public function payInSettlementStatus(){
		return array('processing','initiated','pending','success','failure');
	}






	
}



