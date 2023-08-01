<?php

namespace App\Facade;

class Order
{

   public function discount($totalPrice)
   {
      echo 'discount ' . $totalPrice / 3;
   }

   public function sendMail($mail)
   {
      echo "send mail to :" . $mail . ' successfully';
   }
}
