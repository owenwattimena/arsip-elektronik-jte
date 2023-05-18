<?php
namespace App\Services\Implement;

use App\Models\DosenPlp;
use App\Models\DosenPlpProdi;
use App\Models\User;
use App\Repositories\UserRepository;
use App\Repositories\DosenPlpRepository;
use App\Services\UserService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class UserServiceImplement implements UserService
{

    private UserRepository $userRepo;
    private DosenPlpRepository $dosenPlpRepo;


    public function __construct(UserRepository $userRepo, DosenPlpRepository $dosenPlpRepo)
    {
        $this->userRepo = $userRepo;
        $this->dosenPlpRepo = $dosenPlpRepo;
    }
    public function totalDosen(): int
    {
        return $this->dosenPlpRepo->totalDosen();
    }
    public function totalPlp(): int
    {
        return $this->dosenPlpRepo->totalPlp();
    }
    public function getDosenPlpById(int $id): DosenPlp
    {
        return $this->dosenPlpRepo->getDosenPlpById($id);
    }
    public function getDosenPlpProdi(int $dosenPlpId, int $prodiId): DosenPlpProdi
    {
        return $this->dosenPlpRepo->getDosenPlpProdi($dosenPlpId, $prodiId);
    }
    public function create(array $data): bool
    {
        return DB::transaction(function () use ($data) {

            $user = [
                'username' => $data['nip'],
                'password' => $data['password'],
                'role' => $data['status'],
            ];
            $user = $this->userRepo->create($user);
            if ($user) {
                $dosen_plp = $data;

                unset($dosen_plp['status']);
                unset($dosen_plp['_token']);
                unset($dosen_plp['password']);
                unset($dosen_plp['password_confirmation']);

                $dosen_plp['user_id'] = $user->id;

                if (isset($dosen_plp['foto'])) {
                    $foto = $dosen_plp['foto'];
                    $namaFoto = Str::slug($dosen_plp['nama_lengkap']) . '.' . $foto->getClientOriginalExtension();
                    $foto->storeAs(config('app.photo_url'), $namaFoto);
                    $dosen_plp['foto'] = config('app.photo_url') . '/' . $namaFoto;
                }
                $dosenPlp = $this->dosenPlpRepo->create($dosen_plp);
                if ($dosenPlp) {
                    if (isset($data['program_studi_id'])) {
                        foreach ($data['program_studi_id'] as $key => $value) {
                            $dosen_plp_prodi = [
                                'dosen_plp_id' => $dosenPlp->id,
                                'prodi_id' => $value,
                            ];

                            $this->dosenPlpRepo->createDosenPlpProdi($dosen_plp_prodi);
                        }
                    }

                    return true;
                }

                $this->deleteFile(config('app.photo_url') . '/' . $namaFoto);

                return false;
            }
            return false;
        });

    }
    public function updateDosenPlp(array $data): bool
    {

        if (isset($data['foto'])) {
            $oldPhoto = \Auth::user()->dosenPlp->foto;
            $foto = $data['foto'];
            $namaFoto = Str::slug($data['nama_lengkap']) . '.' . $foto->getClientOriginalExtension();
            $foto->storeAs(config('app.photo_url'), $namaFoto);

            $data['foto'] = config('app.photo_url') . '/' . $namaFoto;
        }
        if ($this->dosenPlpRepo->update(\Auth::user()->dosenPlp->id, $data)){
            if (isset($data['foto'])) {
                if($oldPhoto)
                {
                    $this->deleteFile($oldPhoto);
                }
            }
            return true;
        }

        $this->deleteFile(config('app.photo_url') . '/' . $namaFoto);

        return false;
    }
    public function delete(int $id): bool
    {
        return false;
    }
    public function getAll(): Collection
    {
        return $this->userRepo->getAll()->where('role', '!=', 'admin');
    }
    public function findById(int $id): User
    {
        return User::all()->first();
    }
    public function changePassword(array $data):bool
    {
        return $this->userRepo->changePassword(
            \Auth::user()->id,
            $data['password']
        );
    }

    protected function deleteFile(
        string $filePath
    ) {
        if (Storage::exists($filePath)) {
            Storage::delete($filePath);
        }
    }
}
