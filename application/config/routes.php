<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'home';
$route['404_override'] = 'home/error_404';
$route['translate_uri_dashes'] = FALSE;

$route['error-404'] = 'home/error_404';

$route['post/(:any)/(:num)'] = 'home/post/$1/$2';

$route['gallery'] = 'home/gallery';
$route['gallery-get-images-post'] = 'home/gallery_get_images_post';
$route['contact'] = 'home/contact';
$route['contact-post'] = 'home/contact_post';

$route['category/(:any)/(:num)'] = 'home/category/$1/$2';
$route['tag/(:any)'] = 'home/tag/$1';
$route['reading-list'] = 'home/reading_list';
$route['add-delete-reading-list-post'] = 'home/add_delete_from_reading_list_post';
$route['search'] = 'home/search';
$route['add-comment-post'] = 'home/add_comment_post';
$route['delete-comment-post'] = 'home/delete_comment_post';
$route['add-to-newsletter'] = 'home/add_to_newsletter';


//auth routes
$route['login'] = 'auth/login';
$route['login-post'] = 'auth/login_post';
$route['register'] = 'auth/register';
$route['register-post'] = 'auth/register_post';
$route['update-profile'] = 'auth/update_profile';
$route['update-profile-post'] = 'auth/update_profile_post';
$route['change-password'] = 'auth/change_password';
$route['change-password-post'] = 'auth/change_password_post';
$route['reset-password'] = 'auth/reset_password';
$route['reset-password-post'] = 'auth/reset_password_post';
$route['logout'] = 'auth/logout';
$route['admin/users'] = 'auth/users';
$route['admin/delete-user-post'] = 'auth/delete_user_post';
$route['admin/change-user-role-post'] = 'auth/change_user_role_post';


//admin routes
$route['admin'] = 'admin/index';
$route['admin/add-page'] = 'admin/add_page';
$route['admin/add-page-post'] = 'admin/add_page_post';
$route['admin/update-page/(:num)'] = 'admin/update_page/$1';
$route['admin/update-page-post'] = 'admin/update_page_post';
$route['admin/delete-page-post'] = 'admin/delete_page_post';

//post
$route['admin/add-post'] = 'post/add_post';
$route['admin/add-post-post'] = 'post/add_post_post';
$route['admin/posts'] = 'post/posts';
$route['admin/post-options-post'] = 'post/post_options_post';
$route['admin/post-slider-order-post'] = 'post/post_slider_order_post';
$route['admin/update-post/(:num)'] = 'post/update_post/$1';
$route['admin/update-post-post'] = 'post/update_post_post';
$route['admin/delete-post-image-post'] = 'post/delete_post_image_post';
$route['admin/ckimage-upload-post'] = 'post/upload_ckimage_post';


//category
$route['admin/categories'] = 'category/categories';
$route['admin/add-category-post'] = 'category/add_category_post';
$route['admin/update-category/(:num)'] = 'category/update_category/$1';
$route['admin/update-category-post'] = 'category/update_category_post';
$route['admin/delete-category-post'] = 'category/delete_category_post';
$route['admin/get-subcategories'] = 'category/get_subcategories';


//gallery category
$route['admin/gallery-categories'] = 'category/gallery_categories';
$route['admin/add-gallery-category-post'] = 'category/add_gallery_category_post';
$route['admin/update-gallery-category/(:num)'] = 'category/update_gallery_category/$1';
$route['admin/update-gallery-category-post'] = 'category/update_gallery_category_post';
$route['admin/delete-gallery-category-post'] = 'category/delete_gallery_category_post';

//photo gallery
$route['admin/photo-gallery'] = 'gallery/photo_gallery';
$route['admin/add-image-post'] = 'gallery/add_image_post';
$route['admin/delete-image-post'] = 'gallery/delete_image_post';


//comments
$route['admin/comments'] = 'admin/comments';
$route['admin/delete-comment-post'] = 'admin/delete_comment_post';

//contact messages
$route['admin/contact-messages'] = 'admin/contact_messages';
$route['admin/delete-contact-message-post'] = 'admin/delete_contact_message_post';

//ads
$route['admin/ads'] = 'admin/ads';
$route['admin/ads-post'] = 'admin/ads_post';

//newsletter
$route['admin/newsletter'] = 'admin/newsletter';
$route['admin/delete-newsletter-post'] = 'admin/delete_newsletter_post';
$route['admin/newsletter-send-email-post'] = 'admin/newsletter_send_email_post';

//font options
$route['admin/font-options'] = 'admin/font_options';
$route['admin/font-options-post'] = 'admin/font_options_post';

//settings
$route['admin/settings'] = 'admin/settings';
$route['admin/settings-post'] = 'admin/settings_post';

//seo tools
$route['admin/seo-tools'] = 'admin/seo_tools';
$route['admin/seo-tools-post'] = 'admin/seo_tools_post';
$route['admin/generate-sitemap-post'] = 'sitemap/generate_sitemap_post';


$route['(:any)'] = 'home/get_page/$1';
