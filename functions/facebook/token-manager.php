<?php

class TokenManager
{

    protected $assetsStorage = ASSETS_DIR;
    protected $apiFacebookUrl = API_FACEBOOK_URL;
    protected $apiFacebookVersion = API_FACEBOOK_VERSION;
    protected $request = [];
    protected $accessToken = null;
    protected $key = null;
    protected $tokenStorageDir = null;

    /**
     * TokenManager constructor.
     */
    public function __construct()
    {
        $this->request = $_REQUEST;
        $this->accessToken = $_REQUEST['access_token'] ?? null;
        $this->key = $this->getKeyWithToken($this->accessToken) ?? null;
        $this->getTokenStorageLink($this->key);
    }

    /**
     * @param $token
     * @return bool|string
     */
    public function getKeyWithToken($token)
    {
        return substr($this->accessToken, 20, 7);
    }

    /**
     * @param $subDir
     * @return null|string
     */
    public function getTokenStorageLink($subDir)
    {
        $this->tokenStorageDir = $this->assetsStorage . 'token-storage/' . $subDir;
        return $this->tokenStorageDir;
    }

    /**
     * @return bool|mixed
     */
    public function add()
    {
        if ($this->fileExists()) {
            $data = $this->tokenExpired();
            if ($data) {
                $this->saveInfo($data);
                $result = $this->getInfo() ?? false;
                return $result;
            } else {
                return -1001;
            }
        } else {
            return -1002;
        }
    }

    /**
     * @param null $key
     * @return bool
     */
    public function fileExists($key = null)
    {
        if ($key) {
            $this->getTokenStorageLink($key);
        }
        if (!file_exists($this->tokenStorageDir)) {
            return true;
        }
        return false;
    }

    /**
     * @return bool|mixed
     */
    public function tokenExpired()
    {
        $fullUrl = $this->apiFacebookUrl . $this->apiFacebookVersion . '/me?access_token=' . $this->accessToken;
        $dataUser = json_decode(curl($fullUrl), true);

        if (isset($dataUser['error'])) {
            return false;
        }

        $checkPageLink = $this->apiFacebookUrl . $this->apiFacebookVersion . '/me/accounts?limit=5000&access_token=' . $this->accessToken;
        $accountData = json_decode(curl($checkPageLink), true);
        $tokenPage = [];

        if (isset($accountData['error'])) {
            $dataUser['type'] = 'page';
            $dataUser['token_page'] = json_encode($tokenPage);
        } else {
            $dataUser['type'] = 'account';

            foreach ($accountData['data'] as $page) {
                $tokenPage[] = $page['access_token'];
            }
            $dataUser['token_page'] = json_encode($tokenPage);

        }

        $dataUser['token'] = $this->accessToken;
        $dataUser['key'] = $this->key;

        return $dataUser;
    }

    /**
     * @param $data
     */
    public function saveInfo($data)
    {
        mkdir($this->tokenStorageDir);
        $this->createFile('name.txt', $data['name'], 'w');
        $this->createFile('id.txt', $data['id'], 'w');
        $this->createFile('type.txt', $data['type'], 'w');
        $this->createFile('token.txt', $data['token'], 'w');
        $this->createFile('key.txt', $data['key'], 'w');
        $this->createFile('token_page.txt', $data['token_page'], 'w');
    }

    /**
     * @param $fileName
     * @param $content
     * @param string $overWrite
     */
    public function createFile($fileName, $content, $overWrite = 'w')
    {
        $file = fopen($this->tokenStorageDir . '/' . $fileName, $overWrite);
        fwrite($file, $content);
        fclose($file);
    }

    /**
     * @return mixed
     */
    public function getInfo()
    {
        $data['name'] = $this->getFile('name.txt');
        $data['id'] = $this->getFile('id.txt');
        $data['type'] = $this->getFile('type.txt');
        $data['token'] = $this->getFile('token.txt');
        $data['key'] = $this->getFile('key.txt');
        $data['token_page'] = $this->getFile('token_page.txt');
        return $data;
    }

    /**
     * @param $fileName
     * @return bool|string
     */
    public function getFile($fileName)
    {
        $content = file_get_contents($this->tokenStorageDir . '/' . $fileName);
        return $content;
    }

    public function list()
    {
        $linkTokenStorage = $this->assetsStorage . 'token-storage';
        $listTokenInFolder = scandir($linkTokenStorage);
        $tokenList = [];
        foreach ($listTokenInFolder as $key) {
            if (is_dir($linkTokenStorage . '/' . $key) && !in_array($key, ['.', '..'])) {
                $tokenList[] = $key;
            }
        }
        return $tokenList;
    }

    /**
     * @param $id
     * @return bool|string
     */
    public function getWithId($id)
    {
        $this->key = $id;
        if (!$this->fileExists($this->key)) {
            return $this->getInfo();
        }
        return false;
    }

    /**
     * @param $token
     * @return bool|string
     */
    public function getWithToken($token)
    {
        $this->key = $this->getKeyWithToken($token);
        if (!$this->fileExists($this->key)) {
            return $this->getInfo();
        }
        return false;
    }

    public function deleteWithId($id)
    {
        $this->key = $id;
        if (!$this->fileExists($this->key)) {
            array_map('unlink', glob($this->tokenStorageDir . '/*.*'));
            rmdir($this->tokenStorageDir);
            return true;
        }
        return false;
    }

}