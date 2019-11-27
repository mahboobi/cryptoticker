<?php
$config['login'][] = array('field'=>'login', 'label'=>'login', 'rules'=>'required|callback__isPasswordOK');
$config['login'][] = array('field'=>'password', 'label'=>'password', 'rules'=>'required');
