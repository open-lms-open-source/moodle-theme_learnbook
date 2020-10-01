<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * Theme Learnbook - en language file
 *
 * @package    theme_learnbook
 * @author     2019 Chris Megahan, eCreators <chris@ecreators.com.au>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['pluginname'] = 'Learnbook';
$string['choosereadme'] = 'Learnbook';

// Settings
$string['configtitle'] = 'Learnbook Settings';

// General settings
$string['generalsettings'] = 'General settings';
$string['preset'] = 'Theme preset';
$string['preset_desc'] = 'Pick a preset to broadly change the look of the theme.';
$string['presetfiles'] = 'Additional theme preset files';
$string['presetfiles_desc'] = 'Preset files can be used to dramatically alter the appearance of the theme. See <a href=https://docs.moodle.org/dev/Boost_Presets>Boost presets</a> for information on creating and sharing your own preset files, and see the <a href=http://moodle.net/boost>Presets repository</a> for presets that others have shared.';
$string['brandcolor'] = 'Brand colour';
$string['brandcolor_desc'] = 'The accent colour.';

// Common settings
$string['commonsettings'] = 'Common settings';
$string['headercolor'] = 'Header colour';
$string['headercolor_desc'] = 'The color will be applied to site header background.';
$string['headertextcolor'] = 'Header text colour';
$string['headertextcolor_desc'] = 'The color will be applied to text in the site header.';
$string['leftmenuheadercolor'] = 'Learnbook panel header colour';
$string['leftmenuheadercolor_desc'] = 'The color will be applied to header of learnbook panel.';
$string['leftmenuheadertextcolor'] = 'Learnbook panel header text colour';
$string['leftmenuheadertextcolor_desc'] = 'The color will be applied to text of learnbook panel header';
$string['leftmenuitemhovercolor'] = 'Learnbook panel menu items hover colour';
$string['leftmenuitemhovercolor_desc'] = 'The color will be applied to background of menu items when they are hovered.';
$string['leftmenuitemstextcolor'] = 'Learnbook panel menu items text color';
$string['leftmenuitemstextcolor_desc'] = 'The color will be applied to text of menu items';
$string['leftmenumainitemcolor'] = 'Learnbook panel main menu items background color';
$string['leftmenumainitemcolor_desc'] = 'The color will be applied as background color of menu items';
$string['leftmenusubitemcolor'] = 'Learnbook panel sub menu items background color';
$string['leftmenusubitemcolor_desc'] = 'The color will be applied as background color of sub menu items';
$string['footercolor'] = 'Footer background color';
$string['footercolor_desc'] = 'The color will be applied as background color to footer.';
$string['sectionheadercolor'] = 'Section header colour';
$string['sectionheadercolor_desc'] = 'The color will be applied as background of Section header.';
//$string['sectionhovercolor'] = 'Section hover colour';
//$string['sectionhovercolor_desc'] = 'The color will be applied as background to button in sections when hovered on them.';
$string['coursetilecolor'] = 'My Teams tile background color';
$string['coursetilecolor_desc'] = 'The color will be applied as background of teams tile';
$string['coursetiletextcolor'] = 'Course tile text color';
$string['coursetiletextcolor_desc'] = 'The color will be applied to text in a course tile';
$string['coursebtncolor'] = 'Learnbook blocks color scheme';
$string['coursebtncolor_desc'] = 'The branding color for My Courses block.';
$string['coursebtnhovercolor'] = 'Enter Course button hover color';
$string['coursebtnhovercolor_desc'] = 'The color will be applied when hover on Enter Course button';
$string['login_page_template'] = 'Select login page template';

// Logo Settings
$string['logosettings'] = 'Logo settings';
$string['favicon'] = 'Favicon';
$string['favicon_desc'] = 'Upload your favicon icon here';

