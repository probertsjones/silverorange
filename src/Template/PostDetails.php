<?php

namespace silverorange\DevTest\Template;

use silverorange\DevTest\Context;

class PostDetails extends Layout
{
    protected function renderPage(Context $context): string
    {
        // @codingStandardsIgnoreStart
        return <<<HTML
        <h1 class="post-title">{$context->getPostTitle()}</h1>
        <div class="post-content-meta">
            By: {$context->getPostAuthorName()} @ {$context->getPostCreatedDate()}
        </div>
        <div class="post-content">{$context->getPostBodyHTML()}</div>

HTML;
        // @codingStandardsIgnoreEnd
    }
}
