<?
namespace components\widgets\userpanel;

use modules\users\models\Profile;
use yii\base\Widget;

/**
 * Обертка для ссылки. Аля миксин
 *
 * Class Href
 * @package components\widgets\href
 */
class Userpanel extends Widget
{
    public $profile;

    public function init()
    {
        parent::init();
        $this->profile = Profile::find()->where(["=","user_id",\Yii::$app->user->identity->getId()])->one();
    }

    public function run()
    {
        return $this->render('view', ["image" => $this->profile->image, "name" => $this->profile->name]);
    }
}