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
 * Theme Learnbook - settings file
 *
 * @package    theme_learnbook
 * @copyright  2019 eCreators PTY LTD
 * @author     2019 Chris Megahan, eCreators <chris@ecreators.com.au>
 * @author     2021 Fouad Saikali, eCreators <fouad.saikali@ecreators.com.au>
 * @author     2021 Lupiya Mujala, eCreators <lupiya.mujala@ecreators.com.au>
 * @author     2021 Rob Hunt, eCreators <rob.hunt@ecreators.com.au>
 * @author     2021 Safat Shahin, eCreators <safat.shahin@ecreators.com.au>
 *
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */


defined('MOODLE_INTERNAL') || die();

require_once(__DIR__.'/libs/admin_confightmleditor.php');

global $OUTPUT, $PAGE;

if ($ADMIN->locate('themes') and $ADMIN->locate('root')){

    $ADMIN->add('themes', new admin_category('theme_learnbook', 'Learnbook Footer'));

    include(dirname(__FILE__) . '/settings/learnbook_footer.php');
}

if ($ADMIN->fulltree) {

    $settings = new theme_boost_admin_settingspage_tabs('themesettinglearnbook', get_string('configtitle', 'theme_learnbook'));
    $page = new admin_settingpage('theme_learnbook_general', get_string('generalsettings', 'theme_learnbook'));


    $name = 'theme_learnbook/preset';
    $title = get_string('preset', 'theme_learnbook', null, true);
    $description = get_string('preset_desc', 'theme_learnbook', null, true);
    $default = 'default.scss';

    $context = context_system::instance();
    $fs = get_file_storage();
    $files = $fs->get_area_files($context->id, 'theme_learnbook', 'preset', 0, 'itemid, filepath, filename', false);

    $choices = [];
    foreach ($files as $file) {
        $choices[$file->get_filename()] = $file->get_filename();
    }

    $choices['default.scss'] = 'default.scss';
    $choices['plain.scss'] = 'plain.scss';

    $setting = new admin_setting_configselect($name, $title, $description, $default, $choices);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    $name = 'theme_learnbook/presetfiles';
    $title = get_string('presetfiles','theme_learnbook');
    $description = get_string('presetfiles_desc', 'theme_learnbook');

    $setting = new admin_setting_configstoredfile($name, $title, $description, 'preset', 0,
        array('maxfiles' => 20, 'accepted_types' => array('.scss')));
    $page->add($setting);

    $name = 'theme_learnbook/brandcolor';
    $title = get_string('brandcolor', 'theme_learnbook');
    $description = get_string('brandcolor_desc', 'theme_learnbook');
    $setting = new admin_setting_configcolourpicker($name, $title, $description, '');
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);
    //$settings->add($page);

    //userprofile redirection settings
    $name = 'theme_learnbook/learnbook_user_profile';
    $title = get_string('learnbook_user_profile', 'theme_learnbook');
    $description = get_string('learnbook_user_profile_desc', 'theme_learnbook');
    $setting = new admin_setting_configcheckbox($name, $title, $description, 0);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    //use learnbook menu
    $name = 'theme_learnbook/use_menumanagement';
    $title = get_string('use_menumanagement', 'theme_learnbook');
    $description = get_string('use_menumanagement_desc', 'theme_learnbook');
    $setting = new admin_setting_configcheckbox($name, $title, $description, 0);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    // Alternate home page settings
    $setting = new admin_setting_configcheckbox('theme_learnbook/use_alternate_home_page', get_string('use_alternate_home_page', 'theme_learnbook'),
        get_string('use_alternate_home_page_desc', 'theme_learnbook'), 0);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    $settings->add($page);

    $page = new admin_settingpage('theme_learnbook_common', get_string('commonsettings', 'theme_learnbook'));

    $name = 'theme_learnbook/headercolor';
    $title = get_string('headercolor', 'theme_learnbook');
    $description = get_string('headercolor_desc', 'theme_learnbook');
    $setting = new admin_setting_configcolourpicker($name, $title, $description, '');
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    $name = 'theme_learnbook/headertextcolor';
    $title = get_string('headertextcolor', 'theme_learnbook');
    $description = get_string('headertextcolor_desc', 'theme_learnbook');
    $setting = new admin_setting_configcolourpicker($name, $title, $description, '');
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    $name = 'theme_learnbook/leftmenuitemhovercolor';
    $title = get_string('leftmenuitemhovercolor', 'theme_learnbook');
    $description = get_string('leftmenuitemhovercolor_desc', 'theme_learnbook');
    $setting = new admin_setting_configcolourpicker($name, $title, $description, '');
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    $name = 'theme_learnbook/leftmenuitemstextcolor';
    $title = get_string('leftmenuitemstextcolor', 'theme_learnbook');
    $description = get_string('leftmenuitemstextcolor_desc', 'theme_learnbook');
    $setting = new admin_setting_configcolourpicker($name, $title, $description, '');
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    $name = 'theme_learnbook/leftmenumainitemcolor';
    $title = get_string('leftmenumainitemcolor', 'theme_learnbook');
    $description = get_string('leftmenumainitemcolor_desc', 'theme_learnbook');
    $setting = new admin_setting_configcolourpicker($name, $title, $description, '');
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    $name = 'theme_learnbook/leftmenusubitemcolor';
    $title = get_string('leftmenusubitemcolor', 'theme_learnbook');
    $description = get_string('leftmenusubitemcolor_desc', 'theme_learnbook');
    $setting = new admin_setting_configcolourpicker($name, $title, $description, '');
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    $name = 'theme_learnbook/footercolor';
    $title = get_string('footercolor', 'theme_learnbook');
    $description = get_string('footercolor_desc', 'theme_learnbook');
    $setting = new admin_setting_configcolourpicker($name, $title, $description, '');
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);


    $name = 'theme_learnbook/sectionheadercolor';
    $title = get_string('sectionheadercolor', 'theme_learnbook');
    $description = get_string('sectionheadercolor_desc', 'theme_learnbook');
    $setting = new admin_setting_configcolourpicker($name, $title, $description, '');
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    $name = 'theme_learnbook/coursebtncolor';
    $title = get_string('coursebtncolor', 'theme_learnbook');
    $description = get_string('coursebtncolor_desc', 'theme_learnbook');
    $setting = new admin_setting_configcolourpicker($name, $title, $description, '');
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    $settings->add($page);

    $page = new admin_settingpage('theme_learnbook_logo', get_string('logosettings', 'theme_learnbook'));

    $title = get_string('logo', 'admin');
    $description = get_string('logo_desc', 'admin');
    $setting = new admin_setting_configstoredfile('core_admin/logo', $title, $description, 'logo', 0,
        ['maxfiles' => 1, 'accepted_types' => ['.jpg', '.png']]);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    $title = get_string('logocompact', 'admin');
    $description = get_string('logocompact_desc', 'admin');
    $setting = new admin_setting_configstoredfile('core_admin/logocompact', $title, $description, 'logocompact', 0,
        ['maxfiles' => 1, 'accepted_types' => ['.jpg', '.png']]);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    $title = get_string('favicon', 'theme_learnbook');
    $description = get_string('favicon_desc', 'theme_learnbook');
    $setting = new admin_setting_configstoredfile('theme_learnbook/favicon', $title, $description, 'favicon', 0,
        ['maxfiles' => 1, 'accepted_types' => ['.jpg', '.png', '.ico']]);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);


    $settings->add($page);

    //login page settings
    $page = new admin_settingpage('theme_learnbook_login',
        get_string('loginpagesettings', 'theme_learnbook'));

    $templates = array (
        'learnbook_template' => $OUTPUT->image_url('learnbook_template', 'theme_learnbook'),
        'athena_template' => $OUTPUT->image_url('athena_template', 'theme_learnbook'),
        'apollo_template' => $OUTPUT->image_url('apollo_template', 'theme_learnbook')
    );
    $template_description =
        '<div class="learnbook-template container float-left">
            <div class="row">
                <div class="col=4">
                    <a target="_blank" href='.$templates['learnbook_template'].'>
                        <img class="img-responsive" src="'.$templates['learnbook_template'].'" alt="Learnbook Template" width="150" height="75">
                    </a>
                    <div class="text-center">Learnbook Template</div>
                </div>
                <div class="col=4 ml-2">
                    <a target="_blank" href='.$templates['apollo_template'].'>
                        <img class="img-responsive" src="'.$templates['apollo_template'].'" alt="Learnbook Template" width="150" height="75">
                    </a>
                    <div class="text-center">Apollo Template</div>
                </div>
                <div class="col=4 ml-2">
                    <a target="_blank" href='.$templates['athena_template'].'>
                        <img class="img-responsive" src="'.$templates['athena_template'].'" alt="Learnbook Template" width="150" height="75">
                    </a>
                    <div class="text-center">Athena Template</div>
                </div>
            </div>
        </div>';
    $setting = new admin_setting_configselect('theme_learnbook/login_page_template',
        get_string('login_page_template', 'theme_learnbook'),
        $template_description,
        'Apollo',
        array('Learnbook' => get_string('learnbook_template', 'theme_learnbook'),
              'Athena' => get_string('athena_template', 'theme_learnbook'),
              'Apollo' => get_string('apollo_template', 'theme_learnbook')));
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    $name = 'theme_learnbook/display_welcome_text';
    $title = get_string('display_welcome_text', 'theme_learnbook');
    $description = get_string('display_welcome_text_desc', 'theme_learnbook');
    $setting = new admin_setting_configcheckbox($name, $title, $description, true, true, false);
    $page->add($setting);

    $setting = new admin_setting_configselect('theme_learnbook/welcome_text_location',
        get_string('welcome_text_location', 'theme_learnbook'),
        get_string('welcome_text_location_desc', 'theme_learnbook'), 'left',
        array('left' => get_string('left_side', 'theme_learnbook'),
            'right' => get_string('right_side', 'theme_learnbook')));
    $page->add($setting);

    $setting = new admin_setting_confightmleditor('theme_learnbook/logintitle',
        get_string('logintitle', 'theme_learnbook'),
        get_string('logintitle_desc', 'theme_learnbook'),
        get_string('logintitle_default', 'theme_learnbook'), PARAM_RAW);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    $setting = new admin_setting_confightmleditor('theme_learnbook/welcometitle',
        get_string('welcometitle', 'theme_learnbook'),
        get_string('welcometitle_desc', 'theme_learnbook'),
        get_string('welcometitle', 'theme_learnbook'), PARAM_RAW);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    $setting = new admin_setting_confightmleditor('theme_learnbook/welcomemsg',
        get_string('welcomemsg', 'theme_learnbook'),
        get_string('welcomemsg_desc', 'theme_learnbook'),
        get_string('welcomemsg', 'theme_learnbook'), PARAM_RAW);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);


    $name = 'theme_learnbook/welcomeimg';
    $title = get_string('welcomeimg', 'theme_learnbook');
    $description = get_string('welcomeimg_desc', 'theme_learnbook');
    $setting = new admin_setting_configstoredfile($name, $title, $description, 'welcomeimg', 0,
        ['maxfiles' => 1, 'accepted_types' => ['.jpg', '.png']]);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);


    $name = 'theme_learnbook/slideshow';
    $title = get_string('slideshow', 'theme_learnbook');
    $description = get_string('slideshowdesc', 'theme_learnbook');
    $setting = new admin_setting_configstoredfile($name, $title, $description, 'slideshow', 0,
        ['maxfiles' => 6, 'accepted_types' => ['.jpg', '.png']]);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    $settings->add($page);

    //footer
    $page = new admin_settingpage('theme_learnbook_footer', get_string('layoutsettings', 'theme_learnbook'));
    $footer_url = $CFG->wwwroot.'/admin/settings.php?section=theme_learnbook_layout';
    $footer_string_heml = '<a href='.$footer_url.'>Click here</a>';
    $footer_string = $footer_string_heml.' to customise the footer.';
    $page->add(new admin_setting_heading('theme_learnbook_footer_head', get_string('footersettings', 'theme_learnbook'), $footer_string));
    $settings->add($page);

    //advanced settings
    $page = new admin_settingpage('theme_learnbook_advanced', get_string('advancedsettings', 'theme_learnbook'));

    $setting = new admin_setting_configtextarea('theme_learnbook/scsspre',
        get_string('rawscsspre', 'theme_learnbook'), get_string('rawscsspre_desc', 'theme_learnbook'), '', PARAM_RAW);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    $setting = new admin_setting_configtextarea('theme_learnbook/scss', get_string('rawscss', 'theme_learnbook'),
        get_string('rawscss_desc', 'theme_learnbook'), '', PARAM_RAW);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    $settings->add($page);
}
