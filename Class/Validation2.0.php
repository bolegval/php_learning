<?php

class UserFormValidation
{
    public function validate($form)
    {
        switch (true) {
            case empty($form['name']):
                throw new Exception("Не введено имя", 1);
                break;

            case $form['age'] < 18:
                throw new Exception("Возраст должен быть больше 18", 1);
                break;

            case empty($form['email']):
                throw new Exception("Не введен email", 1);
                break;

            case !filter_var($form['email'], FILTER_VALIDATE_EMAIL):
                throw new Exception("Неправильный формат почты", 1);
                break;
            
            default:
                return 'Валидация успешна';
                break; 
        }
    }
}

class User
{
    public function load($id)
    {
        if ($id == '' || $id > 100) 
        {
            throw new Exception("Вас нет в базе данных", 2);
        }
    } 

    public function save($data)
    {
        if ($data) {
            return rand(0, 1);
        }
    }
}


$success = false;
if (! empty($_POST)) {
    try {
        $success = (new User())->load($_POST['id']);
    

        try {

        $success = (new UserFormValidation())->validate($_POST);


        } catch (\Exception $e) {

            $error = $e->getMessage();

        }
    } catch (\Exception $e) {

        $error = $e->getMessage();
    } 
}

if ($success) {
   (new User())->save($_POST);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="" method="POST">
    <label>ID
        <input type="text" name="id" placeholder="Введите ваш ID">
    </label>
    <label>Имя
        <input type="text" name="name" placeholder="Введите ваше имя">
    </label>
    <label>Ваш возраст
        <input type="text" name="age" placeholder="Введите ваш возраст">
    </label>
    <label>Ваш email
        <input type="email" name="email" placeholder="Введите ваш email">
    </label>
    <input type="submit">
    </form>

    <h4>
    <?= $success ?  : $error ?>
    </h4>
</body>
</html>
