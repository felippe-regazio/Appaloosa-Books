<?php use Cake\Routing\Router; ?>

<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Appaloosa Books - Not Found</title>    
</head>
<body>
    <style type="text/css">
        *{
            box-sizing: border-box;
        }
        body, html{
            margin: 0;
            padding: 0;    
        }
        .notfoundpage{
            min-height: 100vh;
            min-width: 100vw;
            background: black;
            background-image: url("img/bg/404.jpg");
            background-size: cover;
            background-position: top;
            background-repeat: no-repeat;
            overflow: hidden;
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            justify-content: center;
            padding: 14px;
        }
        .content{
            position: relative;
        }
        .content h1,
        .content h2,
        .content p,
        .content a{
            background-color: #000000;
            color: #ffffff;
            padding: 14px;
            margin: 0;
            margin-bottom: 14px;
            width: fit-content;
        }
        .content h1{
            font-size: 6vw;
        }
        .content a{
            position: absolute;
            right: 0;
            display: block;
            position: absolute;
            background-color: #800000;
            text-decoration: none;
        }
    </style>
    <div class="notfoundpage">
        <div class="content">
            <h2>APPALOOSA BOOKS</h2>
            <h1>
                404 . Página Não Encontrada
            </h1>
            <a href="/">IR PARA A HOME</a>
        </div>
    </div>
</body>
</html>