<?php

class RssAdmin extends AdminController {

    private $current_user;

    function __construct() {
        parent::__construct();
        $this->current_user = UserAdmin::checkLogin();
    }

    function index() {
        if ($this->current_user['capability']['rss']['view'] == 0) {
            Debug::throwException(Language::$phrases['message']['error_occur'], null);
        }

        ## Bulk Actions
        $request = $this->getRequest();
        $action = $request->get('action');
        $url = DASHBOARD_URL . '/rss/';
        switch ($action) {
            case 'delete':
                // Check permission
                if ($this->current_user['capability']['rss']['delete'] == 0) {
                    Debug::throwException(Language::$phrases['message']['error_occur'], null);
                }

                $checked = $request->get('item');
                if (count($checked) > 0) {
                    $rss_ID = implode(", ", $checked);
                    if ($rss_ID != "") {
                        $this->model->deleteBulk("id IN ($rss_ID)");
                        $this->getSession()->setFlash('success', Language::$phrases['message']['delete_success']);
                    }
                }
                $this->redirect($url);
                break;
            default:
                break;
        }
        
        $orderby = $request->get('orderby');
        $order = $request->get('order');
        $order_text = "asc";
        if($order == 'asc'){
            $order_text = 'desc';
        } else if ($order == 'desc'){
            $order_text = 'asc';
        }

        ## List table
        $table = new Table(Language::$phrases['page']['rss']['title.index']);
        $columns = array(
            'col_cbox' => '<input type="checkbox" id="checkall" />',
            'col_id' => "ID",
            'col_source' => Language::$phrases['context']['source'],
            'col_categories' => Language::$phrases['context']['categories'],
            'col_URL' => "URL",
            'col_status' => Language::$phrases['context']['status'],
            'col_1day' => '<a class="day_'.$order_text.'" href="' . DASHBOARD_URL . '/rss/?orderby=1day&order=' . $order_text . '">1D</a>',
            'col_2day' => '<a class="day_'.$order_text.'" href="' . DASHBOARD_URL . '/rss/?orderby=2day&order=' . $order_text . '">2D</a>',
            'col_7day' => '<a class="day_'.$order_text.'" href="' . DASHBOARD_URL . '/rss/?orderby=7day&order=' . $order_text . '">7D</a>',
            'col_30day' => '<a class="day_'.$order_text.'" href="' . DASHBOARD_URL . '/rss/?orderby=30day&order=' . $order_text . '">30D</a>',
            'col_options' => Language::$phrases['context']['options'],
        );
        $row = "";
        $table->add_columns($columns);

        $where = "";
        $search_query = $request->get('s');
        $source_id = $request->get('source');
        $cat_id = $request->get('category');
        if (in_array($request->get('status'), array('0', '1'))) {
            $where = "status=" . $request->get('status') . "";
        } elseif (!empty($search_query)) {
            $where = "url LIKE '%$search_query%'";
        }
        if (!empty($source_id) and empty($cat_id)) {
            $where = "source = $source_id";
        } else if (empty($source_id) and !empty($cat_id)) {
            $where = "categories REGEXP '.*;s:[0-9]+:\"$cat_id\".*'";
        } else if (!empty($source_id) and !empty($cat_id)) {
            $where = "source = $source_id AND categories REGEXP '.*;s:[0-9]+:\"$cat_id\".*'";
        }

        // Pagination
        $currentURL = trailingslashit($request->getCurrentRquestUrl());
        if (count($request->all()) > 0) {
            $currentURL = $request->getCurrentRquestUrl();
        }
        $limit = 50;
        $pager = new Pagenavi($currentURL, $request->get('page'), $limit);
        $start = $pager->start($limit);
        $countRecords = $this->model->countRss($where);
        $table->add_pagenavi($pager->pageList($countRecords));

        //Get the records registered in the prepare_items method
        $records = $this->model->getRssByDay($start, $limit, $where, $orderby, $order);
        $sourceModel = new SourceCategoryAdminModel();
        $categoryModel = new CategoryAdminModel();
        
        //Loop for each record
        if (is_array($records) and !empty($records)) {
            $sources = $sourceModel->allCategories();
            $categories = $categoryModel->allCategories();
            
            foreach ($records as $rec) {
                
                //Open the line
                $row .= '<tr id="row_' . $rec->ID . '">';        
                foreach ($columns as $field => $title) {
                    $class = "class='$field column-$field' ";
                    $style = "";
                    $attributes = $class . $style;

                    $source_link = DASHBOARD_URL . '/rss/?source=' . $rec['source'];
                    $edit_link = DASHBOARD_URL . '/rss/' . $rec['id'] . '/edit';
                    $delete_link = DASHBOARD_URL . '/rss/' . $rec['id'] . '/delete';

                    //Display the cell
                    switch ($field) {
                        case "col_cbox":
                            $row .= '<td ' . $attributes . '><input type="checkbox" name="item[]" value="' . $rec['id'] . '" /></td>';
                            break;
                        case "col_id":
                            $row .= '<td ' . $attributes . '>' . $rec['id'] . '</td>';
                            break;
                        case "col_source":
                            $row .= '<td ' . $attributes . '><a href="' . $source_link . '">';
                            foreach ($sources as $source) {
                                if ($source['id'] == $rec['source']) {
                                    $row .= $source['name'];
                                }
                            }
                            $row .= '</a></td>';
                            break;
                        case "col_categories":
                            $row .= '<td ' . $attributes . '>';
                            $rss_cat = unserialize($rec['categories']);
                            $i = 1;
                            foreach ($categories as $category) {
                                if (in_array($category['id'], $rss_cat)) {
                                    if ($i >= count($rss_cat)) {
                                        $row .= '<a href="' . DASHBOARD_URL . '/rss/?category=' . $category['id'] . '">' . $category['name'] . "</a>";
                                    } else {
                                        $row .= '<a href="' . DASHBOARD_URL . '/rss/?category=' . $category['id'] . '">' . $category['name'] . "</a>, ";
                                    }
                                }
                                $i++;
                            }
                            $row .= '</td>';
                            break;
                        case "col_URL":
                            $row .= '<td ' . $attributes . '><a href="' . $rec['url'] . '" target="_blank">';
                            if (strlen($rec['url']) > 50) {
                                $row .= substr($rec['url'], 0, 50) . "...";
                            } else {
                                $row .= $rec['url'];
                            }
                            $row .= '</a></td>';
                            break;
                        case "col_status":
                            $row .= '<td ' . $attributes . '>' . Utils::getRssStatus($rec['status']) . '</td>';
                            break;
                        case "col_1day":
                            $row .= '<td ' . $attributes . '>'.$rec['1day'].'</td>';
                            break;
                        case "col_2day":
                            $row .= '<td ' . $attributes . '>' .$rec['2day']. '</td>';
                            break;
                        case "col_7day":
                            $row .= '<td ' . $attributes . '>' .$rec['7day']. '</td>';
                            break;
                        case "col_30day":
                            $row .= '<td ' . $attributes . '>' .$rec['30day']. '</td>';
                            break;
                        case "col_options":
                            $row .= '<td ' . $attributes . '>';
                            if ($this->current_user['capability']['rss']['edit'] == 1)
                                $row .= '<a href="' . $edit_link . '" class="btn btn-primary btn-xs">' . Language::$phrases['action']['edit'] . '</a> ';
                            if ($this->current_user['capability']['rss']['delete'] == 1)
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

        $this->render("rss/index", array(
            'title' => Language::$phrases['page']['rss']['title.index'],
            'table' => $table->createView(),
            'filter_source' => $sourceModel->categoryOptions(FALSE),
            'filter_category' => $categoryModel->categoryOptions(FALSE),
            'request' => $request,
        ));
    }

    function addnew() {
        // Check permission
        if ($this->current_user['capability']['rss']['create'] == 0) {
            Debug::throwException(Language::$phrases['message']['error_occur'], null);
        }

        $title = Language::$phrases['page']['rss']['title.addnew'];

        $request = $this->getRequest();
        $source = $request->get('source');
        $categories = $request->get('categories');
        $rss_url = $request->get('rss_url');

        $categoryModel = new CategoryAdminModel();
        $sourceModel = new SourceCategoryAdminModel();

        $form = new Form($title, array(
            'action' => '',
            'method' => 'post',
            'class' => 'form-horizontal'
        ));
        $form->add('source', 'choice', array(
                    'label' => Language::$phrases['context']['source'],
                    'choices' => $sourceModel->categoryOptions(false),
                    'data' => $source,
                ))
                ->add('categories', 'choice', array(
                    'label' => Language::$phrases['context']['categories'],
                    'choices' => $categoryModel->categoryOptions(false),
                    'data' => $categories,
                    'multiple' => true,
                    'attr' => array(
                        'size' => 12
                    )
                ))
                ->add('rss_url', 'text', array(
                    'label' => "RSS URL",
                    'data' => $rss_url,
        ));

        if ($request->getMethod() == 'POST') {
            $msg = "";
            if (empty($source)) {
                $msg .= Language::$phrases['context']['source.error.empty'];
            }
            if (empty($categories)) {
                $msg .= Language::$phrases['context']['categories.error.empty'];
            }
            if (empty($rss_url)) {
                $msg .= Language::$phrases['context']['rss.error.empty'];
            }
            if ($msg != "") {
                $this->getSession()->setFlash('warning', $msg);
            } else {
                $id = $this->model->create(array(
                    'source' => $source,
                    'categories' => serialize($categories),
                    'url' => $rss_url,
                ));
                if ($id) {
                    $this->getSession()->setFlash('success', Language::$phrases['message']['create_success']);

                    $url = DASHBOARD_URL . '/rss/' . $id . '/edit';
                    $this->redirect($url);
                }
            }
        }

        $this->render("rss/new", array(
            'title' => $title,
            'formview' => $form->createView(),
        ));
    }

    function edit($id) {
        // Check permission
        if ($this->current_user['capability']['rss']['edit'] == 0) {
            Debug::throwException(Language::$phrases['message']['error_occur'], null);
        }

        $rss = $this->model->getRssByID($id);
        if (empty($rss)) {
            $this->redirect(DASHBOARD_URL . '/rss/');
        } else {
            $title = Language::$phrases['page']['rss']['title.edit'];
            $categoryModel = new CategoryAdminModel();
            $sourceModel = new SourceCategoryAdminModel();

            $form = new Form($title, array(
                'action' => '',
                'method' => 'post',
                'class' => 'form-horizontal'
            ));
            $form->add('source', 'choice', array(
                        'label' => Language::$phrases['context']['source'],
                        'choices' => $sourceModel->categoryOptions(false),
                        'data' => $rss['source'],
                    ))
                    ->add('categories', 'choice', array(
                        'label' => Language::$phrases['context']['categories'],
                        'choices' => $categoryModel->categoryOptions(false),
                        'data' => unserialize($rss['categories']),
                        'multiple' => true,
                        'attr' => array(
                            'size' => 12
                        )
                    ))
                    ->add('rss_url', 'text', array(
                        'label' => "RSS URL",
                        'data' => $rss['url'],
            ));

            $request = $this->getRequest();
            if ($request->getMethod() == 'POST') {
                $msg = "";
                $source = $request->get('source');
                $categories = $request->get('categories');
                $rss_url = $request->get('rss_url');

                if (empty($source)) {
                    $msg .= Language::$phrases['context']['source.error.empty'];
                }
                if (empty($categories)) {
                    $msg .= Language::$phrases['context']['categories.error.empty'];
                }
                if (empty($rss_url)) {
                    $msg .= Language::$phrases['context']['rss.error.empty'];
                }
                if ($msg != "") {
                    $this->getSession()->setFlash('warning', $msg);
                } else {
                    $this->model->update(array(
                        'source' => $source,
                        'categories' => serialize($categories),
                        'url' => $rss_url,
                        'status' => 0,
                            ), array(
                        'id' => $id,
                    ));
                    $this->getSession()->setFlash('success', Language::$phrases['message']['update_success']);
                    $this->redirect($request->getCurrentRquestUrl());
                }
            }

            $this->render("rss/edit", array(
                'title' => $title,
                'formview' => $form->createView(),
                'rss' => $rss,
            ));
        }
    }

    function delete($id) {
        // Check permission
        if ($this->current_user['capability']['rss']['delete'] == 0) {
            Debug::throwException(Language::$phrases['message']['error_occur'], null);
        }

        $url = DASHBOARD_URL . '/rss/';
        $rss = $this->model->getRssByID($id);
        if (empty($rss)) {
            $this->redirect($url);
        } else {
            $this->model->delete($id);
            $this->getSession()->setFlash('success', Language::$phrases['message']['delete_success']);
            $this->redirect($url);
        }
    }

    function check_rss() {
        $filename = TMP_PATH . 'check_rss.log';
        if (!file_exists($filename)) {
            write_file($filename, 0);
        }
        $count_rss = intval(trim(file_get_contents($filename)));
        $where = "";
        $limit = 20;
        $totalRss = $this->model->countRss($where);
        if ($count_rss > $totalRss) {
            $count_rss = 0;
        }
        $rssLive = $this->model->getRss($count_rss, $limit, $where);
        write_file($filename, $count_rss + $limit);

        foreach ($rssLive as $rss) {
            /*$feed = new SimplePie();
            $feed->set_feed_url($rss['url']);
            $feed->init();
            $items = $feed->get_items();

            $count = 0;
            // Calculate 48 hours ago
            $day = time() - (48 * 60 * 60);
            // loop through items
            foreach ($items as $item) {
                // Compare the timestamp of the feed item with 48 hours ago.
                if ($item->get_date('U') > $day) {
                    $count++;
                }
            }*/
            
            $rss_id = $rss['id'];
            $count = $this->model->countRssPosts(Registry::$settings['config']['num_day'], $rss_id);
            if ($count == 0) {
                $this->model->update(array(
                    'status' => 1,
                        ), array(
                    'id' => $rss_id,
                ));
            }
            /*else if ($rss['status'] == 1) {
                $this->model->update(array(
                    'status' => 0,
                        ), array(
                    'id' => $rss_id,
                ));
            }*/
        }
    }

}
