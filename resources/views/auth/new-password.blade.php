<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css">
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
    <title>Définir un nouveau mot de passe</title>
</head>

<body>
    <div class="wrapper">
        <div class="logo">
            <img src="{{ asset('images/logo-banking.jpeg') }}" alt="logo">
        </div>
        <div class="text-center mt-4 name">
            <h6>SALEM FIN</h6>
            <p style="font-size: 12px;font-weight:normal; text-align:left">Prémière connection, définir un mot de passe
            </p>
        </div>
        <form method="POST" action="{{ route('newPassword.store', ['id' => $user->id]) }}" class="p-3 mt-3">
            @csrf
            <input type="hidden" name="email" id="email" value="{{ $user->email }}">
            <div class="form-field d-flex align-items-center">
                <span class="fas fa-key"></span>
                <input type="password" name="password" id="pwd" placeholder="Mot de passe">
            </div>
            <div class="form-field d-flex align-items-center">
                <span class="fas fa-key"></span>
                <input type="password" name="password_confirmation" id="pwd" placeholder="Confirmé Mot de passe">
            </div>
            <button class="btn btn-succes mt-3">Confirmer</button>
        </form>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
