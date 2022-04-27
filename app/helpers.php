<?php

function getTranslations(): array
{
    return [
        'global' => __('global'),
    ];
}

function locale_img(String $locale, String $size = '14px'): string
{
    return '<img src="/images/lang/'.$locale.'.svg" style="height: '.$size.'; width:auto;" alt="">';
}