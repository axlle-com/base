<?php

namespace App\Components;

use Exception;
use SimpleXMLElement;

class CurrencyAgent
{
    private string $url = 'https://www.cbr.ru/scripts/XML_daily.asp';
    private string $urlReserve = 'https://www.cbr-xml-daily.ru/daily_utf8.xml';
    private int $date;
    private ?SimpleXMLElement $list = null;

    public function __construct(?int $to = null)
    {
        $this->date = $to ?? time();
    }

    /**
     * @return void
     */
    public function load(): void
    {
        try {
            $body = ['date_req' => date('d/m/Y', $this->date)];
            $this->list = simplexml_load_string(file_get_contents($this->url . '?' . http_build_query($body)));
        } catch (Exception $exception) {
        }
    }

    /**
     * @return SimpleXMLElement
     */
    public function getList(): SimpleXMLElement
    {
        if (empty($this->list)) {
            $this->load();
        }
        return $this->list;
    }
}
