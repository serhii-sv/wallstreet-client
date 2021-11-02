<?php

function canEditLang()
: bool {
    if (auth()->check() && auth()->user()->can('translate')) {
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
