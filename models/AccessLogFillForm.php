<?php

namespace app\models;

/**
 * Description of AccessLogFillForm
 */
class AccessLogFillForm extends \yii\base\Model {
    
    /**
     * Filename of log file
     * @var string
     */
    public $filename;
    
    // public $uploadingFile;
    
    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            ['filename', 'required'],
            ['filename', function ($attribute) {
                if (!file_exists($this->$attribute)) {
                    $this->addError($attribute, 'File does not exists');
                }
            }],
        ];
    }
}
