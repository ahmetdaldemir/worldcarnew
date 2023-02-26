<!--<div class="col-12 col-sm-3">
    <h4>Menü</h4>
    <div class="user-links">
        <a class="active" href="/{{app()->getLocale()}}/profil/info">Bilgilerim</a>
        <?php $reservation = \App\Models\Reservation::where('id_customer', Auth::id())->first(); ?>
        <?php if ($reservation) { ?>
            <a href="/{{app()->getLocale()}}/profil/reservations">Rezervasyonlarım</a>
{{--            <a href="/{{app()->getLocale()}}/profil/discount">İndirimlerim</a>--}}
            <a href="/{{app()->getLocale()}}/profil/invitation">Davet Gönder</a>
            <a href="/{{app()->getLocale()}}/profil/call_center">Müşteri Hizmetleri</a>
        <?php } ?>
    </div>
</div>-->
