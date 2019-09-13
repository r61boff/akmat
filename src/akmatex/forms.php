<?php 

require 'src/PHPMailer.php';
require 'src/SMTP.php';
require 'src/Exception.php';

$email = new PHPMailer\PHPMailer\PHPMailer();
$email->isHTML(true);
$email->CharSet   = 'UTF-8';
$email->From      = 'info@mylo.su';
$email->FromName  = 'Сайт Mylo';
$email->Subject   = $_POST['title'];


$message = "
            <html> 
                <head> 
                    <title>$subject</title>
                    <meta charset='UTF-8' /> 
                </head> 
                <body>";
foreach ($_POST as $key => $value) {
    if(!empty($value) && $key != 'title') {
        $message .= "<p><b>".$key."</b>: ".$value."</p>";
    }
}
$message .= "
                <p><b>IP</b>: ".$_SERVER['REMOTE_ADDR']."</p>
                </body>
            </html>";
$email->Body      = $message;
$email->AddAddress( 'info@mylo.su' );

if(isset($_FILES)) {
    foreach ($_FILES as $img) {

        $filename = $img['name'];
        // название файла

        $filepath = $img['tmp_name'];
        // месторасположение файла
        $file_to_attach = 'PATH_OF_YOUR_FILE_HERE';

        $email->AddAttachment( $filepath , $filename );
    }
}
return $email->Send();
echo "0";