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
    /**
     * Method ini untuk melakukan pengurangan saldo
     *
     * @return boolean
  */
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
     /**
     * Method ini untuk Pengurangan saldo
     *
     * @return boolean
  */
  private function reduceSaldo($ammount,$note=null,$transaction_id=null)

   {
         if(Dompet::create(['user_id' => $this->user_id,'balance' => DB::raw("-".$ammount),'annotation'=>$note,
          'transaction_id'=>$transaction_id])){
            return true;
         }

         return false;
   }
   private function addSaldo($ammount,$note=null,$transaction_id=null)

   {
         if(Dompet::create(['user_id' => $this->user_id,'balance' => $ammount,'annotation'=>$note,
          'transaction_id'=>$transaction_id])){
            return true;
         }

         return false;
   }
   /**
     * Method ini untuk melakukan perhitungan jumlah saldo dari user yang sudah ditentukan
     *
     * @return float
  */
  protected function totalBalance($formated = false){
        $sum = Dompet::where('user_id',$this->user_id)->sum('balance');
        if($formated)
        {
          $sum = number_format($sum);
        }
        return $sum;
  }
  protected function transactionHistory($limit){
      $data = Dompet::where('user_id',$this->user_id)
              ->orderBy('created_at','DESC')
              ->limit($limit)
              ->get();

      return $data;

  }
    
  /**
     * Method ini untuk melakukan permintaan penarikan dana ke admin website
     *
     * @return boolean
  */
   protected function account($user_id,$pin=null){
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
  /**
     * Method ini untuk melakukan Balidasi Akun
     *
     * @return boolean
  */
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