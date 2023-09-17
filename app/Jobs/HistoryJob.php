<?php

namespace App\Jobs;

use App\Repositories\Interfaces\IHistoryRepository;
use App\Repositories\Interfaces\IIpRepository;

class HistoryJob extends BaseJob
{
    public array $data;

    public function __construct(array $data)
    {
        $this->data = $data;
        parent::__construct();
    }

    public function handle(IHistoryRepository $historyRepo, IIpRepository $ipRepo): void
    {
        $ip = $ipRepo->existOrCreate(['ip' => $this->data['ip'] ?? '127.0.0.1']);
        $this->data['ip_id'] = $ip?->id;
        $historyRepo->create($this->data);
    }
}
