<?php
namespace App\Controllers;



use App\Models\ActionLogModel;

class Logs extends BaseController
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

		$data = [
			'page_title' => 'Logs',
			'active_nav_parent' => 'logs',
			'active_nav' => 'logs',
		];
		if(!hasCapability('logs/view')){
			$data['errorMessage'] = "You don't have capability to access this page. Please contact to admin.";
			return view('user/error',$data);
		}

		

		return view('user/logs/index', $data);
    }


	public function downloadLogReport() {
		
		header("Content-Type: application/vnd.ms-excel");
		$model = new ActionLogModel();

		$start = 0;
		$length = 10;
		
		echo "ID\t Date\t Action By\tAction Type\t Model\t Changed Data\n";
		while($data = $model->getList([], '', $start, $length,'action_log.id desc',true)){
			foreach($data as $row){
				echo "{$row['id']}\t {$row['created_at']}\t {$row['action_by']}\t {$row['action_type']}\t {$row['model']}\t {$row['chaged_data']}\n";
			}
			$start += $length;
		}
		header("Content-disposition: attachment; filename=states.xls");
		exit();

	}
}