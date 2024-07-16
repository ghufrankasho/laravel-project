<!doctype html>
<html lang="{{app()->getLocale()}}">

<head>
    <title>CONTACT US</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
 
</head>

<body style="font-family: "Work Sans",sans-serif;font-size: 15px;font-weight: 400;font-style: normal;line-height: 24px;position: relative;visibility: visible;color: #777;background-color: #fff;">
    <div class="container pt-5 pb-5" style="max-width: 960px;color: #777;background-color: #fff;width: 100%;padding-right: 15px;padding-left: 15px;margin-right: auto;margin-left: auto;">
        <div class="row" style="display: -ms-flexbox;display: flex;-ms-flex-wrap: wrap;flex-wrap: wrap;margin-right: -15px;margin-left: -15px;">
            <div class="col-xl-6 col-lg-6 col-sm-12 col-12" style="flex: 0 0 50%;max-width: 50%;">
                <p style="margin-top: 0;margin-bottom: 1rem;">SUBJECT IS  {{ $details->contactSubject }}</p>
                <p style="margin-top: 0;margin-bottom: 1rem;">My NAME is  {{ $details->customerName }}</p>
                <p style="margin-top: 0;margin-bottom: 1rem;">My EMAIL is  {{ $details->customerEmail }}</p>
                <p style="margin-top: 0;margin-bottom: 1rem;">My REQUEST IS  {{ $details->contactMessage }}</p>
                
                <br />
                <br />
                <br />

            </div>
        </div> 
    </div>
  
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>
</body>

</html>
