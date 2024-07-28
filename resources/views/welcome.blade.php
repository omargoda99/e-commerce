<!-- resources/views/ecommerce.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Commerce Website</title>
    <!-- Add Bootstrap CSS for styling -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Add custom CSS -->
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap');
        
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(120deg, #f6d365 0%, #fda085 100%);
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            text-align: center;
            background: #fff;
            padding: 50px;
            border-radius: 15px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }
        .header {
            font-size: 2.5em;
            font-weight: 600;
            margin-bottom: 20px;
            color: #333;
        }
        .content {
            font-size: 1.2em;
            color: #666;
            margin-bottom: 30px;
        }
        .fashionable-button {
            background: #ff6f61;
            color: white;
            border: none;
            padding: 15px 30px;
            font-size: 18px;
            border-radius: 30px;
            text-transform: uppercase;
            cursor: pointer;
            transition: all 0.4s;
            position: relative;
            overflow: hidden;
        }
        .fashionable-button::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 300%;
            height: 300%;
            background: rgba(255, 255, 255, 0.15);
            transform: translate(-50%, -50%) rotate(45deg);
            transition: all 0.75s;
        }
        .fashionable-button:hover::before {
            width: 0;
            height: 0;
        }
        .fashionable-button:hover {
            background: #ff5f5f;
        }
        .fashionable-button span {
            position: relative;
            z-index: 1;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            Welcome to Our E-Commerce Website
        </div>
        <div class="content">
            Explore our exclusive collection of fashionable items and enjoy a seamless shopping experience.
        </div>
        <button class="fashionable-button" onclick="window.location.href='/admin'">
            <span>Go to Admin</span>
        </button>
    </div>
</body>
</html>
