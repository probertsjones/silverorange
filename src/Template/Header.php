<?php

namespace silverorange\DevTest\Template;

use silverorange\DevTest\Context;

/**
 * Template for common header content
 */
class Header implements Template
{
    public function render(Context $context): string
    {
        // @codingStandardsIgnoreStart
        return <<<HTML
<!DOCTYPE html>
<html lang="en">
     <head>
        <meta charset="utf-8" />
        <title>{$context->title} - My Site</title>
        <link rel="stylesheet" type="text/css" href="/assets/index.css" />
        <link rel="icon" href="/images/favicon.ico" type="image/x-icon" />
        <link rel="icon" href="/images/icon.svg" type="image/svg+xml">
        <link rel="apple-touch-icon" href="/images/apple-touch-icon.png" />
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1, minimum-scale=1, maximum-scale=1" />
        <meta name="mobile-web-app-capable" content="yes" />
        <meta name="apple-mobile-web-app-capable" content="yes" />
    </head>
    <body>
        <header class="header"></header>
        <main>
            <div class="container">
HTML;
        // @codingStandardsIgnoreEnd
    }
}
