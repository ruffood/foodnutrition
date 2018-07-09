<?php
class toolsAction extends baseAction {
    public function index(){

		$this->display();
    }

    public function gongnengbi(){
    	$fmod = M('foodnutrition');

    	
    	$list = $fmod->where($cc)->order('id desc')->select();
    	
    	$superfood=array();

    	foreach ($list as $key => $value) {
    		# code...
    		$bili=$this->gnb($value['danbai'],$value['zhifang'],$value['tanshui']);

    		if($bili['danbai']>=0.1 && $bili['danbai']<=0.15 && $bili['zhifang']>=0.2 && $bili['zhifang']<=0.3 && $bili['tanshui']>=0.55 && $bili['tanshui']<=0.65){
                $value['name']=$value['name'].'('.$bili['danbai'].'-'.$bili['zhifang'].'-'.$bili['tanshui'].')';
    			array_push($superfood, $value);
    		}
    	}
    	// dump($superfood); die;

    	$this->assign('list', $superfood);

    	$this->display();
    }

    public function gnb_data(){
        $fid=$this->_request('fid', 'intval');
        $info=M('foodnutrition')->field('name,danbai,zhifang,tanshui')->find($fid);

        $res_dd=array();
        $data['name']='蛋白质';
        $data['value']=$info['danbai']*4;
        array_push($res_dd, $data);

        $data['name']='脂肪';
        $data['value']=$info['zhifang']*9;
        array_push($res_dd, $data);

        $data['name']='碳水化合物';
        $data['value']=$info['tanshui']*4;
        array_push($res_dd, $data);

        $res['dd']=$res_dd;
        $res['fname']=$info['name'];


        $this->ajaxReturn(array('code'=>200,'res'=>$res));
    }

    public function hongdie(){

        $this->display();

    }

    public function hongdie_getdata(){

        $fmod = M('foodnutrition');

        
        $list = $fmod->field('name,danbai,zhifang,tanshui')->where($cc)->order('danbai desc')->select();


        $res['name']=array();
        $danbai=array();
        $zhifang=array();
        $tanshui=array();

        foreach ($list as $key => $value) {
            # code...
            array_push($res['name'], $value['name']);
            array_push($danbai,$value['danbai']);
            array_push($zhifang,$value['zhifang']);
            array_push($tanshui,$value['tanshui']);
        }

        $res['hong'][0]['name']='蛋白质';
        $res['hong'][0]['type']='line';
        // $res['hong'][0]['stack']='含量';
        $res['hong'][0]['data']=$danbai;

        $res['hong'][1]['name']='脂肪';
        $res['hong'][1]['type']='line';
        // $res['hong'][1]['stack']='含量';
        $res['hong'][1]['data']=$zhifang;

        $res['hong'][2]['name']='碳水';
        $res['hong'][2]['type']='line';
        // $res['hong'][2]['stack']='含量';
        $res['hong'][2]['data']=$tanshui;

        
        $this->ajaxReturn(array('code'=>200,'res'=>$res));
    }


    public function gnball(){

        $this->display();

    }


    public function gnball_data(){

        $fmod = M('foodnutrition');

        
        $list = $fmod->field('name,danbai,zhifang,tanshui')->where($cc)->order('danbai desc')->select();


        $res['name']=array();
        $danbai=array();
        $zhifang=array();
        $tanshui=array();

        foreach ($list as $key => $value) {
            # code...
            $bili=$this->gnb($value['danbai'],$value['zhifang'],$value['tanshui']);

            array_push($res['name'], $value['name']);
            array_push($danbai,$bili['danbai']);
            array_push($zhifang,$bili['zhifang']);
            array_push($tanshui,$bili['tanshui']);
        }

        $res['hong'][0]['name']='蛋白质';
        $res['hong'][0]['type']='line';
        $res['hong'][0]['stack']='供能比';
        $res['hong'][0]['areaStyle']=array('normal'=>'');
        $res['hong'][0]['data']=$danbai;

        $res['hong'][1]['name']='脂肪';
        $res['hong'][1]['type']='line';
        $res['hong'][1]['stack']='供能比';
        $res['hong'][1]['areaStyle']=array('normal'=>'');
        $res['hong'][1]['data']=$zhifang;

        $res['hong'][2]['name']='碳水';
        $res['hong'][2]['type']='line';
        $res['hong'][2]['stack']='供能比';
        $res['hong'][2]['areaStyle']=array('normal'=>'');
        $res['hong'][2]['data']=$tanshui;

        $this->ajaxReturn(array('code'=>200,'res'=>$res));
    }

    public function baota(){
        // 大米-4512  70克    甘薯（红心）-4212 50克
        // 蔬菜  白菜-3609  75克   菠菜-3686  45克   蘑菇-3612  30克
        // 水果  苹果-4125  50克  葡萄 4086 60克
        // 肉 羊肉-4016  50克    鳊鱼-3552  30克    扁豆-4294  30克
        // 牛奶-3744  100克
        // 油 10

        $total=array();
        $wei=array();

        $foodlist=array('4512'=>'70','4212'=>'30','3609'=>'75','3686'=>'45','3612'=>'30','4125'=>'50','4086'=>'60','4016'=>'30','3552'=>'30','4294'=>'30','3453'=>'10');

        // $foodlist=array('4512'=>'150','3609'=>'150','3612'=>'30','4125'=>'100','4016'=>'100','4294'=>'30','3774'=>'100','3453'=>'10');

        $weilist=array('VA'=>'维生素A','B1'=>'维生素B1','B2'=>'维生素B2','B3'=>'维生素B3','VC'=>'维生素C','VE'=>'维生素E','jia'=>'钾','na'=>'钠','gai'=>'钙','mei'=>'镁','tie'=>'铁','meng'=>'锰','xin'=>'锌','tong'=>'铜','lin'=>'磷','xi'=>'硒');


        foreach ($foodlist as $key => $value) {

            $fu=$this->getone($key);

            $flist[$key]['name']=$fu['name'];
            $flist[$key]['liang']=$value;

            $total['nengliang']+=$fu['nengliang']*($value/100);

            $total['danbai']+=$fu['danbai']*($value/100);
            $total['zhifang']+=$fu['zhifang']*($value/100);
            $total['tanshui']+=$fu['tanshui']*($value/100);
            $total['xianwei']+=$fu['xianwei']*($value/100);

            foreach ($weilist as $kk => $vv) {
                # code...
                $wei[$kk]+=$fu[$kk]*($value/100);
            }

        }

        // dump($wei);die;
        $wei_str=array();
        $wei_data=array();

        foreach ($weilist as $kk => $vv) {
                # code...
            array_push($wei_str, "'".$vv."'");
        }
        foreach ($wei as $key => $value) {
            # code...
            array_push($wei_data, "'".$value."'");
        }
        $this->assign('wei_str',implode(',', $wei_str));
        $this->assign('wei_data',implode(',', $wei_data));


        $this->assign('flist', $flist);

        // dump($total);

        $this->assign('total', $total);

        $bili = $this->gnb($total['danbai'], $total['zhifang'], $total['tanshui']);

        $res_dd=array();
        $data['name']='蛋白质';
        $data['value']=$bili['danbai'];
        array_push($res_dd, $data);

        $data['name']='脂肪';
        $data['value']=$bili['zhifang'];
        array_push($res_dd, $data);

        $data['name']='碳水化合物';
        $data['value']=$bili['tanshui'];
        array_push($res_dd, $data);

        $res_data=json_encode($res_dd);
        $this->assign('hong_gnb',$res_data);

        $this->display();
    }
}