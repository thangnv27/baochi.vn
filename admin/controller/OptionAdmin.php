<?php

class OptionAdmin extends AdminController {

    private $current_user;
    private $filename;

    function __construct() {
        parent::__construct();
        $this->current_user = UserAdmin::checkLogin();
        $this->filename = DB_PATH . 'options.json';
    }

    function index() {
        if ($this->current_user['capability']['options']['edit'] == 0) {
            Debug::throwException(Language::$phrases['message']['error_occur'], null);
        }

        $title = Language::$phrases['page']['option']['title.index'];
        $option = $this->get_option();
        $site_option = $option->site_option;
        $contact_info = $option->contact_info;
        $ads = $option->ads;
        $social = $option->social;

        $form = new Form($title);
        $form->add("name", "text", array(
                    'label' => Language::$phrases['page']['option']['name'],
                    'data' => $site_option->name,
                ))
                ->add('description', 'textarea', array(
                    'label' => Language::$phrases['page']['option']['description'],
                    'data' => $site_option->description,
                ))
                ->add("keywords", "text", array(
                    'label' => Language::$phrases['page']['option']['keywords'],
                    'data' => $site_option->keywords,
                ))
                ->add("logo", "upload", array(
                    'label' => "Logo",
                    'data' => $site_option->logo,
                    'btn' => array(
                        'onclick' => "openFileDialog('logo')"
                    )
                ))
                ->add("logo_footer", "upload", array(
                    'label' => "Logo Footer",
                    'data' => $site_option->logo_footer,
                    'btn' => array(
                        'onclick' => "openFileDialog('logo_footer')"
                    )
                ))
                ->add("logo_chuquan", "upload", array(
                    'label' => "Logo Chủ quản",
                    'data' => $site_option->logo_chuquan,
                    'btn' => array(
                        'onclick' => "openFileDialog('logo_chuquan')"
                    )
                ))
                ->add("favicon", "upload", array(
                    'label' => "Favicon",
                    'data' => $site_option->favicon,
                    'btn' => array(
                        'onclick' => "openFileDialog('favicon')"
                    )
                ))
                ->add("sologan", "text", array(
                    'label' => "Sologan",
                    'data' => $site_option->sologan,
                ))
                ->add("fanpage_url", "text", array(
                    'label' => "Fanpage URL",
                    'data' => $site_option->fanpage_url,
                ))
                ->add("admin_email", "text", array(
                    'label' => Language::$phrases['page']['option']['admin_email'],
                    'data' => $site_option->admin_email,
                ))
                ->add("ga_id", "text", array(
                    'label' => Language::$phrases['page']['option']['ga_id'],
                    'data' => $site_option->ga_id,
                    'description' => Language::$phrases['context']['example'] . ': UA-40210538-1 '
                ))
                ->add("footer_info", "textarea", array(
                    'label' => Language::$phrases['context']['footer_info'],
                    'data' => stripslashes($site_option->footer_info),
                    'attr' => array(
                        'class' => 'editor'
                    )
                ))
                // Contact information
                ->add("email", "text", array(
                    'label' => Language::$phrases['context']['email'],
                    'data' => $contact_info->email,
                ))
                ->add("phone", "text", array(
                    'label' => Language::$phrases['context']['phone'],
                    'data' => $contact_info->phone,
                ))
                ->add("address", "text", array(
                    'label' => Language::$phrases['context']['address'],
                    'data' => $contact_info->address,
                ))
//                Quảng cáo
                ->add("ads_home_top1", "textarea", array(
                    'label' => 'ADS Home Top 1',
                    'data' => $ads->ads_home_top1,
                ))
                ->add("ads_home_top2", "textarea", array(
                    'label' => 'ADS Home Top 2',
                    'data' => $ads->ads_home_top2,
                ))
                ->add("ads_home_footer", "textarea", array(
                    'label' => 'ADS Home Footer',
                    'data' => $ads->ads_home_footer,
                ))
//                Social
                ->add("social_fb", "text", array(
                    'label' => 'Facebook',
                    'data' => $social->social_fb,
                ))
                ->add("social_google", "text", array(
                    'label' => 'Google',
                    'data' => $social->social_google,
                ))
                ->add("social_linkedin", "text", array(
                    'label' => 'Linked In',
                    'data' => $social->social_linkedin,
                ))
                ->add("social_twitter", "text", array(
                    'label' => 'Twitter',
                    'data' => $social->social_twitter,
                ))
                ->add("social_instagram", "text", array(
                    'label' => 'Instagram',
                    'data' => $social->social_instagram,
                ))
                ->add("social_youtube", "text", array(
                    'label' => 'Youtube',
                    'data' => $social->social_youtube,
                ))
                ->add("social_pinterest", "text", array(
                    'label' => 'Pinterest',
                    'data' => $social->social_pinterest,
                ));

        $request = $this->getRequest();
        if ($request->getMethod() == 'POST') {
            $name = $request->get('name');
            $description = $request->get('description');
            $keywords = $request->get('keywords');
            $logo = $request->get('logo');
            $logo_footer = $request->get('logo_footer');
            $logo_chuquan = $request->get('logo_chuquan');
            $favicon = $request->get('favicon');
            $sologan = $request->get('sologan');
            $fanpage_url = $request->get('fanpage_url');
            $admin_email = $request->get('admin_email');
            $ga_id = $request->get('ga_id');
            $footer_info = $request->get('footer_info');
            $link_rss = $request->get('link_rss');
            $email = $request->get('email');
            $phone = $request->get('phone');
            $address = $request->get('address');
//            ADS
            $ads_home_top1 = $request->get('ads_home_top1');
            $ads_home_top2 = $request->get('ads_home_top2');
            $ads_home_footer = $request->get('ads_home_footer');
//            Social
            $social_fb = $request->get('social_fb');
            $social_google = $request->get('social_google');
            $social_linkedin = $request->get('social_linkedin');
            $social_twitter = $request->get('social_twitter');
            $social_instagram = $request->get('social_instagram');
            $social_youtube = $request->get('social_youtube');
            $social_pinterest = $request->get('social_pinterest');
            $data = json_encode(array(
                'site_option' => array(
                    'name' => $name,
                    'description' => $description,
                    'keywords' => $keywords,
                    'logo' => $logo,
                    'logo_footer' => $logo_footer,
                    'logo_chuquan' => $logo_chuquan,
                    'favicon' => $favicon,
                    'sologan' => $sologan,
                    'fanpage_url' => $fanpage_url,
                    'admin_email' => $admin_email,
                    'ga_id' => $ga_id,
                    'footer_info' => $footer_info,
                    'link_rss' => $link_rss,
                ),
                'contact_info' => array(
                    'email' => $email,
                    'phone' => $phone,
                    'address' => $address,
                ),
                'ads' => array(
                    'ads_home_top1' => $ads_home_top1,
                    'ads_home_top2' => $ads_home_top2,
                    'ads_home_footer' => $ads_home_footer,
                ),
                'social' => array(
                    'social_fb' => $social_fb,
                    'social_google' => $social_google,
                    'social_linkedin' => $social_linkedin,
                    'social_twitter' => $social_twitter,
                    'social_instagram' => $social_instagram,
                    'social_youtube' => $social_youtube,
                    'social_pinterest' => $social_pinterest,
                )
            ));
            write_file($this->filename, $data);
            $this->redirect(DASHBOARD_URL . '/option/');
        }

        $this->render("option", array(
            'title' => $title,
            'form' => $form,
        ));
    }

    function get_option() {
        $option = file_get_contents($this->filename);
        return json_decode($option);
    }

}
