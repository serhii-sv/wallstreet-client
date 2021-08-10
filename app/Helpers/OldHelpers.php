<?php

function canEditLang()
: bool {
    if (auth()->check() && auth()->user()->hasRole('root|admin')) {
        return true;
    }
    return false;
}
