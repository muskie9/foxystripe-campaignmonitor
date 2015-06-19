<?php


class Foxy2CM_Controller extends Page_Controller{

	const URLSegment = 'Foxy2CM';

	private static $allowed_actions = array(
		'index'
	);

	public function init(){
		parent::init();


	}

	public function getURLSegment() {
		return self::URLSegment;
	}

	public static function getFoxy2CMURL(){
		return Controller::join_links(Director::absoluteBaseURL(), self::URLSegment);
	}

    /**
     * Controller function to process whether a
     * user opted into the newsletter
     *
     * @todo add notices if keys aren't set
     */
    public function index(){

        ///// BEGIN Configuration //////

        $CampaignMonitor_API_Key = Config::inst()->get('Foxy2CM', 'APIKey'); // Replace YOURAPIKEYHERE with your CampaignMonitor API Key.
                                                     // How to find that?  Glad you asked, go here:
                                                     // http://www.campaignmonitor.com/api/required/ to find this and the next few keys.

        //$CampaignMonitor_Client_ID = Config::inst()->get('Foxy2CM', 'ClientID');    // Replace CLIENTID with the Campaign Monitor Client ID.  See the above link.
        $CampaignMonitor_List_ID = Config::inst()->get('Foxy2CM', 'ListID');        // Replace LISTID with the Campaign Monitor List ID.  See the above link.

        /**
         * Use a custom field during checkout?  If true, check for the presence of $Custom_Field below.
         * If false, always subscribe the customer.  Use wisely.
         */
        $Use_Custom_Field = true;

        $Custom_Field = 'newsletter_subscribe';    // Name of the custom "Opt In" field during checkout.
        $Custom_Field_Value = '1';    // The value of the custom field that indicates the customer's agreement.

        ////// END Configuration ///////


        if(isset($_POST['FoxyData'])) {



			$FoxyData = rc4crypt::decrypt(FoxyCart::getStoreKey(),$_POST['FoxyData']);

			$data = new SimpleXMLElement($FoxyData);   // Parse that XML.

			foreach ($data->transactions->transaction as $tx) {
				$subscribe = !$Use_Custom_Field;

				if ($Use_Custom_Field && isset($tx->custom_fields) && isset($tx->custom_fields->custom_field)) {
					foreach ($tx->custom_fields->custom_field as $field) {
						$subscribe = $subscribe ||
							($field->custom_field_name == $Custom_Field &&
								$field->custom_field_value == $Custom_Field_Value);
					}
				}

				if ($subscribe) {
					$customerName = $tx->customer_first_name. " ".$tx->customer_last_name;
					$email = $tx->customer_email;
					self::subscribeUserToList(
						$CampaignMonitor_API_Key,
						$CampaignMonitor_List_ID,
						array(
							'EmailAddress' => $email,
							'Name' => $customerName,
							'Resubscribe' => true
						)
					);
				}
			}

			return "foxy";
		} else {
			return "No FoxyData or FoxySubscriptionData received.";
		}
    }

	/**
	 * @param string $apiKey
	 * @param string $listID
	 * @param array $user
	 * @return string
	 */
    private static function subscribeUserToList($apiKey,$listID, array $user){
		$wrap = new CS_REST_Subscribers($listID, $apiKey, $protocol = 'https');/*,
			$debug_level = CS_REST_LOG_VERBOSE,
			$host = 'api.createsend.com',
			$log = NULL,
			$serialiser = NULL,
			$transport = NULL);*/
			ChromePhp::log($user);
			ChromePhp::log('test');
		$result = $wrap->add(
			$user
		);
		if($result->was_successful()) {
			//ChromePhp::log('Failed with code '.$result->http_status_code, SS_Log::WARN);
			return "foxy";
		} else {
			ChromePhp::log('Failed with code '.$result->http_status_code, SS_Log::WARN);
			//SS_Log::log('Failed with code '.$result->http_status_code, SS_Log::WARN);
			//SS_Log::log('Name'. $user[0], SS_Log::WARN);
			//SS_Log::log('Email'. $user[1], SS_Log::WARN);
			//echo $user['EmailAddress'];
			//var_dump($user);
		}
	}

}