<?php
	$api_key = 'YOUR-API-KEY';
	$list_id = 'LIST ID';
	$optin_id = 'OPTIN ID'

	include('vendor/drewm/mailchimp-api/src/MailChimp.php');

	use \DrewM\MailChimp\MailChimp;
	$MailChimp = new MailChimp($api_key);

		// Submit subscriber data to MailChimp
    $email = $_POST["email"];
    $thirdparty_optin = $_POST["optin"];
    $md5Hash = md5(strtolower($email));
    $result = $MailChimp->put('/lists/'. $list_id . '/members/' . $md5Hash, [
                'status'        => 'pending',
                'status_if_new'=>'pending',
  							'email_address' => $email,
  							'merge_fields'  => [
                  'FNAME'=>$_POST["fname"],
                  'LNAME'=>$_POST["lname"],
                  'MERGE10'=> $_POST["province"]
                ]
  						]);

    if ($thirdparty_optin == 'true') {
      $result = $MailChimp->put('/lists/'. $optin_id . '/members/' . $md5Hash, [
                 'status'        => 'pending',
                 'status_if_new'=>'pending',
    							'email_address' => $email,
    							'merge_fields'  => [
                    'FNAME'=>$_POST["fname"],
                    'LNAME'=>$_POST["lname"]
                  ]
    						]);
    }
	if ($MailChimp->success()) {
		// Success message
		echo "<h4>Thanks for signing up! Please check your inbox to confirm your email address.</h4>";
	} else {
		// Display error
		echo $MailChimp->getLastError();
	}
