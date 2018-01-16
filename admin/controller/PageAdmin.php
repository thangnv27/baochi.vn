<?php

class PageAdmin extends AdminController {

    private $current_user;

    function __construct() {
        parent::__construct();
        $this->current_user = UserAdmin::checkLogin();
    }

    function index() {
        if ($this->current_user['capability']['pages']['view'] == 0) {
            Debug::throwException(Language::$phrases['message']['error_occur'], null);
        }

        ## Bulk Actions
        $request = $this->getRequest();
        $action = $request->get('action');
        $url = DASHBOARD_URL . '/page/';
        switch ($action) {
            case 'move2trash':
                // Check permission
                if ($this->current_user['capability']['pages']['edit'] == 0) {
                    Debug::throwException(Language::$phrases['message']['error_occur'], null);
                }

                $checked = $request->get('item');
                if (count($checked) > 0) {
                    $page_ID = implode(", ", $checked);
                    $this->model->move2trashBulk("id IN ($page_ID)");
                    $this->getSession()->setFlash('success', Language::$phrases['message']['move2trash_success']);
                }
                $this->redirect($url);
                break;
            case 'publish':
                // Check permission
                if ($this->current_user['capability']['pages']['edit'] == 0) {
                    Debug::throwException(Language::$phrases['message']['error_occur'], null);
                }

                $checked = $request->get('item');
                if (count($checked) > 0) {
                    $page_ID = implode(", ", $checked);
                    $this->model->publishBulk("id IN ($page_ID)");
                    $this->getSession()->setFlash('success', Language::$phrases['message']['publish_success']);
                }
                $this->redirect($url);
                break;
            default:
                break;
        }

        ## List table
        $table = new Table(Language::$phrases['page']['page']['title.index']);
        $columns = array(
            'col_cbox' => '<input type="checkbox" id="checkall" />',
            'col_id' => 'ID',
            'col_title' => Language::$phrases['context']['title'],
            'col_date' => Language::$phrases['page']['page']['date'],
            'col_view' => Language::$phrases['page']['page']['view'],
            'col_options' => Language::$phrases['context']['options'],
        );
        $row = "";
        $table->add_columns($columns);

        $where = array();
        if (in_array($request->get('status'), array('trashed', 'draft', 'published'))) {
            $where = "post_status='" . $request->get('status') . "'";
        } else {
            $search_query = $request->get('s');
            if (!empty($search_query)) {
                $where = "post_status IN ('draft','published') AND (title LIKE '%$search_query%' OR "
                        . "slug LIKE '%$search_query%' OR content LIKE '%$search_query%' OR "
                        . "posted_date LIKE '%$search_query%')";
            } else {
                $where = "post_status IN ('draft','published')";
            }
        }

        // Pagination
        $currentURL = trailingslashit($request->getCurrentRquestUrl());
        if (count($request->all()) > 0) {
            $currentURL = $request->getCurrentRquestUrl();
        }
        $limit = 50;
        $pager = new Pagenavi($currentURL, $request->get('page'), $limit);
        $start = $pager->start($limit);
        $countRecords = $this->model->countPages($where);
        $table->add_pagenavi($pager->pageList($countRecords));

        //Get the records registered in the prepare_items method
        $records = $this->model->getPages($start, $limit, $where);

        //Loop for each record
        if (is_array($records) and !empty($records)) {
            foreach ($records as $rec) {

                //Open the line
                $row .= '<tr id="row_' . $rec->ID . '">';
                foreach ($columns as $field => $title) {
                    $class = "class='$field column-$field' ";
                    $style = "";
                    $attributes = $class . $style;

                    $edit_link = DASHBOARD_URL . '/page/' . $rec['id'] . '/edit';
                    $delete_link = DASHBOARD_URL . '/page/' . $rec['id'] . '/delete';
                    $publish_link = DASHBOARD_URL . '/page/' . $rec['id'] . '/publish';

                    //Display the cell
                    switch ($field) {
                        case "col_cbox":
                            $row .= '<td ' . $attributes . '><input type="checkbox" name="item[]" value="' . $rec['id'] . '" /></td>';
                            break;
                        case "col_id":
                            $row .= '<td ' . $attributes . '>' . $rec['id'] . '</td>';
                            break;
                        case "col_title":
                            $row .= '<td ' . $attributes . '><a href="' . $edit_link . '">' . $rec['title'] . '</a></td>';
                            break;
                        case "col_date":
                            $row .= '<td ' . $attributes . '>' . $rec['posted_date'] . '</td>';
                            break;
                        case "col_view":
                            $row .= '<td ' . $attributes . '>' . $rec['view_count'] . '</td>';
                            break;
                        case "col_options":
                            $row .= '<td ' . $attributes . '>';
                            $row .= '<a href="' . get_permalink($rec['slug'], 'page') . '" class="btn btn-info btn-xs" target="_blank">' . Language::$phrases['action']['view'] . '</a> ';
                            if ($this->current_user['capability']['pages']['edit'] == 1)
                                $row .= '<a href="' . $edit_link . '" class="btn btn-primary btn-xs">' . Language::$phrases['action']['edit'] . '</a> ';
                            if ($this->current_user['capability']['pages']['delete'] == 1)
                                $row .= '<a href="' . $delete_link . '" class="btn btn-danger btn-xs" onclick="return confirm(\'' . Language::$phrases['action']['delete.confirm'] . '\');">' . Language::$phrases['action']['delete'] . '</a> ';
                            if ($this->current_user['capability']['pages']['edit'] == 1 and $rec['post_status'] == 'draft')
                                $row .= '<a href="' . $publish_link . '" class="btn btn-warning btn-xs">' . Language::$phrases['action']['publish'] . '</a> ';
                            $row .= '</td>';
                            break;
                    }
                }

                //Close the line
                $row .= '</tr>';
            }
        }

        $table->add_rows($row);

        $this->render("page/index", array(
            'title' => Language::$phrases['page']['page']['page.index'],
            'table' => $table->createView(),
            'request' => $request,
        ));
    }

