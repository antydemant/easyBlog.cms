<?php
class MySQL
{
    protected $db = null;
    protected $result = null;
    protected $host = 'localhost';
    protected $user = 'root';
    protected $password = '';
    protected $base = 'easyblog';
    protected $port = null;

    public function __construct($host, $user, $password, $base, $port)
    {
        if (!empty($host))
            $this->host = $host;
        if (!empty($user))
            $this->user = $user;
        if (!empty($password))
            $this->password = $password;
        if (!empty($base))
            $this->base = $base;
        if (!empty($port))
            $this->port = $port;

    }


    private function connectBase()
    {
        $this->db = new mysqli($this->host, $this->user, $this->password, $this->base, $this->
            port);
        if ($this->db->connect_errno) {
            return false;
        } else {
            return $this->db;
        }
    }

    public function addArticle($title, $datetime, $text, $user_id)
    {
        if ($this->connectBase() != false) {
            $sql = "INSERT INTO news (title, pub_date, pub_text, user_id) 
                    VALUES('$title', $datetime, '$text', " . (int)$user_id . ")";
            if ($this->db->query($sql)) {
                $this->db->close();
                return true;
            } else {
                $this->db->close();
                return false;
            }
        } else {
            return false;
        }
    }

    public function delArticle($id)
    {
        if ($this->connectBase() !== false) {
            $sql = "DELETE FROM news WHERE id=" . (int)$id;
            if ($this->db->query($sql)) {
                $this->db->close();
                return true;
            } else {
                $this->db->close();
                return false;
            }
        } else {
            return false;
        }
    }

    public function updArticle($id_pub, $title_update, $text_update, $user_id)
    {
        if ($this->connectBase() !== false) {
            $sql = "UPDATE news SET title = '" . $title_update . "', pub_date = " . time() .
                ", pub_text = '" . $text_update . "', user_id=" . (int)$user_id . " WHERE id=" . (int)
                $id_pub;
            if ($this->db->query($sql)) {
                $this->db->close();
                return true;
            } else {
                $this->db->close();
                return false;
            }
        } else {
            return false;
        }
    }

    public function getArticles($pagination = null, $id = null)
    {
        $articles = null;
        if ($this->connectBase() !== false) {
            if ($pagination === 'all') {
                $sql = "SELECT n.id, n.title, n.pub_date, n.pub_text, u.name FROM news n INNER JOIN users u ON u.id = n.user_id
                        ORDER BY n.id DESC";
            } elseif ($pagination !== null && $id === null) {
                $lastpage = $pagination * 5;
                $firstpage = $lastpage - 5;
                $sql = "SELECT n.id, n.title, n.pub_date, n.pub_text, u.name FROM news n INNER JOIN users u ON u.id = n.user_id
                        ORDER BY n.id DESC LIMIT $firstpage, $lastpage";
            } elseif ($pagination === null && $id !== null) {
                $sql = "SELECT n.id, n.title, n.pub_date, n.pub_text, u.name FROM news n INNER JOIN users u ON u.id = n.user_id
                        WHERE n.id=" . (int)$id;
            }
            if ($result = $this->db->query($sql)) {
                $this->db->close();
                while ($row = $result->fetch_assoc()) {
                    $article = new Article($row['id'], $row['title'], $row['pub_text'], $row['pub_date'],
                        $row['name']);
                    $articles[] = $article;
                    unset($article);
                }
                return $articles;
            } else {
                $this->db->close();
                return $articles;
            }
        } else {
            return $articles;
        }
    }

    public function addAdmin($name, $login, $password)
    {
        if ($this->connectBase() !== false) {
            $sql = "INSERT INTO users (name, login, password) 
                    VALUES('$name', '$login', '$password')";
            if ($this->db->query($sql)) {
                $this->db->close();
                return true;
            } else {
                $this->db->close();
                return false;
            }
        } else {
            return false;
        }
    }

    public function getAdmin($login)
    {
        if ($this->connectBase() !== false) {
            $sql = "SELECT id, name, login, password FROM users
                    WHERE login='$login'";
            if ($result = $this->db->query($sql)) {
                return $result->fetch_assoc();
            } else {
                $this->db->close();
                return false;
            }
        } else {
            return false;
        }
    }


}


?>