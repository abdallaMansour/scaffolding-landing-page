<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        $this->clearDirectories();

        $this->call(PermissionsSeeder::class);
        $this->call(SeoDatabaseSeeder::class);
        $this->call(SettingDatabaseSeeder::class);
        $this->call(ContactUsSeeder::class);

        $dev = User::factory()->create([
            'name' => 'Developer',
            'email' => 'dev@dev.com',
        ]);

        $dev->syncRoles(['super_admin']);

        $dev->save();

        $role = User::factory()->create([
            'name' => 'Role user',
            'email' => 'role@role.com',
        ]);

        $role->syncRoles(['role']);

        $role->save();

        $seo = User::factory()->create([
            'name' => 'SEO',
            'email' => 'seo@seo.com',
        ]);

        $seo->syncRoles(['seo']);

        $seo->save();

        $info = User::factory()->create([
            'name' => 'Info',
            'email' => 'info@asos.sa',
        ]);

        $info->syncRoles(['super_admin']);

        $info->save();

        $wali = User::factory()->create([
            'name' => 'Waly',
            'email' => 'waly@asos.sa',
        ]);

        $wali->syncRoles(['super_admin']);

        $wali->save();
    }


    public function clearDirectories()
    {
        // Path to the storage/app/public directory
        $storagePath = storage_path('app/public');

        // Delete all folders inside the storage path
        $folders = File::directories($storagePath);

        foreach ($folders as $folder) {
            File::deleteDirectory($folder);
        }

        echo ('All folders in the storage path have been deleted.');
    }
}
