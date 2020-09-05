<?php
/**
 * Created by PhpStorm.
 * User: mahmood
 * Date: 9/5/20
 * Time: 10:17 AM
 */

namespace App\Services;


use App\Payment;
use Illuminate\Mail\Mailer;
class MailerService
{
    protected $mailer;

    public function __construct(Mailer $mailer)
    {
        $this->mailer = $mailer;
    }


    public function sendMailToUserForPayment(Payment $payment)
    {
        $user = $payment->user;
        $toName = $user->name;
        $toEmail = $user->email;
        $data = array('name' => $toName,'paymentStatus' =>  $payment->status);
        $this->mailer->send('emails.paymentNotify', $data, function ($message) use ($toName, $toEmail) {
            $message->to($toEmail, $toName)
                ->subject('Payment Status');
            $message->from('mahmoudmohsenifar@gamil.com', 'Payment Status');

        });

    }
}