    function addnew() {
        // Check permission
        if ($this->current_user['capability']['pages']['create'] == 0) {
            Debug::throwException(Language::$phrases['message']['error_occur'], null);
        }

        $title = Language::$phrases['page']['page']['page.addnew'];

        $request = $this->getRequest();
        $page_title = $request->get('title');
        $slug = $request->get('slug');
        $content = $request->get('content');
        $excerpt = $request->get('excerpt');
        $thumbnail = $request->get('thumbnail');
        $page_status = $request->get('post_status');

        $form = new Form();
        $form->add("title", "text", array(
                    'label' => Language::$phrases['context']['title'],
                    'data' => $page_title,
                    'attr' => array(
                        'placeholder' => Language::$phrases['page']['page']['title.placeholder'],
                    )
                ))
                ->add('slug', 'text', array(
                    'label' => Language::$phrases['context']['slug'],
                    'data' => $slug,
                ))
                ->add('content', 'textarea', array(
                    'label' => Language::$phrases['page']['page']['content'],
                    'data' => $content,
                    'attr' => array(
                        'class' => 'editor'
                    )
                ))
                ->add('excerpt', 'textarea', array(
                    'label' => Language::$phrases['page']['post']['excerpt'],
                    'data' => $excerpt,
                    'attr' => array(
                        'rows' => 5
                    )
                ))
                ->add('thumbnail', 'upload', array(
                    'label' => Language::$phrases['page']['post']['thumbnail'],
                    'data' => $thumbnail,
                    'btn' => array(
                        'onclick' => "openFileDialog('thumbnail')"
                    )
                ))
                ->add('post_status', 'choice', array(
                    'label' => Language::$phrases['context']['status'],
                    'choices' => Utils::getPostStatus(),
                    'data' => $page_status,
        ));

        if ($request->getMethod() == 'POST') {
            $msg = "";
            if ($page_title == null or $page_title == "") {
                $msg .= Language::$phrases['page']['page']['title.error.empty'];
            } elseif (count($this->model->getPageByTitle($page_title)) > 0) {
                $msg .= Language::$phrases['page']['page']['title.error.exists'];
            }
            if ($slug == "") {
                $slug = Utils::clean_entities($page_title);
            }
            $countSlug = count($this->model->getPageBySlug($slug));
            if ($countSlug > 0) {
                $msg .= Language::$phrases['context']['slug.error.exists'];
            }
            if ($content == "") {
                $msg .= Language::$phrases['page']['page']['content.error.empty'];
            }
            if ($msg != "") {
                $this->getSession()->setFlash('warning', $msg);
            } else {
                $id = $this->model->create(array(
                    'lang_code' => Language::$lang_content,
                    'title' => $page_title,
                    'slug' => $slug,
                    'content' => $content,
                    'excerpt' => $excerpt,
                    'thumbnail' => $thumbnail,
                    'seo' => serialize(array(
                        'seo_title' => $request->get('seo_title'),
                        'seo_keyword' => $request->get('seo_keyword'),
                        'seo_description' => $request->get('seo_description'),
                    )),
                    'post_status' => $page_status,
                ));
                if ($id) {
                    $this->getSession()->setFlash('success', Language::$phrases['message']['create_success']);
                    $this->redirect(DASHBOARD_URL . '/page/' . $id . '/edit');
                }
            }
        }

        $this->render("page/new", array(
            'title' => $title,
            'form' => $form,
            'request' => $request,
        ));
    }

