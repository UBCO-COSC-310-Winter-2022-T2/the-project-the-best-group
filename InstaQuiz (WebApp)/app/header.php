<!DOCTYPE html>
<html>
    <head>
        <title>InstaQuiz Header</title>
        <style>
            body 
            {
                color: #CCCCCC;
                background-color: #313357;
                font-family: "monospace";
            }
            /* Header Bar */
            header 
            {
                display: flex;
                justify-content: space-between;
                align-items: center;
                padding: 10px;
                background-color: #07223E;
                font-size: 18px;
                font-weight: bold;
                color: white;
                border-radius: 10px;
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
                background-color: #313357;
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
                background-color: #313357;
                color: #CCCCCC;
            }
        </style>
    </head>
    <body>
        <header>
            <button class="logo" onclick="location.href='index.php'">InstaQuiz</button>
            <nav>
                <a href="login.php">Login</a>
                <a href="register.php">Register</a>
                <a href="tables.php">Database</a>
            </nav>
        </header>
    </body>
</html>
