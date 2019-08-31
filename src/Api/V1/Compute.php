<?php

namespace Rumd3x\CloudCone\Api\V1;

use Rumd3x\CloudCone\Api\V1\ApiAbstract;
use Tightenco\Collect\Support\Collection;

class Compute extends ApiAbstract
{

    /**
     * Get a list of all compute instances registered in your account
     *
     * @return Collection
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
     */
    public function getGraph(int $id)
    {
        $data = $this->doGet(sprintf('compute/%d/graphs', $id));
        return $data['__data'];
    }

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

        return $data;
    }

    public function destroy(int $id)
    {
        $data = $this->doGet(sprintf('compute/%d/destroy', $id));
        return $data;
    }

    public function boot(int $id)
    {
        $data = $this->doGet(sprintf('compute/%d/boot', $id));
        return $data;
    }

    public function reboot(int $id)
    {
        $data = $this->doGet(sprintf('compute/%d/reboot', $id));
        return $data;
    }

    public function reinstallOS(int $id, int $osId)
    {
        $data = $this->doPost(sprintf('compute/%d/reinstall', $id), ['os' => $osId]);
        return $data;
    }

    public function setRootPassword(int $id, string $password, bool $rebootAfter)
    {
        $data = $this->doPost(sprintf('compute/%d/reset/pass', $id), [
            'password' => $password,
            'reboot' => $rebootAfter,
        ]);

        return $data;
    }

    public function resizeInstance(int $id, int $cpu, int $ram, int $disk)
    {
        $data = $this->doPost(sprintf('compute/%d/resize', $id), [
            'cpu' => $cpu,
            'ram' => $ram,
            'disk' => $disk,
        ]);

        return $data;
    }

    public function shutdown(int $id)
    {
        $data = $this->doGet(sprintf('compute/%d/shutdown', $id));
        return $data;
    }

    public function vnc(int $id)
    {
        $data = $this->doGet(sprintf('compute/%d/vnc', $id));
        return $data;
    }
}
