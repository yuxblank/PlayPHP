<?php
/*
 * Copyright (C) 2015 yuri.blanc
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */
/**
 * ** Template Settings **
 */
define ("TEMPLATE", "core");

/**
 * ** DEBUG **
 */
$debug = false;
define('APP_DEBUG', $debug);
if ($debug) {

//    Kint::dump( $_SERVER );
    // or, even easier, use a shorthand:
//    d( $_SERVER );
    // or, to seize execution after dumping use dd();
//    dd( $_SERVER ); // same as d( $_SERVER ); die;
    // to see trace:
//    Kint::trace();
    // or pass 1 to a dumper function
//    Kint::dump( 1 );
    // to disable all output
//    Kint::enabled(true);
    // further calls, this one included, will not yield any output
//    d('Get off my lawn!'); // no effect
}