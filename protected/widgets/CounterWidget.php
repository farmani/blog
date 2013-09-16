<?php
/**
 * CounterWidget.php in blog.
 * User: Ramin Farmani ramin.farmani@gmail.com
 * Date: 9/16/13
 * Time: 2:01 PM
 */

class CounterWidget extends CWidget
{
    public $logFile;

    public function init()
    {
        $sessionID = Yii::app()->session->sessionID;
        $time = time();
        $onlineCheck = $time - 600;
        $todayCheck = $time - 600;
        $weekCheck = $time - 600;
        $monthCheck = $time - 600;
        $online = $today = $week = $month = $total = 1;
        $handle = fopen($this->logFile, "r+");
        if ($handle) {
            while (($line = fgets($handle)) !== false) {
                $line = trim($line);
                list($timeHit, $oldSessionID) = explode(';', $line);

                if ($oldSessionID != $sessionID) {
                    if ($timeHit > $onlineCheck) {
                        $online++;
                    }
                    if ($timeHit > $todayCheck) {
                        $today++;
                    }
                    if ($timeHit > $weekCheck) {
                        $week++;
                    }
                    if ($timeHit > $monthCheck) {
                        $month++;
                    }
                    $lines[] = $line;
                    $total++;
                }
            }
        }
        fclose($handle);
        file_put_contents($this->logFile, $time . ';' . $sessionID . PHP_EOL);
        if (!empty($lines)) {
            foreach ($lines as $line) {
                file_put_contents($this->logFile, $line . PHP_EOL, FILE_APPEND);
            }
        }


        $this->render(
            'counter', array(
                'online' => $online,
                'today' => $today,
                'week' => $week,
                'month' => $month,
                'total' => $total,
            )
        );
    }

}
