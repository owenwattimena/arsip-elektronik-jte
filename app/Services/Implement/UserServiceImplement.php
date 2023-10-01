<?php
namespace App\Services\Implement;

use App\Models\DosenPlp;
use App\Models\DosenPlpProdi;
use App\Models\User;
use App\Repositories\Implement\ProgramStudiRepositoryImplement;
use App\Repositories\UserRepository;
use App\Repositories\DosenPlpRepository;
use App\Services\UserService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use PHPUnit\Event\Code\Throwable;

class UserServiceImplement implements UserService
{

    private UserRepository $userRepo;
    private DosenPlpRepository $dosenPlpRepo;
    private ProgramStudiRepositoryImplement $prodiRepo;


    public function __construct(UserRepository $userRepo, DosenPlpRepository $dosenPlpRepo, ProgramStudiRepositoryImplement $prodiRepo)
    {
        $this->userRepo = $userRepo;
        $this->dosenPlpRepo = $dosenPlpRepo;
        $this->prodiRepo = $prodiRepo;
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
        /**
         * ALGORITMA CREATE USER
         *
         * //1. Buat User::class baru
         * //2. Buat DosenPlp::class baru
         * //3. Jika user adalah Dosen
         * //4. Jika prodi tidak dipilih throw error
         * //5. Jika prodi dipilih maka tambahkan prodi user dosen
         * //6. Jika user adalah PLP
         * //7. ambil prodi plp
         * //8. jika prodi plp tidak ada
         * //9. Buat Prodi::class => plp
         * //10.  tambahkan prodi user plp
         * 11. Jika prodi plp ada maka tambahakn prodi plp
         */
        return DB::transaction(function () use ($data) {

            $user = [
                'username' => $data['username'],
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
                    if ($user->role == 'dosen') {
                        if (!isset($data['program_studi_id']))
                            throw new \Exception("Program studi tidak boleh kosong", 1);
                        foreach ($data['program_studi_id'] as $key => $value) {
                            $dosen_plp_prodi = [
                                'dosen_plp_id' => $dosenPlp->id,
                                'prodi_id' => $value,
                            ];
                            $this->dosenPlpRepo->createDosenPlpProdi($dosen_plp_prodi);
                        }
                    }
                    if ($user->role == 'plp') {
                        $prodiPlp = $this->prodiRepo->getPlp();
                        if (!$prodiPlp) {
                            if (!$this->prodiRepo->create(['program_studi' => 'PLP']))
                                throw new \Exception("Kesalahan saat membuat prodi", 1);

                            $prodiPlp = $this->prodiRepo->getPlp();
                        }
                        $dosen_plp_prodi = [
                            'dosen_plp_id' => $dosenPlp->id,
                            'prodi_id' => $prodiPlp->id,
                        ];
                        $this->dosenPlpRepo->createDosenPlpProdi($dosen_plp_prodi);
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
            $namaFoto = round(microtime(true) * 1000) . '.' . $foto->getClientOriginalExtension();
            // $namaFoto = Str::slug($data['nama_lengkap']) . '.' . $foto->getClientOriginalExtension();
            $foto->storeAs(config('app.photo_url'), $namaFoto);

            $data['foto'] = config('app.photo_url') . '/' . $namaFoto;
        }
        if ($this->dosenPlpRepo->update(\Auth::user()->dosenPlp->id, $data)) {
            if (isset($data['foto'])) {
                if ($oldPhoto) {
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
    public function get(?string $role): Collection
    {
        return $this->userRepo->get(role: $role);
    }
    public function findById(int $id): User
    {
        return $this->userRepo->findById($id);
    }
    public function changePassword(array $data): bool
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
