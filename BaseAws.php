<?php
/**
 * @author Bryan Jayson Tan <bryantan16@gmail.com>
 * @link http://bryantan.info
 * @date 5/29/14
 * @time 9:39 PM
 */

namespace bryglen\aws;

use yii\base\Component;
use Aws\Common\Aws;
use yii\base\InvalidConfigException;

class BaseAws extends Component
{
    /**
     * @var
     */
    public $key;
    public $secret;
    public $region;

    public $configFile = false;

    private $_config;
    private $_aws = null;

    public function init()
    {
        if ($this->configFile === false) {
            if (!$this->key) {
                throw new InvalidConfigException('Key cannot be empty!');
            }
            if (!$this->secret) {
                throw new InvalidConfigException('Secret cannot be empty!');
            }
            if (!$this->region) {
                throw new InvalidConfigException('Region cannot be empty!');
            }
            $this->_config = [
                'key' => $this->key,
                'secret' => $this->secret,
                'region' => $this->region
            ];
        } else {
            if (!file_exists($this->configFile)) {
                throw new InvalidConfigException("{$this->configFile} does not exist");
            }
            $this->_config = $this->configFile;
        }
    }

    public function getAws()
    {
        if ($this->_aws === null) {
            $this->_aws = Aws::factory($this->_config);
        }

        return $this->_aws;
    }

    public function __call($method, $params)
    {
        $client = $this->getAws();
        if (method_exists($client, $method))
            return call_user_func_array(array($client, $method), $params);

        return parent::__call($method, $params);
    }
} 