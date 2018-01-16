<?php

class OrderAdmin extends AdminController {

    private $current_user;

    function __construct() {
        parent::__construct();
        $this->current_user = UserAdmin::checkLogin();
    }

    function index() {
        if ($this->current_user['capability']['orders']['view'] == 0) {
            Debug::throwException(Language::$phrases['message']['error_occur'], null);
        }

        ## Bulk Actions
        $request = $this->getRequest();
        $action = $request->get('action');
        $url = DASHBOARD_URL . '/order/';
        switch ($action) {
            case 'delete':
                // Check permission
                if ($this->current_user['capability']['orders']['delete'] == 0) {
                    Debug::throwException(Language::$phrases['message']['error_occur'], null);
                }

                $checked = $request->get('item');
                if (count($checked) > 0) {
                    $order_ID = implode(", ", $checked);
                    if ($order_ID != "") {
                        // Update parent
                        $this->model->update(array(
                            'parent' => 0,
                                ), "parent IN ($order_ID) AND status = 3");
                        // Delete
                        $this->model->deleteBulk("id IN ($order_ID) AND status = 3");
                        $this->getSession()->setFlash('success', Language::$phrases['message']['delete_success']);
                    }
                }
                $this->redirect($url);
                break;
            default:
                break;
        }

        $page_title = Language::$phrases['page']['order']['title.index'];
        foreach (Utils::getOrderStatus() as $key => $value) {
            if (intval($request->get('status')) == $key) {
                $page_title .= ": $value";
                break;
            }
        }

        ## List table
        $table = new Table($page_title);
        $columns = array(
            'col_cbox' => '<input type="checkbox" id="checkall" />',
            'col_id' => 'ID',
            'col_customer' => Language::$phrases['page']['order']['customer'],
            'col_amount' => Language::$phrases['page']['order']['amount'],
            'col_status' => Language::$phrases['page']['order']['status'],
            'col_delivery' => Language::$phrases['page']['order']['delivery'],
            'col_date' => Language::$phrases['page']['order']['date'],
            'col_options' => Language::$phrases['context']['options'],
        );
        $row = "";
        $table->add_columns($columns);

        $where = array();
        $search_query = $request->get('s');
        if (is_numeric($request->get('status')) and in_array($request->get('status'), array(0, 1, 2, 3))) {
            $where = "status='" . $request->get('status') . "'";
        } elseif (!empty($search_query)) {
            $where = "customer_info LIKE '%$search_query%' OR ship_info LIKE '%$search_query%' OR "
                    . "payment_method LIKE '%$search_query%' OR total_amount LIKE '%$search_query%' OR "
                    . "products LIKE '%$search_query%' OR created_at LIKE '%$search_query%'";
        } else {
            $startdate = $request->get('startdate');
            $enddate = $request->get('enddate');
            if (!empty($startdate) and !empty($enddate)) {
                $where = "created_at BETWEEN '$startdate' AND '$enddate'";
            } elseif (!empty($startdate) and empty($enddate)) {
                $where = "created_at BETWEEN '$startdate' AND curdate()";
            } elseif (empty($startdate) and !empty($enddate)) {
                $where = "created_at <= '$enddate'";
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
        $countRecords = $this->model->countOrders($where);
        $table->add_pagenavi($pager->pageList($countRecords));

        //Get the records registered in the prepare_items method
        $records = $this->model->orderRowsTable($start, $limit, $where);

        //Loop for each record
        if (is_array($records) and !empty($records)) {
            foreach ($records as $rec) {

                //Open the line
                $row .= '<tr id="row_' . $rec->ID . '">';
                foreach ($columns as $field => $title) {
                    $class = "class='$field column-$field' ";
                    $style = "";
                    $attributes = $class . $style;

                    $view_link = DASHBOARD_URL . '/order/' . $rec['id'] . '/view';
                    $cancel_link = DASHBOARD_URL . '/order/' . $rec['id'] . '/cancel';

                    //Display the cell
                    switch ($field) {
                        case "col_cbox":
                            $row .= '<td ' . $attributes . '><input type="checkbox" name="item[]" value="' . $rec['id'] . '" /></td>';
                            break;
                        case "col_id":
                            $row .= '<td ' . $attributes . '>' . $rec['id'] . '</td>';
                            break;
                        case "col_customer":
                            if ($rec['customer_id'] == 0) {
                                $row .= '<td ' . $attributes . '>' . Language::$phrases['context']['guest'] . '</td>';
                            } else {
                                if (empty($rec['first_name']) and empty($rec['last_name'])) {
                                    $row .= '<td ' . $attributes . '>' . $rec['username'] . '</td>';
                                } else {
                                    $row .= '<td ' . $attributes . '>' . $rec['first_name'] . " " . $rec['last_name'] . '</td>';
                                }
                            }
                            break;
                        case "col_amount":
                            $row .= '<td ' . $attributes . '>' . number_format($rec['total_amount'], 0, ',', '.') . ' VNĐ</td>';
                            break;
                        case "col_status":
                            foreach (Utils::getOrderStatus() as $key => $status) {
                                if ($rec['status'] == $key) {
                                    if (0 == $rec['status']) {
                                        $row .= '<td ' . $attributes . '><span class="label label-primary">' . $status . '</span></td>';
                                    } elseif (1 == $rec['status']) {
                                        $row .= '<td ' . $attributes . '><span class="label label-warning">' . $status . '</span></td>';
                                    } elseif (2 == $rec['status']) {
                                        $row .= '<td ' . $attributes . '><span class="label label-success">' . $status . '</span></td>';
                                    } elseif (3 == $rec['status']) {
                                        $row .= '<td ' . $attributes . '><span class="label label-danger">' . $status . '</span></td>';
                                    }
                                }
                            }
                            break;
                        case "col_delivery":
                            foreach (Utils::getDeliveryStatus() as $key => $status) {
                                if ($rec['delivery_status'] == $key) {
                                    if (0 == $rec['delivery_status']) {
                                        $row .= '<td ' . $attributes . '><span class="label label-primary">' . $status . '</span></td>';
                                    } elseif (1 == $rec['delivery_status']) {
                                        $row .= '<td ' . $attributes . '><span class="label label-warning">' . $status . '</span></td>';
                                    } elseif (2 == $rec['status']) {
                                        $row .= '<td ' . $attributes . '><span class="label label-success">' . $status . '</span></td>';
                                    }
                                }
                            }
                            break;
                        case "col_date":
                            $row .= '<td ' . $attributes . '>' . $rec['created_at'] . '</td>';
                            break;
                        case "col_options":
                            $row .= '<td ' . $attributes . '>';
                            if ($this->current_user['capability']['orders']['view'] == 1)
                                $row .= '<a href="' . $view_link . '" class="btn btn-primary btn-xs">' . Language::$phrases['action']['view'] . '</a> ';
                            if ($this->current_user['capability']['orders']['edit'] == 1)
                                $row .= '<a href="' . $cancel_link . '" class="btn btn-danger btn-xs" onclick="return confirm(\'' . Language::$phrases['action']['cancel.confirm'] . '\');">' . Language::$phrases['action']['cancel'] . '</a>';
                            $row .= '</td>';
                            break;
                    }
                }

                //Close the line
                $row .= '</tr>';
            }
        }

        $table->add_rows($row);

        $this->render("order/index", array(
            'title' => $page_title,
            'table' => $table->createView(),
        ));
    }

    function cancel($id) {
        // Check permission
        if ($this->current_user['capability']['orders']['edit'] == 0) {
            Debug::throwException(Language::$phrases['message']['error_occur'], null);
        }

        $orders = $this->model->getOrderByID($id);
        $url = DASHBOARD_URL . '/order/?status=0';
        if (count($orders) <= 0) {
            $this->redirect($url);
        } else {
            $this->model->cancel($id);
            $this->getSession()->setFlash('success', Language::$phrases['message']['cancel_success']);
            $this->redirect($url);
        }
    }

    function view($id) {
        // Check permission
        if ($this->current_user['capability']['orders']['view'] == 0) {
            Debug::throwException(Language::$phrases['message']['error_occur'], null);
        }

        $orders = $this->model->getOrderByID($id);
        if (count($orders) <= 0) {
            $this->redirect(DASHBOARD_URL . '/order/');
        } else {
            $order = $orders[0];
            $title = Language::$phrases['page']['order']['title.view'];
            $customer_info = unserialize($order['customer_info']);
            $ship_info = unserialize($order['ship_info']);
            $products = unserialize($order['products']);

            $customer = new Form();
            $customer->add("fullname", "static", array(
                        'label' => Language::$phrases['page']['order']['fullname'],
                        'data' => $customer_info['fullname'],
                    ))
                    ->add('email', 'static', array(
                        'label' => Language::$phrases['page']['order']['email'],
                        'data' => $customer_info['email'],
                    ))
                    ->add('phone', 'static', array(
                        'label' => Language::$phrases['page']['order']['phone'],
                        'data' => $customer_info['phone'],
                    ))
                    ->add('passport', 'static', array(
                        'label' => Language::$phrases['page']['order']['passport'],
                        'data' => $customer_info['passport'],
                    ))
                    ->add('address', 'static', array(
                        'label' => Language::$phrases['page']['order']['address'],
                        'data' => $customer_info['address'],
                    ))
                    ->add('city', 'static', array(
                        'label' => Language::$phrases['page']['order']['city'],
                        'data' => $customer_info['city'],
            ));
            $shipping = new Form();
            $shipping->add("receiver", "static", array(
                        'label' => Language::$phrases['page']['order']['receiver'],
                        'data' => $ship_info['fullname'],
                    ))
                    ->add('email', 'static', array(
                        'label' => Language::$phrases['page']['order']['email'],
                        'data' => $ship_info['email'],
                    ))
                    ->add('phone', 'static', array(
                        'label' => Language::$phrases['page']['order']['phone'],
                        'data' => $ship_info['phone'],
                    ))
                    ->add('passport', 'static', array(
                        'label' => Language::$phrases['page']['order']['passport'],
                        'data' => $ship_info['passport'],
                    ))
                    ->add('address', 'static', array(
                        'label' => Language::$phrases['page']['order']['address'],
                        'data' => $ship_info['address'],
                    ))
                    ->add('city', 'static', array(
                        'label' => Language::$phrases['page']['order']['city'],
                        'data' => $ship_info['city'],
            ));
            $order_info = new Form();
            $order_info->add("payment_method", "static", array(
                        'label' => Language::$phrases['page']['order']['payment_method'],
                        'data' => $order['payment_method'],
                    ))
                    ->add('discount', 'static', array(
                        'label' => Language::$phrases['page']['order']['discount'],
                        'data' => number_format($order['discount'], 0, ',', '.') . " VNĐ",
                    ))
                    ->add('total_amount', 'static', array(
                        'label' => Language::$phrases['page']['order']['total_amount'],
                        'data' => number_format($order['total_amount'], 0, ',', '.') . " VNĐ",
                    ))
                    ->add('status', 'choice', array(
                        'label' => Language::$phrases['page']['order']['status'],
                        'choices' => Utils::getOrderStatus(),
                        'data' => $order['status'],
                    ))
                    ->add('delivery_status', 'choice', array(
                        'label' => Language::$phrases['page']['order']['delivery_status'],
                        'choices' => Utils::getDeliveryStatus(),
                        'data' => $order['delivery_status'],
            ));

            ## List table
            $table = new Table();
            $columns = array(
                'col_id' => 'ID',
                'col_product_name' => Language::$phrases['page']['order']['product_name'],
                'col_price' => Language::$phrases['page']['order']['price'],
                'col_quantity' => Language::$phrases['page']['order']['quantity'],
                'col_amount' => Language::$phrases['page']['order']['amount'],
                'col_options' => Language::$phrases['context']['options'],
            );
            $row = "";
            $table->add_columns($columns);

            //Loop for each record
            if (is_array($products) and !empty($products)) {
                foreach ($products as $rec) {

                    //Open the line
                    $row .= '<tr id="row_' . $rec->ID . '">';
                    foreach ($columns as $field => $name) {
                        $class = "class='$field column-$field' ";
                        $style = "";
                        $attributes = $class . $style;

                        //Display the cell
                        switch ($field) {
                            case "col_id":
                                $row .= '<td ' . $attributes . '>' . $rec['id'] . '</td>';
                                break;
                            case "col_product_name":
                                $row .= '<td ' . $attributes . '>' . $rec['title'] . '</td>';
                                break;
                            case "col_price":
                                $row .= '<td ' . $attributes . '>' . number_format($rec['price'], 0, ',', '.') . ' VNĐ</td>';
                                break;
                            case "col_quantity":
                                $row .= '<td ' . $attributes . '>' . $rec['quantity'] . '</td>';
                                break;
                            case "col_amount":
                                $row .= '<td ' . $attributes . '>' . number_format($rec['amount'], 0, ',', '.') . ' VNĐ</td>';
                                break;
                            case "col_options":
                                $row .= '<td ' . $attributes . '>';
                                $row .= '<a href="' . Registry::$siteurl . '/product/' . $rec['slug'] . '/" class="btn btn-info btn-xs" target="_blank">' . Language::$phrases['action']['view'] . '</a> ';
                                break;
                        }
                    }

                    //Close the line
                    $row .= '</tr>';
                }
            }

            $table->add_rows($row);

            $request = $this->getRequest();
            if ($request->getMethod() == 'POST') {
                if ($this->current_user['capability']['orders']['edit'] == 0) {
                    $this->getSession()->setFlash('warning', Language::$phrases['message']['error_occur']);
                } else {
                    $msg = "";
                    $order_status = $request->get('status');
                    $delivery_status = $request->get('delivery_status');

                    if (!in_array($order_status, array(0, 1, 2, 3))) {
                        $msg .= Language::$phrases['page']['order']['status.error.invalid'];
                    }
                    if (!in_array($delivery_status, array(0, 1, 2))) {
                        $msg .= Language::$phrases['page']['order']['delivery.error.invalid'];
                    }
                    if ($msg != "") {
                        $this->getSession()->setFlash('warning', $msg);
                    } else {
                        $this->model->update(array(
                            'status' => $order_status,
                            'delivery_status' => $delivery_status,
                                ), array(
                            'id' => $id,
                        ));
                        $this->getSession()->setFlash('success', Language::$phrases['message']['update_success']);
                        $this->redirect($request->getCurrentRquestUrl());
                    }
                }
            }

            $this->render("order/view", array(
                'title' => $title,
                'customer' => $customer,
                'shipping' => $shipping,
                'order_info' => $order_info,
                'order' => $order,
                'table' => $table->createView(),
            ));
        }
    }

}
