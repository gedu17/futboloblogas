<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| Hooks
| -------------------------------------------------------------------------
| This file lets you define "hooks" to extend CI without hacking the core
| files.  Please see the user guide for info:
|
|	https://codeigniter.com/user_guide/general/hooks.html
|
*/
$hook['pre_system'] = array(
                    'class'    => 'Session_start',
                    'function' => 'do_session_start',
                    'filename' => 'session_start.php',
                    'filepath' => 'hooks',
                    'params'   => ''
                    );
