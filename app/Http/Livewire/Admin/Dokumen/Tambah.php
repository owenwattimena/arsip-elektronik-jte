<?php

namespace App\Http\Livewire\Admin\Dokumen;

use App\Services\UserService;
use Livewire\Component;

class Tambah extends Component
{
    protected UserService $userService;
    public string $dilihatOleh;
    public $users;
    public $dosenPlpId;
    public function boot()
    {
        $this->userService = app(UserService::class);
    }
    public function updatedDilihatOleh()
    {
        if($this->dilihatOleh!= null || $this->dilihatOleh != "")
        {
            if($this->dilihatOleh != 'all')
            {
                $this->users = $this->userService->get(role: $this->dilihatOleh);
            }else{
                $this->users = null;
            }
        }

    }

    public function render()
    {
        return view('livewire.admin.dokumen.tambah');
    }
}
