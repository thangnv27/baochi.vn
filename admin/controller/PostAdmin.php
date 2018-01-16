<?php

class PostAdmin extends AdminController {

    private $current_user;

    function __construct() {
        parent::__construct();
        $this->current_user = UserAdmin::checkLogin();
    }

    function index() {
        if ($this->current_user['capability']['posts']['view'] == 0) {
            Debug::throwException(Language::$phrases['message']['error_occur'], null);
        }

        ## Bulk Actions
        $request = $this->getRequest();
        $action = $request->get('action');
        $url = DASHBOARD_URL . '/post/';
        switch ($action) {
            case 'move2trash':
                // Check permission
                if ($this->current_user['capability']['posts']['edit'] == 0) {
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
                if ($this->current_user['capability']['posts']['edit'] == 0) {
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
            case 'delete':
                // Check permission
                if ($this->current_user['capability']['posts']['delete'] == 0) {
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

        $categoryModel = new CategoryAdminModel();
        $sourceModel = new SourceCategoryAdminModel();
        $category_id = $request->get('category');
        $source_id = $request->get('source');

        ## List table
        $table = new Table(Language::$phrases['page']['post']['title.index']);
        $columns = array(
            'col_cbox' => '<input type="checkbox" id="checkall" />',
            'col_id' => 'ID',
            'col_thumbnail' => Language::$phrases['page']['post']['image'],
            'col_title' => Language::$phrases['context']['title'],
            'col_categories' => Language::$phrases['context']['categories'],
            'col_source' => Language::$phrases['context']['source'],
            'col_author' => Language::$phrases['page']['post']['author'],
            'col_date' => Language::$phrases['page']['post']['date'],
            'col_view' => Language::$phrases['page']['post']['view'],
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
        $countRecords = $this->model->countPosts($where, $category_id, $source_id);
        $table->add_pagenavi($pager->pageList($countRecords));

        //Get the records registered in the prepare_items method
        $records = $this->model->getPosts($start, $limit, $where, $category_id, $source_id);

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

                    $edit_link = DASHBOARD_URL . '/post/' . $rec['id'] . '/edit';
                    $delete_link = DASHBOARD_URL . '/post/' . $rec['id'] . '/delete';
                    $publish_link = DASHBOARD_URL . '/post/' . $rec['id'] . '/publish';

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
                            $row .= '<td ' . $attributes . '><a href="' . $edit_link . '">' . stripslashes($rec['title']) . '</a></td>';
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
                        case "col_source":
                            $row .= '<td ' . $attributes . '>' . $sourceModel->getSourceName($rec['source']) . '</td>';
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
                            $rss_id = (empty($rec['rss_id'])) ? 0 : $rec['rss_id'];
                            $row .= '<a href="' . get_permalink($rss_id . "-" . $rec['slug'], 'post') . '" class="btn btn-info btn-xs" target="_blank">' . Language::$phrases['action']['view'] . '</a> ';
                            if ($this->current_user['capability']['posts']['edit'] == 1)
                                $row .= '<a href="' . $edit_link . '" class="btn btn-primary btn-xs">' . Language::$phrases['action']['edit'] . '</a> ';
                            if ($this->current_user['capability']['posts']['delete'] == 1)
                                $row .= '<a href="' . $delete_link . '" class="btn btn-danger btn-xs" onclick="return confirm(\'' . Language::$phrases['action']['delete.confirm'] . '\');">' . Language::$phrases['action']['delete'] . '</a> ';
                            if ($this->current_user['capability']['posts']['edit'] == 1 and $rec['post_status'] == 'draft')
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

        $this->render("post/index", array(
            'title' => Language::$phrases['page']['post']['page.index'],
            'filter_category' => $categoryModel->categoryOptions(FALSE),
            'filter_source' => $sourceModel->categoryOptions(FALSE),
            'table' => $table->createView(),
            'request' => $request,
        ));
    }

    function addnew() {
        // Check permission
        if ($this->current_user['capability']['posts']['create'] == 0) {
            Debug::throwException(Language::$phrases['message']['error_occur'], null);
        }

        $title = Language::$phrases['page']['post']['page.addnew'];

        $request = $this->getRequest();
        $post_title = $request->get('title');
        $slug = $request->get('slug');
        $categories = $request->get('categories');
        $source = $request->get('source');
        $excerpt = $request->get('excerpt');
        $content = $request->get('content');
        $link = $request->get('link');
        $tags = $request->get('tags');
        $thumbnail = $request->get('thumbnail');
        $viewcount = $request->get('viewcount');
        $post_status = $request->get('post_status');
        $show_in_slider = $request->get('show_in_slider');

        $categoryModel = new CategoryAdminModel();
        $sourceModel = new SourceCategoryAdminModel();
        $form = new Form();
        $form->add("title", "text", array(
                    'label' => Language::$phrases['context']['title'],
                    'data' => $post_title,
                    'attr' => array(
                        'placeholder' => Language::$phrases['page']['post']['title.placeholder'],
                        'required' => true
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
                ->add('source', 'choice', array(
                    'label' => Language::$phrases['context']['source'],
                    'choices' => $sourceModel->categoryOptions(false),
                    'data' => $source,
                ))
                ->add('content', 'textarea', array(
                    'label' => Language::$phrases['page']['post']['content'],
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
                ->add('link', 'text', array(
                    'label' => Language::$phrases['context']['link'],
                    'data' => $link,
                ))
                ->add('tags', 'text', array(
                    'label' => Language::$phrases['page']['post']['tags'],
                    'data' => $tags,
                ))
                ->add('thumbnail', 'upload', array(
                    'label' => Language::$phrases['page']['post']['thumbnail'],
                    'data' => $thumbnail,
                    'btn' => array(
                        'onclick' => "openFileDialog('thumbnail')"
                    )
                ))
                ->add('viewcount', 'text', array(
                    'label' => Language::$phrases['context']['viewcount'],
                    'data' => $viewcount,
                ))
                ->add('post_status', 'choice', array(
                    'label' => Language::$phrases['context']['status'],
                    'choices' => Utils::getPostStatus(),
                    'data' => $post_status,
                ))
                ->add('show_in_slider', 'choice', array(
                    'label' => 'Tin slider',
                    'choices' => Utils::getPostShowInSlider(),
                    'data' => $show_in_slider,
        ));

        if ($request->getMethod() == 'POST') {
            $msg = "";
            if ($post_title == null or $post_title == "") {
                $msg .= Language::$phrases['page']['post']['title.error.empty'];
            } elseif (count($this->model->getPostByTitle($post_title)) > 0) {
                $msg .= Language::$phrases['page']['post']['title.error.exists'];
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
                $msg .= Language::$phrases['page']['post']['content.error.empty'];
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
                    'title_md5' => md5($post_title),
                    'slug' => $slug,
                    'categories' => serialize($categories),
                    'source' => $source,
                    'content' => $content,
                    'excerpt' => $excerpt,
                    'link' => $link,
                    'thumbnail' => $thumbnail,
                    'view_count' => $viewcount,
                    'tags' => $tags,
                    'seo' => serialize(array(
                        'seo_title' => $request->get('seo_title'),
                        'seo_keyword' => $request->get('seo_keyword'),
                        'seo_description' => $request->get('seo_description'),
                    )),
                    'post_status' => $post_status,
                    'show_in_slider' => $post_status,
                ));
                if ($id) {
                    foreach ($categories as $cat_ID) {
                        $this->model->createTerms(array(
                            'object_id' => $id,
                            'object_type' => 'post',
                            'taxonomy_id' => $cat_ID,
                        ));
                    }
                    $this->model->createTerms(array(
                        'object_id' => $id,
                        'object_type' => 'source',
                        'taxonomy_id' => $source,
                    ));
                    $this->getSession()->setFlash('success', Language::$phrases['message']['create_success']);

                    $url = DASHBOARD_URL . '/post/' . $id . '/edit';
                    $this->redirect($url);
                }
            }
        }

        $this->render("post/new", array(
            'title' => $title,
            'form' => $form,
            'request' => $request,
            'tags' => $this->model->getAllTags(),
        ));
    }

    function edit($id) {
        // Check permission
        if ($this->current_user['capability']['posts']['edit'] == 0) {
            Debug::throwException(Language::$phrases['message']['error_occur'], null);
        }

        $posts = $this->model->getPostByID($id);
        if (count($posts) <= 0) {
            $this->redirect(DASHBOARD_URL . '/post/');
        } else {
            $post = $posts[0];
            $post['images'] = unserialize($post['images']);
            $title = Language::$phrases['page']['post']['page.edit'];
            $categoryModel = new CategoryAdminModel();
            $sourceModel = new SourceCategoryAdminModel();

            $form = new Form();
            $form->add("title", "text", array(
                        'label' => Language::$phrases['context']['title'],
                        'data' => $post['title'],
                        'attr' => array(
                            'placeholder' => Language::$phrases['page']['post']['title.placeholder'],
                            'required' => true
                        )
                    ))
                    ->add('slug', 'text', array(
                        'label' => Language::$phrases['context']['slug'],
                        'data' => $post['slug'],
                    ))
                    ->add('categories', 'choice', array(
                        'label' => Language::$phrases['context']['categories'],
                        'choices' => $categoryModel->categoryOptions(false),
                        'data' => unserialize($post['categories']),
                        'multiple' => true,
                    ))
                    ->add('source', 'choice', array(
                        'label' => Language::$phrases['context']['source'],
                        'choices' => $sourceModel->categoryOptions(false),
                        'data' => $post['sources'],
                    ))
                    ->add('content', 'textarea', array(
                        'label' => Language::$phrases['page']['post']['content'],
                        'data' => stripslashes($post['content']),
                        'attr' => array(
                            'class' => 'editor'
                        )
                    ))
                    ->add('excerpt', 'textarea', array(
                        'label' => Language::$phrases['page']['post']['excerpt'],
                        'data' => $post['excerpt'],
                        'attr' => array(
                            'rows' => 5
                        )
                    ))
                    ->add('link', 'text', array(
                        'label' => Language::$phrases['context']['link'],
                        'data' => $post['link'],
                    ))
                    ->add('tags', 'text', array(
                        'label' => Language::$phrases['page']['post']['tags'],
                        'data' => $post['tags'],
                    ))
                    ->add('thumbnail', 'upload', array(
                        'label' => Language::$phrases['page']['post']['thumbnail'],
                        'data' => $post['thumbnail'],
                        'btn' => array(
                            'onclick' => "openFileDialog('thumbnail')"
                        )
                    ))
                    ->add('viewcount', 'text', array(
                        'label' => Language::$phrases['context']['viewcount'],
                        'data' => $post['view_count'],
                    ))
                    ->add('post_status', 'choice', array(
                        'label' => Language::$phrases['context']['status'],
                        'choices' => Utils::getPostStatus(),
                        'data' => $post['post_status'],
                    ))
                    ->add('show_in_slider', 'choice', array(
                        'label' => 'Tin slider',
                        'choices' => Utils::getPostShowInSlider(),
                        'data' => $post['show_in_slider'],
            ));

            $request = $this->getRequest();
            if ($request->getMethod() == 'POST') {
                $post_title = $request->get('title');
                $slug = $request->get('slug');
                $categories = $request->get('categories');
                $source = $request->get('source');
                $excerpt = $request->get('excerpt');
                $link = $request->get('link');
                $content = $request->get('content');
                $tags = $request->get('tags');
                $thumbnail = $request->get('thumbnail');
                $viewcount = $request->get('viewcount');
                $post_status = $request->get('post_status');
                $show_in_slider = $request->get('show_in_slider');
                $msg = "";
                if ($post_title == null or $post_title == "") {
                    $msg .= Language::$phrases['page']['post']['title.error.empty'];
                } elseif ($post_title != $post['title'] and count($this->model->getPostByTitle($post_title)) > 0) {
                    $msg .= Language::$phrases['page']['post']['title.error.exists'];
                }
                if ($slug == "") {
                    $slug = Utils::clean_entities($post_title);
                }
                $countSlug = count($this->model->getPostBySlug($slug));
                if ($slug != $post['slug'] and $countSlug > 0) {
                    $msg .= Language::$phrases['context']['slug.error.exists'];
                }
                if (empty($categories)) {
                    $msg .= Language::$phrases['context']['categories.error.empty'];
                }
//                if ($content == "") {
//                    $msg .= Language::$phrases['page']['post']['content.error.empty'];
//                }
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
                        'title_md5' => md5($post_title),
                        'slug' => $slug,
                        'categories' => serialize($categories),
                        'source' => $source,
                        'content' => $content,
                        'excerpt' => $excerpt,
                        'link' => $link,
                        'thumbnail' => $thumbnail,
                        'view_count' => $viewcount,
                        'tags' => $tags,
                        'seo' => serialize(array(
                            'seo_title' => $request->get('seo_title'),
                            'seo_keyword' => $request->get('seo_keyword'),
                            'seo_description' => $request->get('seo_description'),
                        )),
                        'post_status' => $post_status,
                        'show_in_slider' => $show_in_slider,
                        'updated_date' => date('Y-m-d H:i:s'),
                            ), array(
                        'id' => $id,
                    ));
                    $this->model->updateTerms($id, $categories);
                    $this->model->updateSources($id, $source);
                    $this->getSession()->setFlash('success', Language::$phrases['message']['update_success']);
                    $this->redirect($request->getCurrentRquestUrl());
                }
            }

            $this->render("post/edit", array(
                'title' => $title,
                'form' => $form,
                'post' => $post,
                'tags' => $this->model->getAllTags(),
            ));
        }
    }

    function publish($id) {
        // Check permission
        if ($this->current_user['capability']['posts']['edit'] == 0) {
            Debug::throwException(Language::$phrases['message']['error_occur'], null);
        }

        $posts = $this->model->getPostByID($id);
        $url = DASHBOARD_URL . '/post/';
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
        if ($this->current_user['capability']['posts']['delete'] == 0) {
            Debug::throwException(Language::$phrases['message']['error_occur'], null);
        }

        $posts = $this->model->getPostByID($id);
        $url = DASHBOARD_URL . '/post/';
        if (count($posts) <= 0) {
            $this->redirect($url);
        } else {
            $this->model->delete($id);
            $this->getSession()->setFlash('success', Language::$phrases['message']['delete_success']);
            $this->redirect($url);
        }
    }

    function get_from_rss() {
        $req = $this->getRequest()->get('req');
        $req = intval($req);

        $where = "";
        $limit = 20;
        $rssModel = new RssAdminModel();
        $rssLive = array();

        $filename = TMP_PATH . "count_rss{$req}.log";
        if (!file_exists($filename)) {
            write_file($filename, 0);
        }
        $count_rss = intval(trim(file_get_contents($filename)));
        $totalRss = $rssModel->countRss($where);
        if ($count_rss > $totalRss) {
            $count_rss = 0;
        }
        $rssLive = $rssModel->getRss($count_rss, $limit, $where);
        write_file($filename, $count_rss + $limit);

        foreach ($rssLive as $rss) {
            $rss_id = $rss['id'];
            if ($rss_id % 4 == $req) {
                $rss_url = $rss['url'];
                $feed = new SimplePie();
                $feed->set_feed_url($rss_url);
                $feed->init();
                $items = $feed->get_items();

                $latestPost = $this->model->getLatestPostRss($rss_id);
                $new = array();
                if ($latestPost) {
                    foreach ($items as $item) {
                        if (convertCharset($item->get_title(), 2) == $latestPost['title']) {
                            break;
                        }
                        $new[] = $item;
                    }
                } else {
                    $new = $items;
                }
                foreach ($new as $item) {
                    $add = TRUE;
                    $title = convertCharset($item->get_title(), 2);
                    $md5_title = md5($title);
                    $slug = Utils::clean_entities($title);
                    $categories = unserialize($rss['categories']);
                    $source = $rss['source'];
                    $countSlug = count($this->model->getPostBySlug($slug));
                    if (count($this->model->getPostByMD5Title($md5_title)) > 0 or $countSlug > 0 or empty($categories) or empty($source)) {
                        $add = FALSE;
                    }
                    if ($add) {
                        $thumbnail = "";
                        $content = $item->get_content();
                        $doc = new DOMDocument();
                        $doc->loadHTML($content);
                        $img = $doc->getElementsByTagName('img')->item(0);
                        if ($img) {
                            $thumbnail = $img->getAttribute('src');
                        }
                        $data = array(
                            'user_id' => 1,
                            'lang_code' => Language::$lang_content,
                            'title' => $title,
                            'title_md5' => $md5_title,
                            'slug' => $slug,
                            'categories' => serialize($categories),
                            'source' => $source,
                            //'excerpt' => $item->get_description(),
                            'thumbnail' => $thumbnail,
                            'link' => $item->get_link(),
                            'rss_id' => $rss_id,
                            'seo' => serialize(array(
                                'seo_title' => $title,
                                'seo_keyword' => '',
                                'seo_description' => Utils::get_short_content(strip_tags($content), 160),
                            )),
                            'post_status' => 'published',
                        );
                        if (strpos($rss_url, "tamdiem.today") !== FALSE) {
                            $data['view_count'] = rand(1000, 1100);
                        }
                        $id = $this->model->create($data);
                        if ($id) {
                            foreach ($categories as $cat_ID) {
                                $this->model->createTerms(array(
                                    'object_id' => $id,
                                    'object_type' => 'post',
                                    'taxonomy_id' => $cat_ID,
                                ));
                            }
                            $this->model->createTerms(array(
                                'object_id' => $id,
                                'object_type' => 'source',
                                'taxonomy_id' => $source,
                            ));
                        }
                    }
                }
            } // end rss_id % 4
        } // end foreach
    }

    function delete_old_posts() {
        $this->model->deleteOldPosts(15);
    }

    function mobile_generate_posts_by_category() {
        $dirname = TMP_PATH . 'mobile_cat';
        if (!file_exists($dirname)) {
            mkdir($dirname);
        }

        // Chia nho so danh muc ra
        $filename = TMP_PATH . 'count_cat.log';
        if (!file_exists($filename)) {
            write_file($filename, 0);
        }
        $count_cat = intval(trim(file_get_contents($filename)));
        $categoryModel = new CategoryAdminModel();
        $limit_cat = 10;
        if ($count_cat > $categoryModel->countCategories()) {
            $count_cat = 0;
        }
        $categories = $categoryModel->getCategories($count_cat, $limit_cat);
        write_file($filename, $count_cat + $limit_cat);

        $req = $this->getRequest()->get('req');
        $req = intval($req);

        foreach ($categories as $category) {
            if ($category['id'] % 4 == $req) {
                $posts = $this->model->getPostsByCategory(450, $category['id']);
                $limit = Registry::$settings['config']['limit_posts_mobile'];
                $totalPosts = count($posts);
                $totalPages = ceil($totalPosts / $limit);
                $start = 0;

                for ($i = 1; $i <= $totalPages; $i++) {
                    $html = "";
                    $counter = 1;
                    for ($j = $start; ($j < $limit * $i and $j < $totalPosts); $j++) {
                        $post = $posts[$j];
                        $rss_id = (empty($post['rss_id'])) ? 0 : $post['rss_id'];
                        $permalink = get_permalink($rss_id . "-" . $post['slug'], 'post');
                        $siteurl = Registry::$siteurl;

                        $posted_date = date('d/m/Y', strtotime($post['posted_date']));
                        $thumbnail = Registry::$siteurl . "/public/images/no_image_93x69.jpg";
                        if (!empty($post['thumbnail'])) {
                            $thumbnail = $post['thumbnail'];
                        }
                        $post_title = stripslashes($post['title']);
                        $html .= <<<HTML
                <div class="news-item">
                <div class="blog-featured-image blog-image-left">
                    <div class="jack-mobile-img">
                        <a href="{$permalink}" title="{$post_title}">
                            <img src="{$thumbnail}" alt="{$post_title}">
                        </a>
                    </div>
                </div>
                <a href="{$permalink}" title="{$post_title}">
                    <h3 class="blog-article-title">{$post_title}</h3>
                </a>
                <p>
                    <span class="cat-name">{$category['name']}</span> - <span class="post-date">{$posted_date}</span>
                </p>
                <div class="clear"></div>
            </div>
            <div style="border-top:1px solid #0b6097;height:0px"></div>
HTML;
                        if ($counter === 6) {
                            $html .= <<<HTML
            <div class="advertisement-468-60">
                <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
                <!-- ndt mobile mid -->
                <ins class="adsbygoogle"
                     style="display:block"
                     data-ad-client="ca-pub-8791311737735591"
                     data-ad-slot="7310042079"
                     data-ad-format="auto"></ins>
                <script>
                (adsbygoogle = window.adsbygoogle || []).push({});
                </script>
            </div>
            <div style="border-top:1px solid #0b6097;height:0px;margin-top: 0px"></div>
HTML;
                        }
                        $counter++;
                    }
                    $start = $limit * $i;

//                    $prev = ($i == 1) ? 1 : ($i - 1);
                    $next = ($i == $totalPages) ? 1 : ($i + 1);
//                    $prev_page = Registry::$siteurl . "/tmp/news/" . "newnews_p" . $prev . ".html";
//                    $nex_page = Registry::$siteurl . "/tmp/news/" . "newnews_p" . $next . ".html";
                    $html .= <<<HTML
                        <div class="advertisement-468-60 mb0">
                            <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
                            <!-- ndt mobile Bot theo nguon&chude -->
                            <ins class="adsbygoogle"
                                 style="display:inline-block;width:320px;height:50px"
                                 data-ad-client="ca-pub-8791311737735591"
                                 data-ad-slot="8557299270"></ins>
                            <script>
                            (adsbygoogle = window.adsbygoogle || []).push({});
                            </script>
                        </div>    
                        <div style="text-align: center;">
                            <span onclick="next({$next})" class="btnnav">Xem tiếp</span>
                        </div>
HTML;
                    // Write posts
                    write_file($dirname . DS . $category['id'] . "_p$i.html", $html);
                }
            }
        }
    }

}
