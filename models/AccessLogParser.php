<?php

namespace app\models;

use Yii;

/**
 * Parser class for apache log
 */
class AccessLogParser {
    
    /**
     * Limit to number of rows in a batch
     * @var integer
     */
    public $batchInsertLimit = 1000;

    /**
     * Processing apache log file
     * @param string $filename
     * @return boolean
     * @throws \Exception
     */
    public function run($filename) {
        $handle = fopen($filename, "r");
        if ($handle) {
            $n = 0;
            $buffer = [];
            while (($line = fgets($handle)) !== false) {
                $parsed = $this->parseRow($line);
                if ($parsed) {
                    $buffer[] = $parsed;
                    $n++;
                }
                
                if ($n >= $this->batchInsertLimit) {
                    $this->insertRows($buffer);
                    $n = 0;
                    $buffer = [];
                }
            }

            fclose($handle);
        } else {
            throw new \Exception('Cannot open log file');
        }
        return true;
    }
    
    /**
     * Parsing single row of log file into array
     * @param string $row
     * @return boolean|array
     */
    protected function parseRow($row) {
        $items = explode("\t", $row);
        if (count($items) < 9) {
            return false;
        }
        
        for ($i = 0; $i < count($items); $i++) {
            $char = substr($items[$i], 0, 1);
            if ($char === '"') {
                $items[$i] = trim($items[$i], '""');
            } elseif ($char === '[') {
                $items[$i] = trim($items[$i], '[]');
            }
            if ($items[$i] === '-') {
                $items[$i] = null;
            }
        }
        
        unset($items[2]);
        
        $items[3] = date('Y-m-d H:i:s', strtotime($items[3]));
        
        return array_values($items);
    }
    
    /**
     * Inserting parsed rows to db table
     * @param array $rows
     * @return mixed
     */
    protected function insertRows($rows) {
        return Yii::$app->db->createCommand()->batchInsert('access_log', [
            'ip',
            'url',
            'date',
            'headers',
            'status_code',
            'size',
            'referrer',
            'user_agent',
        ], $rows)->execute();
    }
}
