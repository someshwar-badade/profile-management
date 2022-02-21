<?php
namespace App\Controllers\api;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\ActionLogModel;

class Logs extends ResourceController
{
    use ResponseTrait;
    protected $helpers = ['CommonFunction'];

    public function index()
    {
        
        $user = checkUserToken();

        if (!$user) {
            return $this->fail(['messages' => 'Please login.'], 400);
        }

        $model = new ActionLogModel();

        $draw = (int)$this->request->getVar('draw');
        $start = (int)$this->request->getVar('start');
        $length = (int)$this->request->getVar('length');
       

       
        // $iSearch = [];
        $searchKey = $this->request->getVar('search'); //$_POST['search'];
        $columns = $this->request->getVar('columns'); // $_POST['columns'];
        $order = $this->request->getVar('order'); //$_POST['order'];
        $orderBy = $columns[$order[0]['column']]['data'] . ' ' . $order[0]['dir'];

        $iSearch_str = '';
        if (!empty($searchKey['value'])) {
            foreach ($columns as $row) {
                if (!empty($row['data'] && $row['searchable'] == 'true')) {
                    $iSearch[] = " " . $row['data'] . "  LIKE '%" . $searchKey['value'] . "%' ";
                }
            }

            $iSearch_str = implode(' OR ', $iSearch);
        }

        $filter = array();

        if (isset($_GET['filter'])) {
            $filter = $_GET['filter'];
        }
        // $data = ['message'=>"hello"];
       $data = $model->getList($filter, $iSearch_str, $start, $length, $orderBy);
        return $this->respond($data);
        // return $this->respond($data);
    }



}