<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $description = $_POST['description'];
    
    if (isset($_FILES['avatar'])) {
        $file_name = $_FILES['avatar']['name'];
        $file_tmp = $_FILES['avatar']['tmp_name'];
        
        if (!is_dir('uploads')) {
            mkdir('uploads', 0755, true);
        }
        
        move_uploaded_file($file_tmp, "uploads/" . $file_name);
        echo "Файл успешно загружен!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Lab 8</title>
</head>
<body>
    <form action="" method="POST" enctype="multipart/form-data">
        <label>Назва:</label><br>
        <input type="text" name="title"><br><br>

        <label>Опис:</label><br>
        <textarea name="description"></textarea><br><br>

        <label>Файл:</label><br>
        <input type="file" name="avatar"><br><br>

        <button type="submit">Зберегти</button>
    </form>
</body>
</html>
