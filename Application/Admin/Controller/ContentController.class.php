<?php

/*文章*/
namespace Admin\Controller;
use Think\Controller;

class ContentController extends CommonController{

	function index(){
		$conds = array();
		$title = $_GET['title'];
		if($title){
			$conds['title'] = $title;
		}
		if($_GET['catid']){
			$conds['catid']	 = intval($_GET['catid']);
		}
		$page = $_REQUEST['p'] ? $_REQUEST['p'] : 1;
		$pageSize = 1;

		$news = D("News") -> getNews($conds,$page,$pageSize);
		$count = D("News") -> getNewsCount($conds);
		$res = new \Think\Page($count,$pageSize);
		$pageRes = $res -> show();


		$this -> assign("pageRes",$pageRes);
		$this -> assign("news",$news);
		$this -> assign("webSiteMenu",D("Menu")->getBarMenus());
		$this -> display();
	}


	function add(){

		if($_POST){
			if(!isset($_POST['title']) || !$_POST['title']){
				return show(0,'标题不存在');
			}
			if(!isset($_POST['small_title']) || !$_POST['small_title']){
				return show(0,'短标题标题不存在');
			}			
			if(!isset($_POST['catid']) || !$_POST['catid']){
				return show(0,'文章栏目不存在');
			}
			if(!isset($_POST['keywords']) || !$_POST['keywords']){
				return show(0,'关键字不存在');
			}
			if(!isset($_POST['content']) || !$_POST['content']){
				return show(0,'content不存在');
			}

			$newsId = D("News") -> insert($_POST);
			if($newsId){
				$nwesContentData['content'] = $_POST['content'];
				$nwesContentData['news_id']	= $newsId;
				$cId = D("NewsContent") -> insert($nwesContentData);
				if($cId){
					return show(1,'新增成功');
				}
				return show(0,'主表插入成功,副表插入失败');
			}else{
				return show(0,'新增失败');
			}

		}else{
			$webSiteMenu = D("Menu") -> getBarMenus();
			$titleFontColor = C("TITLE_FONT_COLOR");
			$copyFrom = C("COPY_FROM");
			$this -> assign("webSiteMenu",$webSiteMenu);
			$this -> assign("titleFontColor",$titleFontColor);
			$this -> assign("copyFrom",$copyFrom);
			$this -> display();
	}	
		}

}

?>