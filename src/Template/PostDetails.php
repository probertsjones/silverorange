<?php

namespace silverorange\DevTest\Template;

use silverorange\DevTest\Context;

class PostDetails extends Layout
{
    protected function renderPage(Context $context): string
    {
        // @codingStandardsIgnoreStart
        return <<<HTML
        <div class="post">
            <h1 class="post-title">{$context->getPostTitle()}</h1>
            <div class="post-content-meta">
                By: <span class="post-author"><a href="/author/{$context->getPostAuthorId()}">{$context->getPostAuthorName()}</a></span> @ <span class="date">{$context->getPostCreatedDate()}</span>
            </div>
            <div class="post-content">{$context->getPostBodyHTML()}</div>
            <div class="post-footer">Last edited @ <span class="date">{$context->getPostModifiedDate()}</span></div>
        </div>
HTML;
        // @codingStandardsIgnoreEnd
    }
}
