<?php

namespace silverorange\DevTest;

class Context
{
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

    public string $title = '';

    public string $content = '';
}
