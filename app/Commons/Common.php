<?php
namespace App\Commons;
class Common {
    public static $STATUS = [
        '' => 'Select one',
        '0' => 'Public',
        '1' => 'Unpublic'
    ];

    public static $CLASS = [
        '' => 'Select one',
        'themeforest' => 'Theme forest',
        'codecanyon' => 'Codecanyon',
        'video' => 'Video',
        'audio' => 'Audio',
        'photo' => 'Photo',
        'graphic' => 'Graphic',
    ];

    public static $TAGS = [
        'div' => 'div',
        'ul' => 'ul',
        'li' => 'li',
        'p' => 'p',
        'span' => 'span',
        'a' => 'link a',
        'img' => 'img',
        'h1' => 'h1',
        'h2' => 'h2',
        'h3' => 'h3',
        'h4' => 'h4',
        'h5' => 'h5',
        'b' => 'b',
        'i' => 'i',
        'table' => 'table',
        'tr' => 'tr',
        'td' => 'td',
        'th' => 'th',
        'strong' => 'strong',
    ];

    public static $TYPES = [
        '0' => 'Select one',
        '1' => 'Text',
        '2' => 'Image',
        '3' => 'Link',
    ];
}