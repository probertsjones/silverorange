<?php

namespace silverorange\DevTest\Template;

use silverorange\DevTest\Context;

class PostIndex extends Layout
{
    protected function renderPage(Context $context): string
    {

        $listFormat = '<li><a href="/posts/{id}">{title}</a><br>By: {author_full_name} @ {created_at}</li>';


        // @codingStandardsIgnoreStart
        return <<<HTML
        <h1>Latest Posts</h1>
        <pre>
            {$context->listPosts($listFormat,$context->getPosts())}
    </pre>
HTML;
        // @codingStandardsIgnoreEnd
    }
}
