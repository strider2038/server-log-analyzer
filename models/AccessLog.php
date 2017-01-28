<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "access_log".
 *
 * @property integer $id
 * @property string $ip
 * @property string $url
 * @property string $date
 * @property string $headers
 * @property integer $status_code
 * @property integer $size
 * @property string $referrer
 * @property string $user_agent
 */
class AccessLog extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'access_log';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['date'], 'safe'],
            [['status_code', 'size'], 'integer'],
            [['ip', 'url', 'headers', 'referrer', 'user_agent'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'ip' => 'User IP',
            'url' => 'Url',
            'date' => 'Datetime',
            'headers' => 'Headers',
            'status_code' => 'Status Code',
            'size' => 'Size',
            'referrer' => 'Referrer',
            'user_agent' => 'User Agent',
        ];
    }
}
