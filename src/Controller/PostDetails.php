<?php

namespace silverorange\DevTest\Controller;

use silverorange\DevTest\Context;
use silverorange\DevTest\Template;
use silverorange\DevTest\Model;

class PostDetails extends Controller
{
    private ?Model\Post $post = null;
    public $selectQuery; // For debugging output

    public function getContext(): Context
    {
        $context = new Context();

        if ($this->post === null) {
            $context->title = 'Not Found';
            $context->content = "A post with id {$this->params[0]} was not found.<br>";
        } else {
            $context->id = $this->post->id;
            $context->title = $this->post->title;
            $context->body = $this->post->body;
            $context->created_at = $this->post->created_at;
            $context->modified_at = $this->post->modified_at;
            $context->author = $this->post->author;
            $context->author_full_name = $this->post->author_full_name;
        }

        return $context;
    }

    public function getTemplate(): Template\Template
    {
        if ($this->post === null) {
            return new Template\NotFound();
        }

        return new Template\PostDetails();
    }

    public function getStatus(): string
    {
        if ($this->post === null) {
            return $_SERVER['SERVER_PROTOCOL'] . ' 404 Not Found';
        }

        return $_SERVER['SERVER_PROTOCOL'] . ' 200 OK';
    }

    protected function loadData(): void
    {
        // TODO: Load post from database here. $this->params[0] is the post id.

        $this->selectQuery = "SELECT posts.*, authors.full_name AS author_full_name FROM posts "
            . " INNER JOIN authors ON posts.author = authors.id"
            . " WHERE posts.id =:id";
        $selectRun = $this->db->prepare($this->selectQuery);
        $selectRun->bindValue(':id', $this->params[0]);
        $selectRun->execute();
        $selectOutput = $selectRun->fetch();

        if (!$selectOutput) {
            $this->post = null;
        } else {
            $this->post = new Model\Post();
            $this->post->id = $selectOutput['id'];
            $this->post->title = $selectOutput['title'];
            $this->post->body = $selectOutput['body'];
            $this->post->created_at = $selectOutput['created_at'];
            $this->post->modified_at = $selectOutput['modified_at'];
            $this->post->author = $selectOutput['author'];
            $this->post->author_full_name = $selectOutput['author_full_name'];
        }
    }
}
