<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once 'vendor/autoload.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $message = htmlspecialchars($_POST['message']);

    // Create the Transport
    $transport = (new Swift_SmtpTransport('smtp.gmail.com', 587, 'tls'))
        ->setUsername('mirshafie.mohamadreza@gmail.com') // آدرس ایمیل شما
        ->setPassword('wwsn qohs maqv vguy'); // رمز عبور برنامه

    // Create the Mailer using your created Transport
    $mailer = new Swift_Mailer($transport);

    // Create a message
    $emailMessage = (new Swift_Message('پیام جدید از فرم تماس'))
        ->setFrom(['mohamadreza819596@gmail.com' => 'mohamadreza']) // آدرس ایمیل و نام فرستنده
        ->setTo(['mirshafie.mohamadreza@gmail.com']) // آدرس ایمیل مقصد
        ->setBody("نام: $name<br>ایمیل: $email<br><br>پیام:<br>$message", 'text/html');

    // Send the message
    try {
        $result = $mailer->send($emailMessage);
        echo 'پیام شما با موفقیت ارسال شد.';
    } catch (Exception $e) {
        echo "مشکلی در ارسال پیام رخ داده است. لطفا دوباره تلاش کنید. خطا: {$e->getMessage()}";
    }
}
?>
