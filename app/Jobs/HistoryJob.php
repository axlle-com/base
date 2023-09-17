<?php

namespace App\Jobs;

use App\Models\History\History;
use App\Repositories\Interfaces\IHistoryRepository;
use App\Repositories\Interfaces\IIpRepository;
use Exception;
use Illuminate\Support\Facades\DB;

class HistoryJob extends BaseJob
{
    public array $data;

    public function __construct(array $data)
    {
        $this->data = $data;
        parent::__construct();
    }

    public function handle(
        IHistoryRepository $historyRepo,
        IIpRepository $ipRepo
    ): void {
        $data['ip'] = $this->data['ip'] ?? '127.0.0.1';
        $ipRepo->
        $historyRepo->create($data);
    }

    private function getData(): array
    {
        $this->data['ip_id'] = $this->getIpId();
        unset($this->data['ip']);
        return $this->data;
    }

    private function getIpId(): ?int
    {
        $post['ip'] = $this->data['ip'] ?? '127.0.0.1';
        return Ip::createOrUpdate($post)?->id;
    }
}
