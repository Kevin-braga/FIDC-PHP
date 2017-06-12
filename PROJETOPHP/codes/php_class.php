<?php
class FTPClient
{
    private $connectionId;
    private $loginOk = false;
    private $messageArray = array();

private function logMessage($message) 
{
    $this->messageArray[] = $message;
}

public function getMessages()
{
    return $this->messageArray;
}
    
public function ftpconnect ()
{   
    
    $ftpserver = '179.124.33.159';
    $ftpUser = 'jive.anuencia';
    $ftpPassword = 'Jive@123';
    $isPassive = false;
    // *** Set up basic connection
    $this->connectionId = ftp_connect($ftpserver);
 
    // *** Login with username and password
    $loginResult = ftp_login($this->connectionId, $ftpUser, $ftpPassword);
 
    // *** Sets passive mode on/off (default off)
    ftp_pasv($this->connectionId, $isPassive);
 
    // *** Check connection
    if ((!$this->connectionId) || (!$loginResult)) {
        $this->logMessage('FTP connection has failed!');
        $this->logMessage('Attempted to connect to ' . $ftpserver . ' for user ' . $ftpUser, true);
        return false;
    } else {
        $this->logMessage('Connected to ' . $ftpserver . ', for user ' . $ftpUser);
        $this->loginOk = true;
        return true;
    }
}
public function downloadFile ($fileFrom, $fileTo)
{
 
    // *** Set the transfer mode
    $asciiArray = array('txt', 'csv');
    $extension = end(explode('.', $fileFrom));
    if (in_array($extension, $asciiArray)) {
        $mode = FTP_ASCII;      
    } else {
        $mode = FTP_BINARY;
    }
 
    // try to download $remote_file and save it to $handle
    if (ftp_get($this->connectionId, $fileTo, $fileFrom, $mode, 0)) {
 
        return true;
        $this->logMessage(' file "' . $fileTo . '" successfully downloaded');
    } else {
 
        return false;
        $this->logMessage('There was an error downloading file "' . $fileFrom . '" to "' . $fileTo . '"');
    }
 
}
}?>