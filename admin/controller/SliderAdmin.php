<?php

class SliderAdmin extends AdminController {

    private $current_user;

    function __construct() {
        parent::__construct();
        $this->current_user = UserAdmin::checkLogin();
    }

    function index() {
        if ($this->current_user['capability']['sliders']['view'] == 0) {
            Debug::throwException(Language::$phrases['message']['error_occur'], null);
        }

        ## Bulk Actions
        $request = $this->getRequest();
        $action = $request->get('action');
        $url = DASHBOARD_URL . '/slider/';
        switch ($action) {
            case 'delete':
                // Check permission
                if ($this->current_user['capability']['sliders']['delete'] == 0) {
                    Debug::throwException(Language::$phrases['message']['error_occur'], null);
                }

                $checked = $request->get('item');
                if (count($checked) > 0) {
                    $slider_ID = implode(", ", $checked);
                    if ($slider_ID != "") {
                        $this->model->deleteBulk("id IN ($slider_ID)");
                        $this->getSession()->setFlash('success', Language::$phrases['message']['delete_success']);
                    }
                }
                $this->redirect($url);
                break;
            default:
                break;
        }

        ## List table
        $table = new Table(Language::$phrases['page']['slider']['title.index']);
        $columns = array(
            'col_cbox' => '<input type="checkbox" id="checkall" />',
            'col_id' => 'ID',
            'col_image' => Language::$phrases['page']['slider']['image'],
            'col_title' => Language::$phrases['context']['title'],
            'col_displayorder' => Language::$phrases['page']['slider']['displayorder'],
            'col_options' => Language::$phrases['context']['options'],
        );
        $row = "";
        $table->add_columns($columns);

        //Get the records registered in the prepare_items method
        $records = $this->model->sliderRowsTable($request->get('s'));

        //Loop for each record
        if (is_array($records) and !empty($records)) {
            foreach ($records as $rec) {

                //Open the line
                $row .= '<tr id="row_' . $rec->ID . '">';
                foreach ($columns as $field => $title) {
                    $class = "class='$field column-$field' ";
                    $style = "";
                    $attributes = $class . $style;

                    $edit_link = DASHBOARD_URL . '/slider/' . $rec['id'] . '/edit';
                    $delete_link = DASHBOARD_URL . '/slider/' . $rec['id'] . '/delete';

                    //Display the cell
                    switch ($field) {
                        case "col_cbox":
                            $row .= '<td ' . $attributes . '><input type="checkbox" name="item[]" value="' . $rec['id'] . '" /></td>';
                            break;
                        case "col_id":
                            $row .= '<td ' . $attributes . '>' . $rec['id'] . '</td>';
                            break;
                        case "col_image":
                            $row .= '<td ' . $attributes . '>';
                            if ($rec['image'] != "") {
                                $row .= '<img src="' . $rec['image'] . '" width="32" height="32" />';
                            }
                            $row .= '</td>';
                            break;
                        case "col_title":
                            $row .= '<td ' . $attributes . '><a href="' . $edit_link . '">' . $rec['title'] . '</a></td>';
                            break;
                        case "col_displayorder":
                            $row .= '<td ' . $attributes . '>' . $rec['displayorder'] . '</td>';
                            break;
                        case "col_options":
                            $row .= '<td ' . $attributes . '>';
                            if ($this->current_user['capability']['sliders']['edit'] == 1)
                                $row .= '<a href="' . $edit_link . '" class="btn btn-primary btn-xs">' . Language::$phrases['action']['edit'] . '</a> ';
                            if ($this->current_user['capability']['sliders']['delete'] == 1)
                                $row .= '<a href="' . $delete_link . '" class="btn btn-danger btn-xs" onclick="return confirm(\'' . Language::$phrases['action']['delete.confirm'] . '\');">' . Language::$phrases['action']['delete'] . '</a>';
                            $row .= '</td>';
                            break;
                    }
                }

                //Close the line
                $row .= '</tr>';
            }
        }

        $table->add_rows($row);

        $this->render("slider/index", array(
            'title' => Language::$phrases['page']['slider']['page.index'],
            'table' => $table->createView(),
        ));
    }

