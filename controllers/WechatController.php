<?php

namespace app\controllers;
use yii\web\Controller;

class WechatController extends Controller
{

	public function actionIndex()
	{
		// you must define TOKEN by yourself
//		$signature = $_GET["signature"];
//		$timestamp = $_GET["timestamp"];
//		$nonce = $_GET["nonce"];
//
//		$token = 'weixin';
//		$tmpArr = array($token, $timestamp, $nonce);
//		// use SORT_STRING rule
//		sort($tmpArr, SORT_STRING);
//		$tmpStr = implode( $tmpArr );
//		$tmpStr = sha1( $tmpStr );
//
//		if( $tmpStr == $signature && $_GET['echostr']){
//			echo $_GET['echostr'];
//			exit;
//		}else{
//			//return $this->redirect(['response-msg']);
//			$this->responseMsg();
//		}
		$postArr = $GLOBALS['HTTP_RAW_POST_DATA'];

		$postObj = simplexml_load_string($postArr);
		if( strtolower($postObj->MsgType) == 'event' ){
			if( strtolower($postObj->event) == 'subscribe'){
				$toUser = $postObj->FromUserName;
				$fromUser = $postObj->toUserName;
				\Yii::info('toUser'.$toUser);
				$time = time();
				$msgType = 'text';
				$content = '你发现了别人不曾发现的,你很独特';
				$template = "<xml>
								<ToUserName><![CDATA[toUser]]></ToUserName>
								 <FromUserName><![CDATA[fromUser]]></FromUserName>
								 <CreateTime>1348831860</CreateTime>
								 <MsgType><![CDATA[text]]></MsgType>
								 <Content><![CDATA[this is a test]]></Content>
								 <MsgId>1234567890123456</MsgId>
								 </xml>";
				$info = sprintf($template, $toUser, $fromUser, $time, $msgType, $content);
				echo $info;
			}
		}



	}
}






?>