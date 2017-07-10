<?php

class UpsShare
{
    protected $request = null;
    protected $id = null;
    protected $limit = 0;
    protected $apiFacebookUrl = API_FACEBOOK_URL;
    protected $apiFacebookVersion = API_FACEBOOK_VERSION;
    protected $assetsStorage = ASSETS_DIR;
    protected $array = [];
    protected $tokenList = [];

    public function __construct()
    {
        $this->request = $_REQUEST;
        $this->id = $this->request['id'] ?? null;
        $this->limit = isset($this->request['limit']) ? $this->request['limit'] : 0;
        $this->limitCount = isset($this->request['limit']) ? $this->request['limit'] : 0;
        $this->array = [
            'api_url' => $this->apiFacebookUrl . $this->apiFacebookVersion,
            'data' => []
        ];
        $this->getListToken();
    }

    public function getListToken()
    {
        $linkTokenStorage = $this->assetsStorage . 'token-storage';
        $listTokenInFolder = scandir($linkTokenStorage);
        foreach ($listTokenInFolder as $key) {
            if (is_dir($linkTokenStorage . '/' . $key) && !in_array($key, ['.', '..'])) {
                $this->tokenList[] = file_get_contents($linkTokenStorage . '/' . $key . '/token.txt');
            }
        }
        return $this->tokenList;
    }

    public function run()
    {
        if (!$this->checkLimit()) {
            return -1003;
        }
        $a = 0;
        for ($i = 1; $i <= $this->limit; $i++) {
            if ($a === count($this->tokenList) - 1) {
                $a = 0;
            }
            $this->createArray($this->tokenList[$a]);
            $a++;
        }
        $this->createJsonFile();
        return true;
    }

    public function checkLimit()
    {
        if ($this->limit > 500 || $this->limit < 1) {
            return false;
        }
        return true;
    }

    public function createArray($accessToken)
    {
        $this->array['data'][] = [
            'id' => $this->id,
            'access_token' => $accessToken
        ];
    }

    public function createJsonFile()
    {
        $file = fopen($this->assetsStorage . '/data-storage/facebook/up-share/' . $this->id . '.json', 'w');
        fwrite($file, json_encode($this->array));
        fclose($file);
    }

    public function getListUpShare()
    {
        $linkUpShareStorage = $this->assetsStorage . '/data-storage/facebook/up-share';
        $listPostInFolder = scandir($linkUpShareStorage);
        $sharePostList = [];
        foreach ($listPostInFolder as $key) {
            if (!in_array($key, ['.', '..'])) {
                $data = json_decode(file_get_contents($linkUpShareStorage . '/' . $key), true);
                $sharePostList[] = [
                    'id' => str_replace('.json', '', $key),
                    'share_count' => count($data['data'])
                ];
            }
        }
        return $sharePostList;
    }
}