<?php
error_reporting(0);
session_start();
// Create new $_SESSION variables corresponding with the fields of the associated forms.
$_SESSION['roomNum']= $_POST['roomNum'];
$_SESSION['resDate']= $_POST['resDate'];
$_SESSION['timeStart']= $_POST['timeStart'];
$_SESSION['timeEnd']= $_POST['timeEnd'];
$_SESSION['bookType']= $_POST['bookType'];
$_SESSION['primEmail']= $_POST['primEmail'];
$_SESSION['secEmail']= $_POST['secEmail'];
$_SESSION['Comments']= $_POST['Comments'];




if (isset($_SESSION['simpleCaptchaAnswer']) && $_POST['captchaSelection'] == $_SESSION['simpleCaptchaAnswer']) {

     // START "CAPTCHA CORRECTLY VERIFIED" ELSE BLOCK
     // CODE TO HANDLE SUCCESSFUL VERIFICATION
    
                    $_SESSION['incorrectCaptcha'] = null;
                    $_SESSION['incorrectCaptcha'] = 'false';
            
    function randomAlphaNum($length){ 
    
        $rangeMax = pow(36, $length-1); //smallest number to give length digits in base 36 
        $rangeMin = pow(36, $length)-1; //largest number to give length digits in base 36 
        $base10Rand = mt_rand($rangeMin, $rangeMax); //get the random number 
        $newRand = base_convert($base10Rand, 10, 36); //convert it 
        return $newRand; //spit it out 
    
    } 
    $referenceNo = randomAlphaNum(10);
    
   
$to      = 'stephenpagliuca@gmail.com'; // Change the email address and other fields to be displayed on the email depending on the associated form 
$subject = 'Reference No. '.$referenceNo;
$message ="
Primary Patron's Email: ". $_SESSION['primEmail'] . "
Secondary Patron's Email: ". $_SESSION['secEmail'] . '
Room Number: '. $_SESSION['roomNum'] . '
Reservation Date: '. $_SESSION['resDate'] . '
Start Time: '. $_SESSION['timeStart'] . '
End Time: '. $_SESSION['timeEnd'] . '
Comments: '. $_SESSION['Comments'];
}
                
  $headers = 'From:' . $_SESSION['primEmail']. "\r\n" . 'X-Mailer: PHP/' . phpversion();
    
    if (mail($to, $subject, $message, $headers)) {
    	$_SESSION['Message'] = 'Thank You. Your request has been sent to James A. Cannavino Library staff (845) 575-3292. Your tracking number is: '. $referenceNo;
    } else {
      		$_SESSION['Message'] = 'An Error occurred during the submission of your form. Please try again.';
      }
	
	echo 1;
} else {
	//CODE IF CAPTCHA VERIFICATION FAILED
	$_SESSION['incorrectCaptcha'] = null;
	$_SESSION['incorrectCaptcha'] = 'true';
	    
	echo 0;
  }
                
?>