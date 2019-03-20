<?php 

/*For Get Value Use 

get_theme_mod('text_setting'); 

*/



/*Customizer Code HERE*/
add_action('customize_register', 'theme_footer_customizer');
function theme_footer_customizer($wp_customize){
 //adding section in wordpress customizer   
$wp_customize->add_section('footer_settings_section', array(
  'title'          => 'Footer'
 ));
//adding setting for footer text area
$wp_customize->add_setting('text_setting', array(
 'default'        => '',
 ));
$wp_customize->add_control('text_setting', array(
 'label'   => 'Footer Text Here',
  'section' => 'footer_settings_section',
 'type'    => 'text',
));



$wp_customize->add_setting('text2', array(
 'default'        => '',
 ));
$wp_customize->add_control('text2', array(
 'label'   => 'Text Here',
  'section' => 'footer_settings_section',
 'type'    => 'text',
));





}


?>