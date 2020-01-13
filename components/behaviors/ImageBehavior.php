<?php
/*
 * Last change 22.08.2018
 * Add multiple and tabular upload
 */

namespace app\components\behaviors;

use Yii;
use yii\base\Behavior;
use yii\db\ActiveRecord;
use yii\web\UploadedFile;
use yii\helpers\BaseFileHelper;
use yii\base\Security;
use yii\imagine\Image;

class ImageBehavior extends Behavior {
    
    public $savePath;
    public $fields;
    public $files;
    public $deletePhoto;


    // TODO:: add dynamical name and rules for deleteFile for each file field

    public function events() {
        return [
            ActiveRecord::EVENT_BEFORE_VALIDATE => 'beforeValidate',
            ActiveRecord::EVENT_BEFORE_INSERT => 'beforeInsert',
            ActiveRecord::EVENT_BEFORE_UPDATE => 'beforeInsert',
            ActiveRecord::EVENT_BEFORE_DELETE => 'clearImage'
        ];
    }


    public function beforeValidate($event) {
        $multipleIndex = \Yii::$app->session->getFlash('multipleIndex');    // multiple input
        $tabularIndex = \Yii::$app->session->getFlash('tabularIndex');      // several models / tabular input
        foreach($this->fields as $field => $fileSizes) {
            if($multipleIndex !== null)
            {
                $instances = UploadedFile::getInstances($this->owner, $field);
                $this->files[$field] = $instances[$multipleIndex];
            }
            elseif($tabularIndex !== null)
            {
                $this->files[$field] = UploadedFile::getInstance($this->owner, "[$tabularIndex]".$field);
            }
            else
            {
                $this->files[$field] = UploadedFile::getInstance($this->owner, $field);
            }
        }
    }
    
    
    public function beforeInsert($event) {
        if(isset($this->owner->deletePhoto) && $this->owner->deletePhoto) {
            // TODO:: check file for delete (multiple)
//            $this->deleteImage();
        } else {
            $this->saveImage();
        }
    }
    
    public function saveImage() {
        foreach($this->fields as $field => $fieldSizes) {
            $file = $this->files[$field];
            if($file !== null && $file !== '') {
                if(isset($this->owner->oldAttributes[$field])) {
                    $this->deleteImage($field);
                }

                $filePath = $this->getFilePath();
                // create model save path
                BaseFileHelper::createDirectory($filePath);
                // get new name for file
                $fileString = (new Security())->generateRandomString();
                $fileName = $fileString . '.' . $file->extension;
                // upload file
                $file->saveAs($filePath . $fileName);

                if ( is_callable($fieldSizes) ) {
                    $fieldSizes = call_user_func($fieldSizes);
                }
                
                // crop
                foreach($fieldSizes as $sizeName => $sizes) {
                    if($sizeName != 'saveOriginal') {

                        if ( is_callable($sizes['width']) ) {
                            $imgWidth = call_user_func($sizes['width']);
                        } else {
                            $imgWidth = $sizes['width'];
                        }
                        if ( is_callable($sizes['height']) ) {
                            $imgHeight = call_user_func($sizes['height']);
                        } else {
                            $imgHeight= $sizes['height'];
                        }                        
                    
                        $newFileName = $fileString . "_$sizeName." . $file->extension;
                        $mode = isset($sizes['mode']) ? $sizes['mode'] : 'outbound';
                        Image::$thumbnailBackgroundAlpha = 0;
                        Image::thumbnail($filePath . $fileName, $imgWidth, $imgHeight, $mode)
                                ->save($filePath . $newFileName, ['quality' => 100]);
                    }
                }
                
                // set model field value (as saved filename)
                $this->owner->{$field} = $fileName;
                
                // delete original file
                if(!isset($fieldSizes['saveOriginal']) || !$fieldSizes['saveOriginal']) {
                    unlink($filePath . $fileName);
                }
            } else {
                // save old file name
                $this->owner->{$field} = isset($this->owner->oldAttributes[$field]) ? $this->owner->oldAttributes[$field] : null ;
            }
        }
    }


    /*
     * Remove field image
     * @field string - name of image field
     */
    public function deleteImage($field) {
//        foreach($this->fields as $field => $fieldSizes) {
            $this->owner->{$field} = null;
            $filePath = $this->getFilePath();
            $fileName = $this->owner->oldAttributes[$field];
            @unlink($filePath . $fileName);
            foreach($this->fields[$field] as $sizeName => $sizes) {
                if($sizeName != 'saveOriginal') {
                    $thumbFileName = preg_replace("/(\.\S{3,4})$/iu", "_$sizeName$1", $fileName);
                    @unlink($filePath . $thumbFileName);
                }
            }
//        }
    }


    /*
     * Remove all files of field image
     */
    public function clearImage($field) {
        foreach($this->fields as $field => $fieldSizes) {
            $this->deleteImage($field);
        }
    }
     
     
     public function getFilePath() {
         return Yii::getAlias('@uploads' . $this->savePath . DIRECTORY_SEPARATOR);
     }
    
    
    public function getPhoto($type = 'big', $field = 'image') {
        $model = $this->owner;
        if($type == 'original') {
                $photo = $model->{$field} ? $model->{$field} : '/static/i/dummy-300x300.png';
        } else {
            $photo = $model->{$field} ? preg_replace("/(\.\S{3,4})$/iu", "_$type$1", $model->{$field}) : '/static/i/dummy-100x100.png';
        }
            
        return $model->{$field} ? Yii::getAlias('@web/uploads' . $this->savePath ) . '/'. $photo : $photo;
    }

}