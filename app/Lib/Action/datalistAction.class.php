<?php
class datalistAction extends baseAction {
    public function index(){
		


		$this->display();
    }

    public function getdata(){

    	$pageSize=$this->_request('pageSize','intval');

    	$offset=$this->_request('offset','intval');
    	$offset=$offset?$offset:0;

    	$sort=$this->_request('sort','trim');
    	$sortOrder=$this->_request('sortOrder','trim');

    	$dmod=M('foodnutrition');
    	$data['total']=$dmod->count();

    	$list=$dmod->order($sort.' '.$sortOrder)->limit($offset*$pageSize,$pageSize)->select();

    	
    	$data['rows']=$list;
    	echo json_encode($data);
    }
}