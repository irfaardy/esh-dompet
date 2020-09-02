<?php
namespace  Irfa\Dompet\Core;

use Hash;
use Irfa\Dompet\Models\PinDompet;
use Irfa\Dompet\Models\Dompet;
use Illuminate\Support\Facades\Request, File, Lang, Session;

class CredentialManager

{
  private $pin;
  private $user_id;
 
   protected function data($user_id,$pin)

   {
   	 $this->user_id =  $user_id;
   	 $this->pin = $pin;

   	 return $this;
   }
   protected function userID($userId)

   {
      $this->user_id = $userId;
   }
   protected function validateAccount()

   {
   		$dompet = PinDompet::where('user_id',$this->user_id)->first();
   		if(Hash::check($this->pin,$dompet->pin)){
   			return true;
   		}

   		return false;
   }
   
   
   protected function createCredential()

   {

   	$dompet = PinDompet::where('user_id',$this->user_id);
   	if($dompet->count() < 1)
   	{
	     $hash =  Hash::make($this->pin);
	   	 PinDompet::create(['user_id'=>$this->user_id,'pin' => $hash]);
	   	 return true;
   	}
   	return false;

   }

   protected function updateCredential($newPin)

   {

      $dompet = PinDompet::where('user_id',$this->user_id);
      if($dompet->count() >= 1)
      {
        $hash =  Hash::make($newPin);
          PinDompet::where(['user_id'=>$this->user_id,])->update(['pin' => $hash]);
          return true;
      }
      return false;

   }
}