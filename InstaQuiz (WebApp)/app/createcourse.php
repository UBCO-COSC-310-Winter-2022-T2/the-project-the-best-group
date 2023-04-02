<!DOCTYPE html>
<html>
    <head>
        <title>InstaQuiz Create Course</title>
        <style>
            body 
            {
                color: #CCCCCC;
                background-color: #05386B;
                background-image: url("https://www.transparenttextures.com/patterns/dark-mosaic.png");
                font-family: "cambria", serif;
                text-align: center;
                text-shadow: 2px 2px 2px rgba(0, 0, 0, 0.6);
            }
            #create-course-form
            {
                display: inline-block;
                margin-top: 100px;
                padding: 20px;
                background-color: #07223E;
                background-image: url("https://www.transparenttextures.com/patterns/dark-mosaic.png");
                border-radius: 10px;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
            }
            .course-input
            {
                margin: 25px 10px 0px;
            }
            button 
            {
                background-color: transparent;
                text-decoration: none;
                border: none;
                border-radius: 5px;
                outline: none;
                cursor: pointer;
                padding: 10px;
                margin: 50px 10px 0px;
                font-size: 18px;
                font-weight: bold;
                color: #CCCCCC;
                transition: background-color 0.3s ease;
            }
            button:hover 
            {
                background-color: #F64C72;
                color: #CCCCCC;
            }
        </style>
    </head>
    <body>
        <?php include_once 'header.php'; ?>
        <div id="create-course-form">
            <form action="process_course.php" method="post">
                <h1>Create InstaQuiz Course</h1>

                <label for="course-name" class='course-input'><b>Course Name:</b></label>
                <input type="text" placeholder="Enter Course Name" name="coursename" class='course-input'>
                <br>
                <button type='submit'>Create Course</button>
                <button onclick="window.location.href = 'index.php';">Home</button>
                <br>
                <?php
                    if ($_GET['msg'] == 'exists')
                        echo "<p>Course already exists</p>";
                    if ($_GET['msg'] == 'fail')
                        echo "<p>Error creating course. Please try again.</p>";
                ?>
            </form>
        </div>
    </body>
</html>
