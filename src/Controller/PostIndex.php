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

        $this->selectQuery = "SELECT posts.id, posts.title, posts.created_at, authors.full_name AS author_full_name "
            . " FROM posts "
            . " INNER JOIN authors ON posts.author = authors.id ORDER BY created_at DESC";
        $selectRun = $this->db->prepare($this->selectQuery);
        $selectRun->execute();
        $selectOutput = $selectRun->fetchAll();

        if ($selectOutput) {
            foreach ($selectOutput as $key => $post) {
                unset($tempArray);
                $tempArray['id'] = $post['id'];
                $tempArray['title'] = $post['title'];
                $tempArray['created_at'] = $post['created_at'];
                $tempArray['author_full_name'] = $post['author_full_name'];
                $this->posts[] = $tempArray;
            }
        } else {
            $this->posts = [];
        }
    }
}
