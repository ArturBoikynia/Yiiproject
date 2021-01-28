<?php


namespace app\components;

use app\models\entities\PhotoEntities;
use Yii;
use yii\db\Exception;

class EditPhoto
{

    private ?int $id = null;

    public function __construct(int $id){
        $this->id = $id;
    }



    /**
     * @param int $id
     * @param string $path
     */
    public function delete (string $path):void {
        $photo = new PhotoEntities();
        $photo::deleteAll(['user_id' => $this->id, 'path' => $path]);
        unlink($path);
    }

    /**
     * @param int $id
     * @param string $path
     * @throws Exception
     */
    public function setMain (string $path):void {

        $photo = new PhotoEntities();

        $query = $photo::findAll([
            'user_id' => $this->id,
            'is_main' => true,
        ]);

        foreach ($query as $photoEntities){
            $photoEntities->is_main = 0;
            if(!$photoEntities->save()){
                throw new Exception(Yii::t('app', 'Attribut is_main can not be seted for item  {photo}', ['photo' => basename($path)]));
            }
        }

        $query = $photo::findOne([
            'user_id' => $this->id,
            'path' => $path,
        ]);

        $query->is_main = 1;
        if(!$query->save()){
            throw new Exception(Yii::t('app', 'Attribut is_main can not be seted for item  {photo}', ['photo' => basename($path)]));
        }
    }

    public function removeMain (string $path):void {
        $photo = new PhotoEntities();

        $query = $photo::findOne([
            'user_id' => $this->id,
            'path' => $path,
        ]);

        $query->is_main = 0;

        if(!$query->save()){
            throw new Exception(Yii::t('app', 'Attribut is_main can not be seted for item  {photo}', ['photo' => basename($path)]));
        }
    }



    /**
     * @param int $id
     * @return PhotoEntities|null
     */
    public static function findMainPhoto(int $id): ?PhotoEntities{

        $photo = new PhotoEntities();
        $query = $photo::findOne([
            'user_id' => $id,
            'is_main' => true,
        ]);

        return $query;
    }
}