    function addnew() {
        // Check permission
        if ($this->current_user['capability']['sliders']['create'] == 0) {
            Debug::throwException(Language::$phrases['message']['error_occur'], null);
        }

        $title = Language::$phrases['page']['slider']['page.addnew'];
        $request = $this->getRequest();
        $slide_title = $request->get('title');
        $link = $request->get('link');
        $image = $request->get('image');
        $displayorder = ($request->get('displayorder') == "") ? 1 : $request->get('displayorder');

        $form = new Form($title, array(
            'action' => '',
            'method' => 'post',
            'class' => 'form-horizontal'
        ));
        $form->add("title", "text", array(
                    'label' => Language::$phrases['context']['title'],
                    'data' => $slide_title,
                ))
                ->add('link', 'text', array(
                    'label' => Language::$phrases['page']['slider']['link'],
                    'data' => $link,
                ))
                ->add('image', 'upload', array(
                    'label' => Language::$phrases['page']['slider']['image'],
                    'data' => $image,
                    'btn' => array(
                        'onclick' => "openFileDialog('image')"
                    )
                ))
                ->add('displayorder', 'text', array(
                    'label' => Language::$phrases['page']['slider']['displayorder'],
                    'data' => $displayorder,
        ));

        if ($request->getMethod() == 'POST') {
            $msg = "";
            if (empty($slide_title)) {
                $msg .= Language::$phrases['page']['slider']['title.error.empty'];
            }
            if (empty($link)) {
                $msg .= Language::$phrases['page']['slider']['link.error.empty'];
            }
            if (!is_numeric($displayorder)) {
                $msg .= Language::$phrases['page']['slider']['displayorder.error.invalid'];
            }
            if ($msg != "") {
                $this->getSession()->setFlash('warning', $msg);
            } else {
                $id = $this->model->create(array(
                    'title' => $slide_title,
                    'link' => $link,
                    'image' => $image,
                    'displayorder' => $displayorder,
                ));
                if ($id) {
                    $this->getSession()->setFlash('success', Language::$phrases['message']['create_success']);

                    $url = DASHBOARD_URL . '/slider/' . $id . '/edit';
                    $this->redirect($url);
                }
            }
        }

        $this->render("slider/new", array(
            'title' => $title,
            'formview' => $form->createView(),
        ));
    }

    function edit($id) {
        // Check permission
        if ($this->current_user['capability']['sliders']['edit'] == 0) {
            Debug::throwException(Language::$phrases['message']['error_occur'], null);
        }

        $sliders = $this->model->getSliderByID($id);
        if (count($sliders) <= 0) {
            $this->redirect(DASHBOARD_URL . '/slider/');
        } else {
            $slider = $sliders[0];
            $title = Language::$phrases['page']['slider']['page.edit'];

            $form = new Form($title, array(
                'action' => '',
                'method' => 'post',
                'class' => 'form-horizontal'
            ));
            $form->add("title", "text", array(
                        'label' => Language::$phrases['context']['title'],
                        'data' => $slider['title'],
                    ))
                    ->add('link', 'text', array(
                        'label' => Language::$phrases['page']['slider']['link'],
                        'data' => $slider['link'],
                    ))
                    ->add('image', 'upload', array(
                        'label' => Language::$phrases['page']['slider']['image'],
                        'data' => $slider['image'],
                        'btn' => array(
                            'onclick' => "openFileDialog('image')"
                        )
                    ))
                    ->add('displayorder', 'text', array(
                        'label' => Language::$phrases['page']['slider']['displayorder'],
                        'data' => $slider['displayorder'],
            ));

            $request = $this->getRequest();
            if ($request->getMethod() == 'POST') {
                $msg = "";
                $slide_title = $request->get('title');
                $link = $request->get('link');
                $image = $request->get('image');
                $displayorder = ($request->get('displayorder') == "") ? 1 : $request->get('displayorder');

                if (empty($slide_title)) {
                    $msg .= Language::$phrases['page']['slider']['title.error.empty'];
                }
                if (empty($link)) {
                    $msg .= Language::$phrases['page']['slider']['link.error.empty'];
                }
                if (!is_numeric($displayorder)) {
                    $msg .= Language::$phrases['page']['slider']['displayorder.error.invalid'];
                }
                if ($msg != "") {
                    $this->getSession()->setFlash('warning', $msg);
                } else {
                    $this->model->update(array(
                        'title' => $slide_title,
                        'link' => $link,
                        'image' => $image,
                        'displayorder' => $displayorder,
                            ), array(
                        'id' => $id,
                    ));
                    $this->getSession()->setFlash('success', Language::$phrases['message']['update_success']);
                    $this->redirect($request->getCurrentRquestUrl());
                }
            }

            $this->render("slider/edit", array(
                'title' => $title,
                'formview' => $form->createView(),
            ));
        }
    }

    function delete($id) {
        // Check permission
        if ($this->current_user['capability']['sliders']['delete'] == 0) {
            Debug::throwException(Language::$phrases['message']['error_occur'], null);
        }

        $sliders = $this->model->getSliderByID($id);
        $url = DASHBOARD_URL . '/slider/';
        if (count($sliders) <= 0) {
            $this->redirect($url);
        } else {
            if ($this->model->delete($id)) {
                $this->getSession()->setFlash('success', Language::$phrases['message']['delete_success']);
            } else {
                $this->getSession()->setFlash('warning', Language::$phrases['message']['error_occur']);
            }
            $this->redirect($url);
        }
    }

}
