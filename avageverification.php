<?php

/**
 * AvAgeVerification Module Main Php File
 *
 * PHP version 5.4
 *
 * @category Module
 * @package  AvAgeVerification
 * @author   Maxime Morlet <Maxime.Morlet@outlook.com>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     http://Maxicom.pro
 */
if (!defined('_PS_VERSION_')) {
    exit;
}

/**
 * AvAgeVerification Main Module Class
 *
 * @category Class
 * @package  AvAgeVerification
 * @author   Maxime Morlet <Maxime.Morlet@outlook.com>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     http://Maxicom.pro
 */
class AvAgeVerification extends Module
{
    /**
     * AvAgeVerification Constructor
     */
    public function __construct()
    {
        $this->name = 'avageverification';
        $this->tab = 'front_office_features';
        $this->version = '0.0.1';
        $this->author = 'Maxime Morlet';
        $this->need_instance = 0;
        $this->ps_versions_compliancy = [
            'min' => '1.6'
        ];
        $this->bootstrap = true;

        parent::__construct();

        $this->displayName = $this->l('Age Verification');
        $this->description = $this->l('Verify quickly and surely the users\' age with Age Verification!');

        if (!Configuration::get($this->name)) {
            $this->warning = $this->l('No name provided');
        }
    }

    /**
     * GetContent Method
     *
     * @return String
     */
    public function getContent()
    {

    }

    /**
     * HookDisplayFooter Method
     *
     * @return String
     */
    public function hookDisplayFooter()
    {
        return ($this->display(__FILE__, 'avageverification.tpl'));
    }

    /**
     * Install Method
     *
     * @return bool
     */
    public function install()
    {
        return (parent::install() &&
            $this->registerHook('displayFooter'));
    }

    public function uninstall()
    {
        return (parent::uninstall() &&
            $this->unregisterHook('displayFooter'));
    }
}