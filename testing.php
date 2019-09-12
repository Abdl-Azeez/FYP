<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

$toAddress = "$email"; //To whom you are sending the mail.
$message   = <<<EOT
    <html>
       <body>
          <h>To reset your password, please visit this:</h>
          <br>
          <a>$url</a>
       </body>
    </html>
EOT;
$mail = new PHPMailer();
$mail->IsSMTP();
$mail->SMTPAuth    = true;
$mail->Host        = "smtp.gmail.com";
$mail->Port        = 587;
$mail->SMTPOptions = array(
    'ssl' => array(
        'verify_peer' => false,
        'verify_peer_name' => false,
        'allow_self_signed' => true
    )
);
$mail->IsHTML(true);
$mail->Username = "AbdulazeezFYP@gmail.com"; // your gmail address
$mail->Password = "Adediran"; // password
$mail->ClearReplyTos();
$mail->AddReplyTo('xxxx@xxxmail.com', 'Reply to name');
$mail->SetFrom('xxxx@nomail.com', 'NEW PASSWORD');
$mail->Subject = "L_M_S PASSWORD RECOVERY"; // Mail subject
$mail->Body    = $message;
$mail->AddAddress($toAddress);
if (!$mail->Send()) {
    echo "<script>alert(\"Failed to send mail\")</script>";

}
else {
    echo "<script>alert(\"Mail sent succesfully. Check your email\")</script>";
}
?>
