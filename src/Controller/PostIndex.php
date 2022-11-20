<?php

namespace silverorange\DevTest\Controller;

use silverorange\DevTest\Context;
use silverorange\DevTest\Template;

class PostIndex extends Controller
{
    private array $posts = [];

    public function getContext(): Context
    {
        $context = new Context();
        $context->title = 'Posts';
        $context->posts = $this->posts;
        return $context;
    }

    public function getTemplate(): Template\Template
    {
        return new Template\PostIndex();
    }

    protected function loadData(): void
    {

        $this->selectQuery = "SELECT posts.*, authors.full_name AS author_full_name FROM posts "
            . " INNER JOIN authors ON posts.author = authors.id ORDER BY created_at DESC";
        $selectRun = $this->db->prepare($this->selectQuery);
        $selectRun->execute(); 
        $selectOutput = $selectRun->fetch();

        if ($selectOutput) {
            foreach ($selectOutput as $key => $post) {
                $this->posts[] = $post;
            }
        } else {
            $this->posts = [];
        }
        
    }
}
