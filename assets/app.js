/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import './styles/app.scss';

// start the Stimulus application
import './bootstrap';

import 'bootstrap';

// Import all of Bootstrap's JS
import * as bootstrap from 'bootstrap'

import { Tooltip, Toast, Popover } from 'bootstrap';

import * as Popper from "@popperjs/core"

import $ from "jquery";
//const $ = require('jquery');

import jquery from 'jquery';

import 'jquery-ui';

global.$ = global.jQuery = $;

require('bootstrap');

import '/node_modules/bootstrap/dist/css/bootstrap.min.css';

import '/node_modules/jquery-ui/themes/base/theme.css';

require('select2')($);

import './select2';

import './datepicker.js';

import './recrutements';
//import './personnels';

import greet from './greet';

$(document).ready(function () {
    $('body').prepend('<h1>' + greet('Mr SIDIBE') + '</h1>');
});