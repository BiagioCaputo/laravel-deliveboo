<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Email post-acquisto</title>
</head>
<body>
    <div class="container">
        <h1 class="text-center my-5">Gentile {{$customer_name}}, grazie per il tuo acquisto</h1>
        <p>Il tuo ordine di importo {{$final_price}}€ sarà consegnato il prima possibile all'indirizzo:{{$customer_address}}</p>
    </div>
    
</body>
</html>