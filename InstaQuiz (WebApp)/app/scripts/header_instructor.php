<!DOCTYPE html>
<html>
    <head>
        <title>InstaQuiz</title>
        <style>
            body 
            {
                color: #CCCCCC;
                background-color: #05386B;
                background-image: url("https://www.transparenttextures.com/patterns/dark-mosaic.png");
                font-family: "cambria", serif;
                text-shadow: 2px 2px 2px rgba(0, 0, 0, 0.6);
            }
            /* Header Form */
            header 
            {
                display: flex;
                justify-content: space-between;
                align-items: center;
                padding: 10px;
                background-color: #07223E;
                background-image: url("https://www.transparenttextures.com/patterns/dark-mosaic.png");
                font-size: 18px;
                font-weight: bold;
                color: white;
                border-radius: 10px;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
            }
            /* Buttons */
            header a 
            {
                background-color: transparent;
                text-decoration: none;
                border: none;
                border-radius: 5px;
                outline: none;
                cursor: pointer;
                padding: 10px;
                margin: 0;
                font-size: 18px;
                font-weight: bold;
                color: #CCCCCC;
                transition: background-color 0.3s ease;
            }
            /* Buttons : Hover State */
            header a:hover 
            {
                background-color: #F64C72;
                color: #CCCCCC;
            }
            /* InstaQuiz Logo */
            .logo 
            {
                background-color: transparent;
                text-decoration: none;
                border: none;
                border-radius: 5px;
                outline: none;
                cursor: pointer;
                padding: 10px;
                margin: 0;
                font-size: 24px;
                font-weight: bold;
                color: #CCCCCC;
                transition: background-color 0.3s ease;
            }
            /* InstaQuiz Logo : Hover State */
            .logo:hover 
            {
                background-color: #F64C72;
                color: #CCCCCC;
            }
        </style>
    </head>
    <body>
        <header>
            <button class="logo" onclick="location.href='../index.php'">InstaQuiz</button>
            <nav>
                <a href="../pages/logout.php">Logout</a>
                <a href="../pages/tables.php">Database</a>
            </nav>
        </header>
    </body>
</html>
