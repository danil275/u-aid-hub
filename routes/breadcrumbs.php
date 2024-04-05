<?php

use Diglactic\Breadcrumbs\Breadcrumbs;
use Diglactic\Breadcrumbs\Generator;

Breadcrumbs::for('home', function (Generator $g) {
    $g->push('главная', route('home'));
});