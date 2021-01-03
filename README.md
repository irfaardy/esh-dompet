

# 🔒 **ESH Dompet**

Package ini berfungsi untuk menyimpan saldo ke dompet digital





<h3>🛠️ Installation with Composer </h3>

```php
composer require irfa/dompet
```

>You can get Composer <a href="https://getcomposer.org/download/" target="_blank">here</a>

***
<h2>🛠️ Laravel Setup </h2>

<h3>1. Add to config/app.php</h3>

```php
'providers' => [
      	 ....
         Irfa\Dompet\DompetServiceProvider::class, 
     ];
```

<h3>2. Add to config/app.php</h3>

```php
'aliases' => [
         ....
    	'Dompet' => Irfa\Dompet\Saku\Dompet::class,
],
```

  <h3>3. Publish Vendor</h3>


    php artisan vendor:publish --tag=dompet

<h3>4.Migrate Tables</h3>

```
php artisan migrate
```



<h2>Basic Usage</h2>

<hr>
<h2>Create new PIN</h2>

```php
use Dompet;
...
Dompet::make($user->id, 123456);
//return boolean
```

<h2>Update PIN</h2>

```php
...
Dompet::credential($userID,$pin)->update($new_pin);
//return boolean
```



<h2>Add Balance to account</h2>

```php
... 
Dompet::credential($userID,$pin)->balance(20000)->add("Some Transaction",$transaction_id);
//return boolean
```

<h2>Reduce Balance to account</h2>

```php
...
Dompet::credential($userID,$pin)->balance(20000)->reduce("Some Transaction",$transaction_id);
//return boolean
```
<h2>Get total Balance</h2>

```php
...
Dompet::credential($user->id)->sumBalance();
//result 5000
//Formated number
Dompet::credential($user->id)->sumBalance(true);
// result 5,000
```

<h2>Get Transaction History</h2>

```php
... 
foreach(Dompet::credential($userID)->history() as $d)
 {
     echo $d->annotation." | ".$d->balance."<br>";
 }
```



<h2>Get Message success or fail</h2>

```php
if(Dompet::credential()->balance(2000)->add("Some Transaction",$transaction_id))
{
     echo "Succeded, ".Dompet::message();
} else 
	{
     	echo "Failed, ".Dompet::message();
	}

```

------

## How to Contributing

1. Fork it (<https://github.com/irfaardy/esh-dompet/fork>)
3. Commit your changes (`git commit -m 'Add some Feature'`)
4. Push to the branch (`git push origin version`)
5. Create a new Pull Request
***

**LICENSE**<br>
<a href="https://github.com/irfaardy/lockout-account/blob/master/LICENSE"><img alt="GitHub license" src="https://img.shields.io/github/license/irfaardy/lockout-account?style=for-the-badge"></a>