    function edit($id) {
        // Check permission
        if ($this->current_user['capability']['pages']['edit'] == 0) {
            Debug::throwException(Language::$phrases['message']['error_occur'], null);
        }

        $pages = $this->model->getPageByID($id);
        if (count($pages) <= 0) {
            $this->redirect(DASHBOARD_URL . '/page/');
        } else {
            $page = $pages[0];
            $title = Language::$phrases['page']['page']['page.edit'];

            $form = new Form();
            $form->add("title", "text", array(
                        'label' => Language::$phrases['context']['title'],
                        'data' => $page['title'],
                        'attr' => array(
                            'placeholder' => Language::$phrases['page']['page']['title.placeholder'],
                        )
                    ))
                    ->add('slug', 'text', array(
                        'label' => Language::$phrases['context']['slug'],
                        'data' => $page['slug'],
                    ))
                    ->add('content', 'textarea', array(
                        'label' => Language::$phrases['page']['page']['content'],
                        'data' => stripslashes($page['content']),
                        'attr' => array(
                            'class' => 'editor'
                        )
                    ))
                    ->add('excerpt', 'textarea', array(
                        'label' => Language::$phrases['page']['post']['excerpt'],
                        'data' => stripslashes($page['excerpt']),
                        'attr' => array(
                            'rows' => 5
                        )
                    ))
                    ->add('thumbnail', 'upload', array(
                        'label' => Language::$phrases['page']['post']['thumbnail'],
                        'data' => $page['thumbnail'],
                        'btn' => array(
                            'onclick' => "openFileDialog('thumbnail')"
                        )
                    ))
                    ->add('post_status', 'choice', array(
                        'label' => Language::$phrases['context']['status'],
                        'choices' => Utils::getPostStatus(),
                        'data' => $page['post_status'],
            ));

            $request = $this->getRequest();
            if ($request->getMethod() == 'POST') {
                $page_title = $request->get('title');
                $slug = $request->get('slug');
                $content = $request->get('content');
                $excerpt = $request->get('excerpt');
                $thumbnail = $request->get('thumbnail');
                $page_status = $request->get('post_status');
                $msg = "";
                if ($page_title == null or $page_title == "") {
                    $msg .= Language::$phrases['page']['page']['title.error.empty'];
                } elseif ($page_title != $page['title'] and count($this->model->getPageByTitle($page_title)) > 0) {
                    $msg .= Language::$phrases['page']['page']['title.error.exists'];
                }
                if ($slug == "") {
                    $slug = Utils::clean_entities($page_title);
                }
                $countSlug = count($this->model->getPageBySlug($slug));
                if ($slug != $page['slug'] and $countSlug > 0) {
                    $msg .= Language::$phrases['context']['slug.error.exists'];
                }
                if ($content == "") {
                    $msg .= Language::$phrases['page']['page']['content.error.empty'];
                }
                if ($msg != "") {
                    $this->getSession()->setFlash('warning', $msg);
                } else {
                    $this->model->update(array(
                        'title' => $page_title,
                        'slug' => $slug,
                        'content' => $content,
                        'excerpt' => $excerpt,
                        'thumbnail' => $thumbnail,
                        'seo' => serialize(array(
                            'seo_title' => $request->get('seo_title'),
                            'seo_keyword' => $request->get('seo_keyword'),
                            'seo_description' => $request->get('seo_description'),
                        )),
                        'post_status' => $page_status,
                        'updated_date' => date('Y-m-d H:i:s'),
                            ), array(
                        'id' => $id,
                    ));
                    $this->getSession()->setFlash('success', Language::$phrases['message']['update_success']);
                    $this->redirect($request->getCurrentRquestUrl());
                }
            }

            $this->render("page/edit", array(
                'title' => $title,
                'form' => $form,
                'page' => $page,
            ));
        }
    }

    function publish($id) {
        // Check permission
        if ($this->current_user['capability']['pages']['edit'] == 0) {
            Debug::throwException(Language::$phrases['message']['error_occur'], null);
        }

        $pages = $this->model->getPageByID($id);
        $url = DASHBOARD_URL . '/page/';
        if (count($pages) <= 0) {
            $this->redirect($url);
        } else {
            $this->model->publish($id);
            $this->getSession()->setFlash('success', Language::$phrases['message']['publish_success']);
            $this->redirect($url);
        }
    }

    function delete($id) {
        // Check permission
        if ($this->current_user['capability']['pages']['delete'] == 0) {
            Debug::throwException(Language::$phrases['message']['error_occur'], null);
        }

        $pages = $this->model->getPageByID($id);
        $url = DASHBOARD_URL . '/page/';
        if (count($pages) <= 0) {
            $this->redirect($url);
        } else {
            $this->model->delete($id);
            $this->getSession()->setFlash('success', Language::$phrases['message']['delete_success']);
            $this->redirect($url);
        }
    }

}
