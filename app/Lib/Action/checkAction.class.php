<?php
class checkAction extends baseAction {



    public function index(){
		

		$this->display();
    }


    public function test(){
		

		$this->display();
    }

    public function jsondata1(){
    	
    	$fmod = M('foodnutrition');

    	
    	$list = $fmod->field('name,shibu')->where($cc)->order('shibu desc')->select();

    	
    	$this->ajaxReturn(array('code'=>200,'res'=>$list));
    }

    public function jsondata2(){
    	
    	$fmod = M('foodnutrition');

    	
    	$list = $fmod->field('name,danbai')->where($cc)->order('danbai desc')->select();

    	
    	$this->ajaxReturn(array('code'=>200,'res'=>$list));
    }

    public function jsondata3(){
    	
    	$fmod = M('foodnutrition');

    	
    	$list = $fmod->field('name,zhifang')->where($cc)->order('zhifang desc')->select();

    	
    	$this->ajaxReturn(array('code'=>200,'res'=>$list));
    }

    public function jsondata4(){
    	
    	$fmod = M('foodnutrition');

    	
    	$list = $fmod->field('name,tanshui')->where($cc)->order('tanshui desc')->select();

    	
    	$this->ajaxReturn(array('code'=>200,'res'=>$list));
    }

    public function jsondata5(){
    	
    	$fmod = M('foodnutrition');

    	
    	$list = $fmod->field('name,xianwei')->where($cc)->order('xianwei desc')->select();

    	
    	$this->ajaxReturn(array('code'=>200,'res'=>$list));
    }

    public function jsondata6(){
        
        $fmod = M('foodnutrition');

        
        $list = $fmod->field('name,vc')->where($cc)->order('vc desc')->select();

        foreach ($list as $key => $value) {
            # code...
            if(!$value['vc']){
                $list[$key]['vc']=0;
            }
        }

        
        $this->ajaxReturn(array('code'=>200,'res'=>$list));
    }






    public function fenbu1(){
    	
    	$fmod = M('foodnutrition');

    	$list=$fmod->query('select * from yk_foodnutrition where leixing>=10 and leixing<=19');
    	dump(count($list));die;
    	foreach ($list as $key => $value) {
    		# code...

    	}

    }

}