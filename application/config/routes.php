<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
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
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There area two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router what URI segments to use if those provided
| in the URL cannot be matched to a valid route.
|
*/

//$route['default_controller'] = "welcome";
//$route['404_override'] = '';
//$route['myleave/mypending_request/(:num)'] = 'user/my_leave/my_pending_request';
//$route['myleave/myleave_history'] = 'user/my_leave/my_leave_history';
//$route['myleave/myleave_history/(:num)'] = 'user/my_leave/my_leave_history';
//$route['myprofile'] = 'user/my_profile';

//$route['mydashboard/mycalendar'] = 'user/my_dashboard/mycalendar';
//$route['mydashboard/mycalendar/(:num)'] = 'user/my_dashboard/mycalendar';
//$route['mydashboard'] = 'user/my_dashboard';
//$route['employee/example1/(:any)'] = 'employee/example1/$1';
//$route['employee/edit_employee/(:any)'] = 'employee/edit_employee/$1';
//$route['employee/addemployee'] = 'employee/addemployee';
//$route['employee/view/(:any)'] = 'employee/view/$1';
//$route['employee'] = 'employee';
//$route['leave/(:num)'] = 'leave';
$route['employee/(:num)'] = 'employee';
//$route['dashboard/calenda] = 'dashboard';
$route['default_controller'] = 'login';


/* End of file routes.php */
/* Location: ./application/config/routes.php */