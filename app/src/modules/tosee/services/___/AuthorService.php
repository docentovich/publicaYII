<?php

namespace tosee\services\backend;

use app\Services;
use Symfony\Component\Finder\Exception\AccessDeniedException;
use Yii;
use tosee\models\ToseePost;
use yii\web\HttpException;

class authorService extends Services
{
    /**
     * @var string Текущий город
     */
    public $city_id = '1'; //Орел по умолчанию

    public function __construct()
    {
        //Берем город из identity
        $this->city_id = Yii::$app->user->identity->city_id;

        $this->_query = ToseePost::find()
            ->with(["postData", "image"]);

    }

    /**
     * @inheritdoc
     */
    protected function getMany($condition = [])
    {
        $this->count();

        //select all
        $this->items = $this->_query
            ->andWhere($condition)
            ->all();
    }

    /**
     * @inheritdoc
     */
    protected function getOne($id)
    {
        //select all
        $this->items = $this->_query
            ->andWhere(["=", "id", $id])
            ->one();
    }

    public function search($keyword)
    {
        // TODO: Implement search() method.
    }

    /**
     * @inheritdoc
     */
    public function save()
    {
        $model = new ToseePost();

        if ($model->load( Yii::$app->request->post() )) {
            if( Yii::$app->user->can("updatePost", ["post" => $model]) ) //апдейтим только свои посты
                if($model->save())
                    return true;
        }

        return false;
    }

    /**
     * Смена статуса поста
     */
    public function setPostStatus()
    {
        $post_requst = Yii::$app->request->post();

        foreach($post_requst as $post_id => $new_status){
            $new_status = (int)$new_status;
            $post = new ToseePost(["id" => $post_id]);

            if( Yii::$app->user->can("moderatePost", ["object" => $post])){
                $post->status = $new_status;
                $post->save();
            }
        }
    }

    /**
     * Посты на модерации
     *
     * @return $this|postServices
     */
    public function getOnModerate()
    {
        $this->_query->andWhere(["=", "status", ToseePost::STATUS_ON_MODERATE]);

        return $this->getAllPosts();
    }


    /**
     * Получить все доступные посты
     *
     * @return $this|postServices
     * @throw AccessDeniedException
     */
    public function getAllPosts()
    {
        //если не передаем парамтеры то сработает только общее правило для админов
        //так как оно задано черезпаралельную ветку ему (-OR-)
        if(Yii::$app->user->can("reedPost")){
            $this->getMany();
        }
        //просмотр многих городских постов
        elseif(Yii::$app->user->can("reedPosts")){
            $this->getMany(["=", "city", $this->city_id]);
        }
        //просмотр своих многих постов
        elseif(Yii::$app->user->can("reedOwnPosts")){
            $this->getMany(["=", "user_id", Yii::$app->user->getId()]);
        }else{
            throw new HttpException(403, "Access denied");
        }

        return $this;

    }

    /**
     * Возврат своего поста с проверкой на чтение
     *
     * @param int $id
     * @return $this|postServices
     */
    public function getByIdPost($id)
    {
        $this->getOne($id);

        if(!Yii::$app->user->can("reedPost", ['post' => $this->items])){
            $this->items = []; //если не может просматривать этот пост то обнулим результат
        }

        return $this;
    }



}