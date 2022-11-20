<?php

namespace silverorange\DevTest;

class Context
{

    // public $Parsedown = new Parsedown();

    public string $title = '';
    public string $content = '';
    public string $body = '';
    public string $created_at = '';
    public string $modified_at = '';
    public string $author = '';
    public string $author_full_name = '';

    // TODO: You can add more properties to this class to pass values to templates

    public function getPostId() {
        return $this->id;
    }

    public function getPostTitle() {
        return $this->title;
    }
    
    public function getPostBodyRaw() {
        return $this->body;
    }

    public function getPostBodyHTML() {
        $Parsedown = new \Parsedown();
        return $Parsedown->text($this->body);

    }
    
    public function getPostCreatedDate() {
        return $this->created_at;
    }
    
    public function getPostModifiedDate() {
        return $this->modified_at;
    }
    
    public function getPostAuthorId() {
        return $this->author;
    }
    
    public function getPostAuthorName() {
        return $this->author_full_name;
    }
    
}
