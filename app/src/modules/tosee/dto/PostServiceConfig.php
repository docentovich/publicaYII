<?php

namespace app\modules\tosee\dto;

use app\abstractions\ServiceConfig;
use app\modules\tosee\models\Post;
use app\modules\tosee\services\PostService;

/**
 * Class PostServiceConfig
 * @property mixed $action;
 * @property string $keyword;
 * @package app\modules\tosee\dto
 */
class PostServiceConfig extends ServiceConfig
{
    /** @var Post */
    public $post;
    public $page;
    public $id;
    /**
     * @var \DateTime|mixed
     */
    public $date;

    public function __construct($config = [])
    {
        $this->date =  $config['date'] ?? new \DateTime();
        $this->page =  $config['page'] ?? 1;
        $this->action =  $config['action'] ?? PostService::ACTION_FUTURE;
        $this->id =  $config['id'] ?? null;
        $this->post = $config['post'] ?? null;
        unset($config['date'],$config['page'],$config['action'],$config['id'],$config['post']);
        parent::__construct($config);
    }
}