<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FileController extends Controller
{
    public function index()
    {
        $user = session('users');
    
        $listOfUserFile = null;

        $filesList =  $this->getFileList();
        $listOfUserFile = $this->getFileAccessByUser($filesList, $user);

        return view('dashboard/index', compact('listOfUserFile'));
    }


    /**
     * get all files in /file dir of system
     */
    public function getFileList()
    {
        $output = null;
        $retval = null;
        $command = 'cd /files';

        exec('cd /files; ls -a', $output, $retval);
        return $output;
    }

    /**
     * 
     */
    public function getFileAccessByUser($files, $user)
    {
        $fileWithReadAccess = array();

        foreach ($files as $value) {

            $output = null;
            $retval = null;
            $fileUsers = null;

            if ($value == "." || $value == "..") continue;

            exec('cd /files; getfacl ' . $value, $output, $retval);

            $fileUsersWithAcl = $this->getUserOfFile($output);
            
            $acl = array();
            $fileUsers = array();

            foreach ($fileUsersWithAcl as $v) {
                array_push($acl, $v[0]);
                array_push($fileUsers, $v[1]);
            }

            if (in_array($user, $fileUsers)) {

                if ($acl = $this->hasReadAccess($user, $acl)) {
                    array_push($fileWithReadAccess, [$value ,$acl]);
                }
            }
        }
        
        return $fileWithReadAccess;
    }

    /**
     * this function return users of getfacl output for passed getfacl
     */
    public function getUserOfFile($getFaclOutput)
    {
        $usersWithAccess = array();
        $username = null;
        $aclString = null;

        foreach ($getFaclOutput as $value) {

            if (str_starts_with($value, 'user:')) {

                if (str_starts_with($value, 'user::')) continue;

                $aclString = explode(':', $value);
                $username = $aclString[1];
                array_push($usersWithAccess, [$value, $username]);
            }
        }

        return $usersWithAccess;
    }


    /**
     * check if user has read access
     */
    public function hasReadAccess($user, $access)
    {
        $userAccess = array();
        $accesses = null;
        $username = null;
        $aclString = null;
        $userAcl = null;

        foreach ($access as $value) {
                
            if (str_starts_with($value, 'user:')) {

                if (str_starts_with($value, 'user::')) continue;

                $aclString = explode(':', $value);
                $username = $aclString[1];
                $accesses = $aclString[2];
                
                if (strcmp($username, $user) == 0) {
                
                    if(str_starts_with($accesses, "r")){
                        return $accesses;
                    }
                }
            }
        }
    }

}
