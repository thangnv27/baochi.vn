<?php

class SourceCategoryAdmin extends AdminController {

    private $current_user;
    private $taxonomy = 'source';

    function __construct() {
        parent::__construct();
        $this->current_user = UserAdmin::checkLogin();
    }

    function index() {
        if ($this->current_user['capability']['categories']['view'] == 0) {
            Debug::throwException(Language::$phrases['message']['error_occur'], null);
        }

        ## Bulk Actions
        $request = $this->getRequest();
        $action = $request->get('action');
        $url = DASHBOARD_URL . '/sourceCategory/';
        switch ($action) {
            case 'delete':
                // Check permission
                if ($this->current_user['capability']['categories']['delete'] == 0) {
                    Debug::throwException(Language::$phrases['message']['error_occur'], null);
                }

                $checked = $request->get('item');
                if (count($checked) > 0) {
                    foreach ($checked as $key => $id) {
                        if ($this->model->countPostByCatID($id) > 0) {
                            unset($checked[$key]);
                            $this->getSession()->setFlash('warning', Language::$phrases['message']['some_category_contains_posts']);
                        }
                    }
                    $cat_ID = implode(", ", $checked);
                    if ($cat_ID != "") {
                        // Update parent
                        $this->model->update(array(
                            'parent' => 0,
                                ), "parent IN ($cat_ID) AND lang_code = '" . Language::$lang_content . "' AND taxonomy = '{$this->taxonomy}'");
                        // Delete
                        $this->model->deleteBulk("id IN ($cat_ID) AND lang_code = '" . Language::$lang_content . "' AND taxonomy = '{$this->taxonomy}'");
                        $this->getSession()->setFlash('success', Language::$phrases['message']['delete_success']);
                    }
                }
                $this->redirect($url);
                break;
            default:
                break;
        }

        ## List table
        $table = new Table(Language::$phrases['page']['category']['title.index']);
        $columns = array(
            'col_cbox' => '<input type="checkbox" id="checkall" />',
            'col_id' => 'ID',
            'col_image' => Language::$phrases['page']['category']['image'],
            'col_name' => Language::$phrases['page']['category']['name'],
            'col_slug' => Language::$phrases['context']['slug'],
            'col_options' => Language::$phrases['context']['options'],
        );
        $row = "";
        $table->add_columns($columns);

        //Get the records registered in the prepare_items method
        $records = $this->model->categoryRowsTable($request->get('s'));

        //Loop for each record
        if (is_array($records) and ! empty($records)) {
            foreach ($records as $rec) {

                //Open the line
                $row .= '<tr id="row_' . $rec->ID . '">';
                foreach ($columns as $field => $title) {
                    $class = "class='$field column-$field' ";
                    $style = "";
                    $attributes = $class . $style;

                    $edit_link = DASHBOARD_URL . '/sourceCategory/' . $rec['id'] . '/edit';
                    $delete_link = DASHBOARD_URL . '/sourceCategory/' . $rec['id'] . '/delete';

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
                        case "col_name":
                            $row .= '<td ' . $attributes . '><a href="' . $edit_link . '">' . stripslashes($rec['name']) . '</a></td>';
                            break;
                        case "col_slug":
                            $row .= '<td ' . $attributes . '>' . $rec['slug'] . '</td>';
                            break;
                        case "col_options":
                            $row .= '<td ' . $attributes . '>';
                            //$row .= '<a href="' . get_permalink($rec['slug'], "category") . '" class="btn btn-info btn-xs" target="_blank">' . Language::$phrases['action']['view'] . '</a> ';
                            if ($this->current_user['capability']['categories']['edit'] == 1)
                                $row .= '<a href="' . $edit_link . '" class="btn btn-primary btn-xs">' . Language::$phrases['action']['edit'] . '</a> ';
                            if ($this->current_user['capability']['categories']['delete'] == 1)
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

        $this->render("category/index", array(
            'title' => Language::$phrases['page']['category']['title.index'],
            'table' => $table->createView(),
        ));
    }

    function addnew() {
        // Check permission
        if ($this->current_user['capability']['categories']['create'] == 0) {
            Debug::throwException(Language::$phrases['message']['error_occur'], null);
        }

        $title = Language::$phrases['page']['category']['title.addnew'];

        $request = $this->getRequest();
        $name = $request->get('name');
        $slug = $request->get('slug');
        $parent = intval($request->get('parent'));
        $description = $request->get('description');
        $website = $request->get('website');
        $image = $request->get('image');
        $cover = $request->get('cover');
        $displayorder = $request->get('displayorder');

        $form = new Form();
        $form->add("name", "text", array(
                    'label' => Language::$phrases['page']['category']['name'],
                    'data' => $name,
                    'attr' => array(
                        'placeholder' => Language::$phrases['page']['category']['name.placeholder'],
                        'required' => true
                    )
                ))
                ->add('slug', 'text', array(
                    'label' => Language::$phrases['context']['slug'],
                    'data' => $slug,
                ))
                ->add('parent', 'choice', array(
                    'label' => Language::$phrases['page']['category']['parent'],
                    'choices' => $this->model->categoryOptions(),
                    'data' => $parent,
                ))
                ->add('description', 'textarea', array(
                    'label' => Language::$phrases['page']['category']['description'],
                    'data' => $description,
                ))
                ->add('website', 'text', array(
                    'label' => Language::$phrases['page']['category']['website'],
                    'data' => $website,
                ))
                ->add('image', 'upload', array(
                    'label' => Language::$phrases['page']['category']['image'],
                    'data' => $image,
                    'btn' => array(
                        'onclick' => "openFileDialog('image')"
                    )
                ))
                ->add('cover', 'upload', array(
                    'label' => Language::$phrases['page']['category']['cover'],
                    'data' => $cover,
                    'btn' => array(
                        'onclick' => "openFileDialog('cover')"
                    )
                ))
                ->add('displayorder', 'text', array(
                    'label' => Language::$phrases['page']['category']['displayorder'],
                    'data' => (empty($displayorder)) ? 1 : $displayorder,
                ))
                ->add('hidemobile', 'checkbox', array(
                    'label' => Language::$phrases['page']['category']['hidemobile'],
                    'attr' => array(
                        'class' => 'cbswitch',
                    )
                ));

        if ($request->getMethod() == 'POST') {
            if (isset($_REQUEST['hidemobile'])) {
                $hidemobile_value = 1;
            } else {
                $hidemobile_value = 0;
            }
            $msg = "";
            if ($name == null or $name == "") {
                $msg .= Language::$phrases['page']['category']['name.error.empty'];
            } elseif (count($this->model->getCategoryByName($name)) > 0) {
                $msg .= Language::$phrases['page']['category']['name.error.exists'];
            }
            if ($slug == "") {
                $slug = Utils::clean_entities($name);
            }
            $countSlug = count($this->model->getCategoryBySlug($slug));
            if ($countSlug > 0) {
                $msg .= Language::$phrases['context']['slug.error.exists'];
            }
            if ($msg != "") {
                $this->getSession()->setFlash('warning', $msg);
            } else {
                $id = $this->model->create(array(
                    'lang_code' => Language::$lang_content,
                    'name' => $name,
                    'slug' => $slug,
                    'parent' => $parent,
                    'description' => $description,
                    'website' => $website,
                    'image' => $image,
                    'cover' => $cover,
                    'taxonomy' => $this->taxonomy,
                    'seo' => serialize(array(
                        'seo_title' => $request->get('seo_title'),
                        'seo_keyword' => $request->get('seo_keyword'),
                        'seo_description' => $request->get('seo_description'),
                    )),
                    'displayorder' => intval($displayorder),
                    'hidemobile' => $hidemobile_value
                        ));
                if ($id) {
                    $this->getSession()->setFlash('success', Language::$phrases['message']['create_success']);

                    $url = DASHBOARD_URL . '/sourceCategory/' . $id . '/edit';
                    $this->redirect($url);
                }
            }
        }

        $this->render("category/new", array(
            'title' => $title,
            'form' => $form,
            'request' => $request,
        ));
    }

    function edit($id) {
        // Check permission
        if ($this->current_user['capability']['categories']['edit'] == 0) {
            Debug::throwException(Language::$phrases['message']['error_occur'], null);
        }

        $categories = $this->model->getCategoryByID($id);
        if (count($categories) <= 0) {
            $this->redirect(DASHBOARD_URL . '/sourceCategory/');
        } else {
            $category = $categories[0];
            $category['images'] = unserialize($category['images']);
            $title = Language::$phrases['page']['category']['title.edit'];
            $hidemobile = $category['hidemobile'];

            $form = new Form();
            $form->add("name", "text", array(
                        'label' => Language::$phrases['page']['category']['name'],
                        'data' => $category['name'],
                        'attr' => array(
                            'placeholder' => Language::$phrases['page']['category']['name.placeholder']
                        )
                    ))
                    ->add('slug', 'text', array(
                        'label' => Language::$phrases['context']['slug'],
                        'data' => $category['slug'],
                    ))
                    ->add('parent', 'choice', array(
                        'label' => Language::$phrases['page']['category']['parent'],
                        'data' => $category['parent'],
                        'choices' => $this->model->categoryOptions()
                    ))
                    ->add('description', 'textarea', array(
                        'label' => Language::$phrases['page']['category']['description'],
                        'data' => $category['description'],
                    ))
                    ->add('website', 'text', array(
                        'label' => Language::$phrases['page']['category']['website'],
                        'data' => $category['website'],
                    ))
                    ->add('image', 'upload', array(
                        'label' => Language::$phrases['page']['category']['image'],
                        'data' => $category['image'],
                        'btn' => array(
                            'onclick' => "openFileDialog('image')"
                        )
                    ))
                    ->add('cover', 'upload', array(
                        'label' => Language::$phrases['page']['category']['cover'],
                        'data' => $category['cover'],
                        'btn' => array(
                            'onclick' => "openFileDialog('cover')"
                        )
                    ))
                    ->add('displayorder', 'text', array(
                        'label' => Language::$phrases['page']['category']['displayorder'],
                        'data' => $category['displayorder'],
                    ));
            if ($hidemobile == 1) {
                $form->add('hidemobile', 'checkbox', array(
                    'label' => Language::$phrases['page']['category']['hidemobile'],
                    'attr' => array(
                        'class' => 'cbswitch',
                        'checked' => 'checked',
                    )
                ));
            } else {
                $form->add('hidemobile', 'checkbox', array(
                    'label' => Language::$phrases['page']['category']['hidemobile'],
                    'attr' => array(
                        'class' => 'cbswitch',
                    )
                ));
            }
            $request = $this->getRequest();
            if ($request->getMethod() == 'POST') {
                $msg = "";
                $name = $request->get('name');
                $slug = $request->get('slug');
                $parent = intval($request->get('parent'));
                $description = $request->get('description');
                $website = $request->get('website');
                $image = $request->get('image');
                $cover = $request->get('cover');
                $displayorder = $request->get('displayorder');

                if (isset($_REQUEST['hidemobile'])) {
                    $hidemobile_value = 1;
                } else {
                    $hidemobile_value = 0;
                }
                if ($name == null or $name == "") {
                    $msg .= Language::$phrases['page']['category']['name.error.empty'];
                } elseif ($name != $category['name'] and count($this->model->getCategoryByName($name)) > 0) {
                    $msg .= Language::$phrases['page']['category']['name.error.exists'];
                }
                if ($slug == "") {
                    $slug = Utils::clean_entities($name);
                }
                $countSlug = count($this->model->getCategoryBySlug($slug));
                if ($slug != $category['slug'] and $countSlug > 0) {
                    $msg .= Language::$phrases['context']['slug.error.exists'];
                }
                if ($msg != "") {
                    $this->getSession()->setFlash('warning', $msg);
                } else {
                    $this->model->update(array(
                        'name' => $name,
                        'slug' => $slug,
                        'parent' => $parent,
                        'description' => $description,
                        'website' => $website,
                        'image' => $image,
                        'cover' => $cover,
                        'seo' => serialize(array(
                            'seo_title' => $request->get('seo_title'),
                            'seo_keyword' => $request->get('seo_keyword'),
                            'seo_description' => $request->get('seo_description'),
                        )),
                        'displayorder' => intval($displayorder),
                        'hidemobile' => $hidemobile_value,
                            ), array(
                        'id' => $id,
                        'taxonomy' => $this->taxonomy,
                    ));
                    $this->getSession()->setFlash('success', Language::$phrases['message']['update_success']);
                    $this->redirect($request->getCurrentRquestUrl());
                }
            }

            $this->render("category/edit", array(
                'title' => $title,
                'form' => $form,
                'category' => $category,
            ));
        }
    }

    function delete($id) {
        // Check permission
        if ($this->current_user['capability']['categories']['delete'] == 0) {
            Debug::throwException(Language::$phrases['message']['error_occur'], null);
        }

        $categories = $this->model->getCategoryByID($id);
        $url = DASHBOARD_URL . '/sourceCategory/';
        if (count($categories) <= 0) {
            $this->redirect($url);
        } else {
            if ($this->model->countPostByCatID($id) > 0) {
                $this->getSession()->setFlash('warning', "<strong>{$categories[0]['name']}</strong> " . Language::$phrases['message']['category_contains_posts']);
                $this->redirect($url);
            } else {
                if ($this->model->delete($id)) {
                    $this->getSession()->setFlash('success', Language::$phrases['message']['delete_success']);

                    if ($this->model->countChildByCatID($id) > 0) {
                        $this->model->update(array(
                            'parent' => 0,
                                ), array(
                            'parent' => $id,
                            'lang_code' => Language::$lang_content,
                            'taxonomy' => $this->taxonomy
                        ));
                    }
                } else {
                    $this->getSession()->setFlash('warning', Language::$phrases['message']['error_occur']);
                }
                $this->redirect($url);
            }
        }
    }

}
