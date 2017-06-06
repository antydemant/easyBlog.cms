<?php
    $base = null;
    if(!@mysqli_connect($host, $user, $password)) {
        $errors['mysql_connect'] = 'Ошибка соединения с базой данных!';
    } //запиши помилки в масив! маст хев!!!!!!!
    $base = mysqli_connect($host, $user, $password);
    $sql = 'CREATE DATABASE easyblog';

    if(!@mysqli_query($base,$sql)) {
        $errors['mysql_create'] = 'Ошибка создания базы! Наверное она уже создана, пожалуйста удалите её и снова приступайте к установке!';
    }

    if(!@mysqli_select_db($base,'easyblog')) {
        $errors['mysql_select'] = 'Ошибка выбора базы!';
    }
    $sql = "CREATE TABLE users (
	id int(11) NOT NULL auto_increment,
	name varchar(50) NOT NULL default '',
	login varchar(50) NOT NULL UNIQUE,
    password varchar(50) NOT NULL default '',
    role int(11) NOT NULL default 0,
	PRIMARY KEY (id)
    )";
    if(!@mysqli_query($base,$sql)) {
        $errors['mysql_create_users'] = 'Ошибка создания таблицы Users!';
    }
    $sql = "
    CREATE TABLE news (
	id int(11) NOT NULL auto_increment,
	title varchar(50) NOT NULL default '',
	pub_date varchar(50) NOT NULL default '',
	pub_text TEXT,
    user_id int(2) NOT NULL default 1, 
	PRIMARY KEY (id))";
    if(!@mysqli_query($base,$sql)) {
        $errors['mysql_create_news'] = 'Ошибка создания таблицы News!';
    }

    $sql = "
    CREATE TABLE comments (
    id int(11) NOT NULL auto_increment,
    text TEXT,
    user_id int(2) NOT NULL default 1,
    news_id int(2) NOT NULL, 
    pub_date varchar(50) NOT NULL default '',
    PRIMARY KEY (id))";
    //echo mysqli_query($base,$sql);
    if(!@mysqli_query($base,$sql)) {
        $errors['mysql_create_comments'] = 'Ошибка создания таблицы Comments!';
    }

    $sql = "
    INSERT INTO users (id, name, login, password, role) 
    VALUES (NULL, '" . $admin_name . "', '" . $admin_login . "', '" . $admin_password ."',1);";
    //mysql_query($sql) or die("6 " . mysql_error());
    if(!@mysqli_query($base,$sql)) {
        $errors['mysql_insert_users'] = 'Ошибка создания Администратора!';
    }
    else {
        mysqli_close($base);
        $data = "<?php\r\ndefine(DB_HOST,\"" . $host . "\");\r\ndefine(DB_LOGIN, \"" . $user .
        "\");\r\ndefine(DB_PASSWORD, \"" . $password . "\");\r\ndefine(DB_NAME, \"easyblog\");\r\ndefine(DB_INSTALL,TRUE);\r\n?>";
        file_put_contents(dirname(__FILE__).'../../config.inc.php', $data); //сохранение созданого конфига в файл
        $success =  'DB Create Successful!';
    }
    
?>