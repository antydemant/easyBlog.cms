<?php
    if(!mysql_connect($host, $user, $password)) {
        $errors['mysql_connect'] = 'Ошибка соединения с базой данных!';
    } //запиши помилки в масив! маст хев!!!!!!!
    $sql = 'CREATE DATABASE easyblog';
    if(!mysql_query($sql)) {
        $errors['mysql_create'] = 'Ошибка создания базы!';
    }

    if(!mysql_select_db('easyblog')) {
        $errors['mysql_select'] = 'Ошибка выбора базы!';
    }
    $sql = "
    CREATE TABLE users (
	id int(11) NOT NULL auto_increment,
	name varchar(50) NOT NULL default '',
	login varchar(50) NOT NULL UNIQUE,
    password varchar(50) NOT NULL default '',
	PRIMARY KEY (id))";
    //mysql_query($sql) or die("5 " . mysql_error());
    if(!mysql_query($sql)) {
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
    if(!mysql_query($sql)) {
        $errors['mysql_create_news'] = 'Ошибка создания таблицы News!';
    }
    $sql = "
    INSERT INTO users (id, name, login, password) 
    VALUES (NULL, '" . $admin_name . "', '" . $admin_login . "', '" . $admin_password ."');";
    //mysql_query($sql) or die("6 " . mysql_error());
    if(!mysql_query($sql)) {
        $errors['mysql_insert_users'] = 'Ошибка создания Администратора!';
    }
    else {
        mysql_close();
        $data = "<?php\r\ndefine(DB_HOST,\"" . $host . "\");\r\ndefine(DB_LOGIN, \"" . $user .
        "\");\r\ndefine(DB_PASSWORD, \"" . $password . "\");\r\ndefine(DB_NAME, \"easyblog\");\r\ndefine(DB_INSTALL,TRUE);\r\n?>";
        file_put_contents(dirname(__FILE__).'../../config.inc.php', $data); //сохранение созданого конфига в файл
        $success =  'DB Create Successful!';
    }
    
?>