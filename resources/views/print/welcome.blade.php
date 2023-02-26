<html>
<style>
    body {
        background: rgb(204, 204, 204);
    }

    page {
        background: white;
        display: block;
        margin: 0 auto;
        margin-bottom: 0.5cm;
        box-shadow: 0 0 0.5cm rgba(0, 0, 0, 0.5);
    }

    page[size="A4"] {
        width: 21cm;
        height: 29.7cm;
    }

    page[size="A4"][layout="landscape"] {
        width: 29.7cm;
        font-size: 14px;
        height: 21cm;
    }

    page[size="A3"] {
        width: 29.7cm;
        height: 42cm;
    }

    page[size="A3"][layout="landscape"] {
        width: 42cm;
        height: 29.7cm;
    }

    page[size="A5"] {
        width: 14.8cm;
        height: 21cm;
    }

    page[size="A5"][layout="landscape"] {
        width: 21cm;
        height: 14.8cm;
    }



    @media print {

        html, body {
            height:100%;
            margin: 0 !important;
            padding: 0 !important;
            overflow: hidden;
        }

    }
</style>
<script src="http://code.jquery.com/jquery-latest.min.js"></script>
<script src="{{ asset('public/assets/js/textFit.js') }}"></script>

<script>
     $(".text").squishy({ callback: function(args) { console.log(args); } });
    setTimeout(function() {
        window.print();
    }, 500);
</script>
<body>
<page size="A4" layout="landscape">
    <div style="margin: 0 auto;width:90%;    top: 32px;position: relative;">
        <img style="width: 50%" src="{{url('storage/'.$data["logo"].'') }}" alt="World">
    </div>
    <hr style="    margin: 54px;
    border: 5px solid #242e4a;"/>
    <div  class="text" style="
    text-align: center;text-transform: uppercase;
    font-family: fantasy;font-size: 150px;
    line-height: 1;">
        {{$reservation->customer->fullname}}
    </div>
</page>
</body>
</html>
