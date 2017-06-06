<?php

class Comment
{
    private $id;
    private $text;
    private $date;
    private $user_name;

    public function __construct($id, $username, $pub_text, $pub_date, $user_name)
    {
        $this->id = $id;
        $this->text = $pub_text;
        $this->date = $pub_date;
        $this->user_name = $user_name;
    }
    public function getID(){
        return $this->id;
    }
    public function getText(){
        return $this->text;
    }
    public function getDate(){
        return $this->date;
    }
    public function getUserName(){
        return $this->user_name;
    }

    public function getAllInfoArticle()
    {
        $comment = [];
        $comment['id'] = $this->id;
        $comment['text'] = $this->text;
        $comment['date'] = $this->date;
        $comment['user_name'] = $this->user_name;
        return $comment;
    }
}