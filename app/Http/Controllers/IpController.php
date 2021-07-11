<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Stevebauman\Location\Facades\Location;

class IpController extends Controller
{

    public function index()
    {
        return view('dashboard/iran');
    }


    public function addRulesScript(){

        $path = storage_path() . '/app/iranIp.txt';
        $handle = fopen($path ,"r");
        
        if ($handle) {
            while (($line = fgets($handle)) !== false) {
                //remove \n from end of the line
                $line = rtrim($line);
                
                $src_ip = explode(" ",$line)[1];
                $dest_ip = explode(" ",$line)[2];

                $output=null;
                $retval=null;

                $command = 'sudo -S iptables -t filter -I INPUT -p tcp -m string --string "/iran" --algo kmp -m iprange --src-range '.$src_ip.'-'.$dest_ip.' -j ACCEPT';
            
                shell_exec($command);
            }
            shell_exec('sudo -S iptables -A INPUT -m string --string "/iran" --algo kmp --source 127.0.0.1 --jump REJECT');
        
            fclose($handle);
        } else {
           echo "error in openning file";
        } 

    }
}
