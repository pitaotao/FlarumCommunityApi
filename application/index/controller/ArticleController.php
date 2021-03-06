<?php

namespace app\index\controller;

use app\index\model\Article;
use think\Controller;
use think\Request;

class ArticleController extends Controller
{
//    获取所有文章信息的接口
    public function getAllArticle(){
        $article = new Article();
        $data = $article->getArticleInfo();
        return $data;
    }

//    添加话题的接口
    public function addTopic(Request $request){

        $userId = $request->jwt->id;
        $categoryId = $request->categoryId;
        $title = $request->title;
        $topicContent = $request->topicContent;
        $createdAt = date('Y-m-d h:i:s');
        $editTopic = $request->editTopicId;

        if($editTopic){
            $updateTopic = new Article();
            $topicEditId = $updateTopic->updateArticle($editTopic,$userId,$categoryId,$title,$topicContent,$createdAt);

            if($topicEditId){
                echo json_encode([
                    'topicId' => $topicEditId,
                    'code' => 200,
                    'state' => true,
                    'msg' => '话题修改成功'
                ]);
            }else{
                echo json_encode([
                    'code' => 400,
                    'state' => false,
                    'msg' => '话题修改失败'
                ]);
            }

        }else{
            $topic = new Article();
            $topicId = $topic->createTopic($userId,$categoryId,$title,$topicContent,$createdAt);

            if($topicId){
                echo json_encode([
                    'topicId' => $topicId,
                    'code' => 200,
                    'state' => true,
                    'msg' => '话题发表成功'
                ]);
            }else{
                echo json_encode([
                    'code' => 400,
                    'state' => false,
                    'msg' => '话题发表失败'
                ]);
            }
        }

    }

//    根据id获取话题
    public function getTopicById(Request $request){
        $topicId = $request->id;
//        return $topicId;
        $article = new Article();
        $data = $article->getArticleById($topicId);
        return $data;
    }

//    删除话题
    public function deleteTopic(Request $request){
        $topicId = $request->topicId;
        $article = new Article();
        $article->delTopic($topicId);

        echo json_encode([
            'code' => 200,
            'state' => true,
            'msg' => '话题删除成功'
        ]);
    }

//

    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        //
    }

    /**
     * 显示创建资源表单页.
     *
     * @return \think\Response
     */
    public function create()
    {
        //
    }

    /**
     * 保存新建的资源
     *
     * @param  \think\Request  $request
     * @return \think\Response
     */
    public function save(Request $request)
    {
        //
    }

    /**
     * 显示指定的资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function read($id)
    {
        //
    }

    /**
     * 显示编辑资源表单页.
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * 保存更新的资源
     *
     * @param  \think\Request  $request
     * @param  int  $id
     * @return \think\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * 删除指定资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function delete($id)
    {
        //
    }
}
