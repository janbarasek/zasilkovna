<?php
/**
 * Created by PhpStorm.
 * User: sadam
 * Date: 7.9.17
 * Time: 1:51
 */

namespace Salamek\Zasilkovna;

/**
 * Class Api
 * @package Salamek\Zasilkovna
 */
abstract class Api
{
    /** @var string */
    private $jsonEndpoint = 'http://www.zasilkovna.cz/api/v3/%s/branch.json';

    /** @var string */
    private $apiKey;

    /**
     * Api constructor.
     * @param $apiPassword
     * @param $apiKey
     */
    public function __construct($apiPassword, $apiKey)
    {
        $this->apiKey = $apiKey;

        $this->jsonEndpoint = sprintf($this->jsonEndpoint, $this->apiKey);
    }

    /**
     * @return mixed
     * @throws \Exception
     */
    public function getBranchList()
    {
        $result = file_get_contents($this->jsonEndpoint);
        if (!$result)
        {
            throw new \Exception('Failed to open JSON endpoint');
        }

        $data = json_decode($result);
        if (!$data)
        {
            throw new \Exception('Failed to decode JSON');
        }

        return $data;
    }
}