// Login Page Settings
$string['loginpagesettings'] = 'Login Page Settings';
$string['display_welcome_text'] = "Display welcome text";
$string['display_welcome_text_desc'] = "Uncheck to hide welcome text from Apollo and Learnbook template (Not applicable for Athena template).";
$string['welcometitle'] = "Welcome Title";
$string['welcometitle_desc'] = "Title to be showed for Welcome Message on login page (maximum 30 characters allowed).";
$string['welcomemsg'] = "Welcome Message";
$string['welcomemsg_desc'] = "Welcome Message to be displayed on login page.";
$string['welcome_text_location'] = "Welcome Text Location";
$string['welcome_text_location_desc'] = "Display welcome text on left or right hand side Athena or Apollo template, mobile view might affect this change (Not applicable for Learnbook template).";
$string['left_side'] = "Left side";
$string['right_side'] = "Right side";
$string['welcomeimg'] = "Welcome Image";
$string['welcomeimg_desc'] = "Background image of Welcome Message on login page (Not applicable for Apollo and Learnbook template).";
$string['slideshow'] =  'Login Slide Image';
$string['slideshowdesc'] = 'Select Image for Login Page Slide Show';
$string['login_page_template_desc'] = 'Select the template for the login page.';
$string['learnbook_template'] = 'Learnbook Template';
$string['athena_template'] = 'Athena Template';
$string['apollo_template'] = 'Apollo Template';
$string['logintitle'] = 'Login form title';
$string['logintitle_desc'] = 'Title text to be displayed in the login form (maximum 40 characters allowed).';
$string['logintitle_default'] = 'Login';

// Advanced Settings
$string['advancedsettings'] = 'Advanced settings';
$string['rawscsspre'] = 'Raw initial SCSS';
$string['rawscsspre_desc'] = 'In this field you can provide initialising SCSS code, it will be injected before everything else. Most of the time you will use this setting to define variables.';
$string['rawscss'] = 'Raw SCSS';
$string['rawscss_desc'] = 'Use this field to provide SCSS or CSS code which will be injected at the end of the style sheet.';

// Login form
$string['or'] = 'Or login with';
$string['guest_login_desc'] = 'Want to explore the site? Login as a guest';
$string['guest_login'] = 'Guest Login';
$string['sign_up'] = 'Sign up';
$string['capslock_help'] = 'Caps lock is on';
$string['resetfields'] = 'Forgot password?';

// The learnbook user profile settings
$string['learnbook_user_profile'] = 'Enable Learnbook User Profile redirection';
$string['learnbook_user_profile_desc'] = 'Toggle to turn on/off learnbook user profile redirection.';

//footer settings
$string['disabled'] = 'Disable';
$string['moodledocs'] = 'Moodle Docs link';
$string['moodledocsdesc'] = 'Display the Moodle Docs link in the footer.';
$string['layoutcheck'] = 'Check your layout';
$string['layoutcheckdesc'] = 'Use the tool below to check the number of blocks you have used and see a representation of your new layout.';
$string['layoutcount1'] = 'You can set a maximum of ';
$string['layoutcount2'] = ' block regions. You are currently using: ';
$string['layoutaddcontent'] = 'Happy With Your Layout? Now Add Content to Your Blocks.';
$string['layoutaddcontentdesc'] = 'Please use html if you want to customise your text.';
$string['layoutsettings'] = 'Footer Settings';
$string['footersettings'] = 'Footer';
$string['footersettingsheading'] = 'Set the content that should appear in the footer.';
$string['footerdesc'] = 'Control the content that appears in the 4 footer sections of the page.';
$string['showfooterblocks'] = 'Show Footnote Block';
$string['showfooterblocksdesc'] = 'Show / hide the lower footerblock used for footnote / Moodle docs region';
$string['moodlefooterinfo'] = 'Moodle Standard links';
$string['moodlefooterinfodesc'] = 'Display the moodle standard links in the footer.';
$string['footerlayoutrow'] = 'Footer Layout Builder';
$string['footerlayoutrowdesc'] = 'Design your layout for footer block regions.';
$string['footnote'] = 'Footnote';
$string['footnotedesc'] = 'Add text to the footer.';
$string['footercontent'] = 'Footer Content Section ';
$string['footercontentdesc'] = 'Add content to footer section ';
$string['hide'] = 'Hide';
$string['show'] = 'Show';

