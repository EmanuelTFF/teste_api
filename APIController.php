<?php
class APIController {
    private $weatherApiKey = '96aced219bab41b63b356d3aaa686953';
    private $weatherApiUrl = 'http://api.openweathermap.org/data/2.5/weather';
    private $cryptoApiUrl = 'https://api.coingecko.com/api/v3/simple/price';
    private $countryApiUrl = 'https://restcountries.com/v3.1/name/';
    private $catApiUrl = 'https://api.thecatapi.com/v1/images/search';
    private $conversionApiUrl = 'https://api.exchangerate-api.com/v4/latest/USD';

    public function getWeather($city) {
        $url = "{$this->weatherApiUrl}?q={$city}&appid={$this->weatherApiKey}&units=metric";
        return $this->fetchData($url);
    }

    public function getCryptoPrice($crypto) {
        $url = "{$this->cryptoApiUrl}?ids={$crypto}&vs_currencies=usd";
        return $this->fetchData($url);
    }

    public function getCountryInfo($country) {
        $url = "{$this->countryApiUrl}{$country}";
        return $this->fetchData($url);
    }

    public function getRandomCatImage() {
        return $this->fetchData($this->catApiUrl);
    }

    public function getConversionRate() {
        $url = $this->conversionApiUrl;
        return $this->fetchData($url);
    }

    private function fetchData($url) {
        $response = @file_get_contents($url); // Use @ to suppress warnings
        if ($response === FALSE) {
            // Log error message or handle it accordingly
            return null;
        }
        $data = json_decode($response, true);
        if (json_last_error() !== JSON_ERROR_NONE) {
            // Log JSON decode error
            return null;
        }
        return $data;
    }
}
?>
