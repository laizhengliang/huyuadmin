<?php

/**
 * 直播记录
 */
namespace Admin\Controller;
use Common\Controller\AdminbaseController;
class MonitorController extends AdminbaseController {
    function index(){

		$config=getConfigPri();
			
		$this->assign('config', $config);
			
    	$live=M("users_live");
    	$count=$live->where("islive='1'")->count();
    	$page = $this->page($count, 20);
    	$lists = $live
    	->where("islive='1' and isvideo=0")
    	->order("starttime DESC")
    	->limit($page->firstRow . ',' . $page->listRows)
    	->select();
			
			foreach($lists as $k=>$v){
                $userinfo=M("users")->field("user_nicename")->where(["id"=>$v['uid']])->find();
                $lists[$k]['userinfo']=$userinfo;
                
                if($config['cdn_switch']==5){
                    $auth_url=$v['pull'];
                }else{
                    $auth_url=PrivateKeyA('rtmp',$v['stream'],3);
                }
                
				$lists[$k]['url']=$auth_url;
			}
    	$this->assign('lists', $lists);
    	$this->assign('formget', $_GET);
    	$this->assign("page", $page->show('Admin'));
    	
    	$this->display();
    }
	public function full()
	{
		$uid=(int)I('uid');
        $where['islive']=1;
        $where['uid']=$uid;
        
		$live=M("users_live")->where($where)->find();
		$config=getConfigPri();
        
		if($live['title']=="")
		{
			$live['title']="直播监控后台";
		}
        
        if($config['cdn_switch']==5){
            $pull=$live['pull'];
        }else{
            $pull=urldecode(PrivateKeyA('rtmp',$live['stream'],0));
        }
		$live['pull']=$pull;
		$this->assign('config', $config);
		$this->assign('live', $live);
		$this->display();
	}
	public function stopRoom(){
		$uid=(int)I('uid');
		$Live=M("users_live");
		$Gamedb=M("game");
        
        $where['islive']=1;
        $where['uid']=$uid;
        
		$liveinfo=$Live->field("uid,showid,starttime,title,province,city,stream,lng,lat,type,type_val,liveclassid")->where($where)->find();
        
		$Live->where(" uid='{$uid}'")->delete();
		if($liveinfo){
			$liveinfo['endtime']=time();
			$liveinfo['time']=date("Y-m-d",$liveinfo['showid']);
            
            $where2=[];
            $where2['touid']=$uid;
            $where2['showid']=$liveinfo['showid'];
            
			$votes=M("users_coinrecord")
				->where($where2)
				->sum('totalcoin');
			$liveinfo['votes']=0;
			if($votes){
				$liveinfo['votes']=$votes;
			}
            
            $stream=$liveinfo['stream'];
			$redis = connectionRedis();
			$nums=$redis->zSize('user_'.$stream);

			$redis->hDel("livelist",$uid);
			$redis->delete($uid.'_zombie');
			$redis->delete($uid.'_zombie_uid');
			$redis->delete('attention_'.$uid);
			$redis->delete('user_'.$stream);
			
			
			$liveinfo['nums']=$nums;
			
			M("users_liverecord")->add($liveinfo);
            
            /* 游戏处理 */
            $where3=[];
            $where3['state']=0;
            $where3['liveuid']=$uid;
            $where3['stream']=$stream['showid'];
            
			$game=$Gamedb
				->where($where3)
				->find();
			$total=array();
			if($game)
			{
				$total=M("users_gamerecord")
					->field("uid,sum(coin_1 + coin_2 + coin_3 + coin_4 + coin_5 + coin_6) as total")
					->where(["gameid"=>$game['id']])
					->group('uid')
					->select();
				foreach($total as $k=>$v){
                    
                    M()->execute("update __PREFIX__users set coin=coin+{$v['total']} where id={$v['uid']}");

					$redis->delete('userinfo_'.$v['uid']);
					
					$insert=array("type"=>'income',"action"=>'game_return',"uid"=>$v['uid'],"touid"=>$v['uid'],"giftid"=>$game['id'],"giftcount"=>1,"totalcoin"=>$v['total'],"showid"=>0,"addtime"=>$nowtime );
                    
                    M("users_coinrecord")->add($insert);
				}

				$Gamedb->where(["id"=> $game['id']])->save(array('state' =>'3','endtime' => time() ) );
				$brandToken=$stream."_".$game["action"]."_".$game['starttime']."_Game";
				$redis->delete($brandToken);
			}    
		}
        //$redis -> close();
        $action="监控 关闭直播间：{$uid}";
                    setAdminLog($action);
		
//		echo "{'status':0,'data':{},'info':''}";
//		exit;
		echo  json_encode( array("status"=>'1','info'=>'') );
		
	}				
}
