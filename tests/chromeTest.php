<?php
use Facebook\WebDriver;
use Facebook\WebDriver\WebDriverExpectedCondition;
use Facebook\WebDriver\WebDriverBy;
use Facebook\WebDriver\Remote;
use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\Remote\DesiredCapabilities;
 
class chromeTest extends PHPUnit_Framework_TestCase 
{
    public function testWebUI()
    {
        // ドライバーの起動
        $host = 'http://localhost:4444/wd/hub';
        $driver = RemoteWebDriver::create(
            $host,
            DesiredCapabilities::chrome(),
            180 * 1000, // Connection timeout in miliseconds
            180 * 1000  // Request timeout in miliseconds
        );
 
        // テストページへ遷移
        $driver->get('https://www.google.co.jp/');
 
        // 「Google」というタイトルを取得できることを確認する
        $title = $driver->getTitle();
        $this->assertEquals("Google", $title);

        // スクリーンショットを取得
        $driver->takeScreenshot('tmp1.png');
 
        //ブラウザを閉じる
        $driver->close();
    }
}
