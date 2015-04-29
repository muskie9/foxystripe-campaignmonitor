<?php

class FS_CampaignMonitor_Controller extends ContentController {

    const URLSegment = 'foxystripe-campaignmonitor';

    private static $allowed_actions = array(
        'CampaignMonitorHook'
    );

    public function CampaignMonitorHook(){
        $CampaignMonitor_API_Key = "YOURAPIKEYHERE"; // Replace YOURAPIKEYHERE with your CampaignMonitor API Key.
        // How to find that?  Glad you asked, go here:
        // http://www.campaignmonitor.com/api/required/ to find this and the next few keys.

        $CampaignMonitor_Client_ID = "CLIENTID";    // Replace CLIENTID with the Campaign Monitor Client ID.  See the above link.
        $CampaignMonitor_List_ID = "LISTID";        // Replace LISTID with the Campaign Monitor List ID.  See the above link.

        /**
         * Use a custom field during checkout?  If true, check for the presence of $Custom_Field below.
         * If false, always subscribe the customer.  Use wisely.
         */
        $Use_Custom_Field = true;

        $Custom_Field = 'Subscribe';    // Name of the custom "Opt In" field during checkout.
        $Custom_Field_Value = 'yes';    // The value of the custom field that indicates the customer's agreement.

        $key = SiteConfig::current_site_config()->StoreKey;

////// END Configuration ///////


        $_POST['FoxyData'] or die("error"); // Make sure we got passed some FoxyData

        function fatal_error_handler($errno, $errstr, $errfile, $errline, $errcontext) {
            die($errstr);
            return true;
        }
        set_error_handler(fatal_error_handler);

        $FoxyData = rc4crypt::decrypt($key, urldecode($_POST["FoxyData"]));

        $data = new XMLParser($FoxyData);   // Parse that XML.
        $data->Parse();

        foreach ($data->document->transactions[0]->transaction as $tx) {
            $subscribe = !$Use_Custom_Field;

            if ($Use_Custom_Field && isset($tx->custom_fields[0]) && isset($tx->custom_fields[0]->custom_field)) {
                foreach ($tx->custom_fields[0]->custom_field as $field) {
                    $subscribe = $subscribe ||
                        ($field->custom_field_name[0]->tagData == $Custom_Field &&
                            $field->custom_field_value[0]->tagData == $Custom_Field_Value);
                }
            }

            if ($subscribe) {
                subscribe_user_to_list(// See CampaignMonitorUtils.php for documentation.
                    array('first_name' => $tx->customer_first_name[0]->tagData,
                        'last_name' => $tx->customer_last_name[0]->tagData,
                        'email' => $tx->customer_email[0]->tagData),
                    $CampaignMonitor_API_Key,
                    $CampaignMonitor_Client_ID,
                    $CampaignMonitor_List_ID);
            }
        }

        print "foxy";
    }


    /**
     * Given a user, the name of a CampaignMonitor list, and the CampaignMonitor API credentials,
     * subscribe user to named list. <b>Will die() on any errors from CampaignMonitor.</b>
     *
     * @param array $user	Contains the information about the user to subscribe.  Keys:
     *                     'first_name'         => string; the user's first name
     *                     'last_name'          => string; the user's last name
     *                     'email'              => string; the user's email address
     *
     * @param string $list_name     The name of the list to subscribe to.
     *
     * @param string $api_key       The Campaign Monitor API key, go to:
     *                              http://www.campaignmonitor.com/api/required/ to find this and the next few keys.
     * @param string $client_id     Campaign Monitor client ID
     * @param string $campaign_id   Campaign Monitor campaign ID
     * @param string $list_id       Campaign Monitor list ID
     *
     * @return  boolean             Returns true if member subscribed to the list.
     */
    function subscribe_user_to_list($user, $api_key, $client_id, $list_id) {
        $cm = new CampaignMonitor($api_key, $client_id, null, $list_id);

        $cm or die("Unable to connect to CampaignMonitor API, error: ".$cm->errorMessage);

        $result = $cm->subscriberAddWithCustomFields($user['email'],
            $user['email'], $user['first_name'] . ' ' . $user['last_name']);

        ($result['Code'] == 0 or preg_match("/already subscribed/i", $result['Message']) or preg_match("/Email Address exists/i", $result['Message'])) or
        die("Unable to load call subscriberAddWithCustomFields()! " .
            "CampaignMonitor reported error:\n\tCode=" . $result['Code'] .
            "\n\tMsg=" . $result['Message'] . "\n");

        return true;    // All's well.
    }

}