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
    
    $numBooks = sizeOf($_SESSION['Book_Title'])-1;
    $numDVDs = sizeOf($_SESSION['DVD_Title'])-1;
    $numDays = sizeOf($_SESSION['days'])-1;
    $days = '';
    for($y = 0; $y <= $numDays; $y++){
    	$days .= ''. $_SESSION['days'][$y] . " ";
    }
                
$to      = 'stephenpagliuca@gmail.com'; // Change the email address and other fields to be displayed on the email depending on the associated form 
$subject = 'Reference No. '.$referenceNo;
$message ="
Name: ". $_SESSION['Name'] . '
Office Number: '. $_SESSION['Office_Num'] . '
Course Number: '. $_SESSION['Course_Num'] . '
Extension: '. $_SESSION['extension'] . '
Place: '. $_SESSION['place'] . '
Room: '. $_SESSION['room'] . '
Time: '. $_SESSION['time'] . '
Course Title: '. $_SESSION['courseTitle'] . "
Days: ". $days . " 
Semester: " . $_SESSION['semester'] . '
Extension: '. $_SESSION['extension'] .'
 
Comments: '. $_SESSION['Comments'];

for ($i = 1; $i <= $numBooks; $i++) {
$message .= '

Book/Article '. $i .'

'. $_SESSION['book_article'][$i]. '
Title: '. $_SESSION['Book_Title'][$i] .'
Author: '. $_SESSION['Author'][$i] .'
Call #: '. $_SESSION['Book_call'][$i]. '';
}

for ($j = 1; $j <= $numDVDs; $j++) {
$message .= '

DVD/Video ' . $j .'

'. $_SESSION['dvd_video'][$j]. '
Title: '. $_SESSION['DVD_Title'][$j] .'
Date Needed: '. $_SESSION['Date_needed'][$j] . '
Reservation Type: '. $_SESSION['DVD_imp'][$j] . '
Video #: '. $_SESSION['DVD_videoNum'][$j]. '';
}
                
    $headers = 'From:' . $_SESSION['Email']. "\r\n" . 'X-Mailer: PHP/' . phpversion();
    
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