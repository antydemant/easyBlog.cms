<?php
        //�������� ������
        function getAdmin($login) {
            $sql = "SELECT id, name, login, password FROM users
                    WHERE login='$login'";
            $result = mysql_fetch_assoc(mysql_query($sql));
            return $result;
        }
        
        
        //������ ������
        function addAdmin($name, $login, $password) {
            $sql = "INSERT INTO users (name, login, password) 
                            VALUES('$name', '$login', '$password')";
            mysql_query($sql);
        }
        
        // �������� ����������
        function addPub($title, $datetime, $text, $user_id)
        {
            $sql = "INSERT INTO news (title, pub_date, pub_text, user_id) 
                            VALUES('$title', $datetime, '$text', " . (int)$user_id . ")";
            mysql_query($sql);
        }
        
        // ��������� ��������� 5 ����������
        function getLastPub($pagination)
        {
            $lastpage = $pagination*5;
            $firstpage = $lastpage - 5;
            $sql = "SELECT n.id, n.title, n.pub_date, n.pub_text, u.name FROM news n INNER JOIN users u ON u.id = n.user_id
                        ORDER BY n.id DESC LIMIT $firstpage, $lastpage";
            $sql_query = mysql_query($sql);
            return $sql_query;
        }
        
        // ��������� ����� ���������� �� ID ����������
        function getOnePub($id_pub)
        {
            $sql = "SELECT n.id, n.title, n.pub_date, n.pub_text, u.name FROM news n INNER JOIN users u ON u.id = n.user_id
                        WHERE n.id=" . (int)$id_pub;
            $sql_query = mysql_query($sql);
            return $sql_query;
        }
        
        // ��������� ���� ����������
        function getAllPub()
        {
            $sql = "SELECT n.id, n.title, n.pub_date, n.pub_text, u.name FROM news n INNER JOIN users u ON u.id = n.user_id
                        ORDER BY n.id DESC";
            $sql_query = mysql_query($sql);
            return $sql_query;
        }
        
        // ���������� ����������
        function editPub($id_pub, $title_update, $text_update, $user_id)
        {
            $sql = "UPDATE news SET title = '" . $title_update . "', pub_date = " . time() . ", pub_text = '" . $text_update . "'
                    user_id=" . (int)$user_id . " WHERE id=" . (int)$id_pub;
            
            mysql_query($sql);
            
            //return $sql_query;
        }
        function delPub($id_pub) {
            $sql = "DELETE FROM news WHERE id=". (int)$id_pub;
            mysql_query($sql);
        }

?>