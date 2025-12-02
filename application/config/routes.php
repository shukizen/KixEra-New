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
|	https://codeigniter.com/userguide3/general/routing.html
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
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
$config['index_page'] ='';
$route['default_controller'] = 'auth/login';
$route['auth/login'] = 'auth/login';
$route['admin_tugas/calendar'] = 'Admin_tugas/calendar';
$route['admin_tugas/get_calendar_data'] = 'Admin_tugas/get_calendar_data';
$route['admin_tugas/get_tasks_by_date'] = 'Admin_tugas/get_tasks_by_date';
$route['admin_tugas/upload_task_file'] = 'Admin_tugas/upload_task_file';
$route['admin_tugas/delete_task_file/(:num)'] = 'Admin_tugas/delete_task_file/$1';
$route['dashboard/get_calendar_data'] = 'dashboard/get_calendar_data';
$route['dashboard/get_tasks_by_date'] = 'dashboard/get_tasks_by_date';
$route['dashboard/get_roadmap_data'] = 'dashboard/get_roadmap_data';
$route['dashboard_ga/get_roadmap_data'] = 'dashboard/get_roadmap_data';
$route['proyek/upload_document'] = 'proyek/upload_document';
$route['proyek/delete_document/(:num)'] = 'proyek/delete_document/$1';
$route['proyek/download_document/(:num)'] = 'proyek/download_document/$1';
