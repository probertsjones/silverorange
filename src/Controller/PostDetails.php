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
            $context->content = "A post with id {$this->params[0]} was not found." . $this->selectQuery;
        } else {
            $context->title = $this->post->title;
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

        $this->selectQuery = "SELECT * FROM posts WHERE id = :id";
        $selectRun = $this->db->prepare($this->selectQuery);
        $selectRun->bindValue(':id', $this->params[0]);
        $selectOutput = $selectRun->fetch();

        if (!$selectOutput) {
            $this->post = null;
        } else {
            foreach($selectOutput as $post) {
                $this->post = $post;
            }
        }

    }
}
