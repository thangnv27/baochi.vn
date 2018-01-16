<?php

class ReportAdmin extends AdminController {

    private $current_user;

    function __construct() {
        parent::__construct();
        $this->current_user = UserAdmin::checkLogin();
    }

    function index() {
        if ($this->current_user['capability']['report']['view'] == 0) {
            Debug::throwException(Language::$phrases['message']['error_occur'], null);
        }

        ## Bulk Actions
        $request = $this->getRequest();
        $action = $request->get('action');
        $url = DASHBOARD_URL . '/report/';
        switch ($action) {
            case 'delete':
                // Check permission
                if ($this->current_user['capability']['report']['delete'] == 0) {
                    Debug::throwException(Language::$phrases['message']['error_occur'], null);
                }

                $checked = $request->get('item');
                if (count($checked) > 0) {
                    $report_ID = implode(", ", $checked);
                    if ($report_ID != "") {
                        $this->model->deleteBulk("id IN ($report_ID)");
                        $this->getSession()->setFlash('success', Language::$phrases['message']['delete_success']);
                    }
                }
                $this->redirect($url);
                break;
            default:
                break;
        }

        ## List table
        $table = new Table(Language::$phrases['page']['report']['title.index']);
        $columns = array(
            'col_cbox' => '<input type="checkbox" id="checkall" />',
            'col_link_id' => "Link ID",
            'col_link' => "Link",
            'col_categories' => Language::$phrases['context']['categories'],
            'col_broken' => Language::$phrases['context']['broken_link'],
            'col_wrong_category' => Language::$phrases['context']['wrong_category'],
            'col_sex' => Language::$phrases['page']['report']['sex'],
            'col_low_quality' => Language::$phrases['context']['low_quality'],
            'col_spam' => "Spam",
            'col_adv' => Language::$phrases['context']['adv'],
            'col_date' => Language::$phrases['page']['report']['date'],
            'col_options' => Language::$phrases['context']['options'],
        );
        $row = "";
        $table->add_columns($columns);

        // Pagination
        $currentURL = trailingslashit($request->getCurrentRquestUrl());
        if (count($request->all()) > 0) {
            $currentURL = $request->getCurrentRquestUrl();
        }
        $limit = 50;
        $pager = new Pagenavi($currentURL, $request->get('page'), $limit);
        $start = $pager->start($limit);
        $countRecords = $this->model->countReport();
        $table->add_pagenavi($pager->pageList($countRecords));

        //Get the records registered in the prepare_items method
        $records = $this->model->getReport($start, $limit);

        //Loop for each record
        if (is_array($records) and !empty($records)) {
            $categoryModel = new LinkCategoryAdminModel();
            $categories = $categoryModel->allCategories();

            foreach ($records as $rec) {

                //Open the line
                $row .= '<tr id="row_' . $rec->ID . '">';
                foreach ($columns as $field => $title) {
                    $class = "class='$field column-$field' ";
                    $style = "";
                    $attributes = $class . $style;

                    $edit_link = DASHBOARD_URL . '/link/' . $rec['link_id'] . '/edit';
                    $details_link = DASHBOARD_URL . '/report/' . $rec['link_id'] . '/link';
                    $delete_link = DASHBOARD_URL . '/report/' . $rec['id'] . '/delete';

                    //Display the cell
                    switch ($field) {
                        case "col_cbox":
                            $row .= '<td ' . $attributes . '><input type="checkbox" name="item[]" value="' . $rec['id'] . '" /></td>';
                            break;
                        case "col_link_id":
                            $row .= '<td ' . $attributes . '><a href=' . $edit_link . ' target="_blank">' . $rec['link_id'] . '</a></td>';
                            break;
                        case "col_link":
                            $url_link = parse_url($rec['link']);
                            if (empty($url_link['scheme']))
                                $rec['link'] = "http://" . $rec['link'];
                            $row .= '<td ' . $attributes . '><a href="' . $rec['link'] . '" target="_blank">'. $rec['title'] .'</td>';
                            break;
                        case "col_categories":
                            $row .= '<td ' . $attributes . '>';
                            $post_cat = unserialize($rec['categories']);
                            $i = 1;
                            foreach ($categories as $category) {
                                if (in_array($category['id'], $post_cat)) {
                                    if ($i >= count($post_cat)) {
                                        $row .= $category['name'];
                                    } else {
                                        $row .= $category['name'] . ", ";
                                    }
                                }
                                $i++;
                            }
                            $row .= '</td>';
                            break;
                        case "col_broken":
                            $row .= '<td ' . $attributes . '>' . Utils::yesNo($rec['broken']) . '</td>';
                            break;
                        case "col_wrong_category":
                            $row .= '<td ' . $attributes . '>' . Utils::yesNo($rec['wrong_category']) . '</td>';
                            break;
                        case "col_sex":
                            $row .= '<td ' . $attributes . '>' . Utils::yesNo($rec['sex']) . '</td>';
                            break;
                        case "col_low_quality":
                            $row .= '<td ' . $attributes . '>' . Utils::yesNo($rec['low_quality']) . '</td>';
                            break;
                        case "col_spam":
                            $row .= '<td ' . $attributes . '>' . Utils::yesNo($rec['spam']) . '</td>';
                            break;
                        case "col_adv":
                            $row .= '<td ' . $attributes . '>' . Utils::yesNo($rec['adv']) . '</td>';
                            break;
                        case "col_date":
                            $row .= '<td ' . $attributes . '>' . date('d-m-Y H:i:s', strtotime($rec['date'])) . '</td>';
                            break;
                        case "col_options":
                            $row .= '<td ' . $attributes . '>';
                            if ($this->current_user['capability']['report']['view'] == 1)
                                $row .= '<a href="' . $details_link . '" class="btn btn-primary btn-xs">' . Language::$phrases['action']['view'] . '</a> ';
                            if ($this->current_user['capability']['report']['delete'] == 1)
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

        $this->render("report/index", array(
            'title' => Language::$phrases['page']['report']['title.index'],
            'table' => $table->createView(),
        ));
    }

    function link($link_id) {
        if ($this->current_user['capability']['report']['view'] == 0) {
            Debug::throwException(Language::$phrases['message']['error_occur'], null);
        }
        $request = $this->getRequest();

        ## List table
        $table = new Table("LINK ID: " . $link_id);
        $columns = array(
            'col_broken' => Language::$phrases['context']['broken_link'],
            'col_wrong_category' => Language::$phrases['context']['wrong_category'],
            'col_sex' => Language::$phrases['page']['report']['sex'],
            'col_low_quality' => Language::$phrases['context']['low_quality'],
            'col_spam' => "Spam",
            'col_adv' => Language::$phrases['context']['adv'],
            'col_total' => Language::$phrases['context']['total'],
        );
        $row = "";
        $table->add_columns($columns);

        //Get the records registered in the prepare_items method
        $records = $this->model->getReportLink($link_id);

        //Loop for each record
        if (is_array($records) and !empty($records)) {

            foreach ($records as $rec) {

                //Open the line
                $row .= '<tr id="row_' . $rec->ID . '">';
                foreach ($columns as $field => $title) {
                    $class = "class='$field column-$field' ";
                    $style = "";
                    $attributes = $class . $style;

                    //Display the cell
                    switch ($field) {
                        case "col_broken":
                            $row .= '<td ' . $attributes . '>' . $rec['broken'] . '</td>';
                            break;
                        case "col_wrong_category":
                            $row .= '<td ' . $attributes . '>' . $rec['wrong_category'] . '</td>';
                            break;
                        case "col_sex":
                            $row .= '<td ' . $attributes . '>' . $rec['sex'] . '</td>';
                            break;
                        case "col_low_quality":
                            $row .= '<td ' . $attributes . '>' . $rec['low_quality'] . '</td>';
                            break;
                        case "col_spam":
                            $row .= '<td ' . $attributes . '>' . $rec['spam'] . '</td>';
                            break;
                        case "col_adv":
                            $row .= '<td ' . $attributes . '>' . $rec['adv'] . '</td>';
                            break;
                        case "col_total":
                            $row .= '<td ' . $attributes . '>' . $rec['total'] . '</td>';
                            break;
                    }
                }

                //Close the line
                $row .= '</tr>';
            }
        }

        $table->add_rows($row);

        $this->render("report/detail", array(
            'title' => Language::$phrases['page']['report']['title.detail'],
            'table' => $table->createView(),
        ));
    }

    function delete($id) {
        // Check permission
        if ($this->current_user['capability']['report']['delete'] == 0) {
            Debug::throwException(Language::$phrases['message']['error_occur'], null);
        }

        $url = DASHBOARD_URL . '/report/';
        $rss = $this->model->getReportByID($id);
        if (empty($rss)) {
            $this->redirect($url);
        } else {
            $this->model->delete($id);
            $this->getSession()->setFlash('success', Language::$phrases['message']['delete_success']);
            $this->redirect($url);
        }
    }

}
