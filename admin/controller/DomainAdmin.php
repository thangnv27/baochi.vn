<?php

class DomainAdmin extends AdminController {

    private $current_user;

    function __construct() {
        parent::__construct();
        $this->current_user = UserAdmin::checkLogin();
    }

    function index() {
        if ($this->current_user['capability']['blacklistDomains']['view'] == 0) {
            Debug::throwException(Language::$phrases['message']['error_occur'], null);
        }

        ## Bulk Actions
        $request = $this->getRequest();
        $action = $request->get('action');
        $url = DASHBOARD_URL . '/domain/';
        switch ($action) {
            case 'delete':
                // Check permission
                if ($this->current_user['capability']['blacklistDomains']['delete'] == 0) {
                    Debug::throwException(Language::$phrases['message']['error_occur'], null);
                }

                $checked = $request->get('item');
                if (count($checked) > 0) {
                    $domain_ID = implode(", ", $checked);
                    if ($domain_ID != "") {
                        $this->model->deleteBulk("id IN ($domain_ID)");
                        $this->getSession()->setFlash('success', Language::$phrases['message']['delete_success']);
                    }
                }
                $this->redirect($url);
                break;
            default:
                break;
        }

        ## List table
        $table = new Table(Language::$phrases['page']['blacklist_domain']['title.index']);
        $columns = array(
            'col_cbox' => '<input type="checkbox" id="checkall" />',
            'col_id' => "ID",
            'col_domain' => Language::$phrases['context']['domain'],
            'col_options' => Language::$phrases['context']['options'],
        );
        $row = "";
        $table->add_columns($columns);

        $where = array();
        $search_query = $request->get('s');
        if (!empty($search_query)) {
            $where = "domain LIKE '%$search_query%'";
        }

        // Pagination
        $currentURL = trailingslashit($request->getCurrentRquestUrl());
        if (count($request->all()) > 0) {
            $currentURL = $request->getCurrentRquestUrl();
        }
        $limit = 50;
        $pager = new Pagenavi($currentURL, $request->get('page'), $limit);
        $start = $pager->start($limit);
        $countRecords = $this->model->countBlacklistDomains($where);
        $table->add_pagenavi($pager->pageList($countRecords));

        //Get the records registered in the prepare_items method
        $records = $this->model->getBlacklistDomains($start, $limit, $where);

        //Loop for each record
        if (is_array($records) and !empty($records)) {
            foreach ($records as $rec) {

                //Open the line
                $row .= '<tr id="row_' . $rec->ID . '">';
                foreach ($columns as $field => $title) {
                    $class = "class='$field column-$field' ";
                    $style = "";
                    $attributes = $class . $style;

                    $edit_link = DASHBOARD_URL . '/domain/' . $rec['id'] . '/edit';
                    $delete_link = DASHBOARD_URL . '/domain/' . $rec['id'] . '/delete';

                    //Display the cell
                    switch ($field) {
                        case "col_cbox":
                            $row .= '<td ' . $attributes . '><input type="checkbox" name="item[]" value="' . $rec['id'] . '" /></td>';
                            break;
                        case "col_id":
                            $row .= '<td ' . $attributes . '>' . $rec['id'] . '</td>';
                            break;
                        case "col_domain":
                            $row .= '<td ' . $attributes . '>' . $rec['domain'] . '</td>';
                            break;
                        case "col_options":
                            $row .= '<td ' . $attributes . '>';
                            if ($this->current_user['capability']['blacklistDomains']['edit'] == 1)
                                $row .= '<a href="' . $edit_link . '" class="btn btn-primary btn-xs">' . Language::$phrases['action']['edit'] . '</a> ';
                            if ($this->current_user['capability']['blacklistDomains']['delete'] == 1)
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

        $this->render("domain/index", array(
            'title' => Language::$phrases['page']['blacklist_domain']['title.index'],
            'table' => $table->createView(),
        ));
    }

    function addnew() {
        // Check permission
        if ($this->current_user['capability']['blacklistDomains']['create'] == 0) {
            Debug::throwException(Language::$phrases['message']['error_occur'], null);
        }

        $title = Language::$phrases['page']['blacklist_domain']['title.addnew'];

        $request = $this->getRequest();
        $domain = $request->get('domain');

        $form = new Form($title, array(
            'action' => '',
            'method' => 'post',
            'class' => 'form-horizontal'
        ));
        $form->add('domain', 'text', array(
            'label' => Language::$phrases['context']['domain'],
            'data' => $domain,
        ));

        if ($request->getMethod() == 'POST') {
            $msg = "";
            if (empty($domain)) {
                $msg .= Language::$phrases['context']['domain.error.empty'];
            }
            if ($msg != "") {
                $this->getSession()->setFlash('warning', $msg);
            } else {
                $id = $this->model->create(array(
                    'domain' => $domain,
                ));
                if ($id) {
                    $this->getSession()->setFlash('success', Language::$phrases['message']['create_success']);

                    $url = DASHBOARD_URL . '/domain/' . $id . '/edit';
                    $this->redirect($url);
                }
            }
        }

        $this->render("domain/new", array(
            'title' => $title,
            'formview' => $form->createView(),
        ));
    }

    function edit($id) {
        // Check permission
        if ($this->current_user['capability']['blacklistDomains']['edit'] == 0) {
            Debug::throwException(Language::$phrases['message']['error_occur'], null);
        }

        $domain = $this->model->getBlacklistDomainsByID($id);
        if (empty($domain)) {
            $this->redirect(DASHBOARD_URL . '/domain/');
        } else {
            $title = Language::$phrases['page']['blacklist_domain']['title.edit'];

            $form = new Form($title, array(
                'action' => '',
                'method' => 'post',
                'class' => 'form-horizontal'
            ));
            $form->add('domain', 'text', array(
                'label' => Language::$phrases['context']['domain'],
                'data' => $domain['domain'],
            ));

            $request = $this->getRequest();
            if ($request->getMethod() == 'POST') {
                $msg = "";
                $_domain = $request->get('domain');
                $countExistsDomain = $this->model->countBlacklistDomains(array(
                    'domain' => $_domain
                ));
                if (empty($_domain)) {
                    $msg .= Language::$phrases['context']['domain.error.empty'];
                } else if ($countExistsDomain > 0) {
                    $msg .= Language::$phrases['context']['domain.error.exists'];
                }
                if ($msg != "") {
                    $this->getSession()->setFlash('warning', $msg);
                } else {
                    $this->model->update(array(
                        'domain' => $_domain,
                            ), array(
                        'id' => $id,
                    ));
                    $this->getSession()->setFlash('success', Language::$phrases['message']['update_success']);
                    $this->redirect($request->getCurrentRquestUrl());
                }
            }

            $this->render("domain/edit", array(
                'title' => $title,
                'formview' => $form->createView(),
            ));
        }
    }

    function delete($id) {
        // Check permission
        if ($this->current_user['capability']['blacklistDomains']['delete'] == 0) {
            Debug::throwException(Language::$phrases['message']['error_occur'], null);
        }

        $url = DASHBOARD_URL . '/domain/';
        $domain = $this->model->getBlacklistDomainsByID($id);
        if (empty($domain)) {
            $this->redirect($url);
        } else {
            $this->model->delete($id);
            $this->getSession()->setFlash('success', Language::$phrases['message']['delete_success']);
            $this->redirect($url);
        }
    }

}
