<?php

use Illuminate\Support\Facades\Auth;

function me() {
    /* -------------------------------------------------------------------------- */
    /*                               AMBIL DATA USER                              */
    /* -------------------------------------------------------------------------- */
    // SECTION AMBIL DATA USER
    return Auth::user();
    // !SECTION AMBIL DATA USER
}

function myRole() {
    /* -------------------------------------------------------------------------- */
    /*                               AMBIL ROLE USER                              */
    /* -------------------------------------------------------------------------- */
    // SECTION AMBIL ROLE USER
    return Auth::user()->getRoleNames()[0];
    // !SECTION AMBIL ROLE USER
}