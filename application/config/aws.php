<?php

$config['profile1'] = array(
    // Bootstrap the configuration file with AWS specific features
    'includes' => array('_aws'),
    'services' => array(
        // All AWS clients extend from 'default_settings'. Here we are
        // overriding 'default_settings' with our default credentials and
        // providing a default region setting.
        'default_settings' => array(
            'params' => array(
                'key'    => 'AKIAIAEZNPN2F5KIHWJA',
                'secret' => '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',
                'region' => 'ap-southeast-1'
            )
        )
    )
);

$config['profile1_auth'] = array(
                'key'    => 'AKIAIAEZNPN2F5KIHWJA',
                'secret' => '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',
                'region' => 'ap-southeast-1'
            );