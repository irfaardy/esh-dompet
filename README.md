
# 🔒 **ESH Dompet**
Package ini berfungsi untuk menyimpan saldo ke dompet digital

[^Note]: Masih Tahap Pengembangan jadi belum stabil.




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



<h2>Usage</h2>

<hr>
<h2>Create new PIN</h2>

```php
use Dompet;
...
Dompet::make($user->id, 123456);
```

<h2>Update PIN</h2>

```php
$new_pin = 654321;
Dompet::credential(1,123456)->update($new_pin);
```



<h2>Add Balance to account</h2>

```php
 Dompet::credential(1,123456)->balance(2000)->add("Some Transaction",$transaction_id);
```

<h2>Reduce Balance to account</h2>

```php
Dompet::credential(1,123456)->balance(2000)->reduce("Some Transaction",$transaction_id);
```
<h2>Get Message success or fail</h2>

```php
if(Dompet::credential()->balance(2000)->add("Some Transaction",$transaction_id))

{
     echo Dompet::message();
} else 

{
     echo Dompet::message();
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

