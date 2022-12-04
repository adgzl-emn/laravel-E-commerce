<h1>Aroma E-Ticaret</h1>
<p>Merhaba {{$user->name}} kullanıcı kaydınız başarıyla kaydoldu</p>
<br>
<p>Kaydınızı aktifleştirmek için <a href="{{config('app.url')}}/activate/{{$user->activation_key}}">tıklayın</a>
</p>
