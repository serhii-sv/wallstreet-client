<?php

function canEditLang()
: bool {
    if (auth()->check() && auth()->user()->hasRole('root|admin')) {
        return true;
    }
    return false;
}

function checkRequestOnEdit() : bool {
    if (request()->get('edit') && request()->get('edit') == 'true'){
        return true;
    }
    return false;
}