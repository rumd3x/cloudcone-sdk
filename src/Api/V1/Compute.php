<?php

namespace Rumd3x\CloudCone\Api\V1;

use Rumd3x\CloudCone\Api\V1\ApiAbstract;
use Tightenco\Collect\Support\Collection;
use GuzzleHttp\Exception\TransferException;

class Compute extends ApiAbstract
{

    /**
     * Get a list of all compute instances registered in your account
     *
     * @return Collection
     * @throws TransferException
     */
    public function getInstances()
    {
        $data = $this->doGet('compute/list/instances');
        return collect($data['__data']['instances']);
    }

    /**
     * Get a list of all available Operating Systems that can be installed on your compute instance
     *
     * @return Collection
     * @throws TransferException
     */
    public function getOSList()
    {
        $data = $this->doGet('compute/list/os');
        return collect($data['__data']);
    }

    /**
     * Get information on your compute instance
     *
     * @param integer $id
     * @return array
     * @throws TransferException
     */
    public function getInformation(int $id)
    {
        $data = $this->doGet(sprintf('compute/%d/info', $id));
        return $data['__data']['instances'];
    }

    /**
     * Get the current state of your compute instance
     *
     * @param integer $id
     * @return array
     * @throws TransferException
     */
    public function getStatus(int $id)
    {
        $data = $this->doGet(sprintf('compute/%d/info', $id));
        return $data['__data']['instances'];
    }

    /**
     * Monitor the status of your compute instance, from IO to Networking
     *
     * @param integer $id
     * @return array
     * @throws TransferException
     */
    public function getGraph(int $id)
    {
        $data = $this->doGet(sprintf('compute/%d/graphs', $id));
        return $data['__data'];
    }

    /**
     * Deploy a new compute instance
     *
     * @param string $hostname
     * @param integer $cpu
     * @param integer $ram
     * @param integer $disk
     * @param integer $ipv4Count
     * @param integer $os
     * @param boolean $ssd
     * @param boolean $pvtnet
     * @param boolean $ipv6
     * @param string $planId
     * @param string $nodeID
     * @return array
     * @throws TransferException
     */
    public function create(
        string $hostname,
        int $cpu,
        int $ram,
        int $disk,
        int $ipv4Count,
        int $os,
        bool $ssd,
        bool $pvtnet,
        bool $ipv6,
        string $planId = '',
        string $nodeID = ''
    ) {
        $data = $this->doPost('compute/create', [
            'hostname' => $hostname,
            'cpu' => $cpu,
            'ram' => $ram,
            'disk' => $disk,
            'ips' => $ipv4Count,
            'os' => $os,
            'ssd' => (int) $ssd,
            'pvtnet' => (int) $pvtnet,
            'ipv6' => $ipv6 ? 'on' : 'off',
            'plan' => $planId,
            'node' => $nodeID,
        ]);

        return $data['__data'];
    }

    /**
     * Destroys the specified compute instance
     *
     * @param integer $id
     * @return array
     * @throws TransferException
     */
    public function destroy(int $id)
    {
        $data = $this->doGet(sprintf('compute/%d/destroy', $id));
        return $data['__data'];
    }

    /**
     * Boot up an existing compute instance
     *
     * @param integer $id
     * @return array
     * @throws TransferException
     */
    public function boot(int $id)
    {
        $data = $this->doGet(sprintf('compute/%d/boot', $id));
        return $data['__data'];
    }

    /**
     * Reboot an existing compute instance
     *
     * @param integer $id
     * @return array
     * @throws TransferException
     */
    public function reboot(int $id)
    {
        $data = $this->doGet(sprintf('compute/%d/reboot', $id));
        return $data['__data'];
    }

    /**
     * Reinstall the Operating System on your compute instance
     *
     * @param integer $id
     * @param integer $osId
     * @return array
     * @throws TransferException
     */
    public function reinstallOS(int $id, int $osId)
    {
        $data = $this->doPost(sprintf('compute/%d/reinstall', $id), ['os' => $osId]);
        return $data['__data'];
    }

    /**
     * Reset the root password to your compute instance
     *
     * @param integer $id
     * @param string $password
     * @param boolean $rebootAfter
     * @return array
     * @throws TransferException
     */
    public function setRootPassword(int $id, string $password, bool $rebootAfter)
    {
        $data = $this->doPost(sprintf('compute/%d/reset/pass', $id), [
            'password' => $password,
            'reboot' => $rebootAfter,
        ]);

        return $data['__data'];
    }

    /**
     * Modify an existing compute instance with components
     *
     * @param integer $id
     * @param integer $cpu
     * @param integer $ram
     * @param integer $disk
     * @return array
     * @throws TransferException
     */
    public function resizeInstance(int $id, int $cpu, int $ram, int $disk)
    {
        $data = $this->doPost(sprintf('compute/%d/resize', $id), [
            'cpu' => $cpu,
            'ram' => $ram,
            'disk' => $disk,
        ]);

        return $data['__data'];
    }

    /**
     * Shutdown an existing compute instance
     *
     * @param integer $id
     * @return array
     * @throws TransferException
     */
    public function shutdown(int $id)
    {
        $data = $this->doGet(sprintf('compute/%d/shutdown', $id));
        return $data['__data'];
    }

    /**
     * VNC into the instance
     *
     * @param integer $id
     * @return array
     * @throws TransferException
     */
    public function vnc(int $id)
    {
        $data = $this->doGet(sprintf('compute/%d/vnc', $id));
        return $data['__data'];
    }
}
