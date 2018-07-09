<?php
class  baseAction extends Action {
    
    
    public function gnb($danbai, $zhifang, $tanshui){
    	$danbai=$danbai*4;
    	$zhifang=$zhifang*9;
    	$tanshui=$tanshui*4;

    	$bili['danbai']=round($danbai/($danbai+$zhifang+$tanshui),4);
    	$bili['zhifang']=round($zhifang/($danbai+$zhifang+$tanshui),4);
    	$bili['tanshui']=round($tanshui/($danbai+$zhifang+$tanshui),4);
    	return $bili;
    }

    public function getone($id){
    	$fmod = M('foodnutrition');
    	$info = $fmod->find($id);
    	if($info)
    		return $info;
    	else 
    		return false;
    }
}