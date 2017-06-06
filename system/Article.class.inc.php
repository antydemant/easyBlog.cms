<?php
class Article
{
    private $id;
    private $title;
    private $text;
    private $date;
    private $user_name;

    public function __construct($id, $title, $pub_text, $pub_date, $user_name)
    {
        $this->id = $id;
        $this->title = $title;
        $this->text = $pub_text;
        $this->date = $pub_date;
        $this->user_name = $user_name;
    }
    public function getID(){
        return $this->id;
    }
    public function getTitle(){
        return $this->title;
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
        $article = array();
        $article['id'] = $this->id;
        $article['title'] = $this->title;
        $article['text'] = $this->text;
        $article['date'] = $this->date;
        $article['user_name'] = $this->user_name;
        return $article;
    }
}