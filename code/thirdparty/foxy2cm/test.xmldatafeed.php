<?php
/*
	test.xmldatafeed.php
	
	The purpose of this file is to help you set up and debug your FoxyCart XML DataFeed scripts.
	It's designed to mimic FoxyCart.com and send encrypted and encoded XML to a URL of your choice.
	It will print out the response that your script gives back, which should be "foxy" if successful.
	
	NOTE: This script uses cURL, which isn't always enabled, especially on shared hosting.
	
*/

// ======================================================================================
// CHANGE THIS DATA:
// Set the URL you want to post the XML to.
// Set the key you entered in your FoxyCart.com admin.
// Modify the XML below as necessary.  DO NOT modify the structure, just the data
// ======================================================================================
$myURL = 'http://silverstripe.dev/foxystripe/';
$myKey = 'dYnm1cWDc1OFM1cDFnOU41U2dGdjMxWmhVaEYzRmZvUFFiMkNUNFFuRGRVaV';

// This is FoxyCart Version 0.6 XML.  See http://wiki.foxycart.com/docs:datafeed?s[]=xml
$XMLOutput = <<<XML
<?xml version='1.0' encoding='UTF-8' standalone='yes'?>
<foxydata>
    <store_version><![CDATA[2.0]]></store_version>
    <transactions>
        <transaction>
            <id><![CDATA[719176718]]></id>
            <store_id><![CDATA[37914]]></store_id>
            <store_version><![CDATA[2.0]]></store_version>
            <is_test><![CDATA[1]]></is_test>
            <is_hidden><![CDATA[0]]></is_hidden>
            <data_is_fed><![CDATA[1]]></data_is_fed>
            <transaction_date><![CDATA[2015-06-10 12:50:45]]></transaction_date>
            <payment_type><![CDATA[plastic]]></payment_type>
            <payment_gateway_type><![CDATA[authorize]]></payment_gateway_type>
            <processor_response><![CDATA[Authorize.net Transaction ID:2234904787]]></processor_response>
            <processor_response_details></processor_response_details>
            <purchase_order><![CDATA[]]></purchase_order>
            <cc_number_masked><![CDATA[xxxxxxxxxxxx4242]]></cc_number_masked>
            <cc_type><![CDATA[Visa]]></cc_type>
            <cc_exp_month><![CDATA[07]]></cc_exp_month>
            <cc_exp_year><![CDATA[2024]]></cc_exp_year>
            <minfraud_score><![CDATA[0]]></minfraud_score>
            <paypal_payer_id><![CDATA[]]></paypal_payer_id>
            <third_party_id><![CDATA[]]></third_party_id>
            <customer_id><![CDATA[19360588]]></customer_id>
            <is_anonymous><![CDATA[0]]></is_anonymous>
            <customer_first_name><![CDATA[Nic]]></customer_first_name>
            <customer_last_name><![CDATA[Horstmeier]]></customer_last_name>
            <customer_company><![CDATA[]]></customer_company>
            <customer_address1><![CDATA[5334 Agatha Turn]]></customer_address1>
            <customer_address2><![CDATA[]]></customer_address2>
            <customer_city><![CDATA[RACINE]]></customer_city>
            <customer_state><![CDATA[WI]]></customer_state>
            <customer_postal_code><![CDATA[53402]]></customer_postal_code>
            <customer_country><![CDATA[US]]></customer_country>
            <customer_phone><![CDATA[]]></customer_phone>
            <customer_email><![CDATA[nhorstmeier@dynamicagency.com]]></customer_email>
            <customer_ip><![CDATA[98.144.38.231]]></customer_ip>
            <shipping_first_name><![CDATA[Nic]]></shipping_first_name>
            <shipping_last_name><![CDATA[Horstmeier]]></shipping_last_name>
            <shipping_company><![CDATA[]]></shipping_company>
            <shipping_address1><![CDATA[12345 Some Place]]></shipping_address1>
            <shipping_address2><![CDATA[]]></shipping_address2>
            <shipping_city><![CDATA[Sheboygan]]></shipping_city>
            <shipping_state><![CDATA[WI]]></shipping_state>
            <shipping_postal_code><![CDATA[53081]]></shipping_postal_code>
            <shipping_country><![CDATA[US]]></shipping_country>
            <shipping_phone><![CDATA[]]></shipping_phone>
            <shipto_shipping_service_description><![CDATA[USPS Priority Mail Express 1-Day Flat Rate Boxes]]></shipto_shipping_service_description>
            <product_total><![CDATA[39.95]]></product_total>
            <tax_total><![CDATA[0]]></tax_total>
            <shipping_total><![CDATA[44.95]]></shipping_total>
            <order_total><![CDATA[84.9]]></order_total>
            <receipt_url><![CDATA[https://cm-test.foxycart.com/receipt?id=121d1d3ac483355923069f5de927dc295146c48451f1f3c0ce07e0e5faa9613b]]></receipt_url>
            <taxes></taxes>
            <discounts></discounts>
            <customer_password><![CDATA[dca191b07da5e443ca2f1ffd3e73412795811cd1]]></customer_password>
            <customer_password_salt><![CDATA[43CU9KU6sMN1h37pWTtFZ9HGjsHeUiiSfPCjusfQ5X]]></customer_password_salt>
            <customer_password_hash_type><![CDATA[sha1_salted_suffix]]></customer_password_hash_type>
            <customer_password_hash_config><![CDATA[42]]></customer_password_hash_config>
            <custom_fields>
                <custom_field>
                    <custom_field_name><![CDATA[newsletter_subscribe]]></custom_field_name>
                    <custom_field_value><![CDATA[1]]></custom_field_value>
                    <custom_field_is_hidden><![CDATA[0]]></custom_field_is_hidden>
                </custom_field>
            </custom_fields>
            <transaction_details>
                <transaction_detail>
                    <product_name><![CDATA[BD1]]></product_name>
                    <product_price><![CDATA[39.95]]></product_price>
                    <product_quantity><![CDATA[1]]></product_quantity>
                    <quantity_min><![CDATA[0]]></quantity_min>
                    <quantity_max><![CDATA[0]]></quantity_max>
                    <product_weight><![CDATA[1.000]]></product_weight>
                    <product_code><![CDATA[BD1]]></product_code>
                    <parent_code><![CDATA[]]></parent_code>
                    <image><![CDATA[]]></image>
                    <url><![CDATA[]]></url>
                    <length><![CDATA[0]]></length>
                    <width><![CDATA[0]]></width>
                    <height><![CDATA[0]]></height>
                    <expires><![CDATA[0]]></expires>
                    <downloadable_url><![CDATA[]]></downloadable_url>
                    <sub_token_url><![CDATA[]]></sub_token_url>
                    <subscription_frequency><![CDATA[]]></subscription_frequency>
                    <subscription_startdate><![CDATA[0000-00-00]]></subscription_startdate>
                    <subscription_nextdate><![CDATA[0000-00-00]]></subscription_nextdate>
                    <subscription_enddate><![CDATA[0000-00-00]]></subscription_enddate>
                    <is_future_line_item><![CDATA[0]]></is_future_line_item>
                    <shipto><![CDATA[]]></shipto>
                    <category_description><![CDATA[Default for all products]]></category_description>
                    <category_code><![CDATA[DEFAULT]]></category_code>
                    <product_delivery_type><![CDATA[shipped]]></product_delivery_type>
                    <transaction_detail_options>
                        <transaction_detail_option>
                            <product_option_name><![CDATA[product_id]]></product_option_name>
                            <product_option_value><![CDATA[7]]></product_option_value>
                            <price_mod><![CDATA[0]]></price_mod>
                            <weight_mod><![CDATA[0.000]]></weight_mod>
                        </transaction_detail_option>
                    </transaction_detail_options>
                </transaction_detail>
            </transaction_details>
            <shipto_addresses></shipto_addresses>
            <attributes></attributes>
            <status><![CDATA[]]></status>
        </transaction>
    </transactions>
</foxydata>
XML;


// ======================================================================================
// ENCRYPT YOUR XML
// Modify the include path to go to the rc4crypt file.
// ======================================================================================
include '../../../../foxystripe/thirdparty/rc4crypt.php';
$XMLOutput_encrypted = rc4crypt::encrypt($myKey,$XMLOutput);
$XMLOutput_encrypted = urlencode($XMLOutput_encrypted);


// ======================================================================================
// POST YOUR XML TO YOUR SITE
// Do not modify.
// ======================================================================================
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $myURL);
curl_setopt($ch, CURLOPT_POSTFIELDS, array("FoxyData" => $XMLOutput_encrypted));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$response = curl_exec($ch);
curl_close($ch);


header("content-type:text/plain");
print $response;

?>
