<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "connectme";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['ok'])) {
    $name = $_POST['namee'];
    $response = $_POST['response'];
    $teacher = $_POST['teacher'];
    $photo= $_POST['photo'];
    $query = "INSERT INTO student (namee, response,photo,teacher) VALUES ('$name', '$response','$photo', '$teacher')";
    $result = mysqli_query($conn, $query);

    if (!$result) {
        die("Error: " . mysqli_error($conn));
    }
}

$teacherQuery = "SELECT * FROM teacher";
$teacherResult = mysqli_query($conn, $teacherQuery);
$teachers = mysqli_fetch_all($teacherResult, MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teacher-Student</title>
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

    input,
    select,
    textarea {
        width: 100%;
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
        <label for="namee">Name:</label>
        <input type="text" name="namee" required>
        <br>
        <label for="Photo">PHOTO</label>
        <input type="file" name="photo" required>
        <br>
        <label for="teacher">Select Teacher:</label>
        <select name="teacher" required>
            <option></option>
            <?php foreach ($teachers as $teacher) : ?>
                <option value="<?php echo $teacher['tid']; ?>"><?php echo $teacher['name']; ?></option>
            <?php endforeach; ?>
        </select>
        <br>
        <label for="response">Message:</label>
        <textarea name="response" required></textarea>
        <br>
        <input type="hidden" name="action" value="sendMessage">
        <button type="submit" name="ok">Send Message</button>
    </form>
</body>
</html>
