<form method="post" action="/odemeyap">
    @csrf
<div class="row">
    <div class="col-12">
        <div class="card border-0"> <input class="form-control ps-5" type="text" name="cardnumber" placeholder="Card number"> <span class="far fa-credit-card"></span> </div>
    </div>
    <div class="col-6"> <input class="form-control my-3" maxlength="2" type="text" name="exp_date_mounth" placeholder="AY"> </div>
    <div class="col-6"> <input class="form-control my-3"  maxlength="2" type="text" name="exp_date_year" placeholder="YIL"> </div>
    <div class="col-6"> <input class="form-control my-3" type="text" name="cvv" placeholder="cvv"> </div>
    <button class="btn btn-primary d-block h8">PAY <span class="fas fa-dollar-sign ms-2"></span>1400<span class="ms-3 fas fa-arrow-right"></span></button>

</div>
</form>
