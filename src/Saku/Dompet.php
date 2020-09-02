<?php
namespace  Irfa\Dompet\Saku;

use Log;
use Illuminate\Support\Facades\Request, File, Lang, Session;
use Irfa\Dompet\Core\DompetCore;
class Dompet extends DompetCore

{
  private $balance;
  private $userId;
  private $pin;

  /**
     * Method ini untuk melakukan permintaan penarikan dana ke admin website
     *
     * @return boolean
  */
   public function withdrawal()

   {

   }
   /**
      * Method ini untuk menghitung total saldo sesuai dengan userId
      *
      * @param integer $userId
      * @return float
  */
   public function sumBalance($userId){
    
   }
   /**
      * Method ini untuk membuat Pin Baru
      *
      * @param integer $userId
      * @param string $pin
  */
   public function make($userId,$pin)

   {
        $this->account($userId,$pin)->create();
   }
   /**
      * Method ini untuk mengubah Pin
      *
      * @param string $newPin
  */
   public function updatePin($newPin)

   {
       $this->account($this->userId,$this->pin)->update($newPin);
   }
  /**
     * Method ini untuk mengisi credentials untuk transaksi menggunakan e-wallet
     *
     * @param integer $userId
     * @param string $pin
     * @return $this;
  */
   public function credential($userId,$pin)

   {
      $this->userId = $userId;
      $this->pin = $pin;

      return $this;
   }

   /**
      * Hanya untuk Testing Credential
      *
  */
   public function test(){
    if(empty($this->userId) OR empty($this->pin))
    {
      echo"Pin Harus Diisi";
    }
      if($this->account($this->userId,$this->pin)->validate()){
       echo $this->message();
      } else{
        echo $this->message();
      }
   }

   /**
     *  Method ini berfungsi untuk menampung jumlah saldo yang akan di proses oleh method selanjutnya.
     *
     * @param float $amount
  */
   public function balance($amount)

   {
      $this->balance = $amount;

      return $this;
   }

   /**
     *  Method ini berfungsi untuk mengurangi saldo pada akun yang telah di tentukan di method credentials().
     *
     * @param boolean
  */
   public function reduce($note = null,$transaction_id = null)

   {
       $this->account($this->userId,$this->pin)->reduceBalance($this->balance,$note,$transaction_id);
   }

    /**
     *  Method ini berfungsi untuk menambah saldo pada akun yang telah di tentukan di method credentials().
     *
     * @return boolean
  */
   public function add($note = null,$transaction_id = null)

   {
      $this->account($this->userId,$this->pin)->addBalance($this->balance,$note,$transaction_id);
   }
  /**
      * Method ini untuk menampilkan pesan sukses atau gagal
      *
  */
   public function message(){
      return $this->getMessage();
   }

}