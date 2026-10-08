# Звіт з лабораторної роботи №8
**Тема:** Завантаження файлів (Робота з файлами). Додавання до форми атрибута enctype="multipart/form-data" та завантаження файлу завдання на локальний диск сервера.

---

### 1. Код обробника завантаження файлів (`create.php`)

```php
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

1.Це тип кодування форми. Без нього браузер кидає тільки текст, а саму картинку чи файл просто пропускає.

2.Основні ключі: name, type, tmp_name, error, size. А tmp_name — це тупо тимчасовий шлях, де файл валяється на сервері до того, як ми його перенесемо.

3.Для безпеки. Сервер спочатку приймає файл і кидає його в ізольовану тимчасову папку ОС, щоб нічого не зламати, а вже потім ми з ним робимо що хочемо.

4.Вона спеціально перевіряє, чи файл реально прилетів через форму (POST-захист). Звичайний copy() просто так тягати файли небезпечно, бо він не робить перевірок.

5.Завантажать якийсь лівий PHP-скрипт під виглядом картинки, запустять його через браузер — і все, сервак ляже або його ззолвують.