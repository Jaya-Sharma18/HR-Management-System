<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Successful</title>
    <style>
        /* Button style */
        button {
            background-color: #4CAF50; /* Green */
            border: none;
            color: white;
            padding: 15px 32px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 4px 2px;
            transition-duration: 0.4s;
            cursor: pointer;
            border-radius: 12px;
        }

        button:hover {
            background-color: #45a049; /* Darker green on hover */
        }

        /* Background gradient */
        body {
            background: linear-gradient(to bottom, #F0C27B, #4B1248);
            margin: 0;
            padding: 0;
            color: white;
            height: 100vh; /* Full viewport height */
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
        }

        /* Increase heading size */
        h1 {
            font-size: calc(5rem + 5px); /* Increasing by 5 units */
        }

        /* Increase message size */
        p {
            font-size: calc(1rem + 4px); /* Increasing by 4 units */
        }
    </style>
</head>
<body>
    <div style="text-align: center;">
        <h1>Registration Successful</h1>
        <p>Your registration has been successfully completed.</p>
        <button onclick="goBack()">Back</button>
    </div>

    <script>
        function goBack() {
            window.history.back();
        }
    </script>
</body>
</html>
