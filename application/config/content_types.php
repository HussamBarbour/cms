<?php

/* 
 * Content Types By Hussam Barbour
 */

$config['content_types']['page'] = array(
    'primary'=> true,
    'name' => 'pages',
    'type' => 'page',
    'gallery' => true,
    'thumb_show' => false,
    'sub_content' => false,
    'sub' => true,
    'live_editor' => true,
    'menu' => true,
    'thumbs' => array(
        //array('width'=> '400','height'=> '400','maintain_ratio'=> true),
    ),
    'custom_fields' => array(
        //array('placeholder'=> 'trans','name'=> 'trans','type'=> 'input','trans'=> true),
    ),
    'category_custom_fields' => array(
        //array('placeholder'=> 'trans','name'=> 'trans','type'=> 'input','trans'=> true),
    ),
    
);




$config['content_types']['slider'] = array(
    'primary'=> true,
    'name' => 'slider',
    'type' => 'slider',
    'gallery' => false,
    'thumb_show' => true,
    'sub_content' => false,
    'sub' => false,
    'live_editor' => false,
    'menu' => false,
    'thumbs' => array(
        //array('width'=> '400','height'=> '400','maintain_ratio'=> true),
    ),
    'custom_fields' => array(
        //array('placeholder'=> 'trans','name'=> 'trans','type'=> 'input','trans'=> true),
    ),
    'category_custom_fields' => array(
        //array('placeholder'=> 'trans','name'=> 'trans','type'=> 'input','trans'=> true),
    ),
    
);

$config['content_types']['products'] = array(
    'primary'=> true,
    'name' => 'products',
    'type' => 'products',
    'gallery' => true,
    'thumb_show' => false,
    'sub' => true,
    'sub_content' => false,
    'live_editor' => true,
    'menu' => false,
    'thumbs' => array(
        array('width'=> '270','height'=> '200','maintain_ratio'=> true,'master_dim'=> 'width'),
        array('width'=> '480','height'=> '360','maintain_ratio'=> true,'master_dim'=> 'width'),
    ),
    'custom_fields' => array(
        
    ),
    'category_custom_fields' => array(
    ),
    
);