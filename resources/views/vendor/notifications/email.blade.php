<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $subject }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .email-container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .header {
            text-align: center;
            padding-bottom: 20px;
            border-bottom: 1px solid #dddddd;
        }

        .header h1 {
            color: #333333;
            margin: 0;
        }

        .content {
            padding: 20px 0;
            color: #555555;
        }

        .footer {
            text-align: center;
            padding-top: 20px;
            border-top: 1px solid #dddddd;
            color: #777777;
            font-size: 12px;
        }

        .button {
            display: inline-block;
            padding: 10px 20px;
            margin: 20px 0;
            background-color: #007bff;
            color: #ffffff;
            text-decoration: none;
            border-radius: 4px;
        }

        .button:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>
    <div class="email-container">
        <div class="header">
            <h1>{{ $subject }}</h1>
        </div>
        <div class="content">
            @foreach ($introLines as $line)
                <p>{{ $line }}</p>
            @endforeach

            @isset($actionText)
                <a href="{{ $actionUrl }}" class="button">{{ $actionText }}</a>
            @endisset
        </div>
        <div class="footer">
            <p>Ceci est un message automatique, merci de ne pas y répondre.</p>
        </div>
    </div>
</body>

</html>
