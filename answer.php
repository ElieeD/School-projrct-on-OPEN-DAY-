<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "connectme";



$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$studentsQuery = "SELECT * FROM student";
$studentsResult = mysqli_query($conn, $studentsQuery);
$students = mysqli_fetch_all($studentsResult, MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teacher Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2; 
            color: #333;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        form {
            position: fixed;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 300px;
            margin-left: -700px;
            margin-top: -180px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
        }

        select {
            width: 100%;
            padding: 8px;
            margin-bottom: 16px;
            box-sizing: border-box;
            border: 1px solid #ccc; 
            border-radius: 4px;
        }

        textarea {
            width: 100%;
            height: 80px;
            padding: 8px;
            margin-bottom: 16px;
            box-sizing: border-box;
            border: 1px solid #ccc; 
            border-radius: 4px;
        }

        button {
            background-color: #333;
            color: #fff;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background-color: #555;
        }
        .chat-container {
            position: fixed;
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .message {
            margin-bottom: 10px;
        }

        .message strong {
            color: #333;
        }

        .message span {
            color: #555;
        }
        <style>

    .navi {
        background-color: #333;
        padding: 10px;
        text-align: center;
    }

    .navi a {
        color: white;
        text-decoration: none;
        margin: 0 10px;
        font-weight: bold;
    }

    .navi a:hover {
        text-decoration: underline;
    }
    .ok{
        width: 400px;
        height: 30px;
        background:black;
        margin-top: -680px;
        margin-left: 95px;
    }
    .ok a{
        color: white;
        padding: 60px;
        text-decoloration: none;
    }
</style>

        

    </style>
</head>
<body>
    <div class="ok"> 
    <a href="answer.php">TEACHER</a>
    <a href="dash.php">STUDENT</a>
    </div>
<div class="chat-container">
        <?php
        $chatQuery = "SELECT * FROM student";
        $chatResult = mysqli_query($conn, $chatQuery);
        $chatMessages = mysqli_fetch_all($chatResult, MYSQLI_ASSOC);
        ?>

        <?php foreach ($chatMessages as $message) : ?>
            <div class="message">
                <strong><?php echo $message['namee']; ?>:</strong>
                <span><?php echo $message['response']; ?></span>
            </div>
        <?php endforeach; ?>
    </div>

    <form method="post" action="">
        <br>
        <label for="student">Select Student:</label>
        <select name="student" required>
            <option></option>
            <?php foreach ($students as $student) : ?>
                <option value="<?php echo $student['sid']; ?>"><?php echo $student['namee']; ?></option>
            <?php endforeach; ?>
        </select>
        <br>
        <label for="answer">Answer:</label>
        <textarea name="response" required></textarea>
        <br>
        <input type="hidden" name="action" value="answerQuestion">
        <button type="submit" name="ok">Submit Answer</button>
    </form>
</body>
</html>
