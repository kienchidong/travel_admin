<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ConvertConstants extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'constants:convert';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Convert constants';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        try {

            $fileContent = '
            module.exports =  {
            #content
            };';
            $filename = base_path('constants/constants.php');
            $fp = fopen($filename, "r");

            $contents = fread($fp, filesize($filename));

            $contents = str_replace('<?php', '', $contents);
            $contents = str_replace('const ', '', $contents);
            $contents = str_replace('[', '{', $contents);
            $contents = str_replace(']', '}', $contents);
            $contents = str_replace(' = ', ': ', $contents);
            $contents = str_replace(' => ', ': ', $contents);
            $contents = str_replace(';', ',', $contents);
            $contents = str_replace('#content', trim($contents), $fileContent);

            fclose($fp);

           /* if (!file_exists(resource_path() . '\layouts\js\constants.js')) {
                touch(resource_path() . '\layouts\js\constants.js');
            }*/

            $jsConst = fopen(resource_path('layouts/js/constants.js'), 'w');
            fwrite($jsConst, trim($contents));
            fclose($jsConst);

            print 'convert success';
        } catch (\Throwable $e) {
            print $e->getMessage();
        }
    }
}
