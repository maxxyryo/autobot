<?php

namespace App\Console\Commands;

use App\Console\Kernel;
use App\Traits\Signals;
use App\Traits\OHLC;
use Illuminate\Console\Command;
use App\Util;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;
use AndreasGlaser\PPC\PPC; // https://github.com/andreas-glaser/poloniex-php-client

/**
 * Class ExampleCommand
 * @package App\Console\Commands
 */

class SignalsExampleCommand extends Command {

    use Signals,
        OHLC;

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'bowhead:example_signals';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Forex signals example';

    public function doColor($val) {
        if ($val == 0) {
            return 'none';
        }
        if ($val == 1) {
            return 'green';
        }
        if ($val == -1) {
            return 'magenta';
        }
        return 'none';
    }

    /**
     * @return null
     *
     *  this is the part of the command that executes.
     */
    public function handle() {
        echo "PRESS 'q' TO QUIT AND CLOSE ALL POSITIONS\n\n\n";
        stream_set_blocking(STDIN, 0);

        while (1) {
            $instruments = ['BTC/USD'];

            $util = new Util\BrokersUtil();
            $console = new \App\Util\Console();
            $indicators = new \App\Util\Indicators();

            $this->signals(false, false, $instruments);

            $back = $this->signals(1, 2, $instruments);
            print_r($back);

            sleep(5);
        }


        return null;
    }

}
