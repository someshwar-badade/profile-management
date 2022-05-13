<?php
namespace App\Controllers;



use App\Models\UserLeaveTypesModel;
use App\Models\UserLeavesModel;

class Leaves extends BaseController
{

	public function index()
	{
        $user = checkUserToken();

		if (!$user) {
			//redirct to login
			setcookie("a_token", "", time() - 3600, '/'); //delete cookie
			setcookie("r_token", "", time() - 3600, '/'); //delete cookie
			return redirect()->route('logout');
		}

		$UserLeaveTypesModel = new UserLeaveTypesModel();
		$UserLeavesModel = new UserLeavesModel();

		$leaveTypeWiseCount = $UserLeavesModel->getLeaveTypeWiseCount($user['id']);
		$totalLeavesCount = 0;
		foreach($leaveTypeWiseCount as $row){
			$totalLeavesCount += $row['total_days'];
		}

		$data = [
			'page_title' => 'My Leaves',
			'active_nav_parent' => 'leaves',
			'active_nav' => 'leaves',
			'cap_approval' => hasCapability('leaves/approval'),
			'leave_types' => $UserLeaveTypesModel->getActiveTypeList(),
			'leaveTypeWiseCount' => $leaveTypeWiseCount,
			'totalLeavesCount'=> $totalLeavesCount
		];

		if(!hasCapability('leaves/view')){
			$data['errorMessage'] = "You don't have capability to access this page. Please contact to admin.";
			return view('user/error',$data);
		}

		return view('user/leaves/index', $data);
    }
	public function leavesApproval()
	{
        $user = checkUserToken();

		if (!$user) {
			//redirct to login
			setcookie("a_token", "", time() - 3600, '/'); //delete cookie
			setcookie("r_token", "", time() - 3600, '/'); //delete cookie
			return redirect()->route('logout');
		}

		$UserLeaveTypesModel = new UserLeaveTypesModel();

		$data = [
			'page_title' => 'Leaves for approval',
			'active_nav_parent' => 'leaves',
			'active_nav' => 'leave-approval',
			'cap_approval' => hasCapability('leaves/approval'),
		];

		if(!hasCapability('leaves/approval')){
			$data['errorMessage'] = "You don't have capability to access this page. Please contact to admin.";
			return view('user/error',$data);
		}

		return view('user/leaves/leaves-approval', $data);
    }
	public function leavesReport()
	{
        $user = checkUserToken();

		if (!$user) {
			//redirct to login
			setcookie("a_token", "", time() - 3600, '/'); //delete cookie
			setcookie("r_token", "", time() - 3600, '/'); //delete cookie
			return redirect()->route('logout');
		}

		$UserLeavesModel = new UserLeavesModel();
		$UserLeaveTypesModel = new UserLeaveTypesModel();

		$data = [
			'page_title' => 'Leaves Report',
			'active_nav_parent' => 'leaves',
			'active_nav' => 'leave-report',
			'cap_approval' => hasCapability('leaves/report'),
			'employeeList' => $UserLeavesModel->employeeList(),
			'leaveTypes' => $UserLeaveTypesModel->getActiveTypeList(),
			'today'=>date('d-M-Y'),
		];

		if(!hasCapability('leaves/report')){
			$data['errorMessage'] = "You don't have capability to access this page. Please contact to admin.";
			return view('user/error',$data);
		}

		return view('user/leaves/report', $data);
    }


}