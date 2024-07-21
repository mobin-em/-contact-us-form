<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once 'vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $message = htmlspecialchars($_POST['message']);

    // Create a new PHPMailer instance
    $mail = new PHPMailer(true);

    try {
        //Server settings
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'mirshafie.mohamadreza@gmail.com'; // آدرس ایمیل شما
        $mail->Password   = 'wwsn qohs maqv vguy'; // رمز عبور برنامه
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;

        //Recipients
        $mail->setFrom('mohamadreza819596@gmail.com', 'mohamadreza'); // آدرس ایمیل و نام فرستنده
        $mail->addAddress('mirshafie.mohamadreza@gmail.com'); // آدرس ایمیل مقصد

        // Content
        $mail->isHTML(true);
        $mail->Subject = 'پیام جدید از فرم تماس';
        $mail->Body    = "نام: $name<br>ایمیل: $email<br><br>پیام:<br>$message";

        // Send the message
        $mail->send();
        echo 'پیام شما با موفقیت ارسال شد.';
    } catch (Exception $e) {
        echo "مشکلی در ارسال پیام رخ داده است. لطفا دوباره تلاش کنید. خطا: {$mail->ErrorInfo}";
    }
}
?>
