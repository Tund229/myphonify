<!DOCTYPE html>
<html>

<head>
    <title>Réinitialisation de mot de passe</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style type="text/css">
        body {
            background-color: #f6f6f6;
            font-family: sans-serif;
            font-size: 14px;
            line-height: 1.4;
            margin: 0;
            padding: 0;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }

        .container {
            margin: 0 auto;
            max-width: 580px;
            padding: 10px;
            width: 100%;
        }

        .header {
            background-color: #f6f6f6;
            color: #222222;
            padding: 20px 0;
            text-align: center;
        }

        .header img {
            height: 20%;
            width: 20%;
        }

        .content {
            background-color: #ffffff;
            padding: 20px;
        }

        .content p {
            margin: 0 0 20px;
            padding: 0;
        }

        .content a {
            color: #4169e1;
            text-decoration: none;
        }

        .content a:hover {
            text-decoration: none;
        }

        .footer {
            background-color: #f6f6f6;
            color: #222222;
            padding: 20px 0;
            text-align: center;
        }

        .footer p {
            margin: 0;
            padding: 0;
        }

        span {
            font-size: 40px;
        }


        /* Style du bouton personnalisé */
        .custom-button {
            display: inline-block;
            margin-top: 10px;
            padding: 10px 20px;
            color: #222222;
            border: solid 2px #4169e1;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
            margin-bottom: 10px;
            text-decoration: none;
        }

        /* Style du bouton personnalisé au survol */
        .custom-button:hover {
            background-color: #0056b3;
            color: #f6f6f6;
        }
        
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <img src="https://myphonify.com/landing_assets/assets/img/logo.png" alt="Logo">
        </div>
        <div class="content" style="text-align: center">
            <h1>Réinitialisation de mot de passe</h1>
            <p>Vous avez demandé la réinitialisation de votre mot de passe sur Myphonify.</p>
            <p>Voici le code de vérification pour réinitialiser votre mot de passe :</p>
            <p style="text-align: center"><strong><span
                        style="letter-spacing: 10px;">{{ $token }}</span></strong></p>
            <p>Ce code est valide pour une durée de 30 minutes.</p>
            <a href="{{ route('change_password',['identifier' => $user->identifiant]) }}" class="custom-button">Réinitialiser</a>

            <p>Si vous n'avez pas fait cette demande, veuillez ignorer cet e-mail.</p>
            <p style="font-weight:bold; color: #4169e1;">L'équipe Myphonify</p>
        </div>
        <div class="footer">
            <p style="font-size: 10px; font-style:inherit">Cet e-mail a été envoyé automatiquement. Merci de ne pas y
                répondre.</p>
        </div>
    </div>

</body>

</html>
