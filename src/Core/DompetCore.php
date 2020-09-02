<?php
namespace  Irfa\Dompet\Core;

use Irfa\Dompet\Core\CredentialManager;
use Irfa\Dompet\Models\Dompet;
use DB;
use Illuminate\Support\Facades\Request, File, Lang, Session;

class DompetCore extends CredentialManager

{
  private $user_id;
  private $pin;
  private $isFail;
  private $message;
  /**
     * Method ini untuk melakukan permintaan penarikan dana ke admin website
     *
     * @return boolean
  */
   protected function withdrawal()

   {

   }

   protected function addBalance($ammount,$note = null,$transaction_id = null)

   {
      if($this->account($this->user_id,$this->pin)->validate()){
        $this->account($this->user_id,$this->pin)->addSaldo($ammount,$note,$transaction_id);
         $this->message = Lang::get('dompet.add.balance.success');
         return true;
      } 
          $this->isFail = true;
          $this->message =  Lang::get('dompet.pin.invalid');
          return false;
    } 

   protected function reduceBalance($ammount,$note = null,$transaction_id = null)

   {
      if($this->account($this->user_id,$this->pin)->validate()){
        $this->account($this->user_id,$this->pin)->reduceSaldo($ammount,$note,$transaction_id);
         $this->message =  Lang::get('dompet.reduce.balance.success');
         return true;
      } 
          $this->isFail = true;
          $this->message =  Lang::get('dompet.pin.invalid');
          return false;
    }

    protected function reduceSaldo($ammount,$note=null,$transaction_id=null)

   {
         if(Dompet::create(['user_id' => $this->user_id,'balance' => DB::raw("-".$ammount),'annotation'=>$note,
          'transaction_id'=>$transaction_id])){
            return true;
         }

         return false;
   }

    
  /**
     * Method ini untuk melakukan permintaan penarikan dana ke admin website
     *
     * @return boolean
  */
   protected function account($user_id,$pin){
   		$this->user_id = $user_id;
   		$this->pin = $pin;

   		return $this;
   }
   protected function create()

   {
   		if($this->data($this->user_id,$this->pin)->createCredential()){
        $this->message =  Lang::get('dompet.pin.create.success');
        return true;
      }
        $this->isFail = false;
        $this->message =  Lang::get('dompet.pin.create.fail');
        return false;
   }

   protected function update($newPin)
   
   {
     if($this->account($this->user_id,$this->pin)->validate()){
        if($this->data($this->user_id,$this->pin)->updateCredential($newPin)){
          $this->message = Lang::get('dompet.pin.update.success');
          return true;
        } 
          $this->isFail = true;
          $this->message = Lang::get('dompet.pin.update.fail');
          return false;
      } 
          $this->isFail = true;
          $this->message =  Lang::get('dompet.pin.invalid');
          return false;
   }

   protected function validate()

   {
   	  if($this->data($this->user_id,$this->pin)->validateAccount()){
   	  	$this->message =  Lang::get('dompet.pin.valid');
   	  	return true;
   	  } 
   	  	$this->isFail = false;
	   	  $this->message =  Lang::get('dompet.pin.invalid');
	   	  return false;
   }
   protected function getMessage(){
   		return $this->message;
   }
   protected function isFail(){
   		return $this->isFail;
   }

}