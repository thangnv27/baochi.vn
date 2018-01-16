<?php

class LinkAdmin extends AdminController {

    private $current_user;

    function __construct() {
        parent::__construct();
        $this->current_user = UserAdmin::checkLogin();
    }

    function index() {
        if ($this->current_user['capability']['links']['view'] == 0) {
            Debug::throwException(Language::$phrases['message']['error_occur'], null);
        }

        ## Bulk Actions
        $request = $this->getRequest();
        $action = $request->get('action');
        $move2category = $request->get('move2category');
        $url = DASHBOARD_URL . '/link/';
        if (empty($move2category)) {
            switch ($action) {
                case 'move2trash':
                    // Check permission
                    if ($this->current_user['capability']['links']['edit'] == 0) {
                        Debug::throwException(Language::$phrases['message']['error_occur'], null);
                    }

                    $checked = $request->get('item');
                    if (count($checked) > 0) {
                        $link_ID = implode(", ", $checked);
                        $this->model->move2trashBulk("id IN ($link_ID)");
                        $this->getSession()->setFlash('success', Language::$phrases['message']['move2trash_success']);
                    }
                    $this->redirect($url);
                    break;
                case 'publish':
                    // Check permission
                    if ($this->current_user['capability']['links']['edit'] == 0) {
                        Debug::throwException(Language::$phrases['message']['error_occur'], null);
                    }

                    $checked = $request->get('item');
                    if (count($checked) > 0) {
                        $link_ID = implode(", ", $checked);
                        $this->model->publishBulk("id IN ($link_ID)");
                        $this->getSession()->setFlash('success', Language::$phrases['message']['publish_success']);
                    }
                    $this->redirect($url);
                    break;
                case 'delete':
                    // Check permission
                    if ($this->current_user['capability']['links']['delete'] == 0) {
                        Debug::throwException(Language::$phrases['message']['error_occur'], null);
                    }

                    $checked = $request->get('item');
                    if (count($checked) > 0) {
                        $this->model->deleteBulk($checked);
                        $this->getSession()->setFlash('success', Language::$phrases['message']['delete_success']);
                    }
                    $this->redirect($url);
                    break;
                default:
                    break;
            }
        } else {
            // Check permission
            if ($this->current_user['capability']['links']['edit'] == 0) {
                Debug::throwException(Language::$phrases['message']['error_occur'], null);
            }

            // Chuyen danh muc cho hang loat links
            $checked = $request->get('item');
            if (count($checked) > 0) {
                $link_ID = implode(", ", $checked);
                $this->model->update(array(
                    'categories' => serialize(array($move2category)),
                        ), "id IN ($link_ID)");

                $this->model->updateTermsBulk($link_ID, $move2category);
                $this->getSession()->setFlash('success', Language::$phrases['message']['move_success']);
            }
            $this->redirect($url);
        }

        $userModel = new UserAdminModel();
        $categoryModel = new LinkCategoryAdminModel();

        $orderby = $request->get('orderby');
        $order = $request->get('order');
        $order_text = "asc";
        if ($order == 'asc') {
            $order_text = 'desc';
        } else if ($order == 'desc') {
            $order_text = 'asc';
        }

        ## List table
        $table = new Table(Language::$phrases['page']['page']['title.index']);
        $columns = array(
            'col_cbox' => '<input type="checkbox" id="checkall" />',
            'col_id' => 'ID',
            'col_favicon' => 'Favicon',
            'col_title' => Language::$phrases['context']['title'],
            'col_categories' => Language::$phrases['context']['categories'],
            'col_author' => Language::$phrases['page']['post']['author'],
            'col_date' => Language::$phrases['page']['page']['date'],
            'col_view' => '<a class="day_' . $order_text . '" href="' . DASHBOARD_URL . '/link/?orderby=view_count&order=' . $order_text . '">' . Language::$phrases['page']['page']['view'] . '</a>',
            'col_options' => Language::$phrases['context']['options'],
        );
        $row = "";
        $table->add_columns($columns);

        $where = "";
        if (in_array($request->get('status'), array('trashed', 'pending_approval', 'draft', 'published'))) {
            $where = "post_status='" . $request->get('status') . "'";
        } else {
            $search_query = $request->get('s');
            if (!empty($search_query)) {
                $where = "post_status IN ('draft','pending_approval','published') AND "
                        . "(title LIKE '%$search_query%' OR "
                        . "slug LIKE '%$search_query%' OR link LIKE '%$search_query%' OR "
                        . "posted_date LIKE '%$search_query%')";
            } else {
                $where = "post_status IN ('draft','pending_approval','published')";
            }
        }
        $author = $request->get('author');
        $category_id = $request->get('category');
        if (is_numeric($author) and $author > 0) {
            if (empty($where)) {
                $where = "user_id = $author";
            } else {
                $where .= " AND user_id = $author";
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
        $countRecords = $this->model->countLinks($where, $category_id);
        $table->add_pagenavi($pager->pageList($countRecords));

        //Get the records registered in the prepare_items method
        $records = $this->model->getLinks($start, $limit, $where, $orderby, $order, $category_id);

        //Loop for each record
        if (is_array($records) and ! empty($records)) {
            $categories = $categoryModel->allCategories();

            foreach ($records as $rec) {

                //Open the line
                $row .= '<tr id="row_' . $rec->ID . '">';
                foreach ($columns as $field => $title) {
                    $class = "class='$field column-$field' ";
                    $style = "";
                    $attributes = $class . $style;

                    $edit_link = DASHBOARD_URL . '/link/' . $rec['id'] . '/edit';
                    $delete_link = DASHBOARD_URL . '/link/' . $rec['id'] . '/delete';
                    $publish_link = DASHBOARD_URL . '/link/' . $rec['id'] . '/publish';
                    $link_by_author = DASHBOARD_URL . '/link/?author=';

                    //Display the cell
                    switch ($field) {
                        case "col_cbox":
                            $row .= '<td ' . $attributes . '><input type="checkbox" name="item[]" value="' . $rec['id'] . '" /></td>';
                            break;
                        case "col_id":
                            $row .= '<td ' . $attributes . '>' . $rec['id'] . '</td>';
                            break;
                        case "col_favicon":
                            $row .= '<td ' . $attributes . '><img src="' . $rec['thumbnail'] . '" width="16" height="16" /></td>';
                            break;
                        case "col_title":
                            $row .= '<td ' . $attributes . '><a href="' . $edit_link . '">' . $rec['title'] . '</a></td>';
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
                        case "col_author":
                            $row .= '<td ' . $attributes . '><a href="' . $link_by_author . $rec['user_id'] . '">' . $rec['username'] . '</a></td>';
                            break;
                        case "col_date":
                            $row .= '<td ' . $attributes . '>' . $rec['posted_date'] . '</td>';
                            break;
                        case "col_view":
                            $row .= '<td ' . $attributes . '>' . $rec['view_count'] . '</td>';
                            break;
                        case "col_options":
                            $row .= '<td ' . $attributes . '>';
                            $row .= '<a href="' . get_permalink($rec['slug'], 'link') . '" class="btn btn-info btn-xs" target="_blank">' . Language::$phrases['action']['view'] . '</a> ';
                            if ($this->current_user['capability']['links']['edit'] == 1)
                                $row .= '<a href="' . $edit_link . '" class="btn btn-primary btn-xs">' . Language::$phrases['action']['edit'] . '</a> ';
                            if ($this->current_user['capability']['links']['delete'] == 1)
                                $row .= '<a href="' . $delete_link . '" class="btn btn-danger btn-xs" onclick="return confirm(\'' . Language::$phrases['action']['delete.confirm'] . '\');">' . Language::$phrases['action']['delete'] . '</a> ';
                            if ($this->current_user['capability']['links']['edit'] == 1 and $rec['post_status'] == 'draft')
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

        $this->render("link/index", array(
            'title' => Language::$phrases['page']['link']['page.index'],
            'filter_user' => $userModel->getAllUser(),
            'categories' => $categoryModel->categoryOptions(FALSE),
            'table' => $table->createView(),
            'request' => $request,
        ));
    }

    function addnew() {
        // Check permission
        if ($this->current_user['capability']['links']['create'] == 0) {
            Debug::throwException(Language::$phrases['message']['error_occur'], null);
        }

        $title = Language::$phrases['page']['link']['page.addnew'];

        $request = $this->getRequest();
        $page_title = $request->get('title');
        $slug = $request->get('slug');
        $categories = $request->get('categories');
        $link = $request->get('link');
        $viewcount = $request->get('viewcount');
        $page_status = $request->get('post_status');
        $custom_favicon = $request->get('custom_favicon');

        $categoryModel = new LinkCategoryAdminModel();

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
                ->add('categories', 'choice', array(
                    'label' => Language::$phrases['context']['categories'],
                    'choices' => $categoryModel->categoryOptions(false),
                    'data' => $categories,
                    'multiple' => true,
                    'attr' => array(
                        'size' => 10
                    )
                ))
                ->add('link', 'text', array(
                    'label' => Language::$phrases['context']['link'],
                    'data' => $link,
                    'attr' => array(
                        'original_link' => ''
                    )
                ))
                ->add('viewcount', 'text', array(
                    'label' => Language::$phrases['context']['viewcount'],
                    'data' => $viewcount,
                ))
                ->add('custom_favicon', 'upload', array(
                    'label' => Language::$phrases['context']['favicon'],
                    'data' => $custom_favicon,
                    'btn' => array(
                        'onclick' => "openFileDialog('custom_favicon')"
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
                $msg .= Language::$phrases['page']['link']['title.error.empty'];
            } elseif (count($this->model->getLinkByTitle($page_title)) > 0) {
                $msg .= Language::$phrases['page']['link']['title.error.exists'];
            }
            if ($slug == "") {
                $slug = Utils::clean_entities($page_title);
            }
            $countSlug = count($this->model->getLinkBySlug($slug));
            if ($countSlug > 0) {
                $msg .= Language::$phrases['context']['slug.error.exists'];
            }
            if (empty($categories)) {
                $msg .= Language::$phrases['context']['categories.error.empty'];
            }
            if ($link == "") {
                $msg .= Language::$phrases['context']['link.error.empty'];
            } else if ($this->model->isExistsLink($link)) {
                $msg .= Language::$phrases['context']['link.error.exists'];
            }
            if ($msg != "") {
                $this->getSession()->setFlash('warning', $msg);
            } else {
                $data = array(
                    'user_id' => $this->current_user['id'],
                    'lang_code' => Language::$lang_content,
                    'categories' => serialize($categories),
                    'title' => $page_title,
                    'slug' => $slug,
                    'link' => $link,
                    'view_count' => $viewcount,
                    'post_status' => $page_status,
                );
                // Upload file
                if (!empty($link)) {
                    $url = parse_url($link);
                    $file = upload_remote("http://g.etfv.co/" . $url['scheme'] . "://" . $url['host'], "favicons");
                    $data['thumbnail'] = $file['url'];
                }
//                custom favicon
                if (!empty($custom_favicon)) {
                    $data['thumbnail'] = $custom_favicon;
                }
                // Insert link into database
                $id = $this->model->create($data);
                if ($id) {
                    foreach ($categories as $cat_ID) {
                        $this->model->createTerms(array(
                            'object_id' => $id,
                            'object_type' => 'link',
                            'taxonomy_id' => $cat_ID,
                        ));
                    }
                    $this->getSession()->setFlash('success', Language::$phrases['message']['create_success']);
                    $this->redirect(DASHBOARD_URL . '/link/' . $id . '/edit');
                }
            }
        }

        $this->render("link/new", array(
            'title' => $title,
            'form' => $form,
            'request' => $request,
        ));
    }

    function edit($id) {
        // Check permission
        if ($this->current_user['capability']['links']['edit'] == 0) {
            Debug::throwException(Language::$phrases['message']['error_occur'], null);
        }

        $links = $this->model->getLinkByID($id);
        if (count($links) <= 0) {
            $this->redirect(DASHBOARD_URL . '/link/');
        } else {
            $link = $links[0];
            $title = Language::$phrases['page']['link']['page.edit'];
            $categoryModel = new LinkCategoryAdminModel();

            $form = new Form();
            $form->add("title", "text", array(
                        'label' => Language::$phrases['context']['title'],
                        'data' => $link['title'],
                        'attr' => array(
                            'placeholder' => Language::$phrases['page']['page']['title.placeholder'],
                        )
                    ))
                    ->add('slug', 'text', array(
                        'label' => Language::$phrases['context']['slug'],
                        'data' => $link['slug'],
                    ))
                    ->add('categories', 'choice', array(
                        'label' => Language::$phrases['context']['categories'],
                        'choices' => $categoryModel->categoryOptions(false),
                        'data' => unserialize($link['categories']),
                        'multiple' => true,
                        'attr' => array(
                            'size' => 10
                        )
                    ))
                    ->add('link', 'text', array(
                        'label' => Language::$phrases['context']['link'],
                        'data' => $link['link'],
                        'attr' => array(
                            'original_link' => $link['link']
                        )
                    ))
                    ->add('viewcount', 'text', array(
                        'label' => Language::$phrases['context']['viewcount'],
                        'data' => $link['view_count'],
                    ))
                    ->add('custom_favicon', 'upload', array(
                        'label' => Language::$phrases['context']['favicon'],
                        'data' => $link['thumbnail'],
                        'btn' => array(
                            'onclick' => "openFileDialog('custom_favicon')"
                        )
                    ))
                    ->add('post_status', 'choice', array(
                        'label' => Language::$phrases['context']['status'],
                        'choices' => Utils::getPostStatus(),
                        'data' => $link['post_status'],
            ));

            $request = $this->getRequest();
            if ($request->getMethod() == 'POST') {
                $link_title = $request->get('title');
                $slug = $request->get('slug');
                $categories = $request->get('categories');
                $link_url = $request->get('link');
                $viewcount = $request->get('viewcount');
                $custom_favicon = $request->get('custom_favicon');
                $link_status = $request->get('post_status');
                $msg = "";
                if ($link_title == null or $link_title == "") {
                    $msg .= Language::$phrases['page']['link']['title.error.empty'];
                } elseif ($link_title != $link['title'] and count($this->model->getLinkByTitle($link_title)) > 0) {
                    $msg .= Language::$phrases['page']['link']['title.error.exists'];
                }
                if ($slug == "") {
                    $slug = Utils::clean_entities($link_title);
                }
                $countSlug = count($this->model->getLinkBySlug($slug));
                if ($slug != $link['slug'] and $countSlug > 0) {
                    $msg .= Language::$phrases['context']['slug.error.exists'];
                }
                if (empty($link_url)) {
                    $msg .= Language::$phrases['context']['link.error.empty'];
                }
                if ($msg != "") {
                    $this->getSession()->setFlash('warning', $msg);
                } else {
                    $data = array(
                        'categories' => serialize($categories),
                        'title' => $link_title,
                        'slug' => $slug,
                        'link' => $link_url,
                        'view_count' => $viewcount,
                        'post_status' => $link_status,
                        'updated_date' => date('Y-m-d H:i:s'),
                    );
                    // Upload file
                    if (!empty($link['link'])) {
                        $url = parse_url($link['link']);
                        $file = upload_remote("http://g.etfv.co/" . $url['scheme'] . "://" . $url['host'], "favicons");
                        $data['thumbnail'] = $file['url'];
                    }
                    // custom favicon
                    if (!empty($custom_favicon)) {
                        $data['thumbnail'] = $custom_favicon;
                    }
                    // Update database
                    $this->model->update($data, array(
                        'id' => $id,
                    ));
                    $this->model->updateTerms($id, $categories);
                    $this->getSession()->setFlash('success', Language::$phrases['message']['update_success']);
                    $this->redirect($request->getCurrentRquestUrl());
                }
            }

            $this->render("link/edit", array(
                'title' => $title,
                'form' => $form,
                'link' => $link,
            ));
        }
    }

    function publish($id) {
        // Check permission
        if ($this->current_user['capability']['links']['edit'] == 0) {
            Debug::throwException(Language::$phrases['message']['error_occur'], null);
        }

        $links = $this->model->getLinkByID($id);
        $url = DASHBOARD_URL . '/link/';
        if (count($links) <= 0) {
            $this->redirect($url);
        } else {
            $this->model->publish($id);
            $this->getSession()->setFlash('success', Language::$phrases['message']['publish_success']);
            $this->redirect($url);
        }
    }

    function delete($id) {
        // Check permission
        if ($this->current_user['capability']['links']['delete'] == 0) {
            Debug::throwException(Language::$phrases['message']['error_occur'], null);
        }

        $links = $this->model->getLinkByID($id);
        $url = DASHBOARD_URL . '/link/';
        if (count($links) <= 0) {
            $this->redirect($url);
        } else {
            $this->model->delete($id);
            $this->getSession()->setFlash('success', Language::$phrases['message']['delete_success']);
            $this->redirect($url);
        }
    }

    function approve($id) {
        // Check permission
        if ($this->current_user['capability']['links']['edit'] == 0) {
            Debug::throwException(Language::$phrases['message']['error_occur'], null);
        }

        $links = $this->model->getLinkByID($id);
        $url = DASHBOARD_URL . '/link/';
        if (count($links) <= 0) {
            $this->redirect($url);
        } else {
            $this->model->approve($id);
            $this->getSession()->setFlash('success', Language::$phrases['message']['approve_success']);
            $this->redirect($url);
        }
    }

    function check_exists_link() {
        $request = $this->getRequest();
        $response = $this->response();
        $link = $request->get('link');
        $original_link = $request->get('original_link');
        $msg = "";
        if (empty($original_link) and $this->model->isExistsLink($link)) {
            $msg .= Language::$phrases['context']['link.error.exists'];
        } elseif (!empty($original_link) and $original_link != $link and $this->model->isExistsLink($link)) {
            $msg .= Language::$phrases['context']['link.error.exists'];
        }
        $response->setContent(json_encode(array(
            'message' => $msg,
        )));
        $response->sendContent();
    }
    
    ##### CRON JOB
    function generate_latest_links() {
        $limit = Registry::$settings['config']['limit_new_links'];
        $links = $this->model->getLatestLinks($limit);
        $html = "";
        $siteurl = Registry::$siteurl;
        foreach ($links as $link) {
            $html .= <<<HTML
            <li class="clearfix">
                <p>
                    <img alt="" src="{$link['thumbnail']}" class="bg-default">
                    <img href="#inline_content_{$link['id']}" alt="" src="{$siteurl}/public/images/icons/info-1.jpg" class="bg-hover inline cboxElement">
                </p>
                <a target="_blank" title="{$link['title']}" href="{$siteurl}/link/{$link['slug']}/">{$link['title']}</a>
                <div style="display:none" class="popover-box">
                    <div class="popover-content" id="inline_content_{$link['id']}">
                        <div class="top-link clearfix">
                            <a class="add-favor" onclick="addFavoriteLink( {$link['id']} );" href="javascript:{}">Thêm trang này vào danh sách riêng của bạn</a>
                            <ul class="social-links clearfix">
                                <li>Chia sẻ</li>
                                <li class="facebook-link"><a target="_blank" href="http://www.facebook.com/sharer.php?u={$link['link']}&amp;t={$link['title']}">Facebook</a></li>
                                <li class="gplus-link"><a target="_blank" href="https://plus.google.com/share?url={$link['link']}">Google+</a></li>
                                <li class="email-link"><a target="_blank" href="mailto:?subject={$link['title']}&amp;body=Giới thiệu với bạn trang <a href='{$link['link']}'>{$link['title']}</a> Link này được giới thiệu bởi %3Ca%20href%3D%22http%3A//www.nhungtrangwebvietnam.com/%22%3Enhững trang web Việt Nam%3C/a%3E. Hãy follow chúng tôi %3Ca%20href%3D%22https://www.facebook.com/nhungtrangwebvietnam%22%3Etại đây%3C/a%3E để cập những website hay nhất và những tin tức nóng hổi.">Email</a></li>
                            </ul>
                        </div>
                        <form class="frmReport-{$link['id']}" method="post">
                            <ul class="check-list clearfix">
                                <li><label><input type="checkbox" name="le"> Báo link bị lỗi, hỏng</label></li>
                                <li><label><input type="checkbox" name="ce"> Báo up sai chuyên mục</label></li>
                                <li><label><input type="checkbox" name="sex"> Báo nội dung xấu, đồ trụy</label></li>
                                <li><label><input type="checkbox" name="wl"> Web chất lượng thấp</label></li>
                                <li><label><input type="checkbox" name="spam"> Báo spam</label></li>
                                <li><label><input type="checkbox" name="ec"> Lý do khác</label></li>
                            </ul>
                            <input type="hidden" value="{$link['id']}" name="link_id">
                            <p style="margin: 0 35px;margin-bottom: 10px" class="contact-button clearfix">
                                <input type="text" style="border: 1px solid #ccc;padding: 5px" name="captcha">
                                <img width="100" height="30" src="{$siteurl}/public/captcha.php">
                                <input type="submit" value="Gửi đi" class="sendReport-{$link['id']}" id="submit">
                            </p>
                        </form>
                        <div class="clearfix" id="contact-form">
                            <p class="textarea-block">                        
                                <label for="contact_message" class="required">Ý kiến, bình luận:</label>
                                <textarea name="message" id="contact_message" cols="50" rows="7"></textarea>
                            </p>
                        </div>
                        <input type="hidden" value="{$link['link']}" name="url">
                    </div>
                </div>
HTML;
        }
        
        write_file(TMP_PATH . "latest_links.html", $html);
    }

}
