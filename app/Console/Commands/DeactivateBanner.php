<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Banner;

class DeactivateBanner extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'banner:deactivate {id}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Deactivate a banner with the specified {id}';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $id = $this->argument('id');
        $banner = Banner::find($id);

        if(!$banner) {
            $this->error("ERROR: Banner with id = {$id} not found");
        } elseif (!$banner->is_active) {
            $this->error("ERROR: Banner with id = {$id} is already deactivated");
        } else {
            $banner->is_active = false;
            $banner->active_to = now();
            $banner->save();
            $this->info("Banner with id = {$id} deactivated");
        }
    }
}
