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
        $this->version = '1.2.0';
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
        $avTextSizeMultiplicatorOptions = [
            [
                'id_options' => '0.7',
                'name' => 'Smaller'
            ],[
                'id_options' => '0.8',
                'name' => 'Small'
            ],[
                'id_options' => '1',
                'name' => 'Medium'
            ],[
                'id_options' => '1.1',
                'name' => 'Large'
            ],[
                'id_options' => '1.2',
                'name' => 'Larger'
            ]
        ];
        $avOverlayOpacityOptions = [
            [
              'id_options' => '0',
              'name' => '0%'
            ], [
                'id_options' => '0.1',
                'name' => '10%'
            ], [
                'id_options' => '0.2',
                'name' => '20%'
            ], [
                'id_options' => '0.3',
                'name' => '30%'
            ], [
                'id_options' => '0.4',
                'name' => '40%'
            ], [
                'id_options' => '0.5',
                'name' => '50%'
            ], [
                'id_options' => '0.6',
                'name' => '60%'
            ], [
                'id_options' => '0.7',
                'name' => '70%'
            ], [
                'id_options' => '0.8',
                'name' => '80%'
            ], [
                'id_options' => '0.9',
                'name' => '90%'
            ], [
                'id_options' => '1',
                'name' => '100%'
            ]
        ];
        $fieldsForm[0]['form'] = [
            'legend' => [
                'title' => $this->l('Settings')
            ], 'input' => [
                [
                    'type' => 'switch',
                    'label' => $this->l('Display on every page'),
                    'name' => 'avAllPages',
                    'values' => [
                        [
                            'id' => 'active_on',
                            'value' => 1,
                            'label' => $this->l('Yes')
                        ], [
                            'id' => 'active_off',
                            'value' => 0,
                            'label' => $this->l('No')
                        ]
                    ]
                ], [
                    'type' => 'categories',
                    'label' => $this->l('Category'),
                    'name' => 'avCategory',
                    'tree' => [
                        'id' => 'avCategory',
                        'selected_categories' => explode(',', Configuration::get('avCategory')),
                        'use_checkbox' => true
                    ]
                ], [
                    'type' => 'text',
                    'label' => $this->l('Required age'),
                    'name' => 'avAge',
                    'required' => true,
                    'class' => 'fixed-width-xl'
                ]
            ], 'submit' => [
                'title' => $this->l('Save'),
                'class' => 'btn btn-default pull-right'
            ]
        ];
        $fieldsForm[1]['form'] = [
            'legend' => [
                'title' => $this->l('Styles')
            ], 'input' => [
                [
                    'type' => 'select',
                    'label' => $this->l('Overlay Opacity'),
                    'name' => 'avOverlayOpacity',
                    'required' => true,
                    'options' => [
                        'query' => $avOverlayOpacityOptions,
                        'id' => 'id_options',
                        'name' => 'name'
                    ]
                ], [
                    'type' => 'color',
                    'label' => $this->l('Box Background Color'),
                    'name' => 'avBoxBackgroundColor',
                    'required' => true
                ], [
                    'type' => 'color',
                    'label' => $this->l('Box Border Color'),
                    'name' => 'avBoxBorderColor',
                    'required' => true
                ], [
                    'type' => 'color',
                    'label' => $this->l('Box Text Color'),
                    'name' => 'avBoxTextColor',
                    'required' => true
                ], [
                    'type' => 'color',
                    'label' => $this->l('Button Background Color'),
                    'name' => 'avButtonBackgroundColor',
                    'required' => true
                ], [
                    'type' => 'color',
                    'label' => $this->l('Button Text Color'),
                    'name' => 'avButtonTextColor',
                    'required' => true
                ], [
                    'type' => 'select',
                    'label' => $this->l('Text Size'),
                    'name' => 'avTextSizeMultiplicator',
                    'required' => true,
                    'options' => [
                        'query' => $avTextSizeMultiplicatorOptions,
                        'id' => 'id_options',
                        'name' => 'name'
                    ]
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
        $helper->fields_value['avAge'] = Configuration::get('avAge');
        $helper->fields_value['avAllPages'] = Configuration::get('avAllPages');

        return ($helper->generateForm(array($fieldsForm[0], $fieldsForm[1])));
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
            $avAge = strval(Tools::getValue('avAge'));
            $avAllPages = strval(Tools::getValue('avAllPages'));
            $avCategory = Tools::getValue('avCategory');

            if (empty($avBoxBackgroundColor)
                || empty($avBoxBorderColor)
                || empty($avBoxTextColor)
                || empty($avButtonBackgroundColor)
                || empty($avButtonTextColor)
                || empty($avTextSizeMultiplicator)
                || empty($avAge)
                || empty($avCategory)
                || !Validate::isGenericName($avOverlayOpacity)
                || !Validate::isGenericName($avBoxBackgroundColor)
                || !Validate::isGenericName($avBoxBorderColor)
                || !Validate::isGenericName($avBoxTextColor)
                || !Validate::isGenericName($avButtonBackgroundColor)
                || !Validate::isGenericName($avButtonTextColor)
                || !Validate::isGenericName($avTextSizeMultiplicator)
                || !Validate::isGenericName($avAge)
                || !Validate::isGenericName($avAllPages)
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
                Configuration::updateValue('avAge', $avAge);
                Configuration::updateValue('avAllPages', $avAllPages);
                Configuration::updateValue('avCategory', implode(',', $avCategory));

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
                'avTextSizeMultiplicator' => Configuration::get('avTextSizeMultiplicator'),
                'avAge' => Configuration::get('avAge')
            ]
        );

        foreach (explode(',', Configuration::get('avCategory')) as $categoryId) {
            if ($categoryId === Tools::getValue('id_category')) {
                return ($this->display(__FILE__, 'avageverification.tpl'));
            }
        }

        if (Configuration::get('avAllPages') === '1') {
            return ($this->display(__FILE__, 'avageverification.tpl'));
        }
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
            Configuration::updateValue('avBoxBackgroundColor', '#000000') &&
            Configuration::updateValue('avBoxBorderColor', '#3e3e3e') &&
            Configuration::updateValue('avBoxTextColor', '#ffffff') &&
            Configuration::updateValue('avButtonBackgroundColor', '#1d1f21') &&
            Configuration::updateValue('avButtonTextColor', '#ffffff') &&
            Configuration::updateValue('avTextSizeMultiplicator', '1.0') &&
            Configuration::updateValue('avAge', '18') &&
            Configuration::updateValue('avAllPages', '1') &&
            Configuration::updateValue('avCategory', Configuration::get('PS_HOME_CATEGORY')) &&
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
            Configuration::deleteByName('avAge') &&
            Configuration::deleteByName('avAllPages') &&
            Configuration::deleteByName('avCategory') &&
            $this->unregisterHook('displayFooter'));
    }
}