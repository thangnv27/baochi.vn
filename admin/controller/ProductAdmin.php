<?php

class ProductAdmin extends AdminController {

    private $current_user;

    function __construct() {
        parent::__construct();
        $this->current_user = UserAdmin::checkLogin();
    }

    function index() {
        if ($this->current_user['capability']['products']['view'] == 0) {
            Debug::throwException(Language::$phrases['message']['error_occur'], null);
        }

        ## Bulk Actions
        $request = $this->getRequest();
        $action = $request->get('action');
        $url = DASHBOARD_URL . '/product/';
        switch ($action) {
            case 'move2trash':
                // Check permission
                if ($this->current_user['capability']['products']['edit'] == 0) {
                    Debug::throwException(Language::$phrases['message']['error_occur'], null);
                }

                $checked = $request->get('item');
                if (count($checked) > 0) {
                    $post_ID = implode(", ", $checked);
                    $this->model->move2trashBulk("id IN ($post_ID)");
                    $this->getSession()->setFlash('success', Language::$phrases['message']['move2trash_success']);
                }
                $this->redirect($url);
                break;
            case 'publish':
                // Check permission
                if ($this->current_user['capability']['products']['edit'] == 0) {
                    Debug::throwException(Language::$phrases['message']['error_occur'], null);
                }

                $checked = $request->get('item');
                if (count($checked) > 0) {
                    $post_ID = implode(", ", $checked);
                    $this->model->publishBulk("id IN ($post_ID)");
                    $this->getSession()->setFlash('success', Language::$phrases['message']['publish_success']);
                }
                $this->redirect($url);
                break;
            default:
                break;
        }

        $categoryModel = new ProductCategoryAdminModel();

        ## List table
        $table = new Table(Language::$phrases['page']['product']['title.index']);
        $columns = array(
            'col_cbox' => '<input type="checkbox" id="checkall" />',
            'col_id' => 'ID',
            'col_thumbnail' => Language::$phrases['page']['product']['image'],
            'col_title' => Language::$phrases['context']['title'],
            'col_categories' => Language::$phrases['context']['categories'],
            'col_author' => Language::$phrases['page']['product']['author'],
            'col_date' => Language::$phrases['page']['product']['date'],
            'col_view' => Language::$phrases['page']['product']['view'],
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
                        . "slug LIKE '%$search_query%' OR excerpt LIKE '%$search_query%' OR "
                        . "content LIKE '%$search_query%' OR tags LIKE '%$search_query%' OR "
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
        $countRecords = $this->model->countPosts($where);
        $table->add_pagenavi($pager->pageList($countRecords));

        //Get the records registered in the prepare_items method
        $records = $this->model->getPosts($start, $limit, $where, $request->get('category'));

        //Loop for each record
        if (is_array($records) and !empty($records)) {
            $categories = $categoryModel->allCategories();

            foreach ($records as $rec) {

                //Open the line
                $row .= '<tr id="row_' . $rec->ID . '">';
                foreach ($columns as $field => $title) {
                    $class = "class='$field column-$field' ";
                    $style = "";
                    $attributes = $class . $style;

                    $edit_link = DASHBOARD_URL . '/product/' . $rec['id'] . '/edit';
                    $delete_link = DASHBOARD_URL . '/product/' . $rec['id'] . '/delete';
                    $publish_link = DASHBOARD_URL . '/product/' . $rec['id'] . '/publish';

                    //Display the cell
                    switch ($field) {
                        case "col_cbox":
                            $row .= '<td ' . $attributes . '><input type="checkbox" name="item[]" value="' . $rec['id'] . '" /></td>';
                            break;
                        case "col_id":
                            $row .= '<td ' . $attributes . '>' . $rec['id'] . '</td>';
                            break;
                        case "col_thumbnail":
                            $row .= '<td ' . $attributes . '>';
                            if ($rec['thumbnail'] != "") {
                                $row .= '<img src="' . $rec['thumbnail'] . '" width="32" height="32" />';
                            }
                            $row .= '</td>';
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
                            $row .= '<td ' . $attributes . '>' . $rec['username'] . '</td>';
                            break;
                        case "col_date":
                            $row .= '<td ' . $attributes . '>' . $rec['posted_date'] . '</td>';
                            break;
                        case "col_view":
                            $row .= '<td ' . $attributes . '>' . $rec['view_count'] . '</td>';
                            break;
                        case "col_options":
                            $row .= '<td ' . $attributes . '>';
                            $row .= '<a href="' . get_permalink($rec['slug'], 'product') . '" class="btn btn-info btn-xs" target="_blank">' . Language::$phrases['action']['view'] . '</a> ';
                            if ($this->current_user['capability']['products']['edit'] == 1)
                                $row .= '<a href="' . $edit_link . '" class="btn btn-primary btn-xs">' . Language::$phrases['action']['edit'] . '</a> ';
                            if ($this->current_user['capability']['products']['delete'] == 1)
                                $row .= '<a href="' . $delete_link . '" class="btn btn-danger btn-xs" onclick="return confirm(\'' . Language::$phrases['action']['delete.confirm'] . '\');">' . Language::$phrases['action']['delete'] . '</a> ';
                            if ($this->current_user['capability']['products']['edit'] == 1 and $rec['post_status'] == 'draft')
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

        $this->render("product/index", array(
            'title' => Language::$phrases['page']['product']['page.index'],
            'filter_category' => $categoryModel->categoryOptions(FALSE),
            'table' => $table->createView(),
            'request' => $request,
        ));
    }

    function addnew() {
        // Check permission
        if ($this->current_user['capability']['products']['create'] == 0) {
            Debug::throwException(Language::$phrases['message']['error_occur'], null);
        }

        $title = Language::$phrases['page']['product']['page.addnew'];

        $request = $this->getRequest();
        $post_title = $request->get('title');
        $slug = $request->get('slug');
        $categories = $request->get('categories');
        $excerpt = $request->get('excerpt');
        $content = $request->get('content');
        $tags = $request->get('tags');
        $thumbnail = $request->get('thumbnail');
        $post_status = $request->get('post_status');
        $images = $request->get('images');
        if ($images == NULL or !is_array($images)) {
            $images = array();
        }
        $price = $request->get('price');
        $product_status = $request->get('product_status');

        $categoryModel = new ProductCategoryAdminModel();

        $form = new Form();
        $form->add("title", "text", array(
                    'label' => Language::$phrases['context']['title'],
                    'data' => $post_title,
                    'attr' => array(
                        'placeholder' => Language::$phrases['page']['product']['title.placeholder'],
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
                ))
                ->add('content', 'textarea', array(
                    'label' => Language::$phrases['page']['product']['content'],
                    'data' => $content,
                    'attr' => array(
                        'class' => 'editor'
                    )
                ))
                ->add('excerpt', 'textarea', array(
                    'label' => Language::$phrases['page']['product']['excerpt'],
                    'data' => $excerpt,
                    'attr' => array(
                        'rows' => 5
                    )
                ))
                ->add('tags', 'text', array(
                    'label' => Language::$phrases['page']['product']['tags'],
                    'data' => $tags,
                ))
                ->add('thumbnail', 'upload', array(
                    'label' => Language::$phrases['page']['product']['thumbnail'],
                    'data' => $thumbnail,
                    'btn' => array(
                        'onclick' => "openFileDialog('thumbnail')"
                    )
                ))
                ->add('post_status', 'choice', array(
                    'label' => Language::$phrases['context']['status'],
                    'choices' => Utils::getPostStatus(),
                    'data' => $post_status,
                ))
                ->add('price', 'text', array(
                    'label' => Language::$phrases['page']['product']['price'],
                    'data' => $price,
                ))
                ->add('product_status', 'choice', array(
                    'label' => Language::$phrases['page']['product']['product_status'],
                    'choices' => Utils::getProductStatus(),
                    'data' => $product_status,
        ));

        if ($request->getMethod() == 'POST') {
            $msg = "";
            if ($post_title == null or $post_title == "") {
                $msg .= Language::$phrases['page']['product']['title.error.empty'];
            } elseif (count($this->model->getPostByTitle($post_title)) > 0) {
                $msg .= Language::$phrases['page']['product']['title.error.exists'];
            }
            if ($slug == "") {
                $slug = Utils::clean_entities($post_title);
            }
            $countSlug = count($this->model->getPostBySlug($slug));
            if ($countSlug > 0) {
                $msg .= Language::$phrases['context']['slug.error.exists'];
            }
            if (empty($categories)) {
                $msg .= Language::$phrases['context']['categories.error.empty'];
            }
            if ($content == "") {
                $msg .= Language::$phrases['page']['product']['content.error.empty'];
            }
            if ($msg != "") {
                $this->getSession()->setFlash('warning', $msg);
            } else {
                if (trim($tags) != "") {
                    $tags = explode(",", $tags);
                    $tmp = array();
                    foreach ($tags as $tag) {
                        $tmp[] = trim($tag);
                    }
                    $tags = implode(",", $tmp);
                }
                $id = $this->model->create(array(
                    'user_id' => $this->current_user['id'],
                    'lang_code' => Language::$lang_content,
                    'title' => $post_title,
                    'slug' => $slug,
                    'categories' => serialize($categories),
                    'content' => $content,
                    'excerpt' => $excerpt,
                    'thumbnail' => $thumbnail,
                    'tags' => $tags,
                    'images' => serialize($images),
                    'seo' => serialize(array(
                        'seo_title' => $request->get('seo_title'),
                        'seo_keyword' => $request->get('seo_keyword'),
                        'seo_description' => $request->get('seo_description'),
                    )),
                    'price' => $price,
                    'post_status' => $post_status,
                        ), array(
                    'product_status' => $product_status,
                        ), $categories);
                if ($id) {
                    $this->getSession()->setFlash('success', Language::$phrases['message']['create_success']);

                    $url = DASHBOARD_URL . '/product/' . $id . '/edit';
                    $this->redirect($url);
                }
            }
        }

        $this->render("product/new", array(
            'title' => $title,
            'form' => $form,
            'request' => $request,
            'tags' => $this->model->getAllTags(),
        ));
    }

    function edit($id) {
        // Check permission
        if ($this->current_user['capability']['products']['edit'] == 0) {
            Debug::throwException(Language::$phrases['message']['error_occur'], null);
        }

        $products = $this->model->getProductByID($id);
        if (count($products) <= 0) {
            $this->redirect(DASHBOARD_URL . '/product/');
        } else {
            $product = $products[0];
            $product['images'] = unserialize($product['images']);
            $title = Language::$phrases['page']['product']['page.edit'];
            $categoryModel = new ProductCategoryAdminModel();

            $form = new Form();
            $form->add("title", "text", array(
                        'label' => Language::$phrases['context']['title'],
                        'data' => $product['title'],
                        'attr' => array(
                            'placeholder' => Language::$phrases['page']['product']['title.placeholder'],
                            'required' => true
                        )
                    ))
                    ->add('slug', 'text', array(
                        'label' => Language::$phrases['context']['slug'],
                        'data' => $product['slug'],
                    ))
                    ->add('categories', 'choice', array(
                        'label' => Language::$phrases['context']['categories'],
                        'choices' => $categoryModel->categoryOptions(false),
                        'data' => unserialize($product['categories']),
                        'multiple' => true,
                    ))
                    ->add('content', 'textarea', array(
                        'label' => Language::$phrases['page']['product']['content'],
                        'data' => stripslashes($product['content']),
                        'attr' => array(
                            'class' => 'editor'
                        )
                    ))
                    ->add('excerpt', 'textarea', array(
                        'label' => Language::$phrases['page']['product']['excerpt'],
                        'data' => $product['excerpt'],
                        'attr' => array(
                            'rows' => 5
                        )
                    ))
                    ->add('tags', 'text', array(
                        'label' => Language::$phrases['page']['product']['tags'],
                        'data' => $product['tags'],
                    ))
                    ->add('thumbnail', 'upload', array(
                        'label' => Language::$phrases['page']['product']['thumbnail'],
                        'data' => $product['thumbnail'],
                        'btn' => array(
                            'onclick' => "openFileDialog('thumbnail')"
                        )
                    ))
                    ->add('post_status', 'choice', array(
                        'label' => Language::$phrases['context']['status'],
                        'choices' => Utils::getPostStatus(),
                        'data' => $product['post_status'],
                    ))
                    ->add('price', 'text', array(
                        'label' => Language::$phrases['page']['product']['price'],
                        'data' => $product['price'],
                    ))
                    ->add('product_status', 'choice', array(
                        'label' => Language::$phrases['page']['product']['product_status'],
                        'choices' => Utils::getProductStatus(),
                        'data' => $product['meta']['product_status'],
            ));

            $request = $this->getRequest();
            if ($request->getMethod() == 'POST') {
                $post_title = $request->get('title');
                $slug = $request->get('slug');
                $categories = $request->get('categories');
                $excerpt = $request->get('excerpt');
                $content = $request->get('content');
                $tags = $request->get('tags');
                $thumbnail = $request->get('thumbnail');
                $post_status = $request->get('post_status');
                $images = $request->get('images');
                if ($images == NULL or !is_array($images)) {
                    $images = array();
                }
                $price = $request->get('price');
                $product_status = $request->get('product_status');
                $msg = "";
                if ($post_title == null or $post_title == "") {
                    $msg .= Language::$phrases['page']['product']['title.error.empty'];
                } elseif ($post_title != $product['title'] and count($this->model->getPostByTitle($post_title)) > 0) {
                    $msg .= Language::$phrases['page']['product']['title.error.exists'];
                }
                if ($slug == "") {
                    $slug = Utils::clean_entities($post_title);
                }
                $countSlug = count($this->model->getPostBySlug($slug));
                if ($slug != $product['slug'] and $countSlug > 0) {
                    $msg .= Language::$phrases['context']['slug.error.exists'];
                }
                if (empty($categories)) {
                    $msg .= Language::$phrases['context']['categories.error.empty'];
                }
                if ($content == "") {
                    $msg .= Language::$phrases['page']['product']['content.error.empty'];
                }
                if ($msg != "") {
                    $this->getSession()->setFlash('warning', $msg);
                } else {
                    if (trim($tags) != "") {
                        $tags = explode(",", $tags);
                        $tmp = array();
                        foreach ($tags as $tag) {
                            $tmp[] = trim($tag);
                        }
                        $tags = implode(",", $tmp);
                    }
                    $this->model->update(array(
                        'title' => $post_title,
                        'slug' => $slug,
                        'categories' => serialize($categories),
                        'content' => $content,
                        'excerpt' => $excerpt,
                        'thumbnail' => $thumbnail,
                        'tags' => $tags,
                        'images' => serialize($images),
                        'seo' => serialize(array(
                            'seo_title' => $request->get('seo_title'),
                            'seo_keyword' => $request->get('seo_keyword'),
                            'seo_description' => $request->get('seo_description'),
                        )),
                        'price' => $price,
                        'post_status' => $post_status,
                        'updated_date' => date('Y-m-d H:i:s'),
                            ), array(
                        'product_status' => $product_status,
                            ), $id);
                    $this->model->updateTerms($id, $categories);
                    $this->getSession()->setFlash('success', Language::$phrases['message']['update_success']);
                    $this->redirect($request->getCurrentRquestUrl());
                }
            }

            $this->render("product/edit", array(
                'title' => $title,
                'form' => $form,
                'product' => $product,
                'tags' => $this->model->getAllTags(),
            ));
        }
    }

    function publish($id) {
        // Check permission
        if ($this->current_user['capability']['products']['edit'] == 0) {
            Debug::throwException(Language::$phrases['message']['error_occur'], null);
        }

        $posts = $this->model->getProductByID($id);
        $url = DASHBOARD_URL . '/product/';
        if (count($posts) <= 0) {
            $this->redirect($url);
        } else {
            $this->model->publish($id);
            $this->getSession()->setFlash('success', Language::$phrases['message']['publish_success']);
            $this->redirect($url);
        }
    }

    function delete($id) {
        // Check permission
        if ($this->current_user['capability']['products']['delete'] == 0) {
            Debug::throwException(Language::$phrases['message']['error_occur'], null);
        }

        $posts = $this->model->getProductByID($id);
        $url = DASHBOARD_URL . '/product/';
        if (count($posts) <= 0) {
            $this->redirect($url);
        } else {
            $this->model->delete($id);
            $this->getSession()->setFlash('success', Language::$phrases['message']['delete_success']);
            $this->redirect($url);
        }
    }

}
