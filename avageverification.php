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

        $this->displayName = $this->l('AV Age Verification');
        $this->description = $this->l('Verify quickly and surely the users\' age with Age Verification!');
    }

    /**
     * DisplayForm Method
     *
     * @return string
     */
    public function displayForm()
    {
        $defaultLang = (int)Configuration::get('PS_LANG_DEFAULT');
        $helper = new HelperForm();
        $fielsForm[0]['form'] = [
            'legend' => [
                'title' => $this->l('Settings')
            ], 'input' => [
                [
                    'type' => 'text',
                    'label' => $this->l('Overlay Opacity'),
                    'name' => 'avOverlayOpacity',
                    'required' => true
                ], [
                    'type' => 'text',
                    'label' => $this->l('Box Background Color'),
                    'name' => 'avBoxBackgroundColor',
                    'required' => true
                ], [
                    'type' => 'text',
                    'label' => $this->l('Box Border Color'),
                    'name' => 'avBoxBorderColor',
                    'required' => true
                ], [
                    'type' => 'text',
                    'label' => $this->l('Box Text Color'),
                    'name' => 'avBoxTextColor',
                    'required' => true
                ], [
                    'type' => 'text',
                    'label' => $this->l('Button Background Color'),
                    'name' => 'avButtonBackgroundColor',
                    'required' => true
                ], [
                    'type' => 'text',
                    'label' => $this->l('Button Text Color'),
                    'name' => 'avButtonTextColor',
                    'required' => true
                ], [
                    'type' => 'text',
                    'label' => $this->l('Text Size Multiplicator'),
                    'name' => 'avTextSizeMultiplicator',
                    'required' => true
                ]
            ], 'submit' => [
                'title' => $this->l('Save'),
                'class' => 'btn btn-default pull-right'
            ]
        ];

        $helper->module = $this;
        $helper->name_controller = $this->name;
        $helper->token = Tools::getAdminTokenLite('AdminModules');
        $helper->currentIndex
            = AdminController::$currentIndex . '&configure=' . $this->name;

        $helper->default_form_language = $defaultLang;
        $helper->allow_employee_form_lang = $defaultLang;

        $helper->title = $this->displayName;
        $helper->show_toolbar = true;
        $helper->toolbar_scroll = true;
        $helper->submit_action = 'submit' . $this->name;
        $helper->toolbar_btn = [
            'save' => [
                'desc' => $this->l('Save'),
                'href' => AdminController::$currentIndex
                    . '&configure' . $this->name . '&save' . $this->name .
                    '&token=' . Tools::getAdminTokenLite('AdminModules')
            ], 'back' => [
                'desc' => $this->l('Back to list'),
                'href' => AdminController::$currentIndex
                    . '&token=' . Tools::getAdminTokenLite('AdminModules')
            ]
        ];

        $helper->fields_value['avOverlayOpacity'] = Configuration::get('avOverlayOpacity');
        $helper->fields_value['avBoxBackgroundColor'] = Configuration::get('avBoxBackgroundColor');
        $helper->fields_value['avBoxBorderColor'] = Configuration::get('avBoxBorderColor');
        $helper->fields_value['avBoxTextColor'] = Configuration::get('avBoxTextColor');
        $helper->fields_value['avButtonBackgroundColor'] = Configuration::get('avButtonBackgroundColor');
        $helper->fields_value['avButtonTextColor'] = Configuration::get('avButtonTextColor');
        $helper->fields_value['avTextSizeMultiplicator'] = Configuration::get('avTextSizeMultiplicator');

        return ($helper->generateForm($fielsForm));
    }

    /**
     * GetContent Method
     *
     * @return String
     */
    public function getContent()
    {
        $output = null;

        if (Tools::isSubmit('submit' . $this->name)) {
            $avOverlayOpacity = strval(Tools::getValue('avOverlayOpacity'));
            $avBoxBackgroundColor = strval(Tools::getValue('avBoxBackgroundColor'));
            $avBoxBorderColor = strval(Tools::getValue('avBoxBorderColor'));
            $avBoxTextColor = strval(Tools::getValue('avBoxTextColor'));
            $avButtonBackgroundColor = strval(Tools::getValue('avButtonBackgroundColor'));
            $avButtonTextColor = strval(Tools::getValue('avButtonTextColor'));
            $avTextSizeMultiplicator = strval(Tools::getValue('avTextSizeMultiplicator'));

            if (!$avBoxBackgroundColor
                || !$avBoxBorderColor
                || !$avBoxTextColor
                || !$avButtonBackgroundColor
                || !$avButtonTextColor
                || !$avTextSizeMultiplicator
                || empty($avBoxBackgroundColor)
                || empty($avBoxBorderColor)
                || empty($avBoxTextColor)
                || empty($avButtonBackgroundColor)
                || empty($avButtonTextColor)
                || empty($avTextSizeMultiplicator)
                || !Validate::isGenericName($avOverlayOpacity)
                || !Validate::isGenericName($avBoxBackgroundColor)
                || !Validate::isGenericName($avBoxBorderColor)
                || !Validate::isGenericName($avBoxTextColor)
                || !Validate::isGenericName($avButtonBackgroundColor)
                || !Validate::isGenericName($avButtonTextColor)
                || !Validate::isGenericName($avTextSizeMultiplicator)
            ) {
                $output .= $this->displayError($this->l('Invalid Configuration Value'));
            } else {
                Configuration::updateValue('avOverlayOpacity', $avOverlayOpacity);
                Configuration::updateValue('avBoxBackgroundColor', $avBoxBackgroundColor);
                Configuration::updateValue('avBoxBorderColor', $avBoxBorderColor);
                Configuration::updateValue('avBoxTextColor', $avBoxTextColor);
                Configuration::updateValue('avButtonBackgroundColor', $avButtonBackgroundColor);
                Configuration::updateValue('avButtonTextColor', $avButtonTextColor);
                Configuration::updateValue('avTextSizeMultiplicator', $avTextSizeMultiplicator);

                $output .= $this->displayConfirmation($this->l('Settings Updated!'));
            }
        }

        return ($output . $this->displayForm());
    }

    /**
     * HookDisplayFooter Method
     *
     * @return String
     */
    public function hookDisplayFooter()
    {
        $this->smarty->assign(
            [
                'avOverlayOpacity' => Configuration::get('avOverlayOpacity'),
                'avBoxBackgroundColor' => Configuration::get('avBoxBackgroundColor'),
                'avBoxBorderColor' => Configuration::get('avBoxBorderColor'),
                'avBoxTextColor' => Configuration::get('avBoxTextColor'),
                'avButtonBackgroundColor' => Configuration::get('avButtonBackgroundColor'),
                'avButtonTextColor' => Configuration::get('avButtonTextColor'),
                'avTextSizeMultiplicator' => Configuration::get('avTextSizeMultiplicator')
            ]
        );

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
            Configuration::updateValue('avOverlayOpacity', '0.5') &&
            Configuration::updateValue('avBoxBackgroundColor', 'black') &&
            Configuration::updateValue('avBoxBorderColor', 'rgb(62, 62, 62)') &&
            Configuration::updateValue('avBoxTextColor', 'white') &&
            Configuration::updateValue('avButtonBackgroundColor', 'rgb(29, 31, 33)') &&
            Configuration::updateValue('avButtonTextColor', 'white') &&
            Configuration::updateValue('avTextSizeMultiplicator', '1.0') &&
            $this->registerHook('displayFooter'));
    }

    /**
     * Uninstall Method
     *
     * @return bool
     */
    public function uninstall()
    {
        return (parent::uninstall() &&
            Configuration::deleteByName('avOverlayOpacity') &&
            Configuration::deleteByName('avBoxBackgroundColor') &&
            Configuration::deleteByName('avBoxBorderColor') &&
            Configuration::deleteByName('avBoxTextColor') &&
            Configuration::deleteByName('avButtonBackgroundColor') &&
            Configuration::deleteByName('avButtonTextColor') &&
            Configuration::deleteByName('avTextSizeMultiplicator') &&
            $this->unregisterHook('displayFooter'));
    }
}