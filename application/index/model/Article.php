<?php

namespace app\index\model;

use think\Model;

class Article extends Model
{
    protected $field = true;
//    根据用户id获取用户信息
    public function getUserByArticleId(){
        return $this->belongsTo('app\\index\\model\\User','user_id','id');
    }

//    根据分类id获取分类信息
    public function getCategoryByArticleId(){
        return $this->belongsTo('app\\index\\model\\Category','category_id','id');
    }

//    根据话题id获取话题总数
    public function getTopicTotal(){
        return $this->hasMany('app\\index\\model\\Reply','topic_id','id');
    }

//    获取文章信息的接口
    public function getArticleInfo(){
        return Article::with(['getUserByArticleId','getCategoryByArticleId','getTopicTotal'])->order('created_at desc')->select();
    }

//    添加话题
    public function createTopic($userId,$categoryId,$title,$topicContent,$createdAt){
        $topic = new Article([
            'user_id' => $userId,
            'category_id' => $categoryId,
            'title' => $title,
            'content' => $topicContent,
            'created_at' => $createdAt
        ]);
        $topic->save();
        return $topic->id;
    }

//    根据id获取话题
    public function getArticleById($topicId){
        return Article::with(['getUserByArticleId','getCategoryByArticleId'])->where('id',$topicId)->find();
    }

//    编辑话题
    public function updateArticle($editTopic,$userId,$categoryId,$title,$topicContent,$createdAt){
        $topic = Article::where('id',$editTopic)->find();
        $topic->user_id = $userId;
        $topic->category_id = $categoryId;
        $topic->title = $title;
        $topic->content = $topicContent;
        $topic->created_at = $createdAt;
        $topic->save();
        return $topic->id;
    }

//    删除话题
    public function delTopic($topicId){
        $topic = Article::where('id',$topicId)->find();
        $replyArr = Reply::where('topic_id',$topic->id)->all();
        $topic->delete();
        foreach ($replyArr as $v){
            $v->delete();
        }

    }


